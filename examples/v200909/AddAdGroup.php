<?php
/**
 * This example adds an ad group to a campaign. To get campaigns, run
 * GetAllCampaigns.php.
 *
 * Tags: AdGroupService.mutate
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
 * @subpackage v200909
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

  // Get the AdGroupService.
  $adGroupService = $user->GetService('AdGroupService', 'v200909');

  $campaignId = (float) 'INSERT_CAMPAIGN_ID_HERE';

  // Create ad group.
  $adGroup = new AdGroup();
  $adGroup->name = 'Earth to Mars Cruises #' . time();
  $adGroup->status = 'ENABLED';
  $adGroup->campaignId = $campaignId;

  // Create ad group bid.
  $adGroupBids = new ManualCPCAdGroupBids();
  $adGroupBids->keywordMaxCpc = new Bid(new Money(1000000));
  $adGroup->bids = $adGroupBids;

  // Create operations.
  $operation = new AdGroupOperation();
  $operation->operand = $adGroup;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Add ad group.
  $result = $adGroupService->mutate($operations);

  // Display ad groups.
  if (isset($result->value)) {
    foreach ($result->value as $adGroup) {
      print 'Ad group with name "' . $adGroup->name . '" and id "'
          . $adGroup->id . "\" was added.\n";
    }
  } else {
    print "No ad groups were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
