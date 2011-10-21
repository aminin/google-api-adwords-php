<?php
/**
 * This example promotes an experiment, which permanently applies all the
 * experimental changes made to its related ad groups, criteria and ads.
 * To get experiments, run GetAllExperiments.php. To add an experiment, run
 * AddExperiment.php.
 *
 * Tags: ExperimentService.mutate
 * Restriction: adwords-only
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

  // Get the services.
  $experimentService = $user->GetService('ExperimentService', 'v201109');

  $experimentId = "INSERT_EXPERIMENT_ID_HERE";

  // Create experiment with PROMOTED status.
  $experiment = new Experiment();
  $experiment->id = $experimentId;
  $experiment->status = 'PROMOTED';

  // Create operations.
  $operation = new ExperimentOperation();
  $operation->operand = $experiment;
  $operation->operator = 'SET';

  $operations = array($operation);

  // Promote experiment.
  $result = $experimentService->mutate($operations);

  // Display experiments.
  if (isset($result->value)) {
    foreach ($result->value as $experiment) {
      printf ("Experiment with name '%s' and id '%.0f' was promoted.\n",
          $experiment->name, $experiment->id);
    }
  } else {
    print "No experiments were deleted.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
