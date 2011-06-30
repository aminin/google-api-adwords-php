<?php
/**
 * Functional tests for ConversionTrackerService.
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
require_once 'Google/Api/Ads/AdWords/v201101/CampaignService.php';

/**
 * Functional tests for ConversionTrackerService.
 */
class ConversionTrackerServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $conversionTrackerId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201101');
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetConversionTrackerService();
    $this->testUtils = $this->sharedFixture['testUtils'];

    $this->conversionTrackerId = $this->testUtils->CreateConversionTracker();
  }

  /**
   * Test adding a conversion tracker.
   * @covers ConversionTrackerService::mutate
   */
  public function testAdd() {
    $conversionTracker = new AdWordsConversionTracker();
    $conversionTracker->name = 'Interplanetary Cruise Conversion #' . uniqid();
    $conversionTracker->category = 'DEFAULT';
    $conversionTracker->viewthroughLookbackWindow = 30;
    $conversionTracker->isProductAdsChargeable = TRUE;
    $conversionTracker->productAdsChargeableConversionWindow = 30;
    $conversionTracker->markupLanguage = 'HTML';
    $conversionTracker->httpProtocol = 'HTTP';
    $conversionTracker->textFormat = 'HIDDEN';
    $conversionTracker->conversionPageLanguage = 'en';
    $conversionTracker->backgroundColor = 'ffffff';
    $conversionTracker->userRevenueValue = 5;

    $operation = new ConversionTrackerOperation($conversionTracker, 'ADD');
    $testConversionTracker =
        $this->service->mutate(array($operation))->value[0];

    // Exclude generated fields.
    $excludeFields = array('id', 'status', 'ConversionTrackerType', 'snippet');
    $this->assertEqualsWithExclusions($conversionTracker,
        $testConversionTracker, $excludeFields);
  }

  /**
   * Test updating a conversion tracker.
   * @covers ConversionTrackerService::mutate
   */
  public function testUpdate() {
    $conversionTracker = new AdWordsConversionTracker();
    $conversionTracker->id = $this->conversionTrackerId;
    $conversionTracker->name = 'New Name ' . uniqid();

    $operation = new ConversionTrackerOperation($conversionTracker, 'SET');
    $testConversionTracker =
        $this->service->mutate(array($operation))->value[0];

    $this->assertEquals($conversionTracker->name, $testConversionTracker->name);
  }

  /**
   * Test deleting a conversion tracker.
   * @covers ConversionTrackerService::mutate
   */
  public function testDelete() {
    $conversionTracker = new AdWordsConversionTracker();
    $conversionTracker->id = $this->conversionTrackerId;
    $conversionTracker->status = 'DISABLED';

    $operation = new ConversionTrackerOperation($conversionTracker, 'SET');
    $testConversionTracker =
        $this->service->mutate(array($operation))->value[0];

    $this->assertEquals($conversionTracker->status,
        $testConversionTracker->status);
  }

  /**
   * Test getting a conversion tracker.
   * @covers ConversionTrackerService::get
   */
  public function testGet() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('Id', 'IN', array($this->conversionTrackerId));
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
    $this->assertNotNull($page->entries[0]->stats);
  }

  /**
   * Test getting all conversion trackers.
   * @covers ConversionTrackerService::get
   */
  public function testGetAll() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->paging = new Paging(0, 100);
    $selector->ordering = array(new OrderBy('Id', 'ASCENDING'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
    $this->assertLessThanOrEqual(100, sizeof($page->entries));

    // Assert that the order is correct.
    $lastId = 0;
    foreach($page->entries as $conversionTracker) {
      $this->assertGreaterThanOrEqual($lastId, $conversionTracker->id);
      $lastId = $conversionTracker->id;
    }
  }

  /**
   * Returns all the selectable fields for the service.
   * @return array the selectable fields available
   */
  function getAllFields() {
    return array(
        'BackgroundColor',
        'Category',
        'ConversionPageLanguage',
        'ConversionValue',
        'HttpProtocol',
        'Id',
        'IsProductAdsChargeable',
        'MarkupLanguage',
        'MostRecentConversionDate',
        'Name',
        'NumConversionEvents',
        'NumConvertedClicks',
        'ProductAdsChargeableConversionWindow',
        'Status',
        'TextFormat',
        'UserRevenueValue',
        'ViewthroughConversionDeDupSearch',
        'ViewthroughLookbackWindow'
    );
  }
}
