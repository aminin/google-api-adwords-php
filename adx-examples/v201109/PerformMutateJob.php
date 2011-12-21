<?php
/**
 * This code sample illustrates how to perform asynchronous requests using the
 * MutateJobService
 *
 * Tags: MutateJobService.mutate, MutateJobService.get,
 * Tags: MutateJobService.getResults
 *
 * PHP version 5
 *
 * Copyright 2011, Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package    GoogleApiAdsAdWords
 * @subpackage v201109
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <eric.koleda@google.com>
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/Common/Util/ChoiceUtils.php';
require_once 'Google/Api/Ads/Common/Util/OgnlUtils.php';

// Define constants used in the example.
define('PLACEMENT_COUNT', 100);
define('MAX_RETRIES', 100);
define('RETRY_INTERVAL', 10);

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  $adGroupId = 'INSERT_AD_GROUP_ID_HERE';

  // Get the MutateJobService.
  $mutateJobService = $user->GetService('MutateJobService', 'v201109');

  // Generate operations.
  $operations = array();
  for ($i = 0; $i < PLACEMENT_COUNT; $i++) {
    $placement = new Placement();
    // Randomly add invalid characters to URLs.
    if (rand(0, 9) == 0) {
      $placement->url = uniqid('httpwwwexamplecom^');
    } else {
      $placement->url = uniqid('http://www.example.com/');
    }

    $adGroupCriterion = new BiddableAdGroupCriterion();
    $adGroupCriterion->adGroupId = $adGroupId;
    $adGroupCriterion->criterion = $placement;

    $operation = new AdGroupCriterionOperation();
    $operation->operator = 'ADD';
    $operation->operand = $adGroupCriterion;
    $operations[] = $operation;
  }

  // You can specify up to 3 job IDs that must successfully complete before
  // this job can be processed. We won't set any in this example.
  $policy = new BulkMutateJobPolicy();
  $policy->prerequisiteJobIds = array();

  // Call mutate to create a new job.
  printf("Creating job with %d operations.\n", sizeof($operations));
  $job = $mutateJobService->mutate($operations, $policy);
  printf("Job with ID '%s' was created.\n", $job->id);

  // Create a selector for retrieving the job status and later its results.
  $selector = new BulkMutateJobSelector();
  $selector->jobIds[] = $job->id;
  $selector->includeStats = TRUE;
  $selector->includeHistory = TRUE;

  $numRetries = 0;
  do {
    sleep(RETRY_INTERVAL);
    $jobs = $mutateJobService->get($selector);
    $job = $jobs[0];
    switch ($job->status) {
      case 'PENDING':
        printf("The job has been pending for approximately %s.\n",
            strftime('%M:%S', time() - strtotime($job->history[0]->dateTime)));
        break;
      case 'PROCESSING':
        printf("The job is processing and approximately %d%% complete.\n",
            $job->stats->progressPercent);
        break;
      case 'COMPLETED':
        printf("The job is complete and took approximately %d seconds to "
            ."process.\n", $job->stats->processingTimeMillis / 100);
        break;
      case 'FAILED':
        printf("The job failed with reason '%s'.\n",
            ChoiceUtils::GetValue($job->failureReason));
        break;
    }
    $numRetries++;
  } while (($job->status == 'PENDING' || $job->status == 'PROCESSING') &&
        $numRetries < MAX_RETRIES);

  if ($job->status == 'COMPLETED') {
    // Retrieve the results of the job.
    $jobResult = ChoiceUtils::GetValue(
        $mutateJobService->getResult($selector));

    // Sort the placements into groups based on the results.
    $lost = array();
    $skipped = array();
    $failed = array();
    $errors = array();
    $genericErrors = array();

    // Examines the errors to determine which placements failed to be applied.
    foreach ($jobResult->errors as $error) {
      $index = OgnlUtils::GetOperationIndex($error->fieldPath);
      if (isset($index)) {
        $placement = $operations[$index]->operand->criterion->url;
        switch ($error->reason) {
          case 'LOST_RESULT':
            $lost[] = $placement;
            break;
          case 'UNPROCESSED_RESULT':
          case 'BATCH_FAILURE':
            $skipped[] = $placement;
            break;
          default:
            if (!in_array($placement, $failed)) {
              $failed[] = $placement;
            }
            $errors[$placement][] = $error;
        }
      } else {
        $genericErrors[] = $error;
      }
    }

    // Examples the results to determine which placements were added
    // successfully.
    $succeeded = array();
    for ($i = 0; $i < sizeof($jobResult->results); $i++) {
      $operation = $operations[$i];
      $result = ChoiceUtils::GetValue($jobResult->results[$i]);
      if ($result instanceof AdGroupCriterion) {
        $succeeded[] = $result->criterion->url;
      }
    }

    // Display the results of the job.
    printf("%d placements were added successfully: %s\n", sizeof($succeeded),
        implode(', ', $succeeded));

    printf("%d placements were skipped and should be retried: %s\n",
        sizeof($skipped), implode(', ', $skipped));

    printf("%d placements were not added due to errors:\n", sizeof($failed));
    foreach ($failed as $placement) {
      $errorStrings = array();
      foreach ($errors[$placement] as $error) {
        $errorStrings[] = $error->errorString;
      }
      printf("- %s: %s\n", $placement, implode(', ', $errorStrings));
    }

    printf("%d generic errors were encountered:\n", sizeof($genericErrors));
    foreach($genericErrors as $error) {
      printf("- %s\n", $error->errorString);
    }
  }
} catch (Exception $e) {
  print $e->getMessage();
}
