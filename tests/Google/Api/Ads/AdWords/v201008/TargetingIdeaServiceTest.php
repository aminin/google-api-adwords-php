<?php
/**
 * Functional tests for TargetingIdeaService.
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
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

$path = dirname(__FILE__) . '/../../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once 'Google/Api/Ads/AdWords/v201008/TargetingIdeaService.php';
require_once 'Google/Api/Ads/Common/Util/MapUtils.php';

/**
 * Functional tests for TargetingIdeaService.
 *
 * @author api.ekoleda@gmail.com
 */
class TargetingIdeaServiceTest extends AdsTestCase {
  private $service;

  private $adGroupId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    $suite->SetRequires(array('AD_GROUP', 'KEYWORD'));
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetTargetingIdeaService();

    $this->adGroupId = $this->sharedFixture['adGroupId'];
  }

  /**
   * Test getting keyword ideas.
   * @param array $searchParameters an array of search parameters to use
   * @param boolean $expectResults whether to expect results
   * @dataProvider keywordIdeasSearchParametersProvider
   * @covers TargetingIdeaService::get
   */
  public function testGetKeywordIdeas($searchParameters, $expectResults) {
    $this->InsertSearchParameterIds($searchParameters);

    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = $searchParameters;
    $selector->requestedAttributeTypes = array('AD_SHARE',
        'AVERAGE_TARGETED_MONTHLY_SEARCHES', 'COMPETITION',
        'EXTRACTED_FROM_WEBPAGE', 'GLOBAL_MONTHLY_SEARCHES', 'IDEA_TYPE',
        'KEYWORD', 'KEYWORD_CATEGORY', 'NGRAM_GROUP', 'SEARCH_SHARE',
        'TARGETED_MONTHLY_SEARCHES');
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    if ($expectResults) {
      $this->assertEquals(1, sizeof($page->entries));
    }
    if (sizeof($page->entries) > 0) {
      $attributes = MapUtils::GetMap($page->entries[0]->data);
      foreach ($selector->requestedAttributeTypes as $attributeType) {
        $this->assertTrue(array_key_exists($attributeType, $attributes));
        $this->assertNotNull($attributes[$attributeType]);
      }
    }
  }

  /**
   * Test getting keyword stats.
   * @param array $searchParameters an array of search parameters to use
   * @param boolean $expectResults whether to expect results
   * @dataProvider keywordStatsSearchParametersProvider
   * @covers TargetingIdeaService::get
   */
  public function testGetKeywordStats($searchParameters, $expectResults) {
    $this->InsertSearchParameterIds($searchParameters);

    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = $searchParameters;
    $selector->requestedAttributeTypes = array('AD_SHARE',
        'AVERAGE_TARGETED_MONTHLY_SEARCHES', 'COMPETITION',
        'EXTRACTED_FROM_WEBPAGE', 'GLOBAL_MONTHLY_SEARCHES', 'IDEA_TYPE',
        'KEYWORD', 'KEYWORD_CATEGORY', 'NGRAM_GROUP', 'SEARCH_SHARE',
        'TARGETED_MONTHLY_SEARCHES');
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'STATS';
    $selector->paging = new Paging(0, 1);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    if ($expectResults) {
      $this->assertEquals(1, sizeof($page->entries));
    }
    if (sizeof($page->entries) > 0) {
      $attributes = MapUtils::GetMap($page->entries[0]->data);
      foreach ($selector->requestedAttributeTypes as $attributeType) {
        $this->assertTrue(array_key_exists($attributeType, $attributes));
        $this->assertNotNull($attributes[$attributeType]);
      }
    }
  }

  /**
   * Test getting placement ideas.
   * @param array $searchParameters an array of search parameters to use
   * @param boolean $expectResults whether to expect results
   * @dataProvider placementIdeasSearchParametersProvider
   * @covers TargetingIdeaService::get
   */
  public function testGetPlacementIdeas($searchParameters, $expectResults) {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = $searchParameters;
    $selector->requestedAttributeTypes = array(
        'APPROX_CONTENT_IMPRESSIONS_PER_DAY', 'FORMATS', 'IDEA_TYPE',
        'IN_STREAM_AD_INFO', 'PLACEMENT', 'PLACEMENT_CATEGORY',
        'PLACEMENT_NAME', 'PLACEMENT_TYPE', 'SAMPLE_URL');
    $selector->ideaType = 'PLACEMENT';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    if ($expectResults) {
      $this->assertEquals(1, sizeof($page->entries));
    }
    if (sizeof($page->entries) > 0) {
      $attributes = MapUtils::GetMap($page->entries[0]->data);
      foreach ($selector->requestedAttributeTypes as $attributeType) {
        $this->assertTrue(array_key_exists($attributeType, $attributes));
        $this->assertNotNull($attributes[$attributeType]);
      }
    }
  }

  /**
   * Test getting bulk keyword ideas.
   * @param array $searchParameters an array of search parameters to use
   * @param boolean $expectResults whether to expect results
   * @dataProvider bulkKeywordIdeasSearchParametersProvider
   * @covers TargetingIdeaService::getBulkKeywordIdeas
   */
  public function testGetBulkKeywordIdeas($searchParameters, $expectResults) {
      $selector = new TargetingIdeaSelector();
    $selector->searchParameters = $searchParameters;
    // These five attributes are always returned regardles.
    $selector->requestedAttributeTypes = array('AD_SHARE',
        'EXTRACTED_FROM_WEBPAGE', 'IDEA_TYPE', 'KEYWORD', 'SEARCH_SHARE');
    $selector->ideaType = 'KEYWORD';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $page = $this->service->getBulkKeywordIdeas($selector);

    $this->assertNotNull($page);
    if ($expectResults) {
      $this->assertEquals(1, sizeof($page->entries));
    }
    if (sizeof($page->entries) > 0) {
      $attributes = MapUtils::GetMap($page->entries[0]->data);
      foreach ($selector->requestedAttributeTypes as $attributeType) {
        $this->assertTrue(array_key_exists($attributeType, $attributes),
            'Missing attribute in response: ' . $attributeType);
        $this->assertNotNull($attributes[$attributeType]);
      }
    }
  }

  /**
   * Provides search parameters for use with keyword idea requests.
   * @return array an array of search parameters (as an array) and if results
   *     are expected.
   */
  public function keywordIdeasSearchParametersProvider() {
    $data = array();

    // Related to keyword.
    $keyword = new Keyword('mars cruise', 'EXACT');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtksp), TRUE);

    // Related to URL.
    $url = 'mars.google.com';
    $rtusp = new RelatedToUrlSearchParameter(array($url), TRUE);
    $data[] = array(array($rtusp), TRUE);

    // Relates to keyword and URL.
    $data[] = array(array($rtksp, $rtusp), TRUE);

    // Keyword Category Id.
    $kcidsp = new KeywordCategoryIdSearchParameter(198484);
    $data[] = array(array($kcidsp), TRUE);

    // Seed ad group ID.
    $sagsp = new SeedAdGroupIdSearchParameter('ID INSERTED LATER');
    $data[] = array(array($sagsp), TRUE);

    // Ad share.
    $assp = new AdShareSearchParameter(new DoubleComparisonOperation(0,1));
    $data[] = array(array($rtksp, $assp), FALSE);

    // Average targeted monthly searches.
    $atmssp = new AverageTargetedMonthlySearchesSearchParameter(
            new LongComparisonOperation(0, 1000000));
    $data[] = array(array($rtksp, $atmssp), TRUE);

    // Competition.
    $csp = new CompetitionSearchParameter(array('MEDIUM', 'HIGH'));
    $data[] = array(array($rtksp, $csp), TRUE);

    // Country target.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US'),
        new CountryTarget('CN'), new CountryTarget('JP')));
    $data[] = array(array($rtksp, $ctsp), TRUE);

    // Excluded keyword.
    $eksp = new ExcludedKeywordSearchParameter(array(
        new Keyword('jupiter', 'BROAD')));
    $data[] = array(array($rtksp, $eksp), TRUE);

    // Global monthly searches.
    $gmssp = new GlobalMonthlySearchesSearchParameter(
        new LongComparisonOperation(0, 1000000));
    $data[] = array(array($rtksp, $gmssp), TRUE);

    // Idea text matches.
    $itmsp = new IdeaTextMatchesSearchParameter(array('mars'), array('candy'));
    $data[] = array(array($rtksp, $itmsp), TRUE);

    // Include adult content.
    $iacsp = new IncludeAdultContentSearchParameter();
    $data[] = array(array($rtksp, $iacsp), TRUE);

    // Keyword match type.
    $kmtsp = new KeywordMatchTypeSearchParameter(array('BROAD', 'EXACT'));
    $data[] = array(array($rtksp, $kmtsp), TRUE);

    // Language target.
    $ltsp = new LanguageTargetSearchParameter(array(new LanguageTarget('en'),
        new LanguageTarget('zh_CN'), new LanguageTarget('ja')));
    $data[] = array(array($rtksp, $ltsp), TRUE);

    // Mobile.
    $msp = new MobileSearchParameter();
    $data[] = array(array($rtksp, $msp), TRUE);

    // Search share.
    $sssp = new SearchShareSearchParameter(new DoubleComparisonOperation(0,1));
    $data[] = array(array($rtksp, $sssp), FALSE);

    return $data;
  }

  /**
   * Provides search parameters for use with keyword stats requests.
   * @return array an array of search parameters (as an array) and if results
   *     are expected.
   */
  public function keywordStatsSearchParametersProvider() {
    $data = array();

    // Related to keyword.
    $keyword = new Keyword('mars cruise', 'BROAD');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtksp), TRUE);

    // Ad share.
    $assp = new AdShareSearchParameter(new DoubleComparisonOperation(0,1));
    $data[] = array(array($rtksp, $assp), FALSE);

    // Country target.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US'),
        new CountryTarget('CN'), new CountryTarget('JP')));
    $data[] = array(array($rtksp, $ctsp), TRUE);

    // Global monthly searches.
    $gmssp = new GlobalMonthlySearchesSearchParameter(
        new LongComparisonOperation(0, 1000000));
    $data[] = array(array($rtksp, $gmssp), TRUE);

    // Language target.
    $ltsp = new LanguageTargetSearchParameter(array(
        new LanguageTarget('zh_CN'), new LanguageTarget('ja')));
    $data[] = array(array($rtksp, $ltsp), TRUE);

    // Mobile.
    $msp = new MobileSearchParameter();
    $data[] = array(array($rtksp, $msp), TRUE);

    // Search share.
    $sssp = new SearchShareSearchParameter(new DoubleComparisonOperation(0,1));
    $data[] = array(array($rtksp, $sssp), FALSE);

    // Seed ad group ID.
    $sagsp = new SeedAdGroupIdSearchParameter('ID INSERTED LATER');
    $data[] = array(array($rtksp, $sagsp), TRUE);

    return $data;
  }

  /**
   * Provides search parameters for use with placement idea requests.
   * @return array an array of search parameters (as an array) and if results
   *     are expected.
   */
  public function placementIdeasSearchParametersProvider() {
    $data = array();

    // Related to keyword.
    $keyword = new Keyword('mars cruise', 'BROAD');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtksp), TRUE);

    // Related to URL.
    $url = 'mars.google.com';
    $rtusp = new RelatedToUrlSearchParameter(array($url), TRUE);
    $data[] = array(array($rtusp), TRUE);

    // Relates to keyword and URL.
    $data[] = array(array($rtksp, $rtusp), TRUE);

    // Ad type.
    $atsp = new AdTypeSearchParameter(array('DISPLAY'));
    $data[] = array(array($rtksp, $atsp), TRUE);

    // Country target.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US'),
        new CountryTarget('CN'), new CountryTarget('JP')));
    $data[] = array(array($rtksp, $ctsp), TRUE);

    // Language target.
    $ltsp = new LanguageTargetSearchParameter(array(new LanguageTarget('en'),
        new LanguageTarget('zh_CN'), new LanguageTarget('ja')));
    $data[] = array(array($rtksp, $ltsp), TRUE);

    // Placement type.
    $ptsp = new PlacementTypeSearchParameter(array('VIDEO', 'GAME'));
    $data[] = array(array($rtksp, $ptsp), TRUE);

    return $data;
  }

  /**
   * Provides search parameters for use with bulk keyword idea requests.
   * @return array an array of search parameters (as an array) and if results
   *     are expected.
   */
  public function bulkKeywordIdeasSearchParametersProvider() {
    $data = array();

    // Related to URL.
    $url = 'foodnetwork.com';
    $rtusp = new RelatedToUrlSearchParameter(array($url), TRUE);
    $data[] = array(array($rtusp), TRUE);

    // Relates to keyword and URL.
    $keyword = new Keyword('html', 'BROAD');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtusp, $rtksp), TRUE);

    // Keyword Category Id.
    $kcidsp = new KeywordCategoryIdSearchParameter(198484);
    $data[] = array(array($rtusp, $kcidsp), TRUE);

    // Country target, single value only.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US')));
    $data[] = array(array($rtusp, $ctsp), TRUE);

    // Language target, single value only.
    $ltsp =
        new LanguageTargetSearchParameter(array(new LanguageTarget('en')));
    $data[] = array(array($rtusp, $ltsp), TRUE);

    return $data;
  }

  /**
   * Insert ids into search parameters.
   * @param array $searchParameters an array of search parameters
   */
  private function InsertSearchParameterIds($searchParameters) {
    foreach ($searchParameters as $searchParameter) {
      if ($searchParameter instanceof SeedAdGroupIdSearchParameter) {
        $searchParameter->adGroupId = $this->adGroupId;
      }
    }
  }
}
