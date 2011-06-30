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
require_once 'Google/Api/Ads/AdWords/v201101/CampaignCriterionService.php';

/**
 * Functional tests for CampaignCriterionService.
 */
class CampaignCriterionServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $userListId;
  private $criterionId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201101');
    $suite->SetRequires(array('CAMPAIGN', 'USER_LIST'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetCampaignCriterionService();

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->userListId = $this->sharedFixture['userListId'];

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
    if ($criterion instanceof CriterionUserList) {
      $criterion->userListId = $this->userListId;
    }

    $negativeCampaignCriterion = new NegativeCampaignCriterion();
    $negativeCampaignCriterion->campaignId = $this->campaignId;
    $negativeCampaignCriterion->criterion = $criterion;

    $operations = array(
        new CampaignCriterionOperation($negativeCampaignCriterion, 'ADD'));
    $testNegativeCampaignCriterion =
        $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('criterion->id', 'criterion->CriterionType',
        'criterion->userListName', 'criterion->userListSize',
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
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('CampaignId', 'IN', array($this->campaignId));
    $selector->predicates[] =
        new Predicate('Id', 'IN', array($this->criterionId));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Test getting all campaign criteria in a campaign.
   * @covers CampaignCriterionService::get
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
   * Test getting all campaign criteria.
   * @covers CampaignCriterionService::get
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
    foreach($page->entries as $campaignCriterion) {
      $this->assertGreaterThanOrEqual($lastId,
          $campaignCriterion->criterion->id);
      $lastId = $campaignCriterion->criterion->id;
    }
  }

  /**
   * Provides criteria.
   * @return array an array of arrays, each containing one criterion
   */
  function criterionProvider() {
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
    $vertical->path = array('Travel', 'Air Travel');
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
        'Argument',
        'CampaignId',
        'ContentLabelType',
        'Id',
        'KeywordMatchType',
        'KeywordText',
        'Operand',
        'Path',
        'PlacementUrl',
        'Text',
        'UserInterestId',
        'UserInterestName',
        'UserListId',
    );
  }
}
