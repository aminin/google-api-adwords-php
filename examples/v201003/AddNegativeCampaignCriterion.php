<?php
/**
 * This example adds a negative keyword to a campaign. To get campaigns, run
 * GetAllCampaigns.php.
 *
 * Tags: CampaignCriterionService.mutate
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
 * @subpackage v201003
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

  // Get the CampaignCriterionService.
  $campaignCriterionService =
      $user->GetService('CampaignCriterionService', 'v201003');

  $campaignId = (float) 'INSERT_CAMPAIGN_ID_HERE';

  // Create keyword.
  $keyword = new Keyword();
  $keyword->text = 'jupiter cruise';
  $keyword->matchType = 'BROAD';

  // Create negative campaign criterion.
  $negativeCampaignCriterion = new NegativeCampaignCriterion();
  $negativeCampaignCriterion->campaignId = $campaignId;
  $negativeCampaignCriterion->criterion = $keyword;

  // Create operations.
  $operation = new CampaignCriterionOperation();
  $operation->operand = $negativeCampaignCriterion;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Add campaign criteria.
  $result = $campaignCriterionService->mutate($operations);

  // Display campaign criteria.
  if (isset($result->value)) {
    foreach ($result->value as $campaignCriterion) {
      print 'Campaign criterion with campaign id "'
          . $campaignCriterion->campaignId . '", criterion id "'
          . $campaignCriterion->criterion->id . ', and type "'
          . $campaignCriterion->criterion->CriterionType . "\" was added.\n";
    }
  } else {
    print "No campaign criteria were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
