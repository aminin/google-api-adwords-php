<?php
/**
 * This example adds a third party redirect ad to an ad group. To get ad groups,
 * run GetAllAdGroups.php.
 *
 * Tags: AdGroupAdService.mutate
 *
 * PHP version 5
 *
 * Copyright 2009, Google Inc. All Rights Reserved.
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

  // Get the AdGroupAdService.
  $adGroupAdService = $user->GetService('AdGroupAdService', 'v201109');

  $adGroupId = (float) 'INSERT_AD_GROUP_ID_HERE';

  // Create third party redirect ad.
  $thirdPartyRedirectAd = new ThirdPartyRedirectAd();
  $thirdPartyRedirectAd->name = 'Example third party ad #' . time();
  $thirdPartyRedirectAd->url = 'http://www.example.com';
  $thirdPartyRedirectAd->dimensions = new Dimensions(300, 250);
  // This field normally contains the javascript ad tag.
  $thirdPartyRedirectAd->snippet = '<img src="http://goo.gl/HJM3L"/>';
  $thirdPartyRedirectAd->impressionBeaconUrl = 'http://www.examples.com/beacon';
  // Image & Flash format id.
  $thirdPartyRedirectAd->certifiedVendorFormatId = 119;
  $thirdPartyRedirectAd->isCookieTargeted = FALSE;
  $thirdPartyRedirectAd->isUserInterestTargeted = FALSE;
  $thirdPartyRedirectAd->isTagged = FALSE;

  // Create ad group ad.
  $adGroupAd = new AdGroupAd();
  $adGroupAd->adGroupId = $adGroupId;
  $adGroupAd->ad = $thirdPartyRedirectAd;

  // Create operations.
  $operation = new AdGroupAdOperation();
  $operation->operand = $adGroupAd;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Add ads.
  $result = $adGroupAdService->mutate($operations);

  // Display ads.
  if (isset($result->value)) {
    foreach ($result->value as $adGroupAd) {
      print 'Ad with id "' . $adGroupAd->ad->id . '" and type "'
          . $adGroupAd->ad->AdType . "\" was added.\n";
    }
  } else {
    print "No ads were added.\n";
  }
} catch (Exception $e) {
  print_r($e);
}
