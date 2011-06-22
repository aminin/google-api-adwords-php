<?php
/**
 * Functional tests for GeoLocationService.
 *
 * PHP version 5
 *
 * Copyright 2011, Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the 'License');
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an 'AS IS' BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package    GoogleApiAdsAdWords
 * @subpackage v201008
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

$path = dirname(__FILE__) . '/../../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once 'Google/Api/Ads/AdWords/v201008/GeoLocationService.php';

/**
 * Functional tests for GeoLocationService.
 *
 * @author api.ekoleda@gmail.com
 */
class GeoLocationServiceTest extends AdsTestCase {
  private $service;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetGeoLocationService();
  }

  /**
   * Test getting geocoding an address.
   * @param Address $address the address
   * @dataProvider addressProvider
   * @covers GeoLocationService::get
   */
  public function testGet($address) {
    $selector = new GeoLocationSelector(array($address));
    $geoLocations = $this->service->get($selector);

    $this->assertNotNull($geoLocations);
    $this->assertEquals(1, sizeof($geoLocations));
    $this->assertNotType('InvalidGeoLocation', $geoLocations[0]);
    $this->assertNotNull($geoLocations[0]->address);
    $this->assertNotNull($geoLocations[0]->geoPoint);
    $this->assertNotNull($geoLocations[0]->encodedLocation);
  }

  /**
   * Provides addresses for geocoding.
   * @return array an array of addresses (as an array)
   */
  public function addressProvider() {
    $data = array();

    // California.
    $data[] = array(new Address('1600 Amphitheatre Parkway', NULL,
        'Mountain View','US-CA', 'California', '94043', 'US'));

    // New York.
    $data[] = array(new Address('76 Ninth Avenue', NULL, 'New York', 'US-NY',
        'New York', '10011', 'US'));

    // China.
    $data[] = array(new Address('五四大街1号, Beijing东城区', NULL, NULL, NULL,
        NULL, NULL, 'CN'));
    return $data;
  }
}
