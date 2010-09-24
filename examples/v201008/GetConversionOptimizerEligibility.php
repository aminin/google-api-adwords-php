<?php
/**
 * This example shows how to check for conversion optimizer eligibility by
 * examining the conversionOptimizerEligibility field of the Campaign.
 *
 * Tags: CampaignService.get
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
 * @subpackage v201008
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @link       http://code.google.com/apis/adwords/v2009/docs/headers.html
 * @link       http://code.google.com/apis/adwords/v2009/docs/reference/CampaignService.html
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

  // Get the CampaignService.
  $campaignService = $user->GetCampaignService('v201008');

  $campaignId = (float) 'INSERT_CAMPAIGN_ID_HERE';

  // Create selector.
  $selector = new CampaignSelector();
  $selector->ids = array($campaignId);

  // Get campaigns.
  $page = $campaignService->get($selector);

  // Display campaigns.
  if (isset($page->entries)) {
    foreach ($page->entries as $campaign) {
      if ($campaign->conversionOptimizerEligibility->eligible) {
        printf("Campaign with name '%s' and id '%d' is eligible to use "
            . "conversion optimizer.\n", $campaign->name, $campaign->id);
      } else {
        printf("Campaign with name '%s' and id '%d' is not eligible to use "
            . "conversion optimizer for the reasons: %s.\n",
            $campaign->name, $campaign->id,
            implode(', ',
                $campaign->conversionOptimizerEligibility->rejectionReasons));
      }
    }
  } else {
    print "No campaigns were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
