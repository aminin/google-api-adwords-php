<?php
/**
 * This example gets related placements using the TargetingIdeaService.
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
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

/**
 * This example gets related placements using the TargetingIdeaService.
 */
class GetRelatedPlacementsExample {
  static function main() {
    try {
      // Get AdWordsUser from credentials in "../auth.ini"
      // relative to the AdWordsUser.php file's directory.
      $user = new AdWordsUser();

      // Log SOAP XML request and response.
      $user->LogDefaults();

      // Get the TargetingIdeaService.
      $targetingIdeaService = $user->GetTargetingIdeaService();

      // Set url to retrieve related placements for.
      $url = 'finance.google.com';

      // Set language.
      $language = new LanguageTarget('en');

      // Set country.
      $country = new CountryTarget('US');

      // Create selector to get related placements.
      $selector = new TargetingIdeaSelector();
      $selector->requestType = 'IDEAS';
      $selector->ideaType = 'PLACEMENT';
      $selector->searchParameters = array(
          new RelatedToUrlSearchParameter(array($url)),
          new LanguageTargetSearchParameter(array($language)),
          new CountryTargetSearchParameter(array($country)));
      $selector->requestedAttributeTypes = array('PLACEMENT', 'PLACEMENT_TYPE',
          'SAMPLE_URL');

      // Increase paging for more results.
      $selector->paging = new Paging(0, 6);

      // Get targeting ideas.
      $page = $targetingIdeaService->get($selector);

      if (isset($page->entries)) {
        foreach ($page->entries as $targetingIdea) {
          GetRelatedPlacementsExample::DisplayTargetingIdea($targetingIdea);
          print "\n";
        }
      } else {
        print "No targeting ideas found.\n";
      }
    } catch (Exception $e) {
      print_r($e);
    }
  }

  /**
   * Displays the targeting idea in a meaningful way.
   * @param $targetingIdea the targeting idea to display
   * @access private
   */
  private static function DisplayTargetingIdea(TargetingIdea $targetingIdea) {
    foreach ($targetingIdea->data as $entry) {
      print $entry->key . ': ';
      $attribute = $entry->value;
      if ($attribute instanceof KeywordAttribute) {
        print $attribute->value->text . ' / ' . $attribute->value->matchType;
      } else if ($attribute instanceof PlacementAttribute) {
        print $attribute->value->url;
      } else if ($attribute instanceof IdeaTypeAttribute) {
        print $attribute->value;
      } else if ($attribute instanceof IntegerSetAttribute) {
        print implode(', ', $attribute->value);
      } else if ($attribute instanceof WebpageDescriptorAttribute) {
        print $attribute->value->title . ' / ' . $attribute->value->url;
      } else if ($attribute instanceof MonthlySearchVolumeAttribute) {
        print '[';
        foreach ($attribute->value as $searchVolume) {
          print $searchVolume->month . '/' . $searchVolume->year . ': '
              . $searchVolume->count . ', ';
        }
        print ']';
      } else  {
        print $attribute->value;
      }
      print "\n";
    }
  }
}

GetRelatedPlacementsExample::main();
