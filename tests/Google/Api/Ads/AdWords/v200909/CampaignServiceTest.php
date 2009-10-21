<?php
/**
 * Functional tests for CampaignService.
 *
 * PHP version 5
 *
 * Copyright 2009, Google Inc. All Rights Reserved.
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
 * @copyright  2009, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'PHPUnit/Framework.php';

/**
 * Functional tests for CampaignService.
 *
 * @author api.arogal@gmail.com
 */
class CampaignServiceTest extends PHPUnit_Framework_TestCase {
  private $version = 'v200909';
  private $server = 'https://adwords-sandbox.google.com';
  private $user;
  private $service;

  private static $campaign1;
  private static $campaign2;

  protected function setUp() {
    $this->user = new AdWordsUser(dirname(__FILE__)
        . '/../../../../../../test_data/test_auth.ini');
    $this->user->LogDefaults();
    $this->service =
        $this->user->GetCampaignService($this->version, $this->server);
  }

  /**
   * Test whether we can create a campaign using v200909.
   */
  public function testCreateCampaignV200909() {
    $campaign = new Campaign();
    $campaign->name = 'Campaign #' . time();
    $campaign->status = 'PAUSED';
    $campaign->biddingStrategy = new ManualCPC();
    $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

    $operations = array(new CampaignOperation(NULL, $campaign, 'ADD'));

    $campaignReturnValue = $this->service->mutate($operations);
    $testCampaign = $campaignReturnValue->value[0];

    // Set the generated fields.
    $campaign->id = $testCampaign->id;
    $campaign->budget->amount->ComparableValueType =
        $testCampaign->budget->amount->ComparableValueType;
    $campaign->biddingStrategy->BiddingStrategyType =
        $testCampaign->biddingStrategy->BiddingStrategyType;
    $campaign->autoKeywordMatchingStatus =
        $testCampaign->autoKeywordMatchingStatus;
    $campaign->frequencyCap = $testCampaign->frequencyCap;
    $campaign->startDate = $testCampaign->startDate;
    $campaign->endDate = $testCampaign->endDate;
    $campaign->servingStatus = $testCampaign->servingStatus;
    $campaign->adServingOptimizationStatus =
        $testCampaign->adServingOptimizationStatus;

    $this->assertEquals($campaign, $testCampaign);

    CampaignServiceTest::$campaign1 = $campaign;
  }

  /**
   * Test whether we can create a campaign using v200909.
   */
  public function testCreateCampaignsV200909() {
    $campaign1 = new Campaign();
    $campaign1->name = 'Campaign #' . time();
    $campaign1->status = 'PAUSED';
    $campaign1->biddingStrategy = new ManualCPC();
    $campaign1->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

    $campaign2 = new Campaign();
    $campaign2->name = 'Campaign #' . (time() + 1);
    $campaign2->status = 'PAUSED';
    $campaign2->biddingStrategy = new ManualCPC();
    $campaign2->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

    $operations = array(
        new CampaignOperation(NULL, $campaign1, 'ADD'),
        new CampaignOperation(NULL, $campaign2, 'ADD'));

    $testCampaigns = $this->service->mutate($operations)->value;

    // Set the generated fields.
    $campaign1->id = $testCampaigns[0]->id;
    $campaign1->budget->amount->ComparableValueType =
        $testCampaigns[0]->budget->amount->ComparableValueType;
    $campaign1->biddingStrategy->BiddingStrategyType =
        $testCampaigns[0]->biddingStrategy->BiddingStrategyType;
    $campaign1->autoKeywordMatchingStatus =
        $testCampaigns[0]->autoKeywordMatchingStatus;
    $campaign1->frequencyCap = $testCampaigns[0]->frequencyCap;
    $campaign1->startDate = $testCampaigns[0]->startDate;
    $campaign1->endDate = $testCampaigns[0]->endDate;
    $campaign1->servingStatus = $testCampaigns[0]->servingStatus;
    $campaign1->adServingOptimizationStatus =
        $testCampaigns[0]->adServingOptimizationStatus;

    $campaign2->id = $testCampaigns[1]->id;
    $campaign2->budget->amount->ComparableValueType =
        $testCampaigns[1]->budget->amount->ComparableValueType;
    $campaign2->biddingStrategy->BiddingStrategyType =
        $testCampaigns[1]->biddingStrategy->BiddingStrategyType;
    $campaign2->autoKeywordMatchingStatus =
        $testCampaigns[1]->autoKeywordMatchingStatus;
    $campaign2->frequencyCap = $testCampaigns[1]->frequencyCap;
    $campaign2->startDate = $testCampaigns[1]->startDate;
    $campaign2->endDate = $testCampaigns[1]->endDate;
    $campaign2->servingStatus = $testCampaigns[1]->servingStatus;
    $campaign2->adServingOptimizationStatus =
        $testCampaigns[1]->adServingOptimizationStatus;


    $this->assertEquals($campaign1, $testCampaigns[0]);
    $this->assertEquals($campaign2, $testCampaigns[1]);

    CampaignServiceTest::$campaign1 = $campaign1;
    CampaignServiceTest::$campaign2 = $campaign2;
  }

  /**
   * Test whether we can fetch an existing campaign using v200909.
   */
  public function testGetCampaignV200909() {
    if (!isset(CampaignServiceTest::$campaign1)) {
      $this->testCreateCampaignV200909();
    }

    $selector = new CampaignSelector();
    $selector->ids = array(CampaignServiceTest::$campaign1->id);
    $selector->statsSelector =
        new StatsSelector(new DateRange('20090101', '20090131'));

    $page = $this->service->get($selector);
    $testCampaign = $page->entries[0];

    // Set the generated fields.
    CampaignServiceTest::$campaign1->stats = $testCampaign->stats;
    CampaignServiceTest::$campaign1->adServingOptimizationStatus =
        $testCampaign->adServingOptimizationStatus;

    $this->assertEquals(CampaignServiceTest::$campaign1, $testCampaign);
  }

