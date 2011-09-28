<?php
/**
 * Functional tests for the validateOnly header.
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
 * @subpackage v201003
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
require_once 'Google/Api/Ads/AdWords/v201003/CampaignService.php';

/**
 * Functional tests for the validateOnly header.
 *
 * @author api.ekoleda@gmail.com
 */
class ValidateOnlyTest extends AdsTestCase {
  private $service;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201003');
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service =
        $user->GetService('CampaignService', NULL, NULL, NULL, TRUE);
  }

  /**
   * Test whether we can validate a correctly formed create campaign request.
   */
  public function testValidCreateCampaign() {
    $campaign = new Campaign();
    $campaign->name = 'Campaign #' . time();
    $campaign->status = 'PAUSED';
    $campaign->biddingStrategy = new ManualCPC();
    $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

    $operations = array(new CampaignOperation(NULL, $campaign, 'ADD'));

    $campaignReturnValue = $this->service->mutate($operations);

    $this->assertNull($campaignReturnValue);
  }

  /**
   * Test whether we can validate an incorrectly formed create campaign request.
   * @expectedException SoapFault
   */
  public function testInvalidCreateCampaign() {
    $campaign = new Campaign();

    $operations = array(new CampaignOperation(NULL, $campaign, 'ADD'));

    $campaignReturnValue = $this->service->mutate($operations);
  }
}
