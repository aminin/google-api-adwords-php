<?php
/**
 * Functional tests for BulkOpportunityService.
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
require_once 'Google/Api/Ads/AdWords/v201101/TargetingIdeaService.php';
require_once 'Google/Api/Ads/Common/Util/MapUtils.php';

/**
 * Functional tests for BulkOpportunityService.
 *
 * @author api.ekoleda@gmail.com
 */
class BulkOpportunityServiceTest extends AdsTestCase {
  private $service;

  private $adGroupId;

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
    $this->service = $user->GetBulkOpportunityService();
  }

  /**
   * Test getting keyword opportunities.
   * @covers BulkOpportunityService::get
   */
  public function testGetKeywordOpportunities() {
    $selector = new BulkOpportunitySelector();
    $selector->ideaTypes = array('KEYWORD');
    $selector->requestedAttributeTypes = array('ADGROUP_ID',
        'AVERAGE_MONTHLY_SEARCHES', 'CAMPAIGN_ID', 'CUSTOMER_ID', 'IDEA_TYPE',
        'KEYWORD');
    $selector->paging = new Paging(0, 1);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertLessThanOrEqual(1, sizeof($page->entries));

    if (sizeof($page->entries) > 0) {
      $attributes =
          MapUtils::GetMap($page->entries[0]->opportunityIdeas[0]->data);
      foreach ($selector->requestedAttributeTypes as $attributeType) {
        $this->assertTrue(array_key_exists($attributeType, $attributes));
        $this->assertNotNull($attributes[$attributeType]);
      }
    }
  }

  /**
   * Test getting bid opportunities.
   * @covers BulkOpportunityService::get
   */
  public function testGetBidOpportunities() {
    $selector = new BulkOpportunitySelector();
    $selector->ideaTypes = array('BID');
    $selector->requestedAttributeTypes = array('ADGROUP_ID', 'BID_LANDSCAPE',
        'CAMPAIGN_ID', 'CLICKS_CHANGE', 'COST_CHANGE', 'CURRENT_BID',
        'CUSTOMER_ID', 'IDEA_TYPE', 'IMPRESSIONS_CHANGE', 'KEYWORD',
        'NEW_BID');
    $selector->paging = new Paging(0, 1);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertLessThanOrEqual(1, sizeof($page->entries));

    if (sizeof($page->entries) > 0) {
      $attributes =
          MapUtils::GetMap($page->entries[0]->opportunityIdeas[0]->data);
      foreach ($selector->requestedAttributeTypes as $attributeType) {
        $this->assertTrue(array_key_exists($attributeType, $attributes));
        $this->assertNotNull($attributes[$attributeType]);
      }
    }
  }

  /**
   * Test getting budget opportunities.
   * @covers BulkOpportunityService::get
   */
  public function testGetBudgetOpportunities() {
    $selector = new BulkOpportunitySelector();
    $selector->ideaTypes = array('BUDGET');
    $selector->requestedAttributeTypes = array('ADGROUP_ID', 'CAMPAIGN_ID',
        'CLICKS_CHANGE', 'COST_CHANGE', 'CURRENT_BUDGET', 'CUSTOMER_ID',
        'IDEA_TYPE', 'IMPRESSIONS_CHANGE', 'NEW_BUDGET');
    $selector->paging = new Paging(0, 1);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertLessThanOrEqual(1, sizeof($page->entries));

    if (sizeof($page->entries) > 0) {
      $attributes =
          MapUtils::GetMap($page->entries[0]->opportunityIdeas[0]->data);
      foreach ($selector->requestedAttributeTypes as $attributeType) {
        $this->assertTrue(array_key_exists($attributeType, $attributes));
        $this->assertNotNull($attributes[$attributeType]);
      }
    }
  }
}
