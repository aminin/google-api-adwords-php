<?php
/**
 * Functional tests for CampaignTargetService.
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
require_once 'Google/Api/Ads/AdWords/v201008/CampaignTargetService.php';

/**
 * Functional tests for CampaignTargetService.
 */
class CampaignTargetServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    $suite->SetRequires(array('CAMPAIGN'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetService('CampaignTargetService');

    $this->campaignId = $this->sharedFixture['campaignId'];
  }

  /**
   * Test setting campaign targets.
   * @covers CampaignTargetService::mutate
   * @param $targetList the list of targets to set
   * @dataProvider targetListProvider
   */
  public function testSet($targetList) {
    $targetList->campaignId = $this->campaignId;

    $operations = array(new CampaignTargetOperation($targetList, 'SET'));
    $testTargetList = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('TargetListType', 'targets->TargetType');
    $this->assertEqualsWithExclusions($targetList, $testTargetList,
        $excludeFields);
  }

  /**
   * Test getting all campaign targets for a campaign.
   * @covers CampaignTargetService::get
   */
  public function testGetAllForCampaign() {
    $selector = new CampaignTargetSelector();
    $selector->campaignIds = array($this->campaignId);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    // One entry for each type of target list.
    $this->assertEquals(7, sizeof($page->entries));
  }

  /**
   * Test getting all campaign targets.
   * @covers CampaignTargetService::get
   */
  public function testGetAll() {
    $selector = new CampaignTargetSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(7, sizeof($page->entries));
  }

  /**
   * Provides target lists.
   * @return array an array of arrays, each containing one target list
   */
  function targetListProvider() {
    $data = array();

    // Ad schedule target.
    $targetList = new AdScheduleTargetList();
    $targetList->targets = array(
        new AdScheduleTarget('MONDAY', 12, 'FIFTEEN', 13, 'THIRTY', 1.5));
    $data[] = array($targetList);

    // Age and Gender target.
    $targetList = new DemographicTargetList();
    $targetList->targets = array(new AgeTarget('AGE_18_24', 150),
        new GenderTarget('MALE', 150));
    $data[] = array($targetList);

    // City target.
    $targetList = new GeoTargetList();
    $targetList->targets = array(new CityTarget('New York', 'US-NY', 'US'));
    $data[] = array($targetList);

    // Country target.
    $targetList = new GeoTargetList();
    $targetList->targets = array(new CountryTarget('US'));
    $data[] = array($targetList);

    // Metro target.
    $targetList = new GeoTargetList();
    $targetList->targets = array(new MetroTarget('501'));
    $data[] = array($targetList);

    // Polygon target.
    $targetList = new GeoTargetList();
    $targetList->targets = array(new PolygonTarget(array(
        new GeoPoint(40666056, -74185181), new GeoPoint(40580585, -73866577),
        new GeoPoint(40851216, -73943481))));
    $data[] = array($targetList);

    // Province target.
    $targetList = new GeoTargetList();
    $targetList->targets = array(new ProvinceTarget('US-NY'));
    $data[] = array($targetList);

    // Proximity target.
    $targetList = new GeoTargetList();
    $targetList->targets = array(new ProximityTarget(
        new GeoPoint(40742412, -74004378), 'MILES', 10,
        new Address('76 9th Ave', NULL, 'New York', 'US-NY', 'NY', '10011',
            'US'), TRUE));
    $data[] = array($targetList);

    // Language target.
    $targetList = new LanguageTargetList();
    $targetList->targets = array(new LanguageTarget('en'));
    $data[] = array($targetList);

    // Mobile carrier target.
    $targetList = new MobileTargetList();
    $targetList->targets = array(new MobileCarrierTarget('T-Mobile', 'US'));
    $data[] = array($targetList);

    // Mobile platform target.
    $targetList = new MobileTargetList();
    $targetList->targets = array(new MobilePlatformTarget('Android'));
    $data[] = array($targetList);

    // Network target.
    $targetList = new NetworkTargetList();
    $targetList->targets = array(new NetworkTarget('GOOGLE_SEARCH'));
    $data[] = array($targetList);

    // Platform target.
    $targetList = new PlatformTargetList();
    $targetList->targets = array(new PlatformTarget('DESKTOP'));
    $data[] = array($targetList);

    return $data;
  }
}
