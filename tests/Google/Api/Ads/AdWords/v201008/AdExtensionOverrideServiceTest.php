<?php
/**
 * Functional tests for AdExtensionOverrideService.
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
require_once 'Google/Api/Ads/AdWords/v201008/AdExtensionOverrideService.php';

/**
 * Functional tests for AdExtensionOverrideService.
 */
class AdExtensionOverrideServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $adGroupId;
  private $adIdWithExtension;
  private $adIdWithoutExtension;
  private $adExtensionId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    $suite->SetRequires(array('CAMPAIGN', 'AD_GROUP', 'CAMPAIGN_AD_EXTENSION'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetService('AdExtensionOverrideService');

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->adGroupId = $this->sharedFixture['adGroupId'];
    $this->adExtensionId = $this->sharedFixture['adExtensionId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->adIdWithExtension = $this->testUtils->CreateTextAd($this->adGroupId);
    $this->adIdWithoutExtension =
        $this->testUtils->CreateTextAd($this->adGroupId);
    $this->testUtils->CreateAdExtensionOverride($this->adIdWithExtension,
        $this->adExtensionId);
  }

  /**
   * Test adding an ad extension override.
   * @covers AdExtensionOverrideService::mutate
   */
  public function testAdd() {
    $adExtension = new AdExtension();
    $adExtension->id = $this->adExtensionId;

    $adExtensionOverride = new AdExtensionOverride();
    $adExtensionOverride->adId = $this->adIdWithoutExtension;
    $adExtensionOverride->adExtension = $adExtension;
    $adExtensionOverride->overrideInfo =
        new OverrideInfo(new LocationOverrideInfo(30, 'MILES'));
    $adExtensionOverride->status = 'ACTIVE';

    $operations =
        array(new AdExtensionOverrideOperation($adExtensionOverride, 'ADD'));
    $testAdExtensionOverride = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('adExtension', 'approvalStatus', 'stats');
    $this->assertEqualsWithExclusions($adExtensionOverride,
        $testAdExtensionOverride, $excludeFields);
  }

  /**
   * Test removing an ad extension override.
   * @covers AdExtensionOverrideService::mutate
   */
  public function testRemove() {
    $adExtension = new AdExtension();
    $adExtension->id = $this->adExtensionId;

    $adExtensionOverride = new AdExtensionOverride();
    $adExtensionOverride->adId = $this->adIdWithExtension;
    $adExtensionOverride->adExtension = $adExtension;

    $operations =
        array(new AdExtensionOverrideOperation($adExtensionOverride, 'REMOVE'));
    $testAdExtensionOverride = $this->service->mutate($operations)->value[0];

    $this->assertEquals('DELETED', $testAdExtensionOverride->status);
  }

  /**
   * Test getting an ad extension override.
   * @covers AdExtensionOverrideService::get
   */
  public function testGet() {
    $selector = new AdExtensionOverrideSelector();
    $selector->adIds = array($this->adIdWithExtension);
    $selector->adExtensionIds = array($this->adExtensionId);
    $selector->statuses = array('ACTIVE', 'DELETED');

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad extension overrides for an ad.
   * @covers AdExtensionOverrideService::get
   */
  public function testGetAllForAd() {
    $selector = new AdExtensionOverrideSelector();
    $selector->adIds = array($this->adIdWithExtension);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad extension overrides for an ad extension.
   * @covers AdExtensionOverrideService::get
   */
  public function testGetAllForAdExtension() {
    $selector = new AdExtensionOverrideSelector();
    $selector->adExtensionIds = array($this->adExtensionId);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad extension overrides for a campaign.
   * @covers AdExtensionOverrideService::get
   */
  public function testGetAllForCampaign() {
    $selector = new AdExtensionOverrideSelector();
    $selector->campaignIds = array($this->campaignId);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad extension overrides.
   * @covers AdGroupAdService::get
   */
  public function testGetAll() {
    $selector = new AdExtensionOverrideSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }
}
