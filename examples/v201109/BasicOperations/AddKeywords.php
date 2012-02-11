<?php
/**
 * This example adds keywords to an ad group. To get ad groups run
 * GetAdGroups.php.
 *
 * Tags: AdGroupCriterionService.mutate
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

// Add the library to the include path. This is not neccessary if you've already
// done so in your php.ini file.
$path = dirname(__FILE__) . '/../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

// Constants used in the example.
define('NUM_KEYWORDS', 5);

// Enter parameters required by the code example.
$adGroupId = 'INSERT_AD_GROUP_ID_HERE';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 * @param string $adGroupId the ID of the ad group to add the keywords to
 */
function AddKeywordsExample(AdWordsUser $user, $adGroupId) {
  // Get the service, which loads the required classes.
  $adGroupCriterionService =
      $user->GetService('AdGroupCriterionService', 'v201109');

  // Create keyword criteria.
  $criteria = array();
  for ($i = 0; $i < NUM_KEYWORDS; $i++) {
    $keyword = new Keyword();
    $keyword->text = 'mars cruise ' . uniqid();
    $keyword->matchType = 'BROAD';
    $criteria[] = $keyword;
  }

  // Create ad group criteria and operations.
  $operations = array();
  foreach ($criteria as $criterion) {
    $adGroupCriterion = new BiddableAdGroupCriterion();
    $adGroupCriterion->adGroupId = $adGroupId;
    $adGroupCriterion->criterion = $criterion;

    $operation = new AdGroupCriterionOperation();
    $operation->operand = $adGroupCriterion;
    $operation->operator = 'ADD';
    $operations[] = $operation;
  }

  // Make the mutate request.
  $result = $adGroupCriterionService->mutate($operations);

  // Display results.
  foreach ($result->value as $adGroupCriterion) {
    printf("Keyword with text '%s', match type '%s', and id '%s' was added.\n",
        $adGroupCriterion->criterion->text,
        $adGroupCriterion->criterion->matchType,
        $adGroupCriterion->criterion->id);
  }
}

// Don't run the example if the file is being included.
if (__FILE__ != realpath($_SERVER['PHP_SELF'])) {
  return;
}

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  AddKeywordsExample($user, $adGroupId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
