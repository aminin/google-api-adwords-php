<?php
/**
 * Functional tests for BulkMutateJobService.
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
 * Functional tests for BulkMutateJobService.
 *
 * @author api.arogal@gmail.com
 */
class BulkMutateJobServiceTest extends PHPUnit_Framework_TestCase {
  private $version = 'v200909';
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
      $adGroup1->bids->keywordMaxCpc = new Money('1000000');

      $adGroup2 = new AdGroup();
      $adGroup2->campaignId = BulkMutateJobServiceTest::$campaignId;
      $adGroup2->name = 'AdGroup #' . (time() + 1);
      $adGroup2->status = 'ENABLED';
      $adGroup2->bids = new ManualCPCAdGroupBids();
      $adGroup2->bids->keywordMaxCpc = new Money('1000000');

      $operations = array(new AdGroupOperation($adGroup1, 'ADD'),
          new AdGroupOperation($adGroup2, 'ADD'));

      $adGroups = $service->mutate($operations)->value;

      BulkMutateJobServiceTest::$adGroupId1 = $adGroups[0]->id;
      BulkMutateJobServiceTest::$adGroupId2 = $adGroups[1]->id;
    }
  }

  /**
   * Test whether we can fetch all jobs currently in the queue using v200909.
   */
  public function testGetAllJobs() {
    $jobs = $this->service->get(new BulkMutateJobSelector());
  }

  /**
   * Test whether we can fetch all COMPLETED jobs using v200909.
   */
  public function testGetAllCompletedJobs() {
    $jobs = $this->service->get(
        new BulkMutateJobSelector(NULL, array('COMPLETED')));
  }

  /**
   * Test whether we can set campaign targets using single part job with
   * single stream and multiple operations using v200909.
   */
  public function testSinglePartSingleStreamMultipleOperations() {
    $scopingEntityId =
        new EntityId('CAMPAIGN_ID', BulkMutateJobServiceTest::$campaignId);

    $geoTargetList = new GeoTargetList(
        array(new CityTarget('New York', 'US-NY', 'US', NULL, 'CityTarget')),
        BulkMutateJobServiceTest::$campaignId, 'GeoTargetList');

    $networkTargetList = new NetworkTargetList(
        array(new NetworkTarget('CONTENT_NETWORK', 'NetworkTarget')),
        BulkMutateJobServiceTest::$campaignId, 'NetworkTargetList');

    $languageTargetList = new LanguageTargetList(
        array(new LanguageTarget('en', 'LanguageTarget')),
        BulkMutateJobServiceTest::$campaignId, 'LanguageTargetList');

    $operations = array(
        new CampaignTargetOperation($geoTargetList, 'SET'),
        new CampaignTargetOperation($networkTargetList, 'SET'),
        new CampaignTargetOperation($languageTargetList, 'SET'));

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

    $this->assertEquals($geoTargetList,
        $operationResults[0]->returnValue->TargetList);
    $this->assertEquals($networkTargetList,
        $operationResults[1]->returnValue->TargetList);
    $this->assertEquals($languageTargetList,
        $operationResults[2]->returnValue->TargetList);
  }

  /**
   * Test whether we can add ads and keywords using multiple part job with
   * multiple streams using v200909.
   */
  public function testMultiplePartsSingleStreamMultipleOperations() {
    $scopingEntityId =
        new EntityId('CAMPAIGN_ID', BulkMutateJobServiceTest::$campaignId);

    $ad1 = new TextAd('Luxury Cruise to Mars is here now!!!',
        'Visit the Red Planet in style.', 'Low-gravity fun for everyone!', NULL,
        'http://www.example.com', 'example.com', NULL, NULL, 'TextAd');
    $adGroupAd1 = new AdGroupAd(BulkMutateJobServiceTest::$adGroupId1, $ad1);

    $ad2 = new TextAd('Luxury Cruise to Mars is here now!!!',
        'Visit the Red Planet in style.', 'Low-gravity fun for everyone!', NULL,
        'http://www.example.com', 'example.com', NULL, NULL, 'TextAd');
    $adGroupAd2 = new AdGroupAd(BulkMutateJobServiceTest::$adGroupId2, $ad2);

    $adStream = new OperationStream(
        $scopingEntityId,
        array(new AdGroupAdOperation($adGroupAd1, NULL, 'ADD'),
            new AdGroupAdOperation($adGroupAd2, NULL, 'ADD')));

    $part1 = new BulkMutateRequest(0, array($adStream));

    $job = new BulkMutateJob();
    $job->request = $part1;
    $job->numRequestParts = 2;

    $job = $this->service->mutate(new JobOperation($job, 'ADD'));

    $this->assertEquals('PENDING', $job->status);

    $keyword1 = new Keyword('mars cruise', 'BROAD', NULL, 'Keyword');
    $biddableAdGroupCriterion1 = new BiddableAdGroupCriterion(NULL, NULL, NULL,
        NULL, NULL, NULL, NULL, NULL, BulkMutateJobServiceTest::$adGroupId1,
        $keyword1, 'BiddableAdGroupCriterion');

    $keyword2 = new Keyword('mars cruise', 'EXACT', NULL, 'Keyword');
    $biddableAdGroupCriterion2 = new BiddableAdGroupCriterion(NULL, NULL, NULL,
        NULL, NULL, NULL, NULL, NULL, BulkMutateJobServiceTest::$adGroupId2,
        $keyword2, 'BiddableAdGroupCriterion');

    $keywordStream = new OperationStream(
        $scopingEntityId,array(
            new AdGroupCriterionOperation($biddableAdGroupCriterion1, NULL,
                'ADD'),
            new AdGroupCriterionOperation($biddableAdGroupCriterion2, NULL,
                'ADD')));

    $part2 = new BulkMutateRequest(1, array($keywordStream));

    $jobId = $job->id;
    $job = new BulkMutateJob();
    $job->id = $jobId;
    $job->request = $part2;

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

    $jobs = $this->service->get(
        new BulkMutateJobSelector(array($job->id), NULL, 1));
    $job = $jobs[0];
    $operationResults2 =
        $job->result->operationStreamResults[0]->operationResults;

    $this->assertTrue($operationResults1[0] instanceof FailureResult);
    $this->assertTrue($operationResults1[1] instanceof BatchFailureResult);

    $testKeyword1 =
        $operationResults2[0]->returnValue->AdGroupCriterion->criterion;
    $testKeyword2 =
        $operationResults2[1]->returnValue->AdGroupCriterion->criterion;

    $keyword1->id = $testKeyword1->id;
    $keyword2->id = $testKeyword2->id;

    $this->assertEquals($keyword1, $testKeyword1);
    $this->assertEquals($keyword2, $testKeyword2);
  }
}
