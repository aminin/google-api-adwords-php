<?php
/**
 * Functional tests for BidLandscapeService.
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
 * @subpackage v201003
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
require_once 'Google/Api/Ads/AdWords/v201003/BidLandscapeService.php';

/**
 * Functional tests for BidLandscapeService.
 */
class BidLandscapeServiceTest extends AdsTestCase {
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
    $suite->SetVersion('v201003');
    $suite->SetRequires(array('CAMPAIGN', 'AD_GROUP', 'KEYWORD'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetBidLandscapeService();

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->adGroupId = $this->sharedFixture['adGroupId'];
    $this->criterionId = $this->sharedFixture['keywordId'];
  }

  /**
   * Test getting a criterion bid landscape.
   * @covers BidLandscapeService::get
   */
  public function testGetCriterionBidLandscape() {
    $selector = new CriterionBidLandscapeSelector();

    $idFilter = new BidLandscapeIdFilter();
    $idFilter->adGroupId = $this->adGroupId;
    $idFilter->criterionId= $this->criterionId;
    $selector->idFilters = array($idFilter);

    $bidLandscapes = $this->service->getBidLandscape($selector);
  }

  /**
   * Test getting all criterion bid landscapes in an ad group.
   * @covers BidLandscapeService::get
   */
  public function testGetAllCriterionBidLandscapesInAdGroup() {
    $selector = new CriterionBidLandscapeSelector();

    $idFilter = new BidLandscapeIdFilter();
    $idFilter->adGroupId = $this->adGroupId;
    $selector->idFilters = array($idFilter);

    $bidLandscapes = $this->service->getBidLandscape($selector);
  }

  /**
   * Test getting all criterion bid landscapes in a campaign.
   * @covers BidLandscapeService::get
   */
  public function testGetAllCriterionBidLandscapesInCampaign() {
    $selector = new CriterionBidLandscapeSelector();

    $idFilter = new BidLandscapeIdFilter();
    $idFilter->campaignId = $this->campaignId;
    $selector->idFilters = array($idFilter);

    $bidLandscapes = $this->service->getBidLandscape($selector);
  }
}
