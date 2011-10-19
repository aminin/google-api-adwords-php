<?php
/**
 * This example adds various types of targeting criteria to a campaign. To get
 * campaigns, run GetAllCampaigns.php.
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

  // Get the CampaignCriterionService.
  $campaignCriterionService =
      $user->GetService('CampaignCriterionService', 'v201109');

  $campaignId = 'INSERT_CAMPAIGN_ID_HERE';

  $campaignCriteria = array();

  // Create locations. The IDs can be found in the documentation or retrieved
  // with the LocationCriterionService.
  $california = new Location();
  $california->id = 21137;
  $campaignCriteria[] = new CampaignCriterion($campaignId, $california);

  $mexico = new Location();
  $mexico->id = 2484;
  $campaignCriteria[] = new CampaignCriterion($campaignId, $mexico);

  // Create languages. The IDs can be found in the documentation or retrieved
  // with the ConstantDataService.
  $english = new Language();
  $english->id = 1000;
  $campaignCriteria[] = new CampaignCriterion($campaignId, $english);

  $spanish = new Language();
  $spanish->id = 1003;
  $campaignCriteria[] = new CampaignCriterion($campaignId, $spanish);

  // Create platforms. The IDs can be found in the documentation.
  $mobile = new Platform();
  $mobile->id = 30001;
  $campaignCriteria[] = new CampaignCriterion($campaignId, $mobile);

  $tablets = new Platform();
  $tablets->id = 30002;
  $campaignCriteria[] = new CampaignCriterion($campaignId, $tablets);

  // Create operations.
  $operations = array();
  foreach ($campaignCriteria as $campaignCriterion) {
    $operations[] = new CampaignCriterionOperation($campaignCriterion, 'ADD');
  }

  // Make the mutate request.
  $result = $campaignCriterionService->mutate($operations);

  // Display the resulting campaign criteria.
  foreach ($result->value as $campaignCriterion) {
    printf("Campaign criterion with campaign id '%s', criterion id '%s', "
        . "and type '%s' was added.\n", $campaignCriterion->campaignId,
        $campaignCriterion->criterion->id,
        $campaignCriterion->criterion->CriterionType);
  }
} catch (Exception $e) {
  print $e->getMessage();
}
