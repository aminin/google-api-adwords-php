<?php
/**
 * This example adds a location ad extension to a campaign for a location
 * obtained from the GeoLocationService. To get campaigns, run
 * BasicOperations/GetCampaigns.php.
 *
 * Tags: GeoLocationService.get, CampaignAdExtensionService.mutate
 * Restriction: adwords-only
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
 * @param string $campaignId the id of the campaign to the ad the extension to
 */
function AddLocationExtensionExample(AdWordsUser $user, $campaignId) {
  // Get the services, which loads the required classes.
  $geoLocationService = $user->GetService('GeoLocationService', 'v201109');
  $campaignAdExtensionService =
      $user->GetService('CampaignAdExtensionService', 'v201109');

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

  // Make the get request.
  $result = $geoLocationService->get($selector);

  // Display result.
  $geoLocation = $result[0];
  if ($geoLocation->GeoLocationType != 'InvalidGeoLocation') {
    $lat = $geoLocation->geoPoint->latitudeInMicroDegrees /
        AdWordsConstants::MICRO_DEGREES_PER_DEGREE;
    $long = $geoLocation->geoPoint->longitudeInMicroDegrees /
        AdWordsConstants::MICRO_DEGREES_PER_DEGREE;
    printf("Address with street '%s' and lat/long '%s/%s' was found.\n",
        $geoLocation->address->streetAddress, $lat, $long);
  } else {
    printf("Address with street '%s' could not be found.\n",
        $address->streetAddress);
    exit;
  }

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

  // Create operation.
  $operation = new CampaignAdExtensionOperation();
  $operation->operand = $campaignAdExtension;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Make the mutate request.
  $result = $campaignAdExtensionService->mutate($operations);

  // Display result.
  $campaignAdExtension = $result->value[0];
  printf("Location extension with street address '%s' and id '%s' was added.\n",
      $campaignAdExtension->adExtension->address->streetAddress,
      $campaignAdExtension->adExtension->id);
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
  AddLocationExtensionExample($user, $campaignId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
