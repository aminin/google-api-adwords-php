<?php
/**
 * Functional tests for AdParamService.
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v200909/cm/AdParamService.php';

/**
 * Functional tests for AdParamService.
 */
class AdParamServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $adGroupId;
  private $criterionId;

  /**
   * Create the test suite.
   */
  public static function suite() {
      $suite = new AdWordsTestSuite(__CLASS__);
      $suite->SetVersion('v200909');
      $suite->SetRequires(array('AD_GROUP', 'KEYWORD'));
      return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetAdParamService();

    $this->adGroupId = $this->sharedFixture['adGroupId'];
    $this->criterionId = $this->sharedFixture['keywordId'];

    $this->testUtils = $this->sharedFixture['testUtils'];
    $this->testUtils->SetAdParam($this->adGroupId, $this->criterionId);
  }

  /**
   * Tests getting ad params.
   * @covers AdParamService::get
   */
  public function testGet() {
    $selector =
        new AdParamSelector(array($this->adGroupId), $this->criterionId);
    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Tests getting ad params by ad group id.
   * @covers AdParamService::get
   */
  public function testGetByAdGroupId() {
    $selector = new AdParamSelector(array($this->adGroupId), NULL);
    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Tests setting an ad param.
   * @param string $insertionText the param text
   * @param int $paramIndex the param index
   * @covers AdParamService::mutate
   * @dataProvider adParamProvider
   */
  public function testSet($insertionText, $paramIndex) {
    $adParam = new AdParam($this->adGroupId, $this->criterionId,
        $insertionText, $paramIndex);

    $operation = new AdParamOperation($adParam, 'SET');

    $results = $this->service->mutate(array($operation));
    $testAdParam = $results[0];

    $this->assertNotNull($results);
    $this->assertEquals(1, sizeof($results));
    $this->assertEquals($adParam, $testAdParam);
  }

  /**
   * Tests removing an ad param.
   * @covers AdParamService::mutate
   */
  public function testRemove() {
    $adParam = new AdParam($this->adGroupId, $this->criterionId, NULL, 1);
    $operation = new AdParamOperation($adParam, 'REMOVE');
    $results = $this->service->mutate(array($operation));

    $this->assertNotNull($results);
    $this->assertEquals(1, sizeof($results));
  }

  /**
   * Provides insertionText and paramIndex for ad parameters.
   * @return array an array of insertionText and paramIndex (as an array)
   */
  public function adParamProvider() {
    $data = array();

    $data[] = array('1', 1);
    $data[] = array('1', 2);

    // Different number format.
    $data[] = array('1,234.00', 1);
    $data[] = array('1.234,00', 1);

    // Currency symbols.
    $data[] = array('$1', 1);
    $data[] = array('¥1', 1);
    $data[] = array('€1', 1);

    return $data;
  }
}
