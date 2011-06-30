<?php
/**
 * Functional tests for AdGroupCriterionService.
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
require_once 'Google/Api/Ads/AdWords/v201101/AdGroupCriterionService.php';

/**
 * Functional tests for AdGroupCriterionService.
 */
class AdGroupCriterionServiceTest extends AdsTestCase {
  private $service;
  private $partialFailureService;
  private $testUtils;

  private $campaignId;
  private $adGroupId;
  private $criterionId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201101');
    $suite->SetRequires(array('CAMPAIGN', 'AD_GROUP'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetAdGroupCriterionService();
    $this->partialFailureService =
        $user->GetAdGroupCriterionService(NULL, NULL, NULL, NULL, TRUE);

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->adGroupId = $this->sharedFixture['adGroupId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->criterionId = $this->testUtils->CreateKeyword($this->adGroupId);
  }

  /**
   * Test adding a biddable ad group criterion.
   * @covers AdGroupCriterionService::mutate
   * @param Criterion $criterion the criterion to add
   * @dataProvider positiveCriterionProvider
   */
  public function testAddBiddable($criterion) {
    if ($criterion instanceof CriterionUserList) {
      $criterion->userListId = $this->testUtils->CreateUserList();
    }

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
        'criterion->text', 'criterion->userListName', 'criterion->userListSize',
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
   * @dataProvider negativeCriterionProvider
   */
  public function testAddNegative($criterion) {
    if ($criterion instanceof CriterionUserList) {
      $criterion->userListId = $this->testUtils->CreateUserList();
    }

    $negativeAdGroupCriterion = new NegativeAdGroupCriterion();
    $negativeAdGroupCriterion->adGroupId = $this->adGroupId;
    $negativeAdGroupCriterion->criterion = $criterion;

    $operations = array(
        new AdGroupCriterionOperation($negativeAdGroupCriterion, NULL, 'ADD'));
    $testNegativeAdGroupCriterion =
        $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('criterion->id', 'criterion->CriterionType',
        'criterion->userListName', 'criterion->userListSize',
        'AdGroupCriterionType');
    $this->assertEqualsWithExclusions($negativeAdGroupCriterion,
        $testNegativeAdGroupCriterion, $excludeFields);
  }

  /**
   * Test adding an ad group criterion with partial failure.
   * @covers AdGroupCriterionService::mutate
   */
  public function testAddWithPartialFailure() {
    $keyword = new Keyword();
    $keyword->text = '!@#$%';
    $keyword->matchType = 'BROAD';

    $biddableAdGroupCriterion = new BiddableAdGroupCriterion();
    $biddableAdGroupCriterion->adGroupId = $this->adGroupId;
    $biddableAdGroupCriterion->criterion = $keyword;
    $biddableAdGroupCriterion->userStatus = 'PAUSED';
    $biddableAdGroupCriterion->destinationUrl = 'http://www.example.com';

    $bids = new ManualCPCAdGroupCriterionBids();
    $bids->maxCpc = new Bid(new Money(10000));
    $biddableAdGroupCriterion->bids = $bids;

    $operations = array(
        new AdGroupCriterionOperation($biddableAdGroupCriterion, NULL, 'ADD'));
    $result = $this->partialFailureService->mutate($operations);
    $this->assertEquals(1, sizeof($result->partialFailureErrors));
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
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('AdGroupId', 'IN', array($this->adGroupId));
    $selector->predicates[] =
        new Predicate('Id', 'IN', array($this->criterionId));
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

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
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('AdGroupId', 'IN', array($this->adGroupId));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad group criteria in a campaign.
   * @covers AdGroupCriterionService::get
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
   * Test getting all ad group criteria.
   * @covers AdGroupCriterionService::get
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
    foreach($page->entries as $adGroupCriterion) {
      $this->assertGreaterThanOrEqual($lastId,
          $adGroupCriterion->criterion->id);
      $lastId = $adGroupCriterion->criterion->id;
    }
  }

  /**
   * Provides positive criteria.
   * @return array an array of arrays, each containing one criterion
   */
  function positiveCriterionProvider() {
    $data = array();

    // Keyword.
    $keyword = new Keyword();
    $keyword->text = 'mars cruise';
    $keyword->matchType = 'BROAD';
    $data[] = array($keyword);

    // Placement.
    $placement = new Placement();
    $placement->url = 'www.example.com/mars';
    $data[] = array($placement);

    // Vertical.
    $vertical = new Vertical();
    $vertical->path =
      array('Travel', 'Air Travel');
    $data[] = array($vertical);

    // CriterionUserList.
    $criterionUserList = new CriterionUserList();
    $criterionUserList->userListId = 'USER LIST ID INSERTED LATER';
    $data[] = array($criterionUserList);

    // Product.
    $product = new Product();
    $product->conditions = array(new ProductCondition('cruise',
        new ProductConditionOperand('product_type')));
    $data[] = array($product);

    return $data;
  }

  /**
   * Provides negative criteria.
   * @return array an array of arrays, each containing one criterion
   */
  function negativeCriterionProvider() {
    $data = array();

    // Keyword.
    $keyword = new Keyword();
    $keyword->text = 'jupiter cruise';
    $keyword->matchType = 'BROAD';
    $data[] = array($keyword);

    // Placement.
    $placement = new Placement();
    $placement->url = 'www.example.com/juptier';
    $data[] = array($placement);

    // Vertical.
    $vertical = new Vertical();
    $vertical->path = array('Science', 'Physics');
    $data[] = array($vertical);

    // CriterionUserList.
    $criterionUserList = new CriterionUserList();
    $criterionUserList->userListId = 'USER LIST ID INSERTED LATER';
    $data[] = array($criterionUserList);

    return $data;
  }

  /**
   * Returns all the selectable fields for the service.
   * @return array the selectable fields available
   */
  function getAllFields() {
    return array(
        'AdGroupId',
        'ApprovalStatus',
        'Argument',
        'AverageCpc',
        'AverageCpm',
        'AveragePosition',
        'BottomPosition',
        'Clicks',
        'ConversionRate',
        'ConversionRateManyPerClick',
        'Conversions',
        'ConversionsManyPerClick',
        'Cost',
        'CostPerConversion',
        'CostPerConversionManyPerClick',
        'CpcBidSource',
        'CpmBidSource',
        'CriterionUse',
        'Ctr',
        'DestinationUrl',
        'EnhancedCpcEnabled',
        'ExperimentBidMultiplier',
        'ExperimentDeltaStatus',
        'ExperimentId',
        'ExperimentDataStatus',
        'FirstPageCpc',
        'Id',
        'Impressions',
        'IsKeywordAdRelevanceAcceptable',
        'IsLandingPageLatencyAcceptable',
        'IsLandingPageQualityAcceptable',
        'KeywordMatchType',
        'KeywordText',
        'MaxCpc',
        'MaxCpm',
        'Operand',
        'Path',
        'PercentCpa',
        'PercentCpaBidSource',
        'PlacementUrl',
        'PreferredPosition',
        'ProxyMaxCpc',
        'QualityScore',
        'Status',
        'SystemServingStatus',
        'Text',
        'TotalConvValue',
        'UserInterestId',
        'UserInterestName',
        'UserListId',
        'UserListMembershipStatus',
        'UserListName',
        'ValuePerConv',
        'ValuePerConvManyPerClick',
        'ViewThroughConversions'
    );
  }
}
