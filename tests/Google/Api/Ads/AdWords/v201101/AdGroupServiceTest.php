<?php
/**
 * Functional tests for AdGroupService.
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
require_once 'Google/Api/Ads/AdWords/v201101/AdGroupService.php';

/**
 * Functional tests for AdGroupService.
 */
class AdGroupServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $adGroupId;

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
    $this->service = $user->GetService('AdGroupService');
    $this->campaignId = $this->sharedFixture['campaignId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->adGroupId = $this->testUtils->CreateAdGroup($this->campaignId);
  }

  /**
   * Test adding an ad group.
   * @covers AdGroupService::mutate
   */
  public function testAdd() {
    $adGroup = new AdGroup();
    $adGroup->campaignId = $this->campaignId;
    $adGroup->name = 'Ad Group #' . time();
    $adGroup->status = 'PAUSED';
    $adGroup->bids = new ManualCPCAdGroupBids(new Bid(new Money(1000000)));

    $operations = array(new AdGroupOperation($adGroup, 'ADD'));
    $testAdGroup = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('id', 'campaignName', 'bids->AdGroupBidsType',
        'bids->keywordMaxCpc->amount->ComparableValueType');
    $this->assertEqualsWithExclusions($adGroup, $testAdGroup, $excludeFields);
  }

  /**
   * Test updating an ad group.
   * @covers AdGroupService::mutate
   */
  public function testUpdate() {
    $adGroup = new AdGroup();
    $adGroup->id = $this->adGroupId;
    $adGroup->bids = new ManualCPCAdGroupBids(new Bid(new Money(2000000)));

    $operations = array(new AdGroupOperation($adGroup, 'SET'));
    $testAdGroup = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('ComparableValueType');
    $this->assertEqualsWithExclusions($adGroup->bids->keywordMaxCpc->amount,
        $testAdGroup->bids->keywordMaxCpc->amount, $excludeFields);
  }

  /**
   * Test deleting an ad group.
   * @covers AdGroupService::mutate
   */
  public function testDelete() {
    $adGroup = new AdGroup();
    $adGroup->id = $this->adGroupId;
    $adGroup->status = 'DELETED';

    $operations = array(new AdGroupOperation($adGroup, 'SET'));
    $testAdGroup = $this->service->mutate($operations)->value[0];

    $this->assertEquals($adGroup->status, $testAdGroup->status);
  }

  /**
   * Test getting an ad group.
   * @covers AdGroupService::get
   */
  public function testGet() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('Id', 'IN', array($this->adGroupId));
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
    $this->assertNotNull($page->entries[0]->stats);
  }

  /**
   * Test getting all ad groups in a campaign.
   * @covers AdGroupService::get
   */
  public function testGetAllInCampaign() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('CampaignId', 'IN', array($this->campaignId));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad groups.
   * @covers AdGroupService::get
   */
  public function testGetAll() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->paging = new Paging(0, 100);
    $selector->ordering = array(new OrderBy('Id', 'ASCENDING'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
    $this->assertLessThanOrEqual(100, sizeof($page->entries));

    // Assert that the order is correct.
    $lastId = 0;
    foreach($page->entries as $adGroup) {
      $this->assertGreaterThanOrEqual($lastId, $adGroup->id);
      $lastId = $adGroup->id;
    }
  }

  /**
   * Returns all the selectable fields for the service.
   * @return array the selectable fields available
   */
  function getAllFields() {
    return array(
        'AverageCpc',
        'AverageCpm',
        'AveragePosition',
        'CampaignId',
        'CampaignName',
        'Clicks',
        'ConversionOptimizerBidType',
        'ConversionRate',
        'ConversionRateManyPerClick',
        'Conversions',
        'ConversionsManyPerClick',
        'Cost',
        'CostPerConversion',
        'CostPerConversionManyPerClick',
        'Ctr',
        'DeduplicationMode',
        'EnhancedCpcEnabled',
        'ExperimentDeltaStatus',
        'ExperimentId',
        'ExperimentDataStatus',
        'Id',
        'Impressions',
        'KeywordContentMaxCpc',
        'KeywordMaxCpc',
        'MaxContentCpcMultiplier',
        'MaxCpcMultiplier',
        'MaxCpm',
        'MaxCpmMultiplier',
        'Name',
        'PercentCpa',
        'ProxyKeywordMaxCpc',
        'ProxySiteMaxCpc',
        'SiteMaxCpc',
        'Status',
        'TargetCpa',
        'TotalConvValue',
        'ValuePerConv',
        'ValuePerConvManyPerClick',
        'ViewThroughConversions'
    );
  }
}
