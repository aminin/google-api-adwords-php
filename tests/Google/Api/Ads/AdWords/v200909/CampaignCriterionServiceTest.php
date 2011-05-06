<?php
/**
 * Functional tests for CampaignCriterionService.
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
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v200909/CampaignCriterionService.php';

/**
 * Functional tests for CampaignCriterionService.
 */
class CampaignCriterionServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $criterionId;

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
    $this->service = $user->GetCampaignCriterionService();

    $this->campaignId = $this->sharedFixture['campaignId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->criterionId =
        $this->testUtils->CreateNegativeCampaignKeyword($this->campaignId);
  }

  /**
   * Test adding a negative campaign criterion.
   * @covers CampaignCriterionService::mutate
   * @param Criterion $criterion the criterion to add
   * @dataProvider criterionProvider
   */
  public function testAddNegative($criterion) {
    $negativeCampaignCriterion = new NegativeCampaignCriterion();
    $negativeCampaignCriterion->campaignId = $this->campaignId;
    $negativeCampaignCriterion->criterion = $criterion;

    $operations = array(
        new CampaignCriterionOperation($negativeCampaignCriterion, 'ADD'));
    $testNegativeCampaignCriterion =
        $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('criterion->id', 'criterion->CriterionType',
        'CampaignCriterionType');
    $this->assertEqualsWithExclusions($negativeCampaignCriterion,
        $testNegativeCampaignCriterion, $excludeFields);
  }

  /**
   * Test removing a campaign criterion.
   * @covers CampaignCriterionService::mutate
   */
  public function testRemove() {
    $campaignCriterion = new CampaignCriterion();
    $campaignCriterion->campaignId = $this->campaignId;
    $campaignCriterion->criterion = new Criterion($this->criterionId);

    $operations = array(
        new CampaignCriterionOperation($campaignCriterion, 'REMOVE'));
    $testCampaignCriterion = $this->service->mutate($operations)->value[0];

    $this->assertEquals($campaignCriterion->criterion->id,
        $testCampaignCriterion->criterion->id);
  }

  /**
   * Test getting a campaign criterion.
   * @covers CampaignCriterionService::get
   */
  public function testGet() {
    $selector = new CampaignCriterionSelector();

    $idFilter = new CampaignCriterionIdFilter($this->campaignId,
        $this->criterionId);
    $selector->idFilters = array($idFilter);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Test getting all campaign criteria in a campaign.
   * @covers CampaignCriterionService::get
   */
  public function testGetAllInCampaign() {
    $selector = new CampaignCriterionSelector();

    $idFilter = new CampaignCriterionIdFilter($this->campaignId, NULL);
    $selector->idFilters = array($idFilter);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all campaign criteria.
   * @covers CampaignCriterionService::get
   */
  public function testGetAll() {
    $selector = new CampaignCriterionSelector();

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
