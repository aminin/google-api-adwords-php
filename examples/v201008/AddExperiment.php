<?php
/**
 * This example creates an experiment using a query percentage of 10, which
 * defines what fraction of auctions should go to the control split (90%) vs.
 * the experiment split (10%), then adds experimental bid changes for an ad
 * group, and adds an experiment-only keyword. To get campaigns, run
 * GetAllCampaigns.php. To get ad groups, run GetAllAdGroups.php. To get
 * criteria, run GetAllAdGroupCriteria.php.
 *
 * Tags: ExperimentService.mutate
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @subpackage v201008
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
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

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the services.
  $experimentService = $user->GetExperimentService('v201008');
  $adGroupService = $user->GetAdGroupService('v201008');
  $adGroupCriterionService = $user->GetAdGroupCriterionService('v201008');

  $campaignId = (float) "INSERT_CAMPAIGN_ID_HERE";
  $adGroupId = (float) "INSERT_AD_GROUP_ID_HERE";

  // Create experiment.
  $experiment = new Experiment();
  $experiment->campaignId = $campaignId;
  $experiment->name = 'Interplanetary Experiment #' . time();
  $experiment->queryPercentage = 10;
  $experiment->startDateTime = date('Ymd His');

  // Create operations.
  $experimentOperation = new ExperimentOperation();
  $experimentOperation->operand = $experiment;
  $experimentOperation->operator = 'ADD';

  $experimentOperations = array($experimentOperation);

  // Add experiment.
  $result = $experimentService->mutate($experimentOperations);

  // Display experiments.
  if (isset($result->value)) {
    foreach ($result->value as $experiment) {
      printf ("Experiment with name '%s' and id '%d' was added.\n",
          $experiment->name, $experiment->id);
    }
  } else {
    print "No experiments were added.\n";
    exit();
  }

  // Create ad group bid multipliers to be used in the experiment.
  $adGroupBidMultipliers = new ManualCPCAdGroupExperimentBidMultipliers();
  $adGroupBidMultipliers->maxCpcMultiplier = new BidMultiplier(1.5);

  // Create ad group experiment data.
  $adGroupExperimentData = new AdGroupExperimentData();
  $adGroupExperimentData->experimentId = $experiment->id;
  $adGroupExperimentData->experimentDeltaStatus = 'MODIFIED';
  $adGroupExperimentData->experimentBidMultipliers = $adGroupBidMultipliers;

  // Create updated ad group.
  $adGroup = new AdGroup();
  $adGroup->id = $adGroupId;
  $adGroup->experimentData = $adGroupExperimentData;

  // Create operations.
  $adGroupOperation = new AdGroupOperation();
  $adGroupOperation->operand = $adGroup;
  $adGroupOperation->operator = 'SET';

  $adGroupOperations = array($adGroupOperation);

  // Update ad group.
  $result = $adGroupService->mutate($adGroupOperations);

  // Display ad groups.
  if (isset($result->value)) {
    foreach ($result->value as $adGroup) {
      printf ("Ad group with name '%s' and id '%d' was updated in the "
          . "experiment.\n", $adGroup->name, $adGroup->id);
    }
  } else {
    print "No ad groups were updated.\n";
  }

  // Create experiment data for a new experiment-only keyword.
  $adGroupCriterionExperimentData =
      new BiddableAdGroupCriterionExperimentData();
  $adGroupCriterionExperimentData->experimentId = $experiment->id;
  $adGroupCriterionExperimentData->experimentDeltaStatus = 'EXPERIMENT_ONLY';

  // Create keyword.
  $keyword = new Keyword('mars tour', 'BROAD');

  // Create ad group criterion.
  $adGroupCriterion = new BiddableAdGroupCriterion();
  $adGroupCriterion->adGroupId = $adGroupId;
  $adGroupCriterion->criterion = $keyword;
  $adGroupCriterion->experimentData = $adGroupCriterionExperimentData;

  // Create operations.
  $adGroupCriterionOperation = new AdGroupCriterionOperation();
  $adGroupCriterionOperation->operand = $adGroupCriterion;
  $adGroupCriterionOperation->operator = 'ADD';

  $adGroupCriterionOperations = array($adGroupCriterionOperation);

  // Add ad group criteria.
  $result = $adGroupCriterionService->mutate($adGroupCriterionOperations);

  // Display ad group criteria.
  if (isset($result->value)) {
    foreach ($result->value as $adGroupCriterion) {
      printf ("Ad group criterion with ad group id '%d' and criterion id '%d' "
          . "was added to the experiment.\n", $adGroupCriterion->adGroupId,
          $adGroupCriterion->criterion->id);
    }
  } else {
    print "No ad group criteria were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
