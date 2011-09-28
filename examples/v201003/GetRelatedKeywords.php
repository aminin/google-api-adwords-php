<?php
/**
 * This example gets keywords related to a seed keyword.
 *
 * Tags: TargetingIdeaService.get
 * Restriction: adwords-only
 *
 * PHP version 5
 *
 * Copyright 2011, Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
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

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/Common/Util/MapUtils.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the TargetingIdeaService.
  $targetingIdeaService = $user->GetService('TargetingIdeaService', 'v201003');

  // Create seed keyword.
  $keyword = new Keyword();
  $keyword->text = 'mars cruise';
  $keyword->matchType = 'BROAD';

  // Create selector.
  $selector = new TargetingIdeaSelector();
  $selector->requestType = 'IDEAS';
  $selector->ideaType = 'KEYWORD';
  $selector->requestedAttributeTypes =
      array('KEYWORD', 'AVERAGE_TARGETED_MONTHLY_SEARCHES');

  // Set selector paging (required for targeting idea service).
  $paging = new Paging();
  $paging->startIndex = 0;
  $paging->numberResults = 10;
  $selector->paging = $paging;

  // Create related to keyword search parameter.
  $relatedToKeywordSearchParameter = new RelatedToKeywordSearchParameter();
  $relatedToKeywordSearchParameter->keywords = array($keyword);

  // Create keyword match type search parameter to ensure unique results.
  $keywordMatchTypeSearchParameter = new KeywordMatchTypeSearchParameter();
  $keywordMatchTypeSearchParameter->keywordMatchTypes = array('BROAD');

  $selector->searchParameters =
      array($relatedToKeywordSearchParameter, $keywordMatchTypeSearchParameter);

  // Get related keywords.
  $page = $targetingIdeaService->get($selector);

  // Display related keywords.
  if (isset($page->entries)) {
    foreach ($page->entries as $targetingIdea) {
      $data = MapUtils::GetMap($targetingIdea->data);
      $keyword = $data['KEYWORD']->value;
      $averageMonthlySearches =
          isset($data['AVERAGE_TARGETED_MONTHLY_SEARCHES']->value)
          ? $data['AVERAGE_TARGETED_MONTHLY_SEARCHES']->value : 0;
      printf("Keyword with text '%s', match type '%s', and average monthly "
          . "search volume '%s' was found.\n", $keyword->text,
          $keyword->matchType, $averageMonthlySearches);
    }
  } else {
    print "No related keywords were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
