<?php
/**
 * Functional tests for AlertService.
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
 * Functional tests for AlertService.
 */
class AlertServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

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
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetService('AlertService');

    $this->testUtils = $this->sharedFixture['testUtils'];
  }

  /**
   * Test getting all alerts.
   * @covers AlertService::get
   */
  public function testGetAll() {
    $query = new AlertQuery();
    $query->clientSpec = 'ALL';
    $query->filterSpec = 'ALL';
    $query->triggerTimeSpec = 'ALL_TIME';

    $selector = new AlertSelector();
    $selector->query = $query;
    $selector->paging = new Paging(0, 10);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
  }
}
