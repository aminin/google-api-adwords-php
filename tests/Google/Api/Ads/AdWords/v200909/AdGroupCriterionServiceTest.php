<?php
/**
 * Functional tests for AdGroupCriterionService.
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @subpackage v200909
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v200909/cm/AdGroupCriterionService.php';

/**
 * Functional tests for AdGroupCriterionService.
 */
class AdGroupCriterionServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $adGroupId;
  private $criterionId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v200909');
    $suite->SetRequires(array('CAMPAIGN', 'AD_GROUP'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetAdGroupCriterionService();

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->adGroupId = $this->sharedFixture['adGroupId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->criterionId = $this->testUtils->CreateKeyword($this->adGroupId);
  }

  /**
   * Test adding a biddable ad group criterion.
   * @covers AdGroupCriterionService::mutate
   * @param Criterion $criterion the criterion to add
   * @dataProvider criterionProvider
   */
  public function testAddBiddable($criterion) {
    $biddableAdGroupCriterion = new BiddableAdGroupCriterion();
    $biddableAdGroupCriterion->adGroupId = $this->adGroupId;
    $biddableAdGroupCriterion->criterion = $criterion;
    $biddableAdGroupCriterion->userStatus = 'PAUSED';
    $biddableAdGroupCriterion->destinationUrl = 'http://www.example.com';

    $bids = new ManualCPCAdGroupCriterionBids();
    $bids->maxCpc = new Bid(new Money(10000));
    $biddableAdGroupCriterion->bids = $bids;

    $operations = array(
        new AdGroupCriterionOperation($biddableAdGroupCriterion, NULL, 'ADD'));
    $testBiddableAdGroupCriterion =
        $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('criterion->id', 'criterion->CriterionType',
        'AdGroupCriterionType', 'systemServingStatus', 'approvalStatus',
        'bids->AdGroupCriterionBidsType',
        'bids->maxCpc->amount->ComparableValueType', 'bids->bidSource',
        'firstPageCpc', 'qualityInfo', 'stats');
    $this->assertEqualsWithExclusions($biddableAdGroupCriterion,
        $testBiddableAdGroupCriterion, $excludeFields);
  }

  /**
   * Test adding a negative ad group criterion.
   * @covers AdGroupCriterionService::mutate
   * @param Criterion $criterion the criterion to add
   * @dataProvider criterionProvider
   */
  public function testAddNegative($criterion) {
    $negativeAdGroupCriterion = new NegativeAdGroupCriterion();
    $negativeAdGroupCriterion->adGroupId = $this->adGroupId;
    $negativeAdGroupCriterion->criterion = $criterion;

    $operations = array(
        new AdGroupCriterionOperation($negativeAdGroupCriterion, NULL, 'ADD'));
    $testNegativeAdGroupCriterion =
        $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('criterion->id', 'criterion->CriterionType',
        'AdGroupCriterionType');
    $this->assertEqualsWithExclusions($negativeAdGroupCriterion,
        $testNegativeAdGroupCriterion, $excludeFields);
  }

  /**
   * Test updating an ad group criterion.
   * @covers AdGroupCriterionService::mutate
   */
  public function testUpdate() {
    $biddableAdGroupCriterion = new BiddableAdGroupCriterion();
    $biddableAdGroupCriterion->adGroupId = $this->adGroupId;
    $biddableAdGroupCriterion->criterion = new Criterion($this->criterionId);
    $biddableAdGroupCriterion->userStatus = 'PAUSED';

    $operations = array(
        new AdGroupCriterionOperation($biddableAdGroupCriterion, NULL, 'SET'));
    $testBiddableAdGroupCriterion =
        $this->service->mutate($operations)->value[0];

    $this->assertEquals($biddableAdGroupCriterion->userStatus,
        $testBiddableAdGroupCriterion->userStatus);
  }

  /**
   * Test removing an ad group criterion.
   * @covers AdGroupCriterionService::mutate
   */
  public function testRemove() {
    $adGroupCriterion = new AdGroupCriterion();
    $adGroupCriterion->adGroupId = $this->adGroupId;
    $adGroupCriterion->criterion = new Criterion($this->criterionId);

    $operations = array(
        new AdGroupCriterionOperation($adGroupCriterion, NULL, 'REMOVE'));
    $testAdGroupCriterion = $this->service->mutate($operations)->value[0];

    $this->assertEquals($adGroupCriterion->criterion->id,
        $testAdGroupCriterion->criterion->id);
  }

  /**
   * Test getting an ad group criterion.
   * @covers AdGroupCriterionService::get
   */
  public function testGet() {
    $selector = new AdGroupCriterionSelector();

    $idFilter = new AdGroupCriterionIdFilter(NULL, $this->adGroupId,
        $this->criterionId);
    $selector->idFilters = array($idFilter);

    $selector->criterionUse = 'BIDDABLE';
    $selector->userStatuses = array('ACTIVE');
    $selector->statsSelector =
        new StatsSelector(new DateRange(date('Ym01'), date('Ymd')));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
    $this->assertNotNull($page->entries[0]->stats);
  }

  /**
   * Test getting all ad group criteria in an ad group.
   * @covers AdGroupCriterionService::get
   */
  public function testGetAllInAdGroup() {
    $selector = new AdGroupCriterionSelector();

    $idFilter = new AdGroupCriterionIdFilter(NULL, $this->adGroupId, NULL);
    $selector->idFilters = array($idFilter);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad group criteria in a campaign.
   * @covers AdGroupCriterionService::get
   */
  public function testGetAllInCampaign() {
    $selector = new AdGroupCriterionSelector();

    $idFilter = new AdGroupCriterionIdFilter($this->campaignId, NULL, NULL);
    $selector->idFilters = array($idFilter);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad group criteria.
   * @covers AdGroupCriterionService::get
   */
  public function testGetAll() {
    $selector = new AdGroupCriterionSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Provides criteria.
   * @return array an array of arrays, each containing one criterion
   */
  function criterionProvider() {
    $data = array();

    // Keyword.
    $keyword = new Keyword();
    $keyword->text = 'mars cruise ' . uniqid();
    $keyword->matchType = 'BROAD';
    $data[] = array($keyword);

    // Placement.
    $placement = new Placement();
    $placement->url = 'www.example.com/' . uniqid();
    $data[] = array($placement);

    return $data;
  }
}
