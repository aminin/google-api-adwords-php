<?php
/**
 * This example gets placement ideas related to a seed url.
 *
 * Tags: TargetingIdeaService.get
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
 * @subpackage v201109
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <eric.koleda@google.com>
 */

error_reporting(E_STRICT | E_ALL);

// Add the library to the include path. This is not neccessary if you've already
// done so in your php.ini file.
$path = dirname(__FILE__) . '/../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/Common/Util/MapUtils.php';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 */
function GetPlacementIdeasExample(AdWordsUser $user) {
  // Get the service, which loads the required classes.
  $targetingIdeaService = $user->GetService('TargetingIdeaService', 'v201109');

  // Create seed url.
  $url = 'mars.google.com';

  // Create selector.
  $selector = new TargetingIdeaSelector();
  $selector->requestType = 'IDEAS';
  $selector->ideaType = 'PLACEMENT';
  $selector->requestedAttributeTypes = array('CRITERION', 'PLACEMENT_TYPE');

  // Create related to url search parameter.
  $relatedToUrlSearchParameter = new RelatedToUrlSearchParameter();
  $relatedToUrlSearchParameter->urls = array($url);
  $relatedToUrlSearchParameter->includeSubUrls = FALSE;
  $selector->searchParameters[] = $relatedToUrlSearchParameter;

    // Set selector paging (required by this service).
  $selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);

  do {
    // Make the get request.
    $page = $targetingIdeaService->get($selector);

    // Display related placements.
    if (isset($page->entries)) {
      foreach ($page->entries as $targetingIdea) {
        $data = MapUtils::GetMap($targetingIdea->data);
        $placement = $data['CRITERION']->value;
        $placementType = $data['PLACEMENT_TYPE']->value;
        printf("Placement with url '%s' and type '%s' was found.\n",
            $placement->url, $placementType);
      }
    } else {
      print "No related placements were found.\n";
    }

    // Advance the paging index.
    $selector->paging->startIndex += AdWordsConstants::RECOMMENDED_PAGE_SIZE;
  } while ($page->totalNumEntries > $selector->paging->startIndex);
}

// Don't run the example if the file is being included.
if (__FILE__ != realpath($_SERVER['PHP_SELF'])) {
  return;
}

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  GetPlacementIdeasExample($user);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
