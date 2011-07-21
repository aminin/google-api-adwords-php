<?php
/**
 * Functional tests for CampaignAdExtensionService.
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
 * @subpackage v201101
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
require_once 'Google/Api/Ads/AdWords/v201101/CampaignAdExtensionService.php';

/**
 * Functional tests for CampaignAdExtensionService.
 */
class CampaignAdExtensionServiceTest extends AdsTestCase {
  private $service;
  private $geoLocationService;
  private $testUtils;

  private $campaignId;
  private $adExtensionId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201101');
    $suite->SetRequires(array('CAMPAIGN'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetService('CampaignAdExtensionService');
    $this->geoLocationService = $user->GetService('GeoLocationService');

    $this->campaignId = $this->sharedFixture['campaignId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->adExtensionId =
        $this->testUtils->CreateLocationExtension($this->campaignId);
  }

  /**
   * Test adding an campaign ad extension.
   * @covers CampaignAdExtensionService::mutate
   * @param AdExtension $adExtension the ad extension to add
   * @dataProvider adExtensionProvider
   */
  public function testAdd($adExtension) {
    $user = $this->sharedFixture['user'];

    if ($adExtension instanceof LocationSyncExtension) {
      $adExtension->email = $user->GetEmail();
      $adExtension->authToken = $user->GetAuthToken();
    }

    $campaignAdExtension = new CampaignAdExtension();
    $campaignAdExtension->campaignId = $this->campaignId;
    $campaignAdExtension->adExtension = $adExtension;
    $campaignAdExtension->status = 'ACTIVE';

    $operations =
        array(new CampaignAdExtensionOperation($campaignAdExtension, 'ADD'));
    $testCampaignAdExtension = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('adExtension->id', 'adExtension->AdExtensionType',
        'adExtension->address->provinceCode', 'adExtension->encodedLocation',
        'approvalStatus', 'adExtension->authToken');
    $this->assertEqualsWithExclusions($campaignAdExtension,
        $testCampaignAdExtension, $excludeFields);
  }

  /**
   * Test removing a campaign ad extension.
   * @covers CampaignAdExtensionService::mutate
   */
  public function testRemove() {
    $campaignAdExtension= new CampaignAdExtension();
    $campaignAdExtension->campaignId = $this->campaignId;
    $campaignAdExtension->adExtension = new AdExtension($this->adExtensionId);

    $operations =
        array(new CampaignAdExtensionOperation($campaignAdExtension, 'REMOVE'));
    $testCampaignAdExtension = $this->service->mutate($operations)->value[0];

    $this->assertEquals('DELETED', $testCampaignAdExtension->status);
  }

  /**
   * Test getting a campaign ad extensions.
   * @covers CampaignAdExtensionService::get
   */
  public function testGet() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('CampaignId', 'IN', array($this->campaignId));
    $selector->predicates[] =
        new Predicate('AdExtensionId', 'IN', array($this->adExtensionId));
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
    $this->assertNotNull($page->entries[0]->stats);
  }

  /**
   * Test getting all campaign ad extensions for a campaign.
   * @covers CampaignAdExtensionService::get
   */
  public function testGetAllForCampaign() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('CampaignId', 'IN', array($this->campaignId));
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all campaign ad extensions for an ad extension.
   * @covers CampaignAdExtensionService::get
   */
  public function testGetAllForAdExtension() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('AdExtensionId', 'IN', array($this->adExtensionId));
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all campaign ad extensions.
   * @covers CampaignAdExtensionService::get
   */
  public function testGetAll() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->paging = new Paging(0, 100);
    $selector->ordering = array(new OrderBy('AdExtensionId', 'ASCENDING'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
    $this->assertLessThanOrEqual(100, sizeof($page->entries));

    // Assert that the order is correct.
    $lastId = 0;
    foreach($page->entries as $campaignAdExtension) {
      $this->assertGreaterThanOrEqual($lastId,
          $campaignAdExtension->adExtension->id);
      $lastId = $campaignAdExtension->adExtension->id;
    }
  }

  /**
   * Provides ad extensions.
   * @return array an array of arrays, each containing one ad extension
   */
  function adExtensionProvider() {
    $data = array();

    // Location extension.
    $locationExtension = new LocationExtension();
    $locationExtension->address = new Address('76 9th Ave', NULL, 'New York',
        'NY', 'NY', 10011, 'US');
    $locationExtension->geoPoint = new GeoPoint('40742412', '-74004378');
    $locationExtension->encodedLocation =
        base64_decode('qrvM3QDB3iJsdO58XYyix7YGjYhU+jHs3GR0J6uqpGp55fMTsorT5ZLH69crnCWnM3FVAFDO9Un4HNbc5/ORF0Y8hZL/sPevCyxMrjZ2gmwbQwi2fvDB2J7RhyWSV4uWA3LT0sdG2b22nH34uDh88XZyTyZMk0Fgc6wmmIwKSlUdYlyCzJ00Qd2JGboNgcWnVeHC8cbGd4BzGR839qM7tGXlW5TvuGUs/lz3WjScPbHY8L0TfYcv2JV3c88di7qZJem7XV9IQqm3SFfWOwyC6K3y1v9p+V3twZoBCf02QVZFiohpTzau9Bj6hbXNoB7LKMHK1skduIgs854r83tIp1FevrxVNp3S7npNDcQaNAMHoYzX8iDGASwR8sWg2JUYeiTns6AihCApQmwNTdYHhhgh75B9PqYpSA5ghBWr0xWpiZBnM9713DwvG4LCD2smG43VAGUUrCVknwrMxS/XSoF6NMzAFi648SglPozoGrLPdQ/4IbaIr91yAJpegOGivQPQ7NMLc2ClnYt5mj/IzHjNK7u1WDJFW2CF0Kw+/50zljzvWDVUiBxGha7da7ihyuR32D+uCJOM+HsCgA==');
    $locationExtension->companyName = 'Google Inc';
    $locationExtension->phoneNumber = '(212) 565-0000';
    $locationExtension->source = 'ADWORDS_FRONTEND';
    $data[] = array($locationExtension);

    // Location sync extension.
    $locationSyncExtension = new LocationSyncExtension();
    $locationSyncExtension->email = 'EMAIL INSERTED LATER';
    $locationSyncExtension->authToken = 'AUTH TOKEN INSERTED LATER';
    $data[] = array($locationSyncExtension);

    // Mobile extension.
    $mobileExtension = new MobileExtension();
    $mobileExtension->phoneNumber = '(212) 565-0000';
    $mobileExtension->countryCode = 'US';
    $mobileExtension->isCallOnly = TRUE;
    $data[] = array($mobileExtension);

    // Site links extension.
    $siteLinksExtension = new SitelinksExtension();
    $siteLinksExtension->sitelinks = array(
        new Sitelink('Mars', 'http://www.example.com/mars'),
        new Sitelink('Jupiter', 'http://www.example.com/jupiter'));
    $data[] = array($siteLinksExtension);

    return $data;
  }

  /**
   * Returns all the selectable fields for the service.
   * @return array the selectable fields available
   */
  function getAllFields() {
    return array(
        'AdExtensionId',
        'Address',
        'AdvertiserName',
        'ApprovalStatus',
        'Argument',
        'AverageCpc',
        'AverageCpm',
        'AveragePosition',
        'CampaignId',
        'Clicks',
        'CompanyName',
        'ConversionRate',
        'ConversionRateManyPerClick',
        'Conversions',
        'ConversionsManyPerClick',
        'Cost',
        'CostPerConversion',
        'CostPerConversionManyPerClick',
        'CountryCode',
        'Ctr',
        'DestinationUrl',
        'DisplayText',
        'Email',
        'EncodedLocation',
        'GeoPoint',
        'GoogleBaseCustomerId',
        'IconMediaId',
        'ImageMediaId',
        'Impressions',
        'IsCallOnly',
        'LocationExtensionSource',
        'Operand',
        'PhoneNumber',
        'ShouldSyncUrl',
        'Status',
        'ViewThroughConversions'
    );
  }
}
