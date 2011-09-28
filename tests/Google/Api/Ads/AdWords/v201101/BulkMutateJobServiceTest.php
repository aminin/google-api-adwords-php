<?php
/**
 * Functional tests for BulkMutateJobService.
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
require_once 'Google/Api/Ads/AdWords/v201101/BulkMutateJobService.php';

/**
 * Functional tests for BulkMutateJobService.
 */
class BulkMutateJobServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $adGroupId;

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
    $this->service = $user->GetService('BulkMutateJobService');

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->adGroupId = $this->sharedFixture['adGroupId'];
  }

  /**
   * Test adding a bulk mutate job.
   * @covers BulkMutateJobService::mutate
   */
  public function testAdd() {
    $operations = $this->CreateKeywordOperations(50);
    $operationStream =  new OperationStream(
        new EntityId('CAMPAIGN_ID', $this->campaignId), $operations);
    $bulkMutateRequest  = new BulkMutateRequest(0, array($operationStream));

    $bulkMutateJob = new BulkMutateJob();
    $bulkMutateJob->request = $bulkMutateRequest;
    $bulkMutateJob->numRequestParts = 2;

    $operation = new JobOperation($bulkMutateJob, 'ADD');
    $testBulkMutateJob = $this->service->mutate($operation);

    // Exclude generated fields.
    $excludeFields = array('id', 'policy', 'request', 'status',
        'numRequestPartsReceived', 'context', 'JobType');
    $this->assertEqualsWithExclusions($bulkMutateJob,
        $testBulkMutateJob, $excludeFields);

    return $testBulkMutateJob->id;
  }

  /**
   * Test setting a bulk mutate job.
   * @covers BulkMutateJobService::mutate
   * @depends testAdd
   */
  public function testSet($id) {
    $operations = $this->CreateKeywordOperations(50);
    $operationStream =  new OperationStream(
        new EntityId('CAMPAIGN_ID', $this->campaignId), $operations);
    $bulkMutateRequest  = new BulkMutateRequest(1, array($operationStream));

    $bulkMutateJob = new BulkMutateJob();
    $bulkMutateJob->id = $id;
    $bulkMutateJob->request = $bulkMutateRequest;
    $bulkMutateJob->numRequestParts = 2;

    $operation = new JobOperation($bulkMutateJob, 'SET');
    $testBulkMutateJob = $this->service->mutate($operation);

    // Exclude generated fields.
    $excludeFields = array('policy', 'request', 'status',
        'numRequestPartsReceived', 'context', 'JobType');
    $this->assertEqualsWithExclusions($bulkMutateJob,
        $testBulkMutateJob, $excludeFields);

    return $testBulkMutateJob->id;
  }

  /**
   * Test getting a bulk mutate job.
   * @covers BulkMutateJobService::get
   * @depends testAdd
   */
  public function testGet($id) {
    $selector = new BulkMutateJobSelector();
    $selector->jobIds = array($id);
    $selector->jobStatuses =
        array('COMPLETED', 'PROCESSING', 'FAILED', 'PENDING');

    $bulkMutateJobs = $this->service->get($selector);

    $this->assertNotNull($bulkMutateJobs);
    $this->assertEquals(1, sizeof($bulkMutateJobs));
  }

  /**
   * Test getting the results of a bulk mutate job.
   * @covers BulkMutateJobService::get
   * @depends testSet
   */
  public function testGetResults($id) {
    $selector = new BulkMutateJobSelector();
    $selector->jobIds = array($id);

    do {
      $bulkMutateJobs = $this->service->get($selector);
      $bulkMutateJob = $bulkMutateJobs[0];
    } while ($bulkMutateJob->status == 'PENDING'
        || $bulkMutateJob->status == 'PROCESSING');

    $this->assertEquals('COMPLETED', $bulkMutateJob->status);

    $selector->resultPartIndex = 0;
    $selector->includeHistory = TRUE;
    $selector->includeStats = TRUE;

    $bulkMutateJobs = $this->service->get($selector);
    $bulkMutateJob = $bulkMutateJobs[0];

    $this->assertNotNull($bulkMutateJob);
    $this->assertNotNull($bulkMutateJob->stats);
    $this->assertNotNull($bulkMutateJob->billingSummary);
    $this->assertNotNull($bulkMutateJob->history);
    $this->assertNotNull($bulkMutateJob->result);
  }

  /**
   * Creates the specified number of new keyword operations.
   * @param int $num the number of operations to create
   * @return array an array of operations
   */
  private function CreateKeywordOperations($num) {
    $operations = array();
    for ($i=0; $i<$num; $i++) {
      $keyword = new Keyword('mars cruise ' . $i, 'BROAD');
      $adGroupCriterion = new BiddableAdGroupCriterion();
      $adGroupCriterion->adGroupId = $this->adGroupId;
      $adGroupCriterion->criterion = $keyword;
      $operations[] =
          new AdGroupCriterionOperation($adGroupCriterion, NULL, 'ADD');
    }
    return $operations;
  }
}