  /**
   * Test whether we can fetch an existing campaign using v200909.
   */
  public function testGetAllCampaignsV200909() {
    if (!isset(CampaignServiceTest::$campaign1)
        || !isset(CampaignServiceTest::$campaign2)) {
      $this->testCreateCampaignsV200909();
    }

    $selector = new CampaignSelector();

    $page = $this->service->get(new CampaignSelector());

    $found1 = FALSE;
    $found2 = FALSE;

    foreach ($page->entries as $campaign) {
      if ($campaign->id == CampaignServiceTest::$campaign1->id) {
        // Set the generated fields.
        CampaignServiceTest::$campaign1->stats = $campaign->stats;
        CampaignServiceTest::$campaign1->adServingOptimizationStatus =
            $campaign->adServingOptimizationStatus;

        $this->assertEquals(CampaignServiceTest::$campaign1, $campaign);

        CampaignServiceTest::$campaign1 = $campaign;

        $found1 = TRUE;
      } else if ($campaign->id == CampaignServiceTest::$campaign2->id) {
        // Set the generated fields.
        CampaignServiceTest::$campaign2->stats = $campaign->stats;
        CampaignServiceTest::$campaign2->adServingOptimizationStatus =
            $campaign->adServingOptimizationStatus;

        $this->assertEquals(CampaignServiceTest::$campaign2, $campaign);

        CampaignServiceTest::$campaign2 = $campaign;

        $found2 = TRUE;
      }
    }

    $this->assertTrue($found1, 'Campaign 1 not found.');
    $this->assertTrue($found2, 'Campaign 2 not found.');
  }

  /**
   * Test whether we can update a campaign using v200909.
   */
  public function testUpdateCampaignV200909() {
    if (!isset(CampaignServiceTest::$campaign1)) {
      $this->testCreateCampaignV200909();
    }

    $campaign = new Campaign();
    $campaign->id = CampaignServiceTest::$campaign1->id;
    $campaign->status = 'ACTIVE';
    $campaign->budget = new Budget('DAILY', new Money('2000000'), 'STANDARD');

    $operations = array(
        new CampaignOperation(NULL, $campaign, 'SET'));

    $testCampaigns = $this->service->mutate($operations)->value;

    // Set the updated fields.
    CampaignServiceTest::$campaign1->status = 'ACTIVE';
    CampaignServiceTest::$campaign1->budget =
        new Budget('DAILY',
            new Money('2000000', 'Money'), 'STANDARD');

    // Set the generated fields.
    CampaignServiceTest::$campaign1->stats = $testCampaigns[0]->stats;
    CampaignServiceTest::$campaign1->adServingOptimizationStatus =
        $testCampaigns[0]->adServingOptimizationStatus;
    CampaignServiceTest::$campaign1->servingStatus =
        $testCampaigns[0]->servingStatus;

    $this->assertEquals(CampaignServiceTest::$campaign1, $testCampaigns[0]);
  }

  /**
   * Test whether we can update campaigns using v200909.
   */
  public function testUpdateCampaignsV200909() {
    if (!isset(CampaignServiceTest::$campaign1)
        || !isset(CampaignServiceTest::$campaign2)) {
      $this->testCreateCampaignsV200909();
    }
    $campaign1 = new Campaign();
    $campaign1->id = CampaignServiceTest::$campaign1->id;
    $campaign1->status = 'DELETED';
    $campaign1->budget = new Budget('DAILY', new Money('3000000'), 'STANDARD');

    $campaign2 = new Campaign();
    $campaign2->id = CampaignServiceTest::$campaign2->id;
    $campaign2->status = 'DELETED';
    $campaign2->budget = new Budget('DAILY', new Money('3000000'), 'STANDARD');

    $operations = array(
        new CampaignOperation(NULL, $campaign1, 'SET'),
        new CampaignOperation(NULL, $campaign2, 'SET'));

    $testCampaigns = $this->service->mutate($operations)->value;

    // Set the updated fields.
    CampaignServiceTest::$campaign1->status = 'DELETED';
    CampaignServiceTest::$campaign1->budget =
        new Budget('DAILY',
            new Money('3000000', 'Money'), 'STANDARD');

    CampaignServiceTest::$campaign2->status = 'DELETED';
    CampaignServiceTest::$campaign2->budget =
        new Budget('DAILY',
            new Money('3000000', 'Money'), 'STANDARD');

    // Set the generated fields.
    CampaignServiceTest::$campaign1->stats = $testCampaigns[0]->stats;
    CampaignServiceTest::$campaign1->adServingOptimizationStatus =
        $testCampaigns[0]->adServingOptimizationStatus;
    CampaignServiceTest::$campaign1->servingStatus =
        $testCampaigns[0]->servingStatus;

    CampaignServiceTest::$campaign2->stats = $testCampaigns[1]->stats;
    CampaignServiceTest::$campaign2->adServingOptimizationStatus =
        $testCampaigns[1]->adServingOptimizationStatus;
    CampaignServiceTest::$campaign2->servingStatus =
        $testCampaigns[1]->servingStatus;

    $this->assertEquals(CampaignServiceTest::$campaign1, $testCampaigns[0]);
    $this->assertEquals(CampaignServiceTest::$campaign2, $testCampaigns[1]);
  }
}
