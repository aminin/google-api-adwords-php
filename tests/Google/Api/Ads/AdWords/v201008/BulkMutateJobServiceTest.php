<?php
/**
 * Functional tests for BulkMutateJobService.
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'PHPUnit/Framework.php';

/**
 * Functional tests for BulkMutateJobService.
 *
 * @author api.arogal@gmail.com
 */
class BulkMutateJobServiceTest extends PHPUnit_Framework_TestCase {
  private $version = 'v201008';
  private $user;
  private $service;

  private static $campaignId;
  private static $adGroupId1;
  private static $adGroupId2;

  protected function setUp() {
    $authFile =
        dirname(__FILE__) . '/../../../../../../test_data/test_auth.ini';
    $settingsFile =
        dirname(__FILE__) . '/../../../../../../test_data/test_settings.ini';
    $this->user = new AdWordsUser($authFile, NULL, NULL, NULL,
        NULL, NULL, NULL, $settingsFile);
    $this->user->LogDefaults();
    $this->service =
        $this->user->GetBulkMutateJobService($this->version);

    if (!isset(BulkMutateJobServiceTest::$campaignId)) {
      $service = $this->user->GetCampaignService($this->version);

      $campaign = new Campaign();
      $campaign->name = 'Campaign #' . time();
      $campaign->status = 'PAUSED';
      $campaign->biddingStrategy = new ManualCPC();
      $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

      $operations = array(new CampaignOperation(NULL, $campaign, 'ADD'));

      BulkMutateJobServiceTest::$campaignId =
          $service->mutate($operations)->value[0]->id;
    }

    if (!isset(BulkMutateJobServiceTest::$adGroupId1)
        || !isset(BulkMutateJobServiceTest::$adGroupId1)) {
      $service = $this->user->GetAdGroupService($this->version);

      $adGroup1 = new AdGroup();
      $adGroup1->campaignId = BulkMutateJobServiceTest::$campaignId;
      $adGroup1->name = 'AdGroup #' . time();
      $adGroup1->status = 'ENABLED';
      $adGroup1->bids = new ManualCPCAdGroupBids();
      $adGroup1->bids->keywordMaxCpc = new Bid(new Money('1000000'));

      $adGroup2 = new AdGroup();
      $adGroup2->campaignId = BulkMutateJobServiceTest::$campaignId;
      $adGroup2->name = 'AdGroup #' . (time() + 1);
      $adGroup2->status = 'ENABLED';
      $adGroup2->bids = new ManualCPCAdGroupBids();
      $adGroup2->bids->keywordMaxCpc = new Bid(new Money('1000000'));

      $operations = array(new AdGroupOperation($adGroup1, 'ADD'),
          new AdGroupOperation($adGroup2, 'ADD'));

      $adGroups = $service->mutate($operations)->value;

      BulkMutateJobServiceTest::$adGroupId1 = $adGroups[0]->id;
      BulkMutateJobServiceTest::$adGroupId2 = $adGroups[1]->id;
    }
  }

  /**
   * Test whether we can fetch all jobs currently in the queue using v201008.
   */
  public function testGetAllJobs() {
    $jobs = $this->service->get(new BulkMutateJobSelector());
  }

  /**
   * Test whether we can fetch all COMPLETED jobs using v201008.
   */
  public function testGetAllCompletedJobs() {
    $jobs = $this->service->get(
        new BulkMutateJobSelector(NULL, array('COMPLETED')));
  }

