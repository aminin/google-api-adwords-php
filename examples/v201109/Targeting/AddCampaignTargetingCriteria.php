<?php
/**
 * This example adds various types of targeting criteria to a campaign. To get
 * campaigns, run BasicOperations/GetCampaigns.php.
 *
 * Tags: CampaignCriterionService.mutate
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

// Enter parameters required by the code example.
$campaignId = 'INSERT_CAMPAIGN_ID_HERE';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 * @param string $campaignId the id of the campaign to add targeting criteria to
 */
function AddCampaignTargetingCriteriaExample(AdWordsUser $user, $campaignId) {
  // Get the service, which loads the required classes.
  $campaignCriterionService =
      $user->GetService('CampaignCriterionService', 'v201109');

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

  // Display results.
  foreach ($result->value as $campaignCriterion) {
    printf("Campaign targeting criterion with id '%s' and type '%s' was "
        . "added.\n", $campaignCriterion->criterion->id,
        $campaignCriterion->criterion->CriterionType);
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
  AddCampaignTargetingCriteriaExample($user, $campaignId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
