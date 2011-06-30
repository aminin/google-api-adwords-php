<?php
/**
 * Functional tests for TrafficEstimatorService.
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

/**
 * Functional tests for TrafficEstimatorService.
 */
class TrafficEstimatorServiceTest extends AdsTestCase {
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
    $this->service = $user->GetTrafficEstimatorService();
  }

  /**
   * Test getting traffic estimates for a proposed campaign and ad group.
   * @covers TrafficEstimatorService::get
   */
  public function testGet() {
    $keyword = new Keyword('mars cruise', 'BROAD');

    $keywordRequest = new KeywordEstimateRequest();
    $keywordRequest->keyword = $keyword;
    $keywordRequest->maxCpc = new Money(1000000);

    $adGroupRequest = new AdGroupEstimateRequest();
    $adGroupRequest->keywordEstimateRequests = array($keywordRequest);
    $adGroupRequest->maxCpc = new Money(2000000);

    $campaignRequest = new CampaignEstimateRequest();
    $campaignRequest->adGroupEstimateRequests = array($adGroupRequest);
    $campaignRequest->targets[] = new CountryTarget('CA');
    $campaignRequest->targets[] = new ProvinceTarget('US-NY');
    $campaignRequest->targets[] = new MetroTarget(504);
    $campaignRequest->targets[] = new CityTarget('Alstead', 'US-NH', 'US');
    $campaignRequest->targets[] = new LanguageTarget('en');

    $selector = new TrafficEstimatorSelector();
    $selector->campaignEstimateRequests = array($campaignRequest);

    $result = $this->service->get($selector);

    $this->assertEquals(1, sizeof($result->campaignEstimates));
    $this->assertEquals(1,
        sizeof($result->campaignEstimates[0]->adGroupEstimates));
    $this->assertEquals(1, sizeof(
        $result->campaignEstimates[0]->adGroupEstimates[0]->keywordEstimates));
  }

  /**
   * Test getting traffic estimates for an existing campaign.
   * @covers TrafficEstimatorService::get
   */
  public function testGetForCampaign() {
    $keyword = new Keyword('mars cruise', 'BROAD');

    $keywordRequest = new KeywordEstimateRequest();
    $keywordRequest->keyword = $keyword;
    $keywordRequest->maxCpc = new Money(1000000);

    $adGroupRequest = new AdGroupEstimateRequest();
    $adGroupRequest->keywordEstimateRequests = array($keywordRequest);
    $adGroupRequest->maxCpc = new Money(2000000);

    $campaignRequest = new CampaignEstimateRequest();
    $campaignRequest->campaignId = $this->campaignId;
    $campaignRequest->adGroupEstimateRequests = array($adGroupRequest);

    $selector = new TrafficEstimatorSelector();
    $selector->campaignEstimateRequests = array($campaignRequest);

    $result = $this->service->get($selector);

    $this->assertEquals(1, sizeof($result->campaignEstimates));
    $this->assertEquals($this->campaignId,
        $result->campaignEstimates[0]->campaignId);
    $this->assertEquals(1,
        sizeof($result->campaignEstimates[0]->adGroupEstimates));
    $this->assertEquals(1, sizeof(
        $result->campaignEstimates[0]->adGroupEstimates[0]->keywordEstimates));
  }

  /**
   * Test getting traffic estimates for an existing campaign and ad group.
   * @covers TrafficEstimatorService::get
   */
  public function testGetForCampaignAndAdGroup() {
    $keyword = new Keyword('mars cruise', 'BROAD');

    $keywordRequest = new KeywordEstimateRequest();
    $keywordRequest->keyword = $keyword;
    $keywordRequest->maxCpc = new Money(1000000);

    $adGroupRequest = new AdGroupEstimateRequest();
    $adGroupRequest->adGroupId = $this->adGroupId;
    $adGroupRequest->keywordEstimateRequests = array($keywordRequest);

    $campaignRequest = new CampaignEstimateRequest();
    $campaignRequest->campaignId = $this->campaignId;
    $campaignRequest->adGroupEstimateRequests = array($adGroupRequest);

    $selector = new TrafficEstimatorSelector();
    $selector->campaignEstimateRequests = array($campaignRequest);

    $result = $this->service->get($selector);

    $this->assertEquals(1, sizeof($result->campaignEstimates));
    $this->assertEquals($this->campaignId,
        $result->campaignEstimates[0]->campaignId);
    $this->assertEquals(1,
        sizeof($result->campaignEstimates[0]->adGroupEstimates));
    $this->assertEquals($this->adGroupId,
        $result->campaignEstimates[0]->adGroupEstimates[0]->adGroupId);
    $this->assertEquals(1, sizeof(
        $result->campaignEstimates[0]->adGroupEstimates[0]->keywordEstimates));
  }
}
