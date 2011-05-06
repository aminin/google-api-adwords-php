<?php
/**
 * This example shows how to check for conversion optimizer eligibility by
 * attempting to set the bidding transition with the validate only header set to
 * true.
 *
 * Tags: CampaignService.get
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
 * @subpackage v200909
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
require_once 'Google/Api/Ads/Common/Util/ErrorUtils.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the validation CampaignService by passing 'true' for the parameter
  // $validateOnly.
  $campaignValidationService = $user->GetCampaignService('v200909', NULL,
      NULL, true);

  $campaignId = (float) 'INSERT_CAMPAIGN_ID_HERE';

  // Create campaign.
  $campaign = new Campaign();
  $campaign->id = $campaignId;

  // Create bidding transition.
  $conversionOptimizerBiddingTransition =
      new ConversionOptimizerBiddingTransition();

  // Create conversion optimizer bidding strategy.
  $conversionOptimizer = new ConversionOptimizer();
  $conversionOptimizer->pricingModel = 'CONVERSIONS';
  $conversionOptimizerBiddingTransition->targetBiddingStrategy =
      $conversionOptimizer;

  // Create conversion optimizer ad group bids.
  $conversionOptimizerAdGroupBids = new ConversionOptimizerAdGroupBids();
  $conversionOptimizerBiddingTransition->explicitAdGroupBids =
      $conversionOptimizerAdGroupBids;

  // Create operations.
  $operation = new CampaignOperation();
  $operation->biddingTransition = $conversionOptimizerBiddingTransition;
  $operation->operand = $campaign;
  $operation->operator = 'SET';

  $operations = array($operation);

  try {
    // Check that the campaign is eligible for conversion optimization.
    $result = $campaignValidationService->mutate($operations);
    print 'Campaign with id "' . $campaign->id
        . "\" is eligible to use conversion optimizer.\n";
  } catch (SoapFault $fault) {
    $errors = ErrorUtils::GetApiErrors($fault);
    foreach ($errors as $error) {
      if ($error instanceof BiddingTransitionError) {
        print 'Campaign with id "' . $campaign->id
            . '" is not eligible to use conversion optimizer for reason "'
            . $error->reason . "\".\n";
      } else {
        print 'Error of type "' . $error->ApiErrorType
            . '" was returned for reason "' .  $error->reason . "\".\n";
      }
    }
  }
} catch (Exception $e) {
  print $e->getMessage();
}
