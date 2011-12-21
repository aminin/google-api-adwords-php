<?php
/**
 * This example gets a bid landscape for an ad group criterion. To get ad
 * group criteria, run GetAllAdGroupCriteria.php.
 *
 * Tags: DataService.getCriterionBidLandscape
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
 * @subpackage v201109
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

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the DataService.
  $dataService = $user->GetService('DataService', 'v201109');

  $adGroupId = 'INSERT_ADGROUP_ID_HERE';
  $criterionId = 'INSERT_CRITERION_ID_HERE';

  // Create selector.
  $selector = new Selector();
  $selector->fields = array('AdGroupId', 'CriterionId', 'StartDate', 'EndDate',
      'Bid', 'LocalClicks', 'LocalCost', 'MarginalCpc', 'LocalImpressions');

  // Create predicates.
  $adGroupIdPredicate = new Predicate('AdGroupId', 'IN', array($adGroupId));
  $criterionIdPredicate =
      new Predicate('CriterionId', 'IN', array($criterionId));
  $selector->predicates = array($adGroupIdPredicate, $criterionIdPredicate);

  // Get bid landscape for ad group criteria.
  $page = $dataService->getCriterionBidLandscape($selector);

  // Display bid landscapes.
  if (isset($page->entries)) {
    foreach ($page->entries as $bidLandscape) {
      printf("Found criterion bid landscape with ad group id '%s', criterion "
          . "id '%s', start date '%s', end date '%s', and landscape "
          . "points:\n",
          $bidLandscape->adGroupId, $bidLandscape->criterionId,
          $bidLandscape->startDate, $bidLandscape->endDate);
      foreach ($bidLandscape->landscapePoints as $bidLandscapePoint) {
        printf("- bid: %.0f => clicks: %d, cost: %.0f, marginalCpc: %.0f, "
            . "impressions: %d\n",
            $bidLandscapePoint->bid->microAmount, $bidLandscapePoint->clicks,
            $bidLandscapePoint->cost->microAmount,
            $bidLandscapePoint->marginalCpc->microAmount,
            $bidLandscapePoint->impressions);
      }
    }
  } else {
    print "No criterion bid landscapes were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
