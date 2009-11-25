<?php
/**
 * This example creates a multi-part bulk mutate job and polls for the results
 * of the request. This example is broken up into several snippets of logic
 * which will better demonstrate the best-practice usage of the
 * BulkMutateJobService. Though the bulk mutate job service is capable of more
 * complex operations, this example will show how you can easily upgrade from
 * normal mutate calls to using bulk mutate jobs.
 *
 * PHP version 5
 *
 * Copyright 2009, Google Inc. All Rights Reserved.
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
 * @subpackage v200909
 * @category   WebServices
 * @copyright  2009, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

/**
 * This example creates a multi-part bulk mutate job and polls for the results
 * of the request. This example is broken up into several snippets of logic
 * which will better demonstrate the best practice usage of the
 * BulkMutateJobService. Though the bulk mutate job service is capable of more
 * complex operations, this example will show how you can easily upgrade from
 * normal mutate calls to using bulk mutate jobs.
 */
class BulkMutateJobExample {
  static function main() {
    try {
      // Get AdWordsUser from credentials in "../auth.ini"
      // relative to the AdWordsUser.php file's directory.
      $user = new AdWordsUser();

      // Log SOAP XML request and response.
      $user->LogDefaults();

      // Get the BulkMutateJobService.
      $bulkMutateJobService = $user->GetBulkMutateJobService();

      $campaignId = 'INSERT_CAMPAIGN_ID_HERE';
      $adGroupId1 = 'INSERT_AD_GROUP_ID_BELONGING_TO_CAMPAIGN_ABOVE_HERE';
      $adGroupId2 =
          'INSERT_ANOTHER_AD_GROUP_ID_BELONGING_TO_CAMPAIGN_ABOVE_ID_HERE';

      // Set scope of jobs.
      $scopingEntityId = new EntityId('CAMPAIGN_ID', $campaignId);

      // Create the operations listed by part.
      $operationsByPart = BulkMutateJobExample::CreateOperationsByPart(
          $adGroupId1, $adGroupId2);

      // Create and begin job.
      $jobId = BulkMutateJobExample::CreateAndBeginJob($bulkMutateJobService,
          $scopingEntityId, $operationsByPart);

      // Mointor and retrieve results from job.
      $operationResultsByPart = BulkMutateJobExample::RetrieveResultsFromJob(
          $bulkMutateJobService, $jobId);

      // Process results for part 1 that we know to be of type AdGroupAd.
      $adGroupAds = BulkMutateJobExample::ProcessResults(
          $operationResultsByPart[0], 'AdGroupAd');

      // Process results for part 2 that we know to be of type AdGroupCriterion.
      $adGroupCriteria = BulkMutateJobExample::ProcessResults(
          $operationResultsByPart[1], 'AdGroupCriterion');

      // Display results.
      foreach ($adGroupAds as $adGroupAd) {
        if ($adGroupAd->ad instanceof TextAd) {
          $textAd = $adGroupAd->ad;
          print 'New text ad with headline "' . $textAd->headline
              . '" and id "' . $textAd->id . '" was created.' . "\n";
        }
      }

      foreach ($adGroupCriteria as $adGroupCriterion) {
        if ($adGroupCriterion->criterion instanceof Keyword) {
          $keyword = $adGroupCriterion->criterion;
          print 'New keyword with text "' . $keyword->text . '" and id "'
              . $keyword->id . '" was created.' . "\n";
        }
      }

    } catch (Exception $e) {
      print_r($e);
    }
  }

  /**
   * Creates an array of operations to be performed by the BulkMutateJobService.
   * Each sub-array of the returned array is a separate part of the job.
   * @param $adGroupId1 the ad group in which two ads will be added
   * @param $adGroupId2 the ad group in which two keywords will be added
   * @return array an array of operations to be performed by the
   *     BulkMutateJobService
   * @access private
   */
  private static function CreateOperationsByPart($adGroupId1, $adGroupId2) {
    // Create list to store parts.
    $operationsByPart = array();

    // Create operands for part 1 operation.
    $ad1 = new TextAd('Luxury Cruise to Mars', 'Visit the Red Planet.',
        'Low-gravity fun', NULL, 'http://www.example.com',
        'http://www.example.com');
    $adGroupAd1 = new AdGroupAd($adGroupId1, $ad1, 'PAUSED');

    $ad2 = new TextAd('Luxury Hotels on Mars', 'Visit the Red Planet.',
        'Low-gravity fun', NULL, 'http://www.example.com',
        'http://www.example.com');
    $adGroupAd2 = new AdGroupAd($adGroupId2, $ad2, 'PAUSED');

    // Create operations for part 1.
    $operationsByPart[] = array(
        new AdGroupAdOperation($adGroupAd1, NULL, 'ADD'),
        new AdGroupAdOperation($adGroupAd2, NULL, 'ADD'));

    // Create operands for part 2 operation.
    $keyword1 = new Keyword('mars cruise', 'BROAD');
    $biddableAdGroupCriterion1 = new BiddableAdGroupCriterion();
    $biddableAdGroupCriterion1->adGroupId = $adGroupId1;
    $biddableAdGroupCriterion1->criterion = $keyword1;

    $keyword2 = new Keyword('mars hotel', 'EXACT');
    $biddableAdGroupCriterion2 = new BiddableAdGroupCriterion();
    $biddableAdGroupCriterion2->adGroupId = $adGroupId2;
    $biddableAdGroupCriterion2->criterion = $keyword2;

    // Create operations for part 2.
    $operationsByPart[] = array(
      new AdGroupCriterionOperation($biddableAdGroupCriterion1, NULL, 'ADD'),
      new AdGroupCriterionOperation($biddableAdGroupCriterion2, NULL, 'ADD'));

    return $operationsByPart;
  }

