<?php
/**
 * This example gets keyword traffic estimates.
 *
 * Tags: TrafficEstimatorService.get
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

  // Get the TrafficEstimatorService.
  $trafficEstimatorService =
      $user->GetService('TrafficEstimatorService', 'v201101');

  // Create keywords. Up to 2000 keywords can be passed in a single request.
  $keywords = array();
  $keywords[] = new Keyword('mars cruise', 'BROAD');
  $keywords[] = new Keyword('cheap cruise', 'PHRASE');
  $keywords[] = new Keyword('cruise', 'EXACT');

  // Create a keyword estimate request for each keyword.
  $keywordEstimateRequests = array();
  foreach ($keywords as $keyword) {
    $keywordEstimateRequest = new KeywordEstimateRequest();
    $keywordEstimateRequest->keyword = $keyword;
    $keywordEstimateRequests[] = $keywordEstimateRequest;
  }

  // Create ad group estimate requests.
  $adGroupEstimateRequest = new AdGroupEstimateRequest();
  $adGroupEstimateRequest->keywordEstimateRequests = $keywordEstimateRequests;
  $adGroupEstimateRequest->maxCpc = new Money(1000000);
  $adGroupEstimateRequests = array($adGroupEstimateRequest);

  // Create campaign estimate requests.
  $campaignEstimateRequest = new CampaignEstimateRequest();
  $campaignEstimateRequest->adGroupEstimateRequests = $adGroupEstimateRequests;
  $campaignEstimateRequest->targets = array(new CountryTarget('US'),
      new LanguageTarget('en'));
  $campaignEstimateRequests = array($campaignEstimateRequest);

  // Create selector.
  $selector = new TrafficEstimatorSelector();
  $selector->campaignEstimateRequests = $campaignEstimateRequests;

  // Get traffic estimates.
  $result = $trafficEstimatorService->get($selector);

  // Display traffic estimates.
  if (isset($result)) {
    $keywordEstimates =
        $result->campaignEstimates[0]->adGroupEstimates[0]->keywordEstimates;
    for ($i = 0; $i < sizeof($keywordEstimates); $i++) {
      $keyword = $keywordEstimateRequests[$i]->keyword;
      $keywordEstimate = $keywordEstimates[$i];

      // Find the mean of the min and max values.
      $meanAverageCpc = ($keywordEstimate->min->averageCpc->microAmount
          + $keywordEstimate->max->averageCpc->microAmount) / 2;
      $meanAveragePosition = ($keywordEstimate->min->averagePosition
          + $keywordEstimate->max->averagePosition) / 2;
      $meanClicks = ($keywordEstimate->min->clicksPerDay
          + $keywordEstimate->max->clicksPerDay) / 2;
      $meanTotalCost = ($keywordEstimate->min->totalCost->microAmount
          + $keywordEstimate->max->totalCost->microAmount) / 2;

      printf("Results for the keyword with text '%s' and match type '%s':\n",
          $keyword->text, $keyword->matchType);
      printf("  Estimated average CPC: %.0f\n", $meanAverageCpc);
      printf("  Estimated ad position: %.2f \n", $meanAveragePosition);
      printf("  Estimated daily clicks: %d\n", $meanClicks);
      printf("  Estimated daily cost: %.0f\n\n", $meanTotalCost);
    }
  } else {
    print "No traffic estimates were returned.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
