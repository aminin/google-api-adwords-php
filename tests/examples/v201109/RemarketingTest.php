<?php
/**
 * Integration tests for remarketing examples.
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
foreach (glob($examplesPath . 'v201109/Remarketing/*.php') as $filename)
{
  require_once $filename;
}

/**
 * Integration tests for remarketing examples.
 */
class RemarketingTest extends AdsTestCase {
  private $user;
  private $testUtils;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201109');
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $this->user = $this->sharedFixture['user'];
    $this->testUtils = $this->sharedFixture['testUtils'];

    // Suppress output from the example code.
    ob_start();
  }

  /**
   * Tear down the test fixtures.
   */
  protected function tearDown() {
    // Restore output buffer.
    ob_end_clean();
  }

  /**
   * Tests AddAudienceExample.
   */
  public function testAddAudienceExample() {
    AddAudienceExample($this->user);
  }

  /**
   * Tests AddConversionTrackerExample.
   */
  public function testAddConversionTrackerExample() {
    AddConversionTrackerExample($this->user);
  }
}
