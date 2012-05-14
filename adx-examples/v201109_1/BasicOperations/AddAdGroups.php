<?php
/**
 * This example adds ad groups to a campaign. To get campaigns, run
 * GetCampaigns.php.
 *
 * Tags: AdGroupService.mutate
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
 * @subpackage v201109_1
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
 * @param string $campaignId the ID of the campaign to add the ad group to
 */
function AddAdGroupsExample(AdWordsUser $user, $campaignId) {
  // Get the service, which loads the required classes.
  $adGroupService = $user->GetService('AdGroupService', 'v201109_1');

  $numAdGroups = 2;
  $operations = array();
  for ($i = 0; $i < $numAdGroups; $i++) {
    // Create ad group.
    $adGroup = new AdGroup();
    $adGroup->campaignId = $campaignId;
    $adGroup->name = 'Earth to Mars Cruise #' . uniqid();

    // Set bids (required).
    $bids = new ManualCPMAdGroupBids();
    $bids->maxCpm = new Bid(new Money(1000000));
    $adGroup->bids = $bids;

    // Set additional settings (optional).
    $adGroup->status = 'ENABLED';

    // Create operation.
    $operation = new AdGroupOperation();
    $operation->operand = $adGroup;
    $operation->operator = 'ADD';
    $operations[] = $operation;
  }

  // Make the mutate request.
  $result = $adGroupService->mutate($operations);

  // Display result.
  $adGroups = $result->value;
  foreach ($adGroups as $adGroup) {
    printf("Ad group with name '%s' and id '%s' was added.\n", $adGroup->name,
        $adGroup->id);
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
  AddAdGroupsExample($user, $campaignId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
