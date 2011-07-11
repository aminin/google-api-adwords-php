<?php
/**
 * This example creates a multi-part bulk mutate job and polls for the results
 * of the request. This example is broken up into several snippets of logic
 * which will better demonstrate the best-practice usage of the
 * BulkMutateJobService. Though the bulk mutate job service is capable of more
 * complex operations, this example will show how you can easily upgrade from
 * normal mutate calls to using bulk mutate jobs.
 *
 * Tags: BulkMutateJobService.mutate, BulkMutateJobService.get
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
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/Common/Util/MediaUtils.php';

// IDs required for this example.
$campaignId = (float) 'INSERT_CAMPAIGN_ID_HERE';
$adGroupId1 = (float) 'INSERT_AD_GROUP_ID_BELONGING_TO_CAMPAIGN_ABOVE_HERE';
$adGroupId2 =
    (float) 'INSERT_ANOTHER_AD_GROUP_ID_BELONGING_TO_CAMPAIGN_ABOVE_ID_HERE';

/**
 * Creates an array of ad group ad operations to be performed by the
 * BulkMutateJobService.
 * @param $adGroupId1 the ad group to which half the ads will be added
 * @param $adGroupId2 the ad group to which half the ads will be added
 * @return array an array of ad group ad operations to be performed by the
 *     BulkMutateJobService
 * @access private
 */
function CreateAdGroupAdOperations($adGroupId1, $adGroupId2) {
  $operations = array();

  // Create 10 image ads.
  for ($i = 0; $i < 10; $i++) {
    // Create image.
    $image = new Image();
    $image->data = MediaUtils::GetBase64Data('http://goo.gl/HJM3L');

    // Create image ad.
    $imageAd = new ImageAd();
    $imageAd->name = 'Cruise to mars image ad #' . uniqid();
    $imageAd->displayUrl = 'www.example.com';
    $imageAd->url = 'http://www.example.com';
    $imageAd->image = $image;

    // Create ad group ad.
    $imageAdGroupAd = new AdGroupAd();
    $imageAdGroupAd->adGroupId =
        ($i % 2 == 0) ? $adGroupId1 : $adGroupId2;
    $imageAdGroupAd->ad = $imageAd;

    // Create operation.
    $imageAdGroupAdOperation = new AdGroupAdOperation();
    $imageAdGroupAdOperation->operand = $imageAdGroupAd;
    $imageAdGroupAdOperation->operator = 'ADD';

    $operations[] = $imageAdGroupAdOperation;
  }

  return $operations;
}

/**
 * Creates an array of ad group criterion operations to be performed by the
 * BulkMutateJobService.
 * @param $adGroupId1 the ad group to which half the criteria will be added
 * @param $adGroupId2 the ad group to which half the criteria will be added
 * @return array an array of ad group criterion operations to be performed by
 *     the BulkMutateJobService
 * @access private
 */
function CreateAdGroupCriterionOperations($adGroupId1, $adGroupId2) {
  $operations = array();

  // Create 100 placements.
  for ($i = 0; $i < 100; $i++) {
    $placement = new Placement();
    $placement->url = 'http://mars.google.com/' . uniqid();

    // Create biddable ad group criterion.
    $placementAdGroupCriterion = new BiddableAdGroupCriterion();
    $placementAdGroupCriterion->adGroupId =
        ($i % 2 == 0) ? $adGroupId1 : $adGroupId2;
    $placementAdGroupCriterion->criterion = $placement;

    // Create operation.
    $placementAdGroupCriterionOperation = new AdGroupCriterionOperation();
    $placementAdGroupCriterionOperation->operand = $placementAdGroupCriterion;
    $placementAdGroupCriterionOperation->operator = 'ADD';

    $operations[] = $placementAdGroupCriterionOperation;
  }

  return $operations;
}

/**
 * Creates and begins a bulk mutate job. Each array of operations from the
 * operationsByPart list corresponds to a single part of the request.
 * @param $bulkMutateJobService the service client to make the request against
 * @param $scopingEntityId the scoping entity ID of the request
 * @param $operationsByPart an array of operations seperated by part
 * @return int the id of the created bulk mutate job
 * @access private
 */
