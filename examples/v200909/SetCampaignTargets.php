<?php
/**
 * This example adds geo, language, and network targeting to an existing
 * campaign. To get a campaign, run GetAllCampaigns.php.
 *
 * Tags: CampaignTargetService.mutate
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
 * @subpackage v200909
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @link       http://code.google.com/apis/adwords/v2009/docs/reference-v200909/CampaignTargetService.html
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

  // Get the CampaignTargetService.
  $campaignTargetService = $user->GetCampaignTargetService('v200909');

  $campaignId = (float) 'INSERT_CAMPAIGN_ID_HERE';

  // Create language targets.
  $langTargetList = new LanguageTargetList();
  $langTargetList->campaignId = $campaignId;
  $langTargetList->targets =
      array(new LanguageTarget('fr'), new LanguageTarget('ja'));

  // Create geo targets.
  $geoTargetList = new GeoTargetList();
  $geoTargetList->campaignId = $campaignId;
  $geoTargetList->targets =
      array(new CountryTarget('US'), new CountryTarget('JP'));

  // Create network targets.
  $networkTargetList = new NetworkTargetList();
  $networkTargetList->campaignId = $campaignId;
  // Specifying GOOGLE_SEARCH is necessary if you want to target SEARCH_NETWORK.
  $networkTargetList->targets = array(
      new NetworkTarget('GOOGLE_SEARCH'), new NetworkTarget('SEARCH_NETWORK'));

  // Create operations.
  $langTargetOperation = new CampaignTargetOperation();
  $langTargetOperation->operand = $langTargetList;
  $langTargetOperation->operator = 'SET';

  $geoTargetOperation = new CampaignTargetOperation();
  $geoTargetOperation->operand = $geoTargetList;
  $geoTargetOperation->operator = 'SET';

  $networkTargetOperation = new CampaignTargetOperation();
  $networkTargetOperation->operand = $networkTargetList;
  $networkTargetOperation->operator = 'SET';

  $operations = array($langTargetOperation, $geoTargetOperation,
      $networkTargetOperation);

  // Set campaign targets.
  $result = $campaignTargetService->mutate($operations);

  // Dispaly campaign targets.
  if (isset($result->value)) {
    foreach ($result->value as $targetList) {
      print 'Campaign target with campaign id "' . $targetList->campaignId
          . '" and type "' . $targetList->TargetListType . "\" was set.\n";
    }
  } else {
    print "No campaign targets were set.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
