<?php
/**
 * This example gets all keyword opportunities for the account.
 *
 * Tags: BulkOpportunityService.get
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
 * @subpackage v201101
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
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

  // Get the BulkOpportunityService.
  $bulkOpportunityService = $user->GetBulkOpportunityService('v201101');

  // Create selector.
  $selector = new BulkOpportunitySelector();
  $selector->ideaTypes = array('KEYWORD');
  $selector->requestedAttributeTypes =
      array('CAMPAIGN_ID', 'ADGROUP_ID', 'KEYWORD', 'AVERAGE_MONTHLY_SEARCHES');

  // Set selector paging (required by the BulkOpportunityService).
  $paging = new Paging();
  $paging->startIndex = 0;
  $paging->numberResults = 10;
  $selector->paging = $paging;

  // Get keyword opportunities.
  $page = $bulkOpportunityService->get($selector);

  // Display keyword opportunities.
  if (isset($page->entries)) {
    foreach ($page->entries as $opportunity) {
      $data = MapUtils::GetMap($opportunity->opportunityIdeas[0]->data);
      $campaignId = $data['CAMPAIGN_ID']->value;
      $adGroupId = $data['ADGROUP_ID']->value;
      printf("Opportunities found for campaign id '%s' and ad group id '%s':\n",
          $campaignId, $adGroupId);
      foreach ($opportunity->opportunityIdeas as $opportunityIdea) {
        $data = MapUtils::GetMap($opportunityIdea->data);
        $keyword = $data['KEYWORD']->value;
        $averageMonthlySearches =
            isset($data['AVERAGE_MONTHLY_SEARCHES']->value)
            ? $data['AVERAGE_MONTHLY_SEARCHES']->value : 0;
        printf("\tKeyword opportunity with text '%s', match type '%s', and "
            . "average monthly search volume '%s' was found.\n", $keyword->text,
            $keyword->matchType, $averageMonthlySearches);
      }
    }
  } else {
    print "No keyword opportunities were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
