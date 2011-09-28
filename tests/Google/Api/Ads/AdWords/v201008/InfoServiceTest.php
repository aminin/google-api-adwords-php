<?php
/**
 * Functional tests for InfoService.
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
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

$path = dirname(__FILE__) . '/../../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once 'Google/Api/Ads/AdWords/v201008/InfoService.php';

/**
 * Functional tests for InfoService.
 *
 * @author api.arogal@gmail.com
 */
class InfoServiceTest extends AdsTestCase {
  private $service;

  private $clientId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['mccUser'];
    $this->service = $user->GetService('InfoService');

    $this->clientId = $this->sharedFixture['clientId'];
  }

  /**
   * Test getting API usage.
   * @param string $apiUsageType the API usage type
   * @dataProvider apiUsageTypeProvider
   * @covers InfoService::get
   */
  public function testGetApiUsage($apiUsageType) {
    $selector = new InfoSelector();
    $selector->serviceName = 'CampaignService';
    $selector->methodName = 'mutate';
    $selector->operator = 'ADD';
    $selector->dateRange =  new DateRange(date('Ym01'), date('Ymd'));
    $selector->apiUsageType = $apiUsageType;

    $apiUsageInfo = $this->service->get($selector);

    $this->assertNull($apiUsageInfo->apiUsageRecords);
    $this->assertNotNull($apiUsageInfo->cost);
  }

  /**
   * Test getting monthly API usage limits.
   * @param string $apiUsageType the API usage type
   * @dataProvider monthlyLimitApiUsageTypeProvider
   * @covers InfoService::get
   */
  public function testGetMonthyLimits($apiUsageType) {
    $selector = new InfoSelector();
    $selector->apiUsageType = $apiUsageType;
    $apiUsageInfo = $this->service->get($selector);

    $this->assertNull($apiUsageInfo->apiUsageRecords);
    $this->assertNotNull($apiUsageInfo->cost);
  }

  /**
   * Test getting a unit count for clients.
   * @covers InfoService::get
   */
  public function testGetUnitCountForClients() {
    $selector = new InfoSelector('CampaignService', 'mutate', 'ADD',
        new DateRange(date('Ym01'), date('Ymd')), array($this->clientId),
        'UNIT_COUNT_FOR_CLIENTS');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertNotNull($apiUsageInfo->apiUsageRecords);
    $this->assertEquals($this->clientId,
        $apiUsageInfo->apiUsageRecords[0]->clientEmail);
    $this->assertNotNull($apiUsageInfo->apiUsageRecords[0]->cost);
    $this->assertEquals(0, $apiUsageInfo->cost);
  }

  /**
   * Test getting the cost of a method.
   * @covers InfoService::get
   */
  public function testGetMethodCost() {
    $selector = new InfoSelector('CampaignService', 'mutate', 'ADD',
        new DateRange(date('Ymd'), date('Ymd')), NULL, 'METHOD_COST');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertNull($apiUsageInfo->apiUsageRecords);
    $this->assertNotNull($apiUsageInfo->cost);
  }

  /**
   * Provides apiUsageTypes for InfoSelectors.
   * @return array an array of apiUsageType (as an array)
   */
  public function apiUsageTypeProvider() {
    $data = array();

    // Unit count.
    $data[] = array('UNIT_COUNT');
    // Operation count.
    $data[] = array('OPERATION_COUNT');

    return $data;
  }

  /**
   * Provides monthly limit apiUsageTypes for InfoSelectors.
   * @return array an array of apiUsageType (as an array)
   */
  public function monthlyLimitApiUsageTypeProvider() {
    $data = array();

    // Free units.
    $data[] = array('FREE_USAGE_API_UNITS_PER_MONTH');
    // Unit cap.
    $data[] = array('TOTAL_USAGE_API_UNITS_PER_MONTH');

    return $data;
  }
}
