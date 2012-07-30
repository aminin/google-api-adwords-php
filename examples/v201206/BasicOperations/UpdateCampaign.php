<?php
/**
 * This example updates the budget delivery method of a campaign. To get
 * campaigns, run GetCampaigns.php.
 *
 * Tags: CampaignService.mutate
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
 * @subpackage v201206
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
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
 * @param string $campaignId the ID of the campaign to update
 */
function UpdateCampaignExample(AdWordsUser $user, $campaignId) {
  // Get the service, which loads the required classes.
  $campaignService = $user->GetService('CampaignService', 'v201206');

  // Create campaign using an existing ID.
  $campaign = new Campaign();
  $campaign->id = $campaignId;

  // Updated the budget delivery method.
  $campaign->budget = new Budget();
  $campaign->budget->deliveryMethod = 'ACCELERATED';

  // Create operation.
  $operation = new CampaignOperation();
  $operation->operand = $campaign;
  $operation->operator = 'SET';

  $operations = array($operation);

  // Make the mutate request.
  $result = $campaignService->mutate($operations);

  // Display result.
  $campaign = $result->value[0];
  printf("Campaign with id '%s' has updated budget delivery method '%s'.\n",
      $campaign->id, $campaign->budget->deliveryMethod);
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
  UpdateCampaignExample($user, $campaignId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
