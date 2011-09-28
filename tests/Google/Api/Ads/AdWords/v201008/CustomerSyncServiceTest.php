<?php
/**
 * Functional tests for CustomerSyncService.
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
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

$path = dirname(__FILE__) . '/../../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once 'Google/Api/Ads/AdWords/v201008/AdGroupAdService.php';
require_once 'Google/Api/Ads/Common/Util/MediaUtils.php';

/**
 * Functional tests for CustomerSyncService.
 */
class CustomerSyncServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    $suite->SetRequires(array('CAMPAIGN'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetService('CustomerSyncService');

    $this->campaignId = $this->sharedFixture['campaignId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
  }

  /**
   * Test getting changes for a campaign.
   * @covers CustomerSyncService::get
   */
  public function testGet() {
    $selector = new CustomerSyncSelector();
    $selector->campaignIds = array($this->campaignId);

    $dateTimeRange = new DateTimeRange();
    $dateTimeRange->min = date('Ymd hms', strtotime('-1 day'));
    $dateTimeRange->max = date('Ymd hms');
    $selector->dateTimeRange = $dateTimeRange;

    $result = $this->service->get($selector);

    $this->assertNotNull($result);
    $this->assertEquals(1, sizeof($result->changedCampaigns));
    $this->assertEquals($this->campaignId,
        $result->changedCampaigns[0]->campaignId);
  }
}
