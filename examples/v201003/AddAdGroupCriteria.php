<?php
/**
 * This example adds a keyword and a placement to an ad group. To get ad groups
 * run GetAllAdGroups.php.
 *
 * Tags: AdGroupCriterionService.mutate
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @subpackage v201003
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @link       http://code.google.com/apis/adwords/v2009/docs/reference/AdGroupCriterionService.html
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

  // Get the AdGroupCriterionService.
  $adGroupCriterionService = $user->GetAdGroupCriterionService('v201003');

  $adGroupId = (float) 'INSERT_AD_GROUP_ID_HERE';

  // Create keyword.
  $keyword = new Keyword();
  $keyword->text = 'mars cruise';
  $keyword->matchType = 'BROAD';

  // Create biddable ad group criterion.
  $keywordAdGroupCriterion = new BiddableAdGroupCriterion();
  $keywordAdGroupCriterion->adGroupId = $adGroupId;
  $keywordAdGroupCriterion->criterion = $keyword;

  // Create placement.
  $placement = new Placement();
  $placement->url = 'http://mars.google.com';

  // Create biddable ad group criterion.
  $placementAdGroupCriterion = new BiddableAdGroupCriterion();
  $placementAdGroupCriterion->adGroupId = $adGroupId;
  $placementAdGroupCriterion->criterion = $placement;

  // Create operations.
  $keywordAdGroupCriterionOperation = new AdGroupCriterionOperation();
  $keywordAdGroupCriterionOperation->operand = $keywordAdGroupCriterion;
  $keywordAdGroupCriterionOperation->operator = 'ADD';

  $placementAdGroupCriterionOperation = new AdGroupCriterionOperation();
  $placementAdGroupCriterionOperation->operand = $placementAdGroupCriterion;
  $placementAdGroupCriterionOperation->operator = 'ADD';

  $operations = array($keywordAdGroupCriterionOperation,
      $placementAdGroupCriterionOperation);

  // Add ad group criteria.
  $result = $adGroupCriterionService->mutate($operations);

  // Display ad group criteria.
  if (isset($result->value)) {
    foreach ($result->value as $adGroupCriterion) {
      print 'Ad group criterion with ad group id "'
          . $adGroupCriterion->adGroupId . '", criterion id "'
          . $adGroupCriterion->criterion->id . ', and type "'
          . $adGroupCriterion->criterion->CriterionType . "\" was added.\n";
    }
  } else {
    print "No ad group criteria were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
