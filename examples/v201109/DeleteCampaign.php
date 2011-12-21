<?php
/**
 * This example deletes a campaign by setting the status to 'DELETED'. To get
 * campaigns, run GetAllCampaigns.php.
 *
 * Tags: CampaignService.mutate
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
 * @author     Adam Rogal <api.arogal@gmail.com>
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

  // Get the CampaignService.
  $campaignService = $user->GetService('CampaignService', 'v201109');

  $campaignId = 'INSERT_CAMPAIGN_ID_HERE';

  // Create campaign with DELETED status.
  $campaign = new Campaign();
  $campaign->id = $campaignId;
  $campaign->status = 'DELETED';

  // Create operations.
  $operation = new CampaignOperation();
  $operation->operand = $campaign;
  $operation->operator = 'SET';

  $operations = array($operation);

  // Delete campaign.
  $result = $campaignService->mutate($operations);

  // Display campaigns.
  if (isset($result->value)) {
    foreach ($result->value as $campaign) {
      print 'Campaign with name "' . $campaign->name . '" and id "'
          . $campaign->id . "\" was deleted.\n";
    }
  } else {
    print "No campaigns were deleted.";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
