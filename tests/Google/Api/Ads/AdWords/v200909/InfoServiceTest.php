<?php
/**
 * Functional tests for InfoService.
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
 * @subpackage v200909
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'PHPUnit/Framework.php';

/**
 * Functional tests for InfoService.
 *
 * @author api.arogal@gmail.com
 */
class InfoServiceTest extends PHPUnit_Framework_TestCase {
  private $version = 'v200909';
  private $user;
  private $service;

  private static $clientId;

  protected function setUp() {
    $authFile =
        dirname(__FILE__) . '/../../../../../../test_data/test_auth.ini';
    $settingsFile =
        dirname(__FILE__) . '/../../../../../../test_data/test_settings.ini';
    $this->user = new AdWordsUser($authFile, NULL, NULL, NULL,
        NULL, NULL, NULL, $settingsFile);
    InfoServiceTest::$clientId = $this->user->GetClientId();
    $this->user->SetClientId(NULL);
    $this->user->LogDefaults();
    $this->service =
        $this->user->GetInfoService($this->version);
  }

  /**
   * Test whether we can get free usage units per month using v200909.
   */
  public function testGetFreeUsageUnitsPerMonth() {
    $selector = new InfoSelector(NULL, NULL, NULL,
        NULL, NULL, 'FREE_USAGE_API_UNITS_PER_MONTH');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertFalse(isset($apiUsageInfo->apiUsageRecords));
    $this->assertTrue(isset($apiUsageInfo->cost));
  }

  /**
   * Test whether we can get total usage units per month using v200909.
   */
  public function testGetTotalUsageUnitsPerMonth() {
    $selector = new InfoSelector(NULL, NULL, NULL,
        NULL, NULL, 'TOTAL_USAGE_API_UNITS_PER_MONTH');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertFalse(isset($apiUsageInfo->apiUsageRecords));
    $this->assertTrue(isset($apiUsageInfo->cost));
  }

  /**
   * Test whether we can get operation count using v200909.
   */
  public function testGetOperationCount() {
    $selector = new InfoSelector('CampaignService', 'get', NULL,
        new DateRange('20090601', '20090831'), NULL, 'OPERATION_COUNT');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertFalse(isset($apiUsageInfo->apiUsageRecords));
    $this->assertTrue(isset($apiUsageInfo->cost));
  }

  /**
   * Test whether we can get unit count using v200909.
   */
  public function testGetUnitCount() {
    $selector = new InfoSelector('CampaignService', 'get', NULL,
        new DateRange('20090601', '20090831'), NULL, 'UNIT_COUNT');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertFalse(isset($apiUsageInfo->apiUsageRecords));
    $this->assertTrue(isset($apiUsageInfo->cost));
  }

  /**
   * Test whether we can get unit count for clients using v200909.
   */
  public function testGetUnitCountForClients() {
    $selector = new InfoSelector('CampaignService', 'get', NULL,
        new DateRange('20090601', '20090831'),
        array(InfoServiceTest::$clientId), 'UNIT_COUNT_FOR_CLIENTS');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertTrue(isset($apiUsageInfo->apiUsageRecords));
    $this->assertEquals(InfoServiceTest::$clientId,
        $apiUsageInfo->apiUsageRecords[0]->clientEmail);
    $this->assertEquals(0, $apiUsageInfo->cost);
  }

  /**
   * Test whether we can get method cost using v200909.
   */
  public function testGetMethodCost() {
    $selector = new InfoSelector('CampaignService', 'get', NULL,
        new DateRange('20090601', '20090601'),
        array(InfoServiceTest::$clientId), 'METHOD_COST');
    $apiUsageInfo = $this->service->get($selector);

    $this->assertFalse(isset($apiUsageInfo->apiUsageRecords));
    $this->assertEquals(1, $apiUsageInfo->cost);
  }
}
