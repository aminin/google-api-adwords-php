<?php
/**
 * Functional tests for AdGroupAdService.
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
 * Functional tests for AdGroupAdService.
 */
class AdGroupAdServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $campaignId;
  private $adGroupId;
  private $adId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    $suite->SetRequires(array('CAMPAIGN', 'AD_GROUP'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetAdGroupAdService();

    $this->campaignId = $this->sharedFixture['campaignId'];
    $this->adGroupId = $this->sharedFixture['adGroupId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->adId = $this->testUtils->CreateTextAd($this->adGroupId);
  }

  /**
   * Test adding an ad group ad.
   * @covers AdGroupAdService::mutate
   * @param Ad $ad the ad to add
   * @dataProvider adProvider
   */
  public function testAdd($ad) {
    $adGroupAd = new AdGroupAd();
    $adGroupAd->adGroupId = $this->adGroupId;
    $adGroupAd->ad = $ad;
    $adGroupAd->status = 'PAUSED';

    $operations = array(new AdGroupAdOperation($adGroupAd, NULL, 'ADD'));
    $testAdGroupAd = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('ad->id', 'ad->approvalStatus', 'ad->AdType',
        'ad->image', 'ad->templateElements');
    $this->assertEqualsWithExclusions($adGroupAd, $testAdGroupAd,
        $excludeFields);
  }

  /**
   * Test updating an ad group ad.
   * @covers AdGroupAdService::mutate
   */
  public function testUpdate() {
    $adGroupAd = new AdGroupAd();
    $adGroupAd->adGroupId = $this->adGroupId;
    $adGroupAd->ad = new Ad($this->adId);
    $adGroupAd->status = 'PAUSED';

    $operations = array(new AdGroupAdOperation($adGroupAd, NULL, 'SET'));
    $testAdGroupAd = $this->service->mutate($operations)->value[0];

    $this->assertEquals($adGroupAd->status, $testAdGroupAd->status);
  }

  /**
   * Test removing an ad group ad.
   * @covers AdGroupService::mutate
   */
  public function testRemove() {
    $adGroupAd = new AdGroupAd();
    $adGroupAd->adGroupId = $this->adGroupId;
    $adGroupAd->ad = new Ad($this->adId);

    $operations = array(new AdGroupAdOperation($adGroupAd, NULL, 'REMOVE'));
    $testAdGroupAd = $this->service->mutate($operations)->value[0];

    $this->assertEquals('DISABLED', $testAdGroupAd->status);
  }

  /**
   * Test getting an ad group ad.
   * @covers AdGroupAdService::get
   */
  public function testGet() {
    $selector = new AdGroupAdSelector();
    $selector->adIds = array($this->adId);
    $selector->statsSelector =
        new AdStatsSelector(new DateRange(date('Ym01'), date('Ymd')));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
    $this->assertNotNull($page->entries[0]->stats);
  }

  /**
   * Test getting all ad group ads in an ad group.
   * @covers AdGroupAdService::get
   */
  public function testGetAllInAdGroup() {
    $selector = new AdGroupAdSelector();
    $selector->adGroupIds = array($this->adGroupId);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad group ads in a campaign.
   * @covers AdGroupAdService::get
   */
  public function testGetAllInCampaign() {
    $selector = new AdGroupAdSelector();
    $selector->campaignIds = array($this->campaignId);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting all ad group ads.
   * @covers AdGroupAdService::get
   */
  public function testGetAll() {
    $selector = new AdGroupAdSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Provides ads.
   * @return array an array of arrays, each containing one ad
   */
  function adProvider() {
    $data = array();

    // Text ad.
    $ad = new TextAd();
    $ad->url = 'http://www.example.com';
    $ad->displayUrl = 'www.example.com';
    $ad->headline = 'Text Ad';
    $ad->description1 = 'Description 1';
    $ad->description2 = 'Description 2';
    $data[] = array($ad);

    // Image ad.
    $ad = new ImageAd();
    $ad->url = 'http://www.example.com';
    $ad->displayUrl = 'www.example.com';
    $ad->image = new Image(MediaUtils::GetBase64Data('http://goo.gl/HJM3L'));
    $ad->name = 'Image Ad';
    $data[] = array($ad);

    // Template ad, All purpose 15.
    $ad = new TemplateAd();
    $ad->url = 'http://www.example.com';
    $ad->displayUrl = 'www.example.com';
    $ad->templateId = 51;
    $ad->templateElements = array(
        new TemplateElement('adData', array(
            new TemplateElementField('displayUrlColor', 'ENUM', '#000000'),
            new TemplateElementField('text1', 'TEXT', 'Headline'),
            new TemplateElementField('text1Font', 'ENUM', 'arial'),
            new TemplateElementField('text1Color', 'ENUM', '#000000'),
            new TemplateElementField('text2', 'TEXT', 'Description line 1'),
            new TemplateElementField('text2Font', 'ENUM', 'arial'),
            new TemplateElementField('text2Color', 'ENUM', '#000000'),
            new TemplateElementField('text3', 'TEXT', 'Description line 2'),
            new TemplateElementField('text3Font', 'ENUM', 'arial'),
            new TemplateElementField('text3Color', 'ENUM', '#000000'),
            new TemplateElementField('clickText', 'TEXT', 'Click text'),
            new TemplateElementField('clickTextFont', 'ENUM', 'arial'),
            new TemplateElementField('clickTextColor', 'ENUM', '#000000'),
            new TemplateElementField('buttonColor', 'ENUM', '#000000'),
            new TemplateElementField('back1Color', 'ENUM', '#000000'))));
    $ad->dimensions = new Dimensions(300, 250);
    $ad->name = "Template Ad";
    $data[] = array($ad);

    // Mobile ad.
    $ad = new MobileAd();
    $ad->url = 'http://www.example.com';
    $ad->displayUrl = 'www.example.com';
    $ad->headline = 'Text Ad';
    $ad->description = 'Description';
    $ad->markupLanguages = array('HTML');
    $ad->mobileCarriers = array('ALLCARRIERS');
    $ad->businessName = 'Business Name';
    $ad->countryCode = 'US';
    $ad->phoneNumber = '1-212-555-5555';
    $data[] = array($ad);

    // Mobile image ad.
    $ad = new MobileImageAd();
    $ad->url = 'http://www.example.com';
    $ad->displayUrl = 'www.example.com';
    $ad->markupLanguages = array('HTML');
    $ad->mobileCarriers = array('ALLCARRIERS');
    $ad->image = new Image(MediaUtils::GetBase64Data(
        'http://adwords.google.com/select/images/samples/mobile300-50.gif'));
    $data[] = array($ad);

    // Product ad.
    $ad = new ProductAd();
    $ad->promotionLine = "Promotion Line";
    $data[] = array($ad);

    return $data;
  }
}
