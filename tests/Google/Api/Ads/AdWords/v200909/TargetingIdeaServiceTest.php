<?php
/**
 * Functional tests for TargetingIdeaService.
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
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'PHPUnit/Framework.php';

/**
 * Functional tests for TargetingIdeaService.
 *
 * @author api.ekoleda@gmail.com
 */
class TargetingIdeaServiceTest extends PHPUnit_Framework_TestCase {
  private $version = 'v200909';
  private $user;
  private $service;

  private static $adGroupId;

  protected function setUp() {
    $authFile =
        dirname(__FILE__) . '/../../../../../../test_data/test_auth.ini';
    $settingsFile =
        dirname(__FILE__) . '/../../../../../../test_data/test_settings.ini';
    $this->user = new AdWordsUser($authFile, NULL, NULL, NULL,
        NULL, NULL, NULL, $settingsFile);
    $this->user->LogDefaults();

    $this->service =
        $this->user->GetTargetingIdeaService($this->version);

    if (!isset(TargetingIdeaServiceTest::$adGroupId)) {
      $campaignService =
          $this->user->GetCampaignService($this->version);
      $campaign = new Campaign();
      $campaign->name = 'Campaign #' . time();
      $campaign->status = 'PAUSED';
      $campaign->biddingStrategy = new ManualCPC();
      $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

      $campaignId = $campaignService->mutate(
          array(new CampaignOperation(NULL, $campaign, 'ADD')))->value[0]->id;

      $adGroupService =
          $this->user->GetAdGroupService($this->version);

      $adGroup = new AdGroup();
      $adGroup->name = 'AdGroup #' . time();
      $adGroup->bids = new ManualCPCAdGroupBids(new Bid(new Money(1000000)));
      $adGroup->campaignId = $campaignId;

      TargetingIdeaServiceTest::$adGroupId = $adGroupService->mutate(
          array(new AdGroupOperation($adGroup, 'ADD')))->value[0]->id;
    }
  }

  /**
   * Test whether we can catch required search parameter error in selector using
   * v200909.
   */
  public function testGetEmptySelector() {
    try {
      $this->service->get(new TargetingIdeaSelector());
    } catch (SoapFault $e) {
      $actualErrors = explode(', ', trim($e->getMessage(), ']['));
      $this->assertGreaterThanOrEqual(1, sizeof($actualErrors),
          'Did not receive enough errors.');
    }
  }

  /**
   * Test whether we can catch required search parameter error in selector using
   * v200909.
   */
  public function testGetAdTypeSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new AdTypeSearchParameter(array('DISPLAY')),
        new RelatedToUrlSearchParameter(array('http://news.google.com')));
    $selector->ideaType = 'PLACEMENT';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request average targeted monthly search parameter using
   * v200909.
   */
  public function testGetAverageTargetedMonthlySearchesSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new AverageTargetedMonthlySearchesSearchParameter(
            new LongComparisonOperation(1, 50)),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('election', 'BROAD'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request competition search parameter using v200909.
   */
  public function testGetCompetitionSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new CompetitionSearchParameter(
            array('MEDIUM', 'HIGH')),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('election', 'BROAD'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request country target search parameter using v200909.
   */
  public function testGetCountryTargetSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new CountryTargetSearchParameter(
            array(new CountryTarget('US'),
                new CountryTarget('CN'), new CountryTarget('JP'))),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('election', 'BROAD'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request excluded keyword search parameter using
   * v200909.
   */
  public function testGetExcludedKeywordSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new ExcludedKeywordSearchParameter(array(
            new Keyword('media player', 'EXACT'))),
        new KeywordMatchTypeSearchParameter(array('BROAD', 'EXACT')),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('dvd player', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request global monthly search parameter using v200909.
   */
  public function testGlobalMonthlySearchesSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new GlobalMonthlySearchesSearchParameter(
            new LongComparisonOperation(1000, 10000)),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('dvd player', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request keyword category id search parameter using
   * v200909.
   */
  public function testGetIncludeAdultContentSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new KeywordCategoryIdSearchParameter(5),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('presidential vote', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request keyword match type search parameter using
   * v200909.
   */
  public function testGetKeywordMatchTypeSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new KeywordMatchTypeSearchParameter(array('BROAD', 'EXACT')),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('presidential vote', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request language target search parameter using
   * v200909.
   */
  public function testGetLanguageTargetSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new LanguageTargetSearchParameter(
            array(new LanguageTarget('cn'), new LanguageTarget('jp'))),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('presidential vote', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request mobile search parameter using v200909.
   */
  public function testGetMobileSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new MobileSearchParameter(),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('presidential vote', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request ngram groups search parameter using v200909.
   */
  public function testGetNgramGroupsSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new NgramGroupsSearchParameter(array(27)),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('presidential vote', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request placement type search parameter using v200909.
   */
  public function testGetPlacementTypeSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new PlacementTypeSearchParameter(array('VIDEO', 'GAME')),
        new RelatedToKeywordSearchParameter(array(
            new Keyword('iron man', 'EXACT'))));
    $selector->ideaType = 'PLACEMENT';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request related to keyword search parameter using
   * v200909.
   */
  public function testGetRelatedToKeywordSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new RelatedToKeywordSearchParameter(array(
            new Keyword('flowers', 'EXACT'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request related to keyword search parameter and
   * retrieve complete set of resulting pages using v200909.
   */
  public function testGetRelatedToKeywordSearchParameterAllPages() {
    $index = 0;
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new RelatedToKeywordSearchParameter(array(
            new Keyword('flowers', 'BROAD'))));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging($index, 100);

    $results = array();
    $page = $this->service->get($selector);

    while (($selector->paging->startIndex + 100) <= $page->totalNumEntries) {
      $results = array_merge($results, $page->entries);
      $selector->paging->startIndex += 100;
      $page = $this->service->get($selector);
    }

    $this->assertEquals($page->totalNumEntries, sizeof($results));
  }

  /**
   * Test whether we can request related to url search parameter using
   * v200909.
   */
  public function testGetRelatedToUrlSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new RelatedToUrlSearchParameter(array(
            'http://finance.google.com'), false));
    $selector->ideaType = 'PLACEMENT';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request seed ad group id search parameter using
   * v200909.
   */
  public function testGetSeedAdGroupIdSearchParameter() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new SeedAdGroupIdSearchParameter(TargetingIdeaServiceTest::$adGroupId));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }

  /**
   * Test whether we can request bulk keyword ideas using v200909.
   */
  public function testGetBulkKeywordIdeas() {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = array(
        new RelatedToKeywordSearchParameter(array(
            new Keyword('presidential vote', 'EXACT'))),
        new RelatedToUrlSearchParameter(array(
            'http://finance.google.com'), false));
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $result = $this->service->get($selector);

    // TODO(api.ekoleda): validate result.
  }
}
