<?php
/**
 * Integration tests for basic operations examples.
 *
 * PHP version 5
 *
 * Copyright 2012, Google Inc. All Rights Reserved.
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
 * @subpackage v201109
 * @category   WebServices
 * @copyright  2012, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <eric.koleda@google.com>
 */

error_reporting(E_STRICT | E_ALL);

$testsPath = dirname(__FILE__) . '/../../';
require_once $testsPath . 'Google/Api/Ads/AdWords/AdWordsTestSuite.php';
require_once $testsPath . 'Google/Api/Ads/Common/AdsTestCase.php';

// Include all example code.
$examplesPath = dirname(__FILE__) . '/../../../examples/';
foreach (glob($examplesPath . 'v201109/BasicOperations/*.php') as $filename)
{
  require_once $filename;
}

/**
 * Integration tests for basic operations examples.
 */
class BasicOperationsTest extends AdsTestCase {
  private $user;
  private $testUtils;

  private $campaignId;
  private $adGroupId;

  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201109');
    return $suite;
  }

  protected function setUp() {
    $this->user = $this->sharedFixture['user'];
    $this->testUtils = $this->sharedFixture['testUtils'];

    $this->campaignId = $this->testUtils->CreateCampaign();
    $this->adGroupId = $this->testUtils->CreateAdGroup($this->campaignId);

    // Suppress output from the example code.
    ob_start();
  }

  protected function tearDown() {
    $this->testUtils->DeleteCampaign($this->campaignId);

    // Restore output buffer.
    ob_end_clean();

    // Sleep to avoid rate exceeded errors.
    sleep(5);
  }

  public function testAddAdGroupsExample() {
    AddAdGroupsExample($this->user, $this->campaignId);
  }

  public function testAddCampaignsExample() {
    AddCampaignsExample($this->user);
  }

  public function testAddKeywordsExample() {
    AddKeywordsExample($this->user, $this->adGroupId);
  }

  public function testAddTextAdsExample() {
    AddTextAdsExample($this->user, $this->adGroupId);
  }

  public function testDeleteAdExample() {
    $adId = $this->testUtils->CreateTextAd($this->adGroupId);
    DeleteAdExample($this->user, $this->adGroupId, $adId);
  }

  public function testDeleteAdGroupExample() {
    $adGroupId = $this->testUtils->CreateAdGroup($this->campaignId);
    DeleteAdGroupExample($this->user, $adGroupId);
  }

  public function testDeleteCampaignExample() {
    $campaignId = $this->testUtils->CreateCampaign();
    DeleteCampaignExample($this->user, $campaignId);
  }

  public function testDeleteKeywordExample() {
    $criterionId = $this->testUtils->CreateKeyword($this->adGroupId);
    DeleteKeywordExample($this->user, $this->adGroupId, $criterionId);
  }

  public function testGetAdGroupsExamples() {
    GetAdGroupsExample($this->user, $this->campaignId);
  }

  public function testGetCampaignsExample() {
    GetCampaignsExample($this->user);
  }

  public function testGetKeywordsExample() {
    GetKeywordsExample($this->user, $this->adGroupId);
  }

  public function testGetTextAdsExample() {
    GetTextAdsExample($this->user, $this->adGroupId);
  }

  public function testPauseAdExample() {
    $adId = $this->testUtils->CreateTextAd($this->adGroupId);
    PauseAdExample($this->user, $this->adGroupId, $adId);
  }

  public function testUpdateAdGroupExample() {
    $adGroupId = $this->testUtils->CreateAdGroup($this->campaignId);
    UpdateAdGroupExample($this->user, $adGroupId);
  }

  public function testUpdateCampaignExample() {
    $campaignId = $this->testUtils->CreateCampaign();
    UpdateCampaignExample($this->user, $campaignId);
  }

  public function testUpdateKeywordExample() {
    $criterionId = $this->testUtils->CreateKeyword($this->adGroupId);
    UpdateKeywordExample($this->user, $this->adGroupId, $criterionId);
  }
}
