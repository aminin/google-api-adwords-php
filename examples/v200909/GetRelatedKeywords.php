<?php
/**
 * This example gets keywords related to a seed keyword.
 *
 * PHP version 5
 *
 * Copyright 2009, Google Inc. All Rights Reserved.
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
 * @subpackage v200909
 * @category   WebServices
 * @copyright  2009, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @link       http://code.google.com/apis/adwords/v2009/docs/reference/TargetingIdeaService.html
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the TargetingIdeaService.
  $targetingIdeaService = $user->GetTargetingIdeaService('v200909');

  // Create seed keyword.
  $keyword = new Keyword();
  $keyword->text = 'mars cruise';
  $keyword->matchType = 'BROAD';

  // Create selector.
  $selector = new TargetingIdeaSelector();
  $selector->requestType = 'IDEAS';
  $selector->ideaType = 'KEYWORD';
  $selector->requestedAttributeTypes = array('KEYWORD');

  // Set selector paging (required for targeting idea service).
  $paging = new Paging();
  $paging->startIndex = 0;
  $paging->numberResults = 10;
  $selector->paging = $paging;

  // Create related to keyword search parameter.
  $relatedToKeywordSearchParameter = new RelatedToKeywordSearchParameter();
  $relatedToKeywordSearchParameter->keywords = array($keyword);
  $selector->searchParameters = array($relatedToKeywordSearchParameter);

  // Get related keywords.
  $page = $targetingIdeaService->get($selector);

  // Display related keywords.
  if (isset($page->entries)) {
    foreach ($page->entries as $targetingIdea) {
      $keyword = $targetingIdea->data[0]->value->value;
      print 'Keyword with text "' . $keyword->text . '" and match type "'
          . $keyword->matchType . "\" was found.\n";
    }
  } else {
    print "No related keywords were found.\n";
  }
} catch (Exception $e) {
  print_r($e);
}
