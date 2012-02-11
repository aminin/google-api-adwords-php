<?php
/**
 * This example gets keyword opportunities for all ad groups in the account.
 *
 * Tags: BulkOpportunityService.get
 * Restriction: adwords-only
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

// Constants used in the example.
// Use a low page size with this service, as each opportunity can contain many
// ideas.
define('PAGE_SIZE', 20);

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 */
function GetKeywordOpportunitiesExample(AdWordsUser $user) {
  // Get the service, which loads the required classes.
  $bulkOpportunityService =
      $user->GetService('BulkOpportunityService', 'v201109');

  // Create selector.
  $selector = new BulkOpportunitySelector();
  $selector->ideaTypes = array('KEYWORD');
  $selector->requestedAttributeTypes =
      array('CAMPAIGN_ID', 'ADGROUP_ID', 'KEYWORD', 'AVERAGE_MONTHLY_SEARCHES');

  // Set selector paging (required by this service).
  $selector->paging = new Paging(0, PAGE_SIZE);

  do {
    // Make the get request.
    $page = $bulkOpportunityService->get($selector);

    // Display results.
    if (isset($page->entries)) {
      foreach ($page->entries as $opportunity) {
        $data = MapUtils::GetMap($opportunity->opportunityIdeas[0]->data);
        $campaignId = $data['CAMPAIGN_ID']->value;
        $adGroupId = $data['ADGROUP_ID']->value;
        printf("Opportunities found for campaign id '%s' and ad group id "
            . "'%s':\n", $campaignId, $adGroupId);
        foreach ($opportunity->opportunityIdeas as $opportunityIdea) {
          $data = MapUtils::GetMap($opportunityIdea->data);
          $keyword = $data['KEYWORD']->value;
          $averageMonthlySearches =
              isset($data['AVERAGE_MONTHLY_SEARCHES']->value)
              ? $data['AVERAGE_MONTHLY_SEARCHES']->value : 0;
          printf("\tKeyword idea with text '%s', match type '%s', and "
              . "average monthly search volume '%d' was found.\n",
              $keyword->text, $keyword->matchType, $averageMonthlySearches);
        }
      }
    } else {
      print "No keyword opportunities were found.\n";
    }

    // Advance the paging index.
    $selector->paging->startIndex += PAGE_SIZE;
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
  GetKeywordOpportunitiesExample($user);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
