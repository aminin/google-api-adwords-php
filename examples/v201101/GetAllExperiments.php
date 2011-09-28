<?php
/**
 * This example gets all experiments in a campaign. To add an experiment, run
 * AddExperiment.php. To get campaigns, run GetAllCampaigns.php.
 *
 * Tags: ExperimentService.get
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
 * @subpackage v201101
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

  // Get the services.
  $experimentService = $user->GetService('ExperimentService', 'v201101');

  $campaignId = (float) "INSERT_CAMPAIGN_ID_HERE";

  // Create selector.
  $selector = new Selector();
  $selector->fields = array('Name', 'Id', 'ControlId', 'AdGroupsCount',
      'AdGroupCriteriaCount', 'AdGroupAdsCount');
  $selector->ordering = array(new OrderBy('Name', 'ASCENDING'));

  // Create predicates.
  $campaignIdPredicate = new Predicate('CampaignId', 'IN', array($campaignId));
  $selector->predicates = array($campaignIdPredicate);

  // Get all experiments.
  $page = $experimentService->get($selector);

  // Display experiments.
  if (isset($page->entries)) {
    foreach ($page->entries as $experiment) {
      printf("Experiment with name '%s', id '%.0f', and control id '%.0f' was "
          . "found. It includes %d ad groups, %d criteria, and %d ads. \n",
          $experiment->name, $experiment->id, $experiment->controlId,
          $experiment->experimentSummaryStats->adGroupsCount,
          $experiment->experimentSummaryStats->adGroupCriteriaCount,
          $experiment->experimentSummaryStats->adGroupAdsCount);
    }
  } else {
    print "No experiments were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
