<?php
/**
 * This example get geo location information for addresses.
 *
 * PHP version 5
 *
 * Copyright 2009, Google Inc. All Rights Reserved.
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
 * @copyright  2009, Google Inc. All Rights Reserved.
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

/**
 * This example get geo location information for addresses.
 */
class GetGeoLocationInfo {
  static function main() {
    try {
      // Get AdWordsUser from credentials in "../auth.ini"
      // relative to the AdWordsUser.php file's directory.
      $user = new AdWordsUser();

      // Log SOAP XML request and response.
      $user->LogDefaults();

      // Get the GeoLocationService.
      $getLocationService = $user->GetGeoLocationService('v200909');

      // Create addresses.
      $addresses = array(
          new Address('1600 Amphitheatre Parkway', NULL, 'Mountain View',
              'US-CA', 'California', '94043', 'US'),
          new Address('76 Ninth Avenue', NULL, 'New York', 'US-NY', 'New York',
              '10011', 'US'),
          new Address('五四大街1号, Beijing东城区', NULL, NULL, NULL, NULL,
              NULL, 'CN'));

      // Create selector.
      $selector = new GeoLocationSelector($addresses);

      // Get geo locations.
      $geoLocations = $getLocationService->get($selector);

      // Display geo locations.
      if (isset($geoLocations)) {
        foreach ($geoLocations as $geoLocation) {
          if (!$geoLocation instanceof InvalidGeoLocation) {
            print 'Address "' . $geoLocation->address->streetAddress
                . '" has latitude "'
                . $geoLocation->geoPoint->latitudeInMicroDegrees
                . '" and longitude "'
                . $geoLocation->geoPoint->longitudeInMicroDegrees
                . "\".\n";
          } else {
            print "Invalid geo location returned.\n";
          }
        }
      } else {
        print "No geo locations were returned.\n";
      }
    } catch (Exception $e) {
      print_r($e);
    }
  }
}

GetGeoLocationInfo::main();
