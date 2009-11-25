<?php
/**
 * Functional tests for the validateOnly header.
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
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'PHPUnit/Framework.php';

/**
 * Functional tests for the validateOnly header.
 *
 * @author api.ekoleda@gmail.com
 */
class ValidateOnlyTest extends PHPUnit_Framework_TestCase {
  private $version = 'v200909';
  private $server = 'http://adwords-sandbox.google.com';
  private $user;
  private $campaignValidationService;

  protected function setUp() {
    $this->user = new AdWordsUser(dirname(__FILE__)
        . '/../../../../../../test_data/test_auth.ini');
    $this->user->LogDefaults();
    $this->campaignValidationService =
        $this->user->GetCampaignService($this->version, $this->server, NULL,
            true);
  }

  /**
   * Test whether we can validate a correctly formed create campaign request
   * using v200909.
   */
  public function testValidCreateCampaignV200909() {
    $campaign = new Campaign();
    $campaign->name = 'Campaign #' . time();
    $campaign->status = 'PAUSED';
    $campaign->biddingStrategy = new ManualCPC();
    $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

    $operations = array(new CampaignOperation(NULL, $campaign, 'ADD'));

    $campaignReturnValue = $this->campaignValidationService->mutate(
        $operations);

    $this->assertNull($campaignReturnValue);
  }

  /**
   * Test whether we can validate an incorrectly formed create campaign request
   * using v200909.
   */
  public function testInvalidCreateCampaignV200909() {
    $campaign = new Campaign();

    $operations = array(new CampaignOperation(NULL, $campaign, 'ADD'));

    try {
      $campaignReturnValue = $this->campaignValidationService->mutate(
          $operations);
      $this->fail('The expected SoapFault was not thrown.');
    } catch (SoapFault $expected) {
      $this->assertNotNull($expected->detail->ApiExceptionFault);
    }
  }
}
