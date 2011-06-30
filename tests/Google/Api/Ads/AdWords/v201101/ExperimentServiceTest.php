<?php
/**
 * Functional tests for ExperimentService.
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
require_once 'Google/Api/Ads/AdWords/v201101/CampaignService.php';

/**
 * Functional tests for ExperimentService.
 */
class ExperimentServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $experimentId;

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
    $this->service = $user->GetExperimentService();

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->campaignId = $this->testUtils->CreateCampaign();
    $this->experimentId = $this->testUtils->CreateExperiment(
        $this->sharedFixture['campaignId']);
  }

  /**
   * Tear down the test fixtures.
   */
  protected function tearDown() {
    $this->testUtils->DeleteCampaign($this->campaignId);
    if (isset($this->experimentId)) {
      $this->testUtils->DeleteExperiment($this->experimentId);
    }
  }

  /**
   * Test adding an experiment.
   * @covers ExperimentService::mutate
   */
  public function testAdd() {
    $experiment = new Experiment();
    $experiment->campaignId = $this->campaignId;
    $experiment->name = 'Experiment ' . uniqid();
    $experiment->queryPercentage = 50;
    $experiment->startDateTime = date('Ymd hms', strtotime('+1 day'))
        . ' America/New_York';
    $experiment->endDateTime = date('Ymd hms', strtotime('+2 day'))
        . ' America/New_York';

    $operations = array(new ExperimentOperation($experiment, 'ADD'));
    $testExperiment = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('id', 'controlId', 'status', 'servingStatus');
    $this->assertEqualsWithExclusions($experiment, $testExperiment,
        $excludeFields);
  }

  /**
   * Test updating an experiment.
   * @covers ExperimentService::mutate
   */
  public function testUpdate() {
    $experiment = new Experiment();
    $experiment->id = $this->experimentId;
    $experiment->queryPercentage = 90;

    $operations = array(new ExperimentOperation($experiment, 'SET'));
    $testExperiment = $this->service->mutate($operations)->value[0];

    $this->assertEquals($experiment->queryPercentage,
        $testExperiment->queryPercentage);
  }

  /**
   * Test deleting an experiment.
   * @covers ExperimentService::mutate
   */
  public function testDelete() {
    $experiment = new Experiment();
    $experiment->id = $this->experimentId;
    $experiment->status = 'DELETED';

    $operations = array(new ExperimentOperation($experiment, 'SET'));
    $testExperiment = $this->service->mutate($operations)->value[0];

    $this->assertEquals($experiment->status,
        $testExperiment->status);
    $this->experimentId = NULL;
  }

  /**
   * Test getting an experiment.
   * @covers ExperimentService::get
   */
  public function testGet() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('Id', 'IN', array($this->experimentId));
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
    $this->assertNotNull($page->entries[0]->experimentSummaryStats);
  }

  /**
   * Test getting an experiment for a campaign.
   * @covers ExperimentService::get
   */
  public function testGetForCampaign() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] = new Predicate('CampaignId', 'IN',
        array($this->sharedFixture['campaignId']));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Test getting all experiments.
   * @covers ExperimentService::get
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
    foreach($page->entries as $experiment) {
      $this->assertGreaterThanOrEqual($lastId, $experiment->id);
      $lastId = $experiment->id;
    }
  }

  /**
   * Returns all the selectable fields for the service.
   * @return array the selectable fields available
   */
  function getAllFields() {
    return array(
        'AdGroupAdsCount',
        'AdGroupCriteriaCount',
        'AdGroupsCount',
        'CampaignId',
        'ControlId',
        'EndDateTime',
        'Id',
        'LastModifiedDateTime',
        'Name',
        'QueryPercentage',
        'ServingStatus',
        'StartDateTime',
        'Status'
    );
  }
}
