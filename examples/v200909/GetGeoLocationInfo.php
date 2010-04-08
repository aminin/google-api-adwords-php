<?php
/**
 * This example gets geo location information for addresses.
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
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @link       http://code.google.com/apis/adwords/v2009/docs/reference/GeoLocationService.html
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

  // Get the GeoLocationService.
  $getLocationService = $user->GetGeoLocationService('v200909');

  // Create addresses.
  $address1 = new Address();
  $address1->streetAddress = '1600 Amphitheatre Parkway';
  $address1->cityName = 'Mountain View';
  $address1->provinceCode = 'US-CA';
  $address1->postalCode = '94043';
  $address1->countryCode = 'US';

  $address2 = new Address();
  $address2->streetAddress = '76 Ninth Avenue';
  $address2->cityName = 'New York';
  $address2->provinceCode = 'US-NY';
  $address2->postalCode = '10011';
  $address2->countryCode = 'US';

  $address3 = new Address();
  $address3->streetAddress = '五四大街1号, Beijing东城区';
  $address3->countryCode = 'CN';

  // Create selector.
  $selector = new GeoLocationSelector();
  $selector->addresses = array($address1, $address2, $address3);

  // Get geo locations.
  $geoLocations = $getLocationService->get($selector);

  // Display geo locations.
  if (isset($geoLocations)) {
    foreach ($geoLocations as $geoLocation) {
      if ($geoLocation instanceof InvalidGeoLocation) {
        print "Invalid geo location was found.\n";
      } else {
        print 'Geo location with street address "'
            . $geoLocation->address->streetAddress . '", latitude "'
            . $geoLocation->geoPoint->latitudeInMicroDegrees
            . '", and longitude "'
            . $geoLocation->geoPoint->longitudeInMicroDegrees
            . "\" was found.\n";
      }
    }
  } else {
    print "No geo locations were found.\n";
  }
} catch (Exception $e) {
  print_r($e);
}
