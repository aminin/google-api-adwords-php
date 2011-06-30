<?php
/**
 * Functional tests for DataService.
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
require_once 'Google/Api/Ads/AdWords/v201101/DataService.php';

/**
 * Functional tests for DataService.
 */
class DataServiceTest extends AdsTestCase {
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
    $suite->SetVersion('v201101');
    $suite->SetRequires(array('CAMPAIGN', 'AD_GROUP', 'KEYWORD'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetDataService();

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->adGroupId = $this->sharedFixture['adGroupId'];
    $this->criterionId = $this->sharedFixture['keywordId'];
  }

  /**
   * Test getting a criterion bid landscape.
   * @covers BidLandscapeService::get
   */
  public function testGetCriterionBidLandscape() {
    $selector = new Selector();
    $selector->fields = $this->getAllCriterionBidLandscapeFields();
    $selector->predicates[] =
        new Predicate('AdGroupId', 'IN', array($this->adGroupId));
    $selector->predicates[] =
        new Predicate('CriterionId', 'IN', array($this->criterionId));

    $page = $this->service->getCriterionBidLandscape($selector);
  }

  /**
   * Test getting all criterion bid landscapes in an ad group.
   * @covers BidLandscapeService::get
   */
  public function testGetAllCriterionBidLandscapesInAdGroup() {
    $selector = new Selector();
    $selector->fields = $this->getAllCriterionBidLandscapeFields();
    $selector->predicates[] =
        new Predicate('AdGroupId', 'IN', array($this->adGroupId));

    $page = $this->service->getCriterionBidLandscape($selector);
  }

  /**
   * Test getting all criterion bid landscapes in a campaign.
   * @covers BidLandscapeService::get
   */
  public function testGetAllCriterionBidLandscapesInCampaign() {
    $selector = new Selector();
    $selector->fields = $this->getAllCriterionBidLandscapeFields();
    $selector->predicates[] =
        new Predicate('CampaignId', 'IN', array($this->campaignId));

    $page = $this->service->getCriterionBidLandscape($selector);
  }

  /**
   * Test getting all criterion bid landscapes.
   * @covers BidLandscapeService::get
   */
  public function testGetAllCriterionBidLandscapes() {
    $selector = new Selector();
    $selector->fields = $this->getAllCriterionBidLandscapeFields();
    $selector->paging = new Paging(0, 100);
    $selector->ordering = array(new OrderBy('CriterionId', 'ASCENDING'));

    $page = $this->service->getCriterionBidLandscape($selector);
    $this->assertLessThanOrEqual(100, sizeof($page->entries));

    if (isset($page->entries)) {
      // Assert that the order is correct.
      $lastId = 0;
      foreach($page->entries as $criterionBidLandscape) {
        $this->assertGreaterThanOrEqual($lastId,
            $criterionBidLandscape->criterionId);
        $lastId = $criterionBidLandscape->criterionId;
      }
    }
  }

  /**
   * Test getting an ad group bid landscape.
   * @covers BidLandscapeService::get
   */
  public function testGetAdGroupBidLandscape() {
    $selector = new Selector();
    $selector->fields = $this->getAllAdGroupBidLandscapeFields();
    $selector->predicates[] =
        new Predicate('AdGroupId', 'IN', array($this->adGroupId));

    $page = $this->service->getAdGroupBidLandscape($selector);
  }

  /**
   * Test getting all ad group bid landscapes in a campaign.
   * @covers BidLandscapeService::get
   */
  public function testGetAllAdGroupBidLandscapesInCampaign() {
    $selector = new Selector();
    $selector->fields = $this->getAllAdGroupBidLandscapeFields();
    $selector->predicates[] =
        new Predicate('CampaignId', 'IN', array($this->campaignId));

    $page = $this->service->getAdGroupBidLandscape($selector);
  }

  /**
   * Test getting all ad group bid landscapes.
   * @covers BidLandscapeService::get
   */
  public function testGetAllAdGroupBidLandscapes() {
    $selector = new Selector();
    $selector->fields = $this->getAllAdGroupBidLandscapeFields();
    $selector->paging = new Paging(0, 100);
    $selector->ordering = array(new OrderBy('AdGroupId', 'ASCENDING'));

    $page = $this->service->getAdGroupBidLandscape($selector);
    $this->assertLessThanOrEqual(100, sizeof($page->entries));

    if (isset($page->entries)) {
      // Assert that the order is correct.
      $lastId = 0;
      foreach($page->entries as $adGroupBidLandscape) {
        $this->assertGreaterThanOrEqual($lastId, $adGroupBidLandscape->adGroupId);
        $lastId = $adGroupBidLandscape->adGroupId;
      }
    }
  }

  /**
   * Returns all the selectable fields for ad group bid landscapes.
   * @return array the selectable fields available
   */
  function getAllAdGroupBidLandscapeFields() {
    return array(
        'AdGroupId',
        'Bid',
        'CampaignId',
        'EndDate',
        'LandscapeCurrent',
        'LocalClicks',
        'LocalCost',
        'LocalImpressions',
        'MarginalCpc',
        'StartDate'
    );
  }

  /**
   * Returns all the selectable fields for criterion bid landscapes.
   * @return array the selectable fields available
   */
  function getAllCriterionBidLandscapeFields() {
    return array(
        'AdGroupId',
        'Bid',
        'CampaignId',
        'CriterionId',
        'EndDate',
        'LocalClicks',
        'LocalCost',
        'LocalImpressions',
        'MarginalCpc',
        'StartDate'
    );
  }
}
