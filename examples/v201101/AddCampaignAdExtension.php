<?php
/**
 * This example adds a location ad extension to a campaign for a location
 * obtained from the GeoLocationService. To get campaigns, run
 * GetAllCampaigns.php.
 *
 * Tags: GeoLocationService.get, CampaignAdExtensionService.mutate
 * Restriction: adwords-only
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
 * @subpackage v201101
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

  // Get the CampaignAdExtensionService.
  $campaignAdExtensionService =
      $user->GetService('CampaignAdExtensionService', 'v201101');

  // Get the GeoLocationService.
  $geoLocationService = $user->GetService('GeoLocationService', 'v201101');

  $campaignId = (float) 'INSERT_CAMPAIGN_ID_HERE';

  // Create address.
  $address = new Address();
  $address->streetAddress = '1600 Amphitheatre Parkway';
  $address->cityName = 'Mountain View';
  $address->provinceCode = 'US-CA';
  $address->postalCode = '94043';
  $address->countryCode = 'US';

  // Create geo location selector.
  $selector = new GeoLocationSelector();
  $selector->addresses = array($address);

  // Get geo location.
  $result = $geoLocationService->get($selector);
  $geoLocation = $result[0];

  // Create location extension.
  $locationExtension = new LocationExtension();
  $locationExtension->address = $geoLocation->address;
  $locationExtension->geoPoint = $geoLocation->geoPoint;
  $locationExtension->encodedLocation = $geoLocation->encodedLocation;
  $locationExtension->companyName = 'Google';
  $locationExtension->phoneNumber = '650-253-0000';
  $locationExtension->source = 'ADWORDS_FRONTEND';

  // Create campaign ad extension.
  $campaignAdExtension = new CampaignAdExtension();
  $campaignAdExtension->campaignId = $campaignId;
  $campaignAdExtension->adExtension = $locationExtension;

  // Create operations.
  $operation = new CampaignAdExtensionOperation();
  $operation->operand = $campaignAdExtension;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Add campaign ad extension.
  $result = $campaignAdExtensionService->mutate($operations);

  // Display campaign ad extensions.
  if (isset($result->value)) {
    foreach ($result->value as $campaignAdExtension) {
      print 'Campaign ad extension with campaign id "'
          . $campaignAdExtension->campaignId . '", ad extension id "'
          . $campaignAdExtension->adExtension->id . '", and type "'
          . $campaignAdExtension->adExtension->AdExtensionType
          . "\" was added.\n";
    }
  } else {
    print "No campaign ad extensions were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
