<?php
/**
 * This example gets a bulk mutate job and displays its status. To add a bulk
 * mutate job, run PerformBulkMutateJob.php.
 *
 * Tags: BulkMutateJobService.get
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
 * @subpackage v201101
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/Common/Util/ChoiceUtils.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the BulkMutateJobService.
  $bulkMutateJobService = $user->GetBulkMutateJobService('v201101');

  $bulkMutateJobId = (float) 'INSERT_BULK_MUTATE_JOB_ID_HERE';

  // Create selector.
  $selector = new BulkMutateJobSelector();
  $selector->jobIds = array($bulkMutateJobId);
  $selector->includeStats = TRUE;

  // Get all bulk mutate jobs.
  $bulkMutateJobs = $bulkMutateJobService->get($selector);

  // Display bulk mutate jobs.
  if (isset($bulkMutateJobs)) {
    foreach ($bulkMutateJobs as $bulkMutateJob) {
      printf("Bulk mutate job with id '%.0f' and status '%s' was found.\n",
          $bulkMutateJob->id, $bulkMutateJob->status);
      if ($bulkMutateJob->status == 'PENDING') {
        printf("  Total parts: %d, parts received: %d.\n",
            $bulkMutateJob->numRequestParts,
            $bulkMutateJob->numRequestPartsReceived);
      } else if ($bulkMutateJob->status == 'PROCESSING') {
        printf("  Percent complete: %d.\n",
            $bulkMutateJob->stats->progressPercent);
      } else if ($bulkMutateJob->status == 'COMPLETED') {
        printf("  Total operations: %d, failed: %d, unprocessed: %d.\n",
            $bulkMutateJob->stats->numOperations,
            $bulkMutateJob->stats->numFailedOperations,
            $bulkMutateJob->stats->numUnprocessedOperations);
      } else if ($bulkMutateJob->status == 'FAILED') {
        printf("  Failure reason: %s.\n",
            ChoiceUtils::GetValue($bulkMutateJob->failureReason));
      }
    }
  } else {
    print "No bulk mutate jobs were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
