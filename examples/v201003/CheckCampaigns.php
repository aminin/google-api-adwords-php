<?php
/**
 * This example shows how to use the validate only header to check for errors.
 * No objects will be created, but exceptions will still be thrown.
 *
 * Tags: CampaignService.mutate
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
 * @subpackage v201003
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @link       http://code.google.com/apis/adwords/v2009/docs/headers.html
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

  // Get the validation CampaignService by passing 'true' for the parameter
  // $validateOnly.
  $campaignValidationService = $user->GetCampaignService('v201003', NULL,
      NULL, true);

  // Create campaign.
  $goodCampaign = new Campaign();
  $goodCampaign->name = 'Campaign #' + time();
  $goodCampaign->status = 'PAUSED';
  $goodCampaign->biddingStrategy = new ManualCPC();

  // Create budget.
  $budget = new Budget();
  $budget->period = 'DAILY';
  $budget->amount = new Money(50000000);
  $budget->deliveryMethod = 'STANDARD';
  $goodCampaign->budget = $budget;

  // Create operations.
  $operation = new CampaignOperation();
  $operation->operand = $goodCampaign;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Validate campaign operation.
  $result = $campaignValidationService->mutate($operations);

  // Display new campaigns, which should be none if the service was a
  // validation service.
  if (isset($result->value)) {
    foreach ($result->value as $campaign) {
      print 'New campaign with name "' . $campaign->name
          . '" and id "' . $campaign->id . "\" was created.\n";
    }
  } else {
    print "No campaigns were created.\n";
  }

  // Provide an invalid bidding strategy that will cause an exception
  // durning validation.
  $badCampaign = new Campaign();
  $badCampaign->name = 'Campaign #' + time();
  $badCampaign->status = 'PAUSED';
  $badCampaign->budget = $budget;

  // Throws RequiredError.REQUIRED @ operations[0].operand.biddingStrategy.
  $badCampaign->biddingStrategy = NULL;

  // Create operations.
  $operation = new CampaignOperation();
  $operation->operand = $badCampaign;
  $operation->operator = 'ADD';

  $operations = array($operation);

  try {
    // Validate campaign operation.
    $result = $campaignValidationService->mutate($operations);
  } catch (Exception $e) {
    print 'Validation failed for reason "' . $e->getMessage() . "\".\n";
  }
} catch (Exception $e) {
  print_r($e);
}