  /**
   * Creates and begins a bulk mutate job. Each array of operations from the
   * operationsByPart list corresponds to a single part of the request.
   * @param $bulkMutateJobService the service client to make the request against
   * @param $scopingEntityId the scoping entity ID of the request
   * @param $operationsByPart an array of operations seperated by part
   * @return int the id of the created BulkMutateJob
   * @access private
   */
  private static function CreateAndBeginJob($bulkMutateJobService,
      $scopingEntityId, $operationsByPart) {
    // Initialize the bulk mutate job id.
    $jobId = NULL;

    for ($partCounter = 0;  $partCounter < sizeof($operationsByPart);
        $partCounter++) {
      // Create bulk mutate job.
      $job = new BulkMutateJob();
      $job->id = $jobId;
      $job->numRequestParts = sizeof($operationsByPart);

      // Create the operation stream.
      $opStream = new OperationStream();
      $opStream->scopingEntityId = $scopingEntityId;
      $opStream->operations = $operationsByPart[$partCounter];

      // Create the bulk mutate request part.
      $part = new BulkMutateRequest();
      $part->partIndex = $partCounter;
      $part->operationStreams = array($opStream);

      // Set the part request in the job.
      $job->request = $part;

      // Create the operation to contain the job.
      $jobOperation = new JobOperation();
      $jobOperation->operand = $job;

      // If this is our first part, then the job must be added, not set.
      if ($partCounter == 0) {
        $jobOperation->operator = 'ADD';
      } else {
        $jobOperation->operator = 'SET';
      }

      // Add/set the job. The job will not start until all parts are added.
      $job = $bulkMutateJobService->mutate($jobOperation);

      // Store jobId.
      $jobId = $job->id;
    }

    return $jobId;
  }

  /**
   * Retrieves the results from a job that has all parts requested. When the
   * job has completed, this will return an array of operation results sepereted
   * by part.
   * @param $bulkMutateJobService the service client to make the request against
   * @param $jobId the id of the BulkMutateJob
   * @return array the operation results
   * @access private
   */
  private static function RetrieveResultsFromJob($bulkMutateJobService,
      $jobId) {
    $operationResultsByPart = array();

    // Create the selector for the job.
    $selector = new BulkMutateJobSelector();
    $selector->jobIds = array($jobId);

    // Loop while waiting for the job to complete.
    do {
      $jobs = $bulkMutateJobService->get($selector);
      $job = $jobs[0];
      sleep(10);
    } while (($job->status == 'PENDING')
        || ($job->status == 'PROCESSING'));

    if ($job->status == 'FAILED') {
      throw new ApiException(NULL, 'Job failed.');
    }

    for ($i = 0; $i < $job->numRequestParts; $i++) {
      // Set selector to retrieve results for part.
      $selector->resultPartIndex = $i;
      $jobsWithResult = $bulkMutateJobService->get($selector);
      $jobWithResult = $jobsWithResult[0];

      // Get the operation results.
      $operationResultsByPart[] =
          $jobWithResult->result->operationStreamResults[0]->operationResults;
    }

    return $operationResultsByPart;
  }

  /**
   * Proccess the operation results to create an array of return values.
   * @param operationResults the results retrieved from the operation stream
   *     result
   * @param type the type of the return value
   * @return array an array of return values
   * @access private
   */
  private static function ProcessResults($operationResults, $type) {
    $results = array();

    foreach ($operationResults as $operationResult) {
      if ($operationResult instanceof FailureResult) {
        // You can alternatively throw failureResult.getCause().
        print 'Results were not successful for reason(s): '
            . $operationResult->cause->message . "\n";
      } else if ($operationResult instanceof BatchFailureResult) {
        print 'Results were not successful in batch index of operation: '
            . $operationResult->operationIndexInBatch . "\n";
      } else if ($operationResult instanceof LostResult) {
        print "Results were lost.\n";
      } else if ($operationResult instanceof UnprocessedResult) {
        print "Results were unprocessed.\n";
      } else if ($operationResult instanceof ReturnValueResult) {
        $results[] = $operationResult->returnValue->$type;
      }
    }

    return $results;
  }
}

BulkMutateJobExample::main();
