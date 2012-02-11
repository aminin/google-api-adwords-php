<?php
/**
 * This example gets all targeting criteria for a campaign. To add targeting
 * criteria, run AddCampaignTargetingCriteria.php.
 *
 * Tags: CampaignCriterionService.get
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
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <eric.koleda@google.com>
 */

error_reporting(E_STRICT | E_ALL);

// Add the library to the include path. This is not neccessary if you've already
// done so in your php.ini file.
$path = dirname(__FILE__) . '/../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

// Constants used in the example.
define('PAGE_SIZE', 500);

// Enter parameters required by the code example.
$campaignId = 'INSERT_CAMPAIGN_ID_HERE';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 * @param string $campaignId the ID of the campaign to get targeting criteria
 *     for
 */
function GetCampaignTargetingCriteriaExample(AdWordsUser $user, $campaignId) {
  // Get the service, which loads the required classes.
  $campaignCriterionService =
      $user->GetService('CampaignCriterionService', 'v201109');

  // Create selector.
  $selector = new Selector();
  $selector->fields = array('Id', 'CriteriaType');

  // Create predicates.
  $selector->predicates[] =
      new Predicate('CampaignId', 'IN', array($campaignId));
  $selector->predicates[] = new Predicate('CriteriaType', 'IN',
      array('LANGUAGE', 'LOCATION', 'AGE_RANGE', 'CARRIER',
          'OPERATING_SYSTEM_VERSION', 'GENDER', 'POLYGON', 'PROXIMITY',
          'PLATFORM'));

  // Create paging controls.
  $selector->paging = new Paging(0, PAGE_SIZE);

  do {
    // Make the get request.
    $page = $campaignCriterionService->get($selector);

    // Display results.
    if (isset($page->entries)) {
      foreach ($page->entries as $campaignCriterion) {
        printf("Campaign targeting criterion with id '%s' and type '%s' was "
            . "found.\n", $campaignCriterion->criterion->id,
            $campaignCriterion->criterion->CriterionType);
      }
    } else {
      print "No campaign targeting criteria were found.\n";
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
  GetCampaignTargetingCriteriaExample($user, $campaignId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
