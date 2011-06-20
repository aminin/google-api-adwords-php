<?php
/**
 * Functional tests for CampaignService.
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

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v201008/CampaignService.php';

/**
 * Functional tests for CampaignService.
 */
class CampaignServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $newCampaignId;

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
    $this->service = $user->GetCampaignService();

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->campaignId = $this->testUtils->CreateCampaign();
  }

  /**
   * Tear down the test fixtures.
   */
  protected function tearDown() {
    $this->testUtils->DeleteCampaign($this->campaignId);
    if (isset($this->newCampaignId)) {
      $this->testUtils->DeleteCampaign($this->newCampaignId);
    }
  }

  /**
   * Test adding a campaign.
   * @covers CampaignService::mutate
   */
  public function testAdd() {
    $campaign = new Campaign();
    $campaign->name = 'Campaign #' . time();
    $campaign->status = 'PAUSED';
    $campaign->startDate = date('Ymd', strtotime('+1 day'));
    $campaign->endDate = date('Ymd', strtotime('+1 day'));
    $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');
    $campaign->biddingStrategy = new ManualCPC();
    $campaign->adServingOptimizationStatus = 'OPTIMIZE';
    $campaign->frequencyCap = new FrequencyCap(100, 'WEEK', 'CREATIVE');

    $operations = array(new CampaignOperation(NULL, $campaign, 'ADD'));
    $testCampaign = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('id', 'budget->amount->ComparableValueType',
        'biddingStrategy->BiddingStrategyType',
        'biddingStrategy->positionPreference', 'conversionOptimizerEligibility',
        'servingStatus');
    $this->assertEqualsWithExclusions($campaign, $testCampaign, $excludeFields);

    $this->newCampaignId = $testCampaign->id;
  }

  /**
   * Test updating a campaign.
   * @covers CampaignService::mutate
   */
  public function testUpdate() {
    $campaign = new Campaign();
    $campaign->id = $this->campaignId;
    $campaign->budget = new Budget('DAILY', new Money(2000000), 'STANDARD');

    $operations = array(new CampaignOperation(NULL, $campaign, 'SET'));
    $testCampaign = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('ComparableValueType');
    $this->assertEqualsWithExclusions($campaign->budget->amount,
        $testCampaign->budget->amount, $excludeFields);
  }

  /**
   * Test transitioning the bidding strategy of a campaign.
   * @covers CampaignService::mutate
   */
  public function testBiddingTransition() {
    $campaign = new Campaign();
    $campaign->id = $this->campaignId;

    $biddingTransition = new BiddingTransition(new BudgetOptimizer());

    $operations = array(
        new CampaignOperation($biddingTransition, $campaign, 'SET'));
    $testCampaign = $this->service->mutate($operations)->value[0];

    $this->assertType("BudgetOptimizer", $testCampaign->biddingStrategy);
  }

  /**
   * Test deleting a campaign.
   * @covers CampaignService::mutate
   */
  public function testDelete() {
    $campaign = new Campaign();
    $campaign->id = $this->campaignId;
    $campaign->status = 'DELETED';

    $operations = array(new CampaignOperation(NULL, $campaign, 'SET'));
    $testCampaign = $this->service->mutate($operations)->value[0];

    $this->assertEquals($campaign->status, $testCampaign->status);
  }

  /**
   * Test getting a campaign.
   * @covers CampaignService::get
   */
  public function testGet() {
    $selector = new CampaignSelector();
    $selector->ids = array($this->campaignId);
    $selector->statsSelector =
        new StatsSelector(new DateRange(date('Ym01'), date('Ymd')));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
    $this->assertNotNull($page->entries[0]->campaignStats);
  }

  /**
   * Test getting all campaigns.
   * @covers CampaignService::get
   */
  public function testGetAll() {
    $selector = new CampaignSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }
}
