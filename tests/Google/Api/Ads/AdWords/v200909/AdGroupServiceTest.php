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
 * @subpackage v200909
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v200909/cm/AdGroupService.php';

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
    $suite->SetVersion('v200909');
    $suite->SetRequires(array('CAMPAIGN'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetAdGroupService();
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
    $selector = new AdGroupSelector();
    $selector->adGroupIds = array($this->adGroupId);
    $selector->statsSelector =
        new StatsSelector(new DateRange(date('Ym01'), date('Ymd')));

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
    $selector = new AdGroupSelector();
    $selector->campaignId = $this->campaignId;

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad groups.
   * @covers AdGroupService::get
   */
  public function testGetAll() {
    $selector = new AdGroupSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }
}
