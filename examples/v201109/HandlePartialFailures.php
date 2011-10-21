<?php
/**
 * This example demonstrates how to handle partial failures. To get ad groups
 * run GetAllAdGroups.php.
 *
 * Tags: AdGroupCriterionService.mutate
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
require_once 'Google/Api/Ads/Common/Util/ErrorUtils.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the AdGroupCriterionService with partial failure support enabled.
  $adGroupCriterionService = $user->GetService('AdGroupCriterionService',
      'v201109', NULL, NULL, NULL, TRUE);

  $adGroupId = 'INSERT_AD_GROUP_ID_HERE';

  // Create keywords.
  $keywords = array();
  $keywords[] = new Keyword('mars cruise', 'BROAD');
  $keywords[] = new Keyword('inv\@lid cruise', 'BROAD');
  $keywords[] = new Keyword('venus cruise', 'BROAD');
  $keywords[] = new Keyword('b\(a\)d keyword cruise', 'BROAD');

  // Create biddable ad group criteria and operations.
  $operations = array();
  foreach ($keywords as $keyword) {
    $adGroupCriterion = new BiddableAdGroupCriterion();
    $adGroupCriterion->adGroupId = $adGroupId;
    $adGroupCriterion->criterion = $keyword;

    $operation = new AdGroupCriterionOperation();
    $operation->operand = $adGroupCriterion;
    $operation->operator = 'ADD';

    $operations[] = $operation;
  }

  // Add ad group criteria.
  $result = $adGroupCriterionService->mutate($operations);

  // Display ad group criteria.
  if (isset($result->value)) {
    foreach ($result->value as $adGroupCriterion) {
      if ($adGroupCriterion instanceof BiddableAdGroupCriterion) {
        printf("Ad group criterion with ad group id '%.0f', criterion id"
            . "'%.0f', and keyword '%s' was added.\n",
            $adGroupCriterion->adGroupId, $adGroupCriterion->criterion->id,
            $adGroupCriterion->criterion->text);
      }
    }
  } else {
    print "No ad group criteria were added.\n";
  }

  // Check for partial failures.
  if (isset($result->partialFailureErrors)) {
    foreach ($result->partialFailureErrors as $error) {
      $index = ErrorUtils::GetSourceOperationIndex($error);
      if (isset($index)) {
        $adGroupCriterion = $operations[$index]->operand;
        printf("Ad group criterion with ad group id '%.0f' and keyword '%s' "
            . "failed with error '%s'.\n", $adGroupCriterion->adGroupId,
            $adGroupCriterion->criterion->text, $error->errorString);
      } else {
        printf("Operations failed with error '%s'.\n", $error->errorString);
      }
    }
  }
} catch (Exception $e) {
  print $e->getMessage();
}
