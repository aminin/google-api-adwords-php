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

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v200909/o/TargetingIdeaService.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/Common/Util/MapUtils.php';

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
    $suite->SetVersion('v200909');
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
   * @dataProvider keywordIdeasSearchParametersProvider
   * @covers TargetingIdeaService::get
   */
  public function testGetKeywordIdeas($searchParameters) {
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
    $this->assertEquals(1, sizeof($page->entries));
    $attributes = MapUtils::GetMap($page->entries[0]->data);
    foreach ($selector->requestedAttributeTypes as $attributeType) {
      $this->assertTrue(array_key_exists($attributeType, $attributes));
      $this->assertNotNull($attributes[$attributeType]);
    }
  }

  /**
   * Test getting keyword stats.
   * @param array $searchParameters an array of search parameters to use
   * @dataProvider keywordStatsSearchParametersProvider
   * @covers TargetingIdeaService::get
   */
  public function testGetKeywordStats($searchParameters) {
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
    $this->assertEquals(1, sizeof($page->entries));
    $attributes = MapUtils::GetMap($page->entries[0]->data);
    foreach ($selector->requestedAttributeTypes as $attributeType) {
      $this->assertTrue(array_key_exists($attributeType, $attributes));
      $this->assertNotNull($attributes[$attributeType]);
    }
  }

  /**
   * Test getting placement ideas.
   * @param array $searchParameters an array of search parameters to use
   * @dataProvider placementIdeasSearchParametersProvider
   * @covers TargetingIdeaService::get
   */
  public function testGetPlacementIdeas($searchParameters) {
    $selector = new TargetingIdeaSelector();
    $selector->searchParameters = $searchParameters;
    $selector->requestedAttributeTypes = array(
        'APPROX_CONTENT_IMPRESSIONS_PER_DAY', 'FORMATS', 'IDEA_TYPE',
        'IN_STREAM_AD_INFO', 'PLACEMENT', 'PLACEMENT_CATEGORY',
        'PLACEMENT_NAME', 'PLACEMENT_TYPE', 'PUBLISHER_DESCRIPTION',
        'SAMPLE_URL');
    $selector->ideaType = 'PLACEMENT';
    $selector->requestType = 'IDEAS';
    $selector->paging = new Paging(0, 1);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
    $attributes = MapUtils::GetMap($page->entries[0]->data);
    foreach ($selector->requestedAttributeTypes as $attributeType) {
      $this->assertTrue(array_key_exists($attributeType, $attributes));
      $this->assertNotNull($attributes[$attributeType]);
    }
  }

  /**
   * Test getting bulk keyword ideas.
   * @param array $searchParameters an array of search parameters to use
   * @dataProvider bulkKeywordIdeasSearchParametersProvider
   * @covers TargetingIdeaService::getBulkKeywordIdeas
   */
  public function testGetBulkKeywordIdeas($searchParameters) {
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
    $this->assertEquals(1, sizeof($page->entries));
    $attributes = MapUtils::GetMap($page->entries[0]->data);
    foreach ($selector->requestedAttributeTypes as $attributeType) {
      $this->assertTrue(array_key_exists($attributeType, $attributes),
          'Missing attribute in response: ' . $attributeType);
      $this->assertNotNull($attributes[$attributeType]);
    }
  }

  /**
   * Provides search parameters for use with keyword idea requests.
   * @return array an array of search parameters (as an array)
   */
  public function keywordIdeasSearchParametersProvider() {
    $data = array();

    // Related to keyword.
    $keyword = new Keyword('mars cruise', 'BROAD');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtksp));

    // Related to URL.
    $url = 'mars.google.com';
    $rtusp = new RelatedToUrlSearchParameter(array($url), TRUE);
    $data[] = array(array($rtusp));

    // Relates to keyword and URL.
    $data[] = array(array($rtksp, $rtusp));

    // Keyword Category Id.
    $kcidsp = new KeywordCategoryIdSearchParameter(194600);
    $data[] = array(array($kcidsp));

    // Seed ad group ID.
    $sagsp = new SeedAdGroupIdSearchParameter('ID INSERTED LATER');
    $data[] = array(array($sagsp));

    // Average targeted monthly searches.
    $atmssp = new AverageTargetedMonthlySearchesSearchParameter(
            new LongComparisonOperation(0, 1000000));
    $data[] = array(array($rtksp, $atmssp));

    // Competition.
    $csp = new CompetitionSearchParameter(array('MEDIUM', 'HIGH'));
    $data[] = array(array($rtksp, $csp));

    // Country target.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US'),
        new CountryTarget('CN'), new CountryTarget('JP')));
    $data[] = array(array($rtksp, $ctsp));

    // Excluded keyword.
    $eksp = new ExcludedKeywordSearchParameter(array(
        new Keyword('jupiter', 'BROAD')));
    $data[] = array(array($rtksp, $eksp));

    // Global monthly searches.
    $gmssp = new GlobalMonthlySearchesSearchParameter(
        new LongComparisonOperation(0, 1000000));
    $data[] = array(array($rtksp, $gmssp));

    // Include adult content.
    $iacsp = new IncludeAdultContentSearchParameter();
    $data[] = array(array($rtksp, $iacsp));

    // Keyword match type.
    $kmtsp = new KeywordMatchTypeSearchParameter(array('BROAD', 'EXACT'));
    $data[] = array(array($rtksp, $kmtsp));

    // Language target.
    $ltsp = new LanguageTargetSearchParameter(array(
        new LanguageTarget('zh_CN'), new LanguageTarget('ja')));
    $data[] = array(array($rtksp, $ltsp));

    // Mobile.
    $msp = new MobileSearchParameter();
    $data[] = array(array($rtksp, $msp));

    // Ngram group.
    $ngsp = new NgramGroupsSearchParameter(array('4'));
    $data[] = array(array($rtksp, $ngsp));

    return $data;
  }

  /**
   * Provides search parameters for use with keyword stats requests.
   * @return array an array of search parameters (as an array)
   */
  public function keywordStatsSearchParametersProvider() {
    $data = array();

    // Related to keyword.
    $keyword = new Keyword('mars cruise', 'BROAD');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtksp));

    // Country target.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US'),
        new CountryTarget('CN'), new CountryTarget('JP')));
    $data[] = array(array($rtksp, $ctsp));

    // Global monthly searches.
    $gmssp = new GlobalMonthlySearchesSearchParameter(
        new LongComparisonOperation(0, 1000000));
    $data[] = array(array($rtksp, $gmssp));

    // Language target.
    $ltsp = new LanguageTargetSearchParameter(array(
        new LanguageTarget('zh_CN'), new LanguageTarget('ja')));
    $data[] = array(array($rtksp, $ltsp));

    // Mobile.
    $msp = new MobileSearchParameter();
    $data[] = array(array($rtksp, $msp));

    // Seed ad group ID.
    $sagsp = new SeedAdGroupIdSearchParameter('ID INSERTED LATER');
    $data[] = array(array($rtksp, $sagsp));

    return $data;
  }

  /**
   * Provides search parameters for use with placement idea requests.
   * @return array an array of search parameters (as an array)
   */
  public function placementIdeasSearchParametersProvider() {
    $data = array();

    // Related to keyword.
    $keyword = new Keyword('mars cruise', 'BROAD');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtksp));

    // Related to URL.
    $url = 'mars.google.com';
    $rtusp = new RelatedToUrlSearchParameter(array($url), TRUE);
    $data[] = array(array($rtusp));

    // Relates to keyword and URL.
    $data[] = array(array($rtksp, $rtusp));

    // Ad type.
    $atsp = new AdTypeSearchParameter(array('DISPLAY'));
    $data[] = array(array($rtksp, $atsp));

    // Country target.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US'),
        new CountryTarget('CN'), new CountryTarget('JP')));
    $data[] = array(array($rtksp, $ctsp));

    // Language target.
    $ltsp = new LanguageTargetSearchParameter(array(
        new LanguageTarget('zh_CN'), new LanguageTarget('ja')));
    $data[] = array(array($rtksp, $ltsp));

    // Placement type.
    $ptsp = new PlacementTypeSearchParameter(array('VIDEO', 'GAME'));
    $data[] = array(array($rtksp, $ptsp));

    return $data;
  }

  /**
   * Provides search parameters for use with bulk keyword idea requests.
   * @return array an array of search parameters (as an array)
   */
  public function bulkKeywordIdeasSearchParametersProvider() {
    $data = array();

    // Related to URL.
    $url = 'mars.google.com';
    $rtusp = new RelatedToUrlSearchParameter(array($url), TRUE);
    $data[] = array(array($rtusp));

    // Relates to keyword and URL.
    $keyword = new Keyword('mars cruise', 'BROAD');
    $rtksp = new RelatedToKeywordSearchParameter(array($keyword));
    $data[] = array(array($rtusp, $rtksp));

    // Keyword Category Id.
    $kcidsp = new KeywordCategoryIdSearchParameter(194600);
    $data[] = array(array($rtusp, $kcidsp));

    // Country target, single value only.
    $ctsp = new CountryTargetSearchParameter(array(new CountryTarget('US')));
    $data[] = array(array($rtusp, $ctsp));

    // Language target, single value only.
    $ltsp =
        new LanguageTargetSearchParameter(array(new LanguageTarget('zh_CN')));
    $data[] = array(array($rtusp, $ltsp));

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
