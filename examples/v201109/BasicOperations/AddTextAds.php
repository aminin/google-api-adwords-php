<?php
/**
 * This example adds text ads to an ad group. To get ad groups,
 * run GetAdGroups.php.
 *
 * Tags: AdGroupAdService.mutate
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
require_once 'Google/Api/Ads/Common/Util/MediaUtils.php';

// Enter parameters required by the code example.
$adGroupId = 'INSERT_AD_GROUP_ID_HERE';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 * @param string $adGroupId the id of the ad group to add the ads to
 */
function AddTextAdsExample(AdWordsUser $user, $adGroupId) {
  // Get the service, which loads the required classes.
  $adGroupAdService = $user->GetService('AdGroupAdService', 'v201109');

  // Create text ads.
  $numAds = 5;
  $ads = array();
  for ($i = 0; $i < $numAds; $i++) {
    $textAd = new TextAd();
    $textAd->headline = 'Cruise #' . uniqid();
    $textAd->description1 = 'Visit the Red Planet in style.';
    $textAd->description2 = 'Low-gravity fun for everyone!';
    $textAd->displayUrl = 'www.example.com';
    $textAd->url = 'http://www.example.com';
    $ads[] = $textAd;
  }

  // Create ad group ads and operations.
  $operations = array();
  foreach ($ads as $ad) {
    $adGroupAd = new AdGroupAd();
    $adGroupAd->adGroupId = $adGroupId;
    $adGroupAd->ad = $ad;

    // Create operation.
    $operation = new AdGroupAdOperation();
    $operation->operand = $adGroupAd;
    $operation->operator = 'ADD';
    $operations[] = $operation;
  }

  // Make the mutate request.
  $result = $adGroupAdService->mutate($operations);

  // Display results.
  foreach ($result->value as $adGroupAd) {
    printf("Text ad with headline '%s' and id '%s' was added.\n",
        $adGroupAd->ad->headline, $adGroupAd->ad->id);
  }
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
  AddTextAdsExample($user, $adGroupId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
