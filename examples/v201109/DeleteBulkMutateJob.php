<?php
/**
 * This example deletes a bulk mutate job using the 'REMOVE' operator. Jobs may
 * only deleted if they are in the 'PENDING' state and have not yet receieved
 * all of their request parts. To get bulk mutate jobs,
 * run GetAllBulkMutateJobs.php.
 *
 * Tags: BulkMutateJobService.mutate
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
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the BulkMutateJobService.
  $bulkMutateJobService = $user->GetService('BulkMutateJobService', 'v201109');

  $bulkMutateJobId = 'INSERT_BULK_MUTATE_JOB_ID_HERE';

  // Create BulkMutateJob.
  $bulkMutateJob = new BulkMutateJob();
  $bulkMutateJob->id = $bulkMutateJobId;

  // Create operation.
  $operation = new JobOperation();
  $operation->operand = $bulkMutateJob;
  $operation->operator = 'REMOVE';

  // Delete bulk mutate job.
  $bulkMutateJob = $bulkMutateJobService->mutate($operation);

  // Display bulk mutate jobs.
  if (isset($bulkMutateJob)) {
    printf("Bulk mutate job with id '%.0f' was deleted.\n", $bulkMutateJob->id);
  } else {
    print "No bulk mutate jobs were deleted.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
