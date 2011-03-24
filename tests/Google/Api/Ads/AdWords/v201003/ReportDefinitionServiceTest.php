<?php
/**
 * Functional tests for ReportDefinitionService.
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

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v201003/cm/ReportDefinitionService.php';

/**
 * Functional tests for ReportDefinitionService.
 *
 * @author api.ekoleda@gmail.com
 */
class ReportDefinitionServiceTest extends AdsTestCase {
  private $service;

  private $reportDefinitionId;

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
    $this->service = $user->GetReportDefinitionService();

    $testUtils = $this->sharedFixture['testUtils'];
    $this->reportDefinitionId = $testUtils->AddReportDefinition();
  }

  /**
   * Test adding a report definition.
   * @param string $reportType the report type of the report to add
   * @param array $feilds the fields to include in the report
   * @covers ReportDetinitionService::mutate
   * @dataProvider reportProvider
   */
  public function testAdd($reportType, $fields) {
    $selector = new Selector();
    $selector->fields = $fields;
    $selector->dateRange = new DateRange(date('Ym01'), date('Ymd'));

    $reportDefinition = new ReportDefinition();
    $reportDefinition->selector = $selector;
    $reportDefinition->reportName = 'Test report #' . time();
    $reportDefinition->reportType = $reportType;
    $reportDefinition->hasAttachment = FALSE;
    $reportDefinition->dateRangeType = 'CUSTOM_DATE';
    $reportDefinition->downloadFormat = 'XML';

    $operation = new ReportDefinitionOperation($reportDefinition, 'ADD');
    $results = $this->service->mutate(array($operation));

    $this->assertNotNull($results);
    $this->assertEquals(1, sizeof($results));

    // Exclude generated fields.
    $excludeFields = array('id', 'creationTime');
    $this->assertEqualsWithExclusions($reportDefinition, $results[0],
        $excludeFields);
  }

  /**
   * Test updating a report definition.
   * @covers ReportDetinitionService::mutate
   */
  public function testUpdate() {
    $reportDefinition = new ReportDefinition();
    $reportDefinition->id = $this->reportDefinitionId;
    $reportDefinition->reportName = 'New report name #' . time();

    $operation = new ReportDefinitionOperation($reportDefinition, 'SET');
    $results = $this->service->mutate(array($operation));

    $this->assertNotNull($results);
    $this->assertEquals(1, sizeof($results));
    $this->assertEquals($reportDefinition->reportName, $results[0]->reportName);
  }

  /**
   * Test removing a report definition.
   * @covers ReportDetinitionService::mutate
   */
  public function testRemove() {
    $reportDefinition = new ReportDefinition();
    $reportDefinition->id = $this->reportDefinitionId;

    $operation = new ReportDefinitionOperation($reportDefinition, 'REMOVE');
    $results = $this->service->mutate(array($operation));
  }

  /**
   * Test getting all report definitions.
   * @covers ReportDetinitionService::get
   */
  public function testGetAll() {
    $selector = new ReportDefinitionSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }

  /**
   * Test getting report fields.
   * @param string $reportType the report type to get fields for
   * @covers ReportDetinitionService::getReportFields
   * @dataProvider reportProvider
   */
  public function testGetReportFields($reportType) {
    $fields = $this->service->getReportFields($reportType);

    $this->assertNotNull($fields);
    $this->assertGreaterThanOrEqual(1, sizeof($fields));
    foreach ($fields as $field) {
      $this->assertNotNull($field->fieldName);
      $this->assertNotNull($field->fieldType);
      $this->assertNotNull($field->canSelect);
      $this->assertNotNull($field->canFilter);
    }
  }

  /**
   * Provides report information.
   * @return array an array of report types (as an array)
   */
  public function reportProvider() {
    $data = array();

    $data[] = array('KEYWORDS_PERFORMANCE_REPORT', array('Id', 'Clicks'));
    $data[] = array('AD_PERFORMANCE_REPORT', array('Id', 'Clicks'));
    $data[] = array('URL_PERFORMANCE_REPORT', array('Url', 'Clicks'));
    $data[] = array('ADGROUP_PERFORMANCE_REPORT', array('Id', 'Clicks'));
    $data[] = array('CAMPAIGN_PERFORMANCE_REPORT', array('Id', 'Clicks'));
    $data[] = array('SEARCH_QUERY_PERFORMANCE_REPORT',
        array('Query', 'Clicks'));
    $data[] = array('MANAGED_PLACEMENTS_PERFORMANCE_REPORT',
        array('PlacementUrl', 'Clicks'));
    $data[] = array('AUTOMATIC_PLACEMENTS_PERFORMANCE_REPORT',
        array('Domain', 'Clicks'));
    $data[] = array('ADGROUP_NEGATIVE_KEYWORDS_PERFORMANCE_REPORT',
        array('Id', 'KeywordText'));
    $data[] = array('CAMPAIGN_NEGATIVE_KEYWORDS_PERFORMANCE_REPORT',
        array('Id', 'KeywordText'));
    $data[] = array('ADGROUP_NEGATIVE_PLACEMENTS_PERFORMANCE_REPORT',
        array('Id', 'PlacementUrl'));
    $data[] = array('CAMPAIGN_NEGATIVE_PLACEMENTS_PERFORMANCE_REPORT',
        array('Id', 'PlacementUrl'));

    return $data;
  }
}