  /**
   * Test whether we can set campaign targets using single part job with
   * single stream and multiple operations using v201008.
   */
  public function testSinglePartSingleStreamMultipleOperations() {
    $scopingEntityId =
        new EntityId('CAMPAIGN_ID', BulkMutateJobServiceTest::$campaignId);

    $operations = $this->CreateKeywordOperations(100);
    $operationStream = new OperationStream($scopingEntityId, $operations);
    $request = new BulkMutateRequest(0, $operationStream);

    $job = new BulkMutateJob();
    $job->request = $request;
    $job->numRequestParts = 1;

    $job = $this->service->mutate(new JobOperation($job, 'ADD'));

    $this->assertEquals('PENDING', $job->status);

    do {
      $jobs = $this->service->get(
          new BulkMutateJobSelector(array($job->id)));
      $job = $jobs[0];
      sleep(5);
    } while($job->status == 'PENDING' || $job->status == 'PROCESSING');

    $this->assertEquals('COMPLETED', $job->status);

    $jobs = $this->service->get(
        new BulkMutateJobSelector(array($job->id), NULL, 0));
    $job = $jobs[0];

    $operationResults =
        $job->result->operationStreamResults[0]->operationResults;

    $this->assertEquals(sizeof($operations), sizeof($operationResults));

    for ($i=0; $i<sizeof($operationResults); $i++) {
      $requestKeyword = $operations[$i]->operand->criterion;
      $resultKeyword =
          $operationResults[0]->returnValue->AdGroupCriterion->criterion;
      $this->assertEquals($requestKeyword->text, $resultKeyword->text);
    }
  }

  /**
   * Test whether we can add ads and keywords using multiple part job with
   * multiple streams using v201008.
   */
  public function testMultiplePartsSingleStreamMultipleOperations() {
    $scopingEntityId =
        new EntityId('CAMPAIGN_ID', BulkMutateJobServiceTest::$campaignId);

    $operations1 = $this->CreateKeywordOperations(100);
    $operationStream1 = new OperationStream($scopingEntityId, $operations1);
    $request1 = new BulkMutateRequest(0, $operationStream1);

    $job = new BulkMutateJob();
    $job->request = $request1;
    $job->numRequestParts = 2;

    $job = $this->service->mutate(new JobOperation($job, 'ADD'));

    $this->assertEquals('PENDING', $job->status);

    $operations2 = $this->CreateKeywordOperations(100);
    $operationStream2 = new OperationStream($scopingEntityId, $operations2);
    $request2 = new BulkMutateRequest(1, $operationStream2);

    $jobId = $job->id;
    $job = new BulkMutateJob();
    $job->id = $jobId;
    $job->request = $request2;

    $job = $this->service->mutate(new JobOperation($job, 'SET'));

    $this->assertEquals('PENDING', $job->status);

    do {
      $jobs = $this->service->get(
          new BulkMutateJobSelector(array($job->id)));
      $job = $jobs[0];
      sleep(5);
    } while($job->status == 'PENDING' || $job->status == 'PROCESSING');

    $this->assertEquals('COMPLETED', $job->status);

    $jobs = $this->service->get(
        new BulkMutateJobSelector(array($job->id), NULL, 0));
    $job = $jobs[0];
    $operationResults1 =
        $job->result->operationStreamResults[0]->operationResults;

    $this->assertEquals(sizeof($operations1), sizeof($operationResults1));

    for ($i=0; $i<sizeof($operationResults1); $i++) {
      $requestKeyword = $operations1[$i]->operand->criterion;
      $resultKeyword =
          $operationResults1[0]->returnValue->AdGroupCriterion->criterion;
      $this->assertEquals($requestKeyword->text, $resultKeyword->text);
    }

    $jobs = $this->service->get(
        new BulkMutateJobSelector(array($job->id), NULL, 1));
    $job = $jobs[0];
    $operationResults2 =
        $job->result->operationStreamResults[0]->operationResults;

    $this->assertEquals(sizeof($operations2), sizeof($operationResults2));

    for ($i=0; $i<sizeof($operationResults2); $i++) {
      $requestKeyword = $operations2[$i]->operand->criterion;
      $resultKeyword =
          $operationResults2[0]->returnValue->AdGroupCriterion->criterion;
      $this->assertEquals($requestKeyword->text, $resultKeyword->text);
    }
  }

  /**
   * Creates the specified number of new keyword operations.
   * @param int $num the number of operations to create
   * @return array an array of operations
   */
  private function CreateKeywordOperations($num) {
    $operations = array();
    for ($i=0; $i<$num; $i++) {
      $keyword = new Keyword('mars cruise ' . time(), 'BROAD');
      $adGroupCriterion = new BiddableAdGroupCriterion();
      $adGroupCriterion->adGroupId = BulkMutateJobServiceTest::$adGroupId1;
      $adGroupCriterion->criterion = $keyword;
      $operations[] =
          new AdGroupCriterionOperation($adGroupCriterion, NULL, 'ADD');
    }
    return $operations;
  }
}
