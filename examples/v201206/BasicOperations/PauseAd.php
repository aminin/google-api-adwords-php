<?php
/**
 * This example pauses an ad. To get text ads, run GetTextAds.php.
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
 * @subpackage v201206
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

// Enter parameters required by the code example.
$adGroupId = 'INSERT_AD_GROUP_ID_HERE';
$adId = 'INSERT_AD_ID_HERE';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 * @param string $adGroupId the id of the ad group containing the ad
 * @param string $adId the ID of the ad
 */
function PauseAdExample(AdWordsUser $user, $adGroupId, $adId) {
  // Get the service, which loads the required classes.
  $adGroupAdService = $user->GetService('AdGroupAdService', 'v201206');

  // Create ad using an existing ID. Use the base class Ad instead of TextAd to
  // avoid having to set ad-specific fields.
  $ad = new Ad();
  $ad->id = $adId;

  // Create ad group ad.
  $adGroupAd = new AdGroupAd();
  $adGroupAd->adGroupId = $adGroupId;
  $adGroupAd->ad = $ad;

  // Update the status.
  $adGroupAd->status = 'PAUSED';

  // Create operation.
  $operation = new AdGroupAdOperation();
  $operation->operand = $adGroupAd;
  $operation->operator = 'SET';

  $operations = array($operation);

  // Make the mutate request.
  $result = $adGroupAdService->mutate($operations);

  // Display result.
  $adGroupAd = $result->value[0];
  printf("Ad of type '%s' with id '%s' has updated status '%s'.\n",
      $adGroupAd->ad->AdType, $adGroupAd->ad->id, $adGroupAd->status);
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
  PauseAdExample($user, $adGroupId, $adId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