function CreateAndBeginJob($bulkMutateJobService,
    $scopingEntityId, $operationsByPart) {
  // Initialize the bulk mutate job id.
  $jobId = NULL;

  for ($partCounter = 0;  $partCounter < sizeof($operationsByPart);
      $partCounter++) {
    // Create operation stream.
    $opStream = new OperationStream();
    $opStream->scopingEntityId = $scopingEntityId;
    $opStream->operations = $operationsByPart[$partCounter];

    // Create bulk mutate request part.
    $part = new BulkMutateRequest();
    $part->partIndex = $partCounter;
    $part->operationStreams = array($opStream);

    // Create bulk mutate job.
    $job = new BulkMutateJob();
    $job->id = $jobId;
    $job->numRequestParts = sizeof($operationsByPart);
    $job->request = $part;

    // Create operation.
    $operation = new JobOperation();
    $operation->operand = $job;

    // If this is our first part, then the job must be added, not set.
    if ($partCounter == 0) {
      $operation->operator = 'ADD';
    } else {
      $operation->operator = 'SET';
    }

    // Add/set the job. The job will not start until all parts are added.
    $job = $bulkMutateJobService->mutate($operation);

    // Display notification.
    if ($partCounter == 0) {
      print 'Bulk mutate request with job id "' . $job->id
          . '" and part number "' . $partCounter . "\" was added.\n";
    } else {
      print 'Bulk mutate request with job id "' . $job->id
          . '" and part number "' . $partCounter . "\" was set.\n";
    }

    // Store job id.
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
function RetrieveResultsFromJob($bulkMutateJobService,
    $jobId) {
  $operationResultsByPart = array();

  // Create selector.
  $selector = new BulkMutateJobSelector();
  $selector->jobIds = array($jobId);

  // Loop while waiting for the job to complete.
  do {
    $jobs = $bulkMutateJobService->get($selector);
    $job = $jobs[0];

    print 'Bulk mutate job with id "' . $job->id . '" has status "'
        . $job->status . "\".\n";

    if (($job->status == 'PENDING') || ($job->status == 'PROCESSING')) {
      sleep(10);
    }
  } while (($job->status == 'PENDING') || ($job->status == 'PROCESSING'));

  if ($job->status == 'FAILED') {
    throw new ApiException(NULL, 'Job failed.');
  }

  for ($i = 0; $i < $job->numRequestParts; $i++) {
    // Set selector to retrieve results for part.
    $selector->resultPartIndex = $i;
    $jobsWithResult = $bulkMutateJobService->get($selector);
    $jobWithResult = $jobsWithResult[0];

    print 'Bulk mutate result with job id "' . $job->id . '" and part number "'
        . $i . "\" was retrieved.\n";

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
function ProcessResults($operationResults, $type) {
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

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the BulkMutateJobService.
  $bulkMutateJobService = $user->GetService('BulkMutateJobService', 'v201101');

  // Set scope of jobs.
  $scopingEntityId = new EntityId('CAMPAIGN_ID', $campaignId);

  // Create operations.
  $adGroupAdOperations = CreateAdGroupAdOperations($adGroupId1, $adGroupId2);
  $adGroupCriterionOperations = CreateAdGroupCriterionOperations($adGroupId1,
      $adGroupId2);

  $operationsByPart = array($adGroupAdOperations, $adGroupCriterionOperations);

  // Create and begin job.
  $jobId = CreateAndBeginJob($bulkMutateJobService,
      $scopingEntityId, $operationsByPart);

  // Mointor and retrieve results from job.
  $operationResultsByPart = RetrieveResultsFromJob(
      $bulkMutateJobService, $jobId);

  // Process results for part 1 that we know to be of type AdGroupAd.
  $adGroupAds = ProcessResults(
      $operationResultsByPart[0], 'AdGroupAd');

  // Process results for part 2 that we know to be of type AdGroupCriterion.
  $adGroupCriteria = ProcessResults(
      $operationResultsByPart[1], 'AdGroupCriterion');

  // Display results.
  foreach ($adGroupAds as $adGroupAd) {
    print 'Ad with id "' . $adGroupAd->ad->id . '" and type "'
        . $adGroupAd->ad->AdType . "\" was added.\n";
  }

  foreach ($adGroupCriteria as $adGroupCriterion) {
    print 'Ad group criterion with ad group id "'
        . $adGroupCriterion->adGroupId . '", criterion id "'
        . $adGroupCriterion->criterion->id . ', and type "'
        . $adGroupCriterion->criterion->CriterionType . "\" was added.\n";
  }

} catch (Exception $e) {
  print $e->getMessage();
}
