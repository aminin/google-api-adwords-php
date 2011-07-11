<?php
/**
 * This example ads an ad extension override to an ad using an existing
 * campaign ad extension. To get ads, run GetAllAds.php. To get campaign
 * ad extensions, run GetAllCampaignAdExtensions.php.
 *
 * Tags: AdGroupCriterionService.mutate
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
 * @subpackage v201008
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

  // Get the AdExtensionOverrideService.
  $adExtensionOverrideService =
      $user->GetService('AdExtensionOverrideService', 'v201008');

  $adId = (float) 'INSERT_AD_ID_HERE';
  $campaignAdExtensionId = (float) 'INSERT_CAMPAIGN_AD_EXTENSION_ID_HERE';

  // Create ad extenstion override.
  $adExtensionOverride = new AdExtensionOverride();
  $adExtensionOverride->adId = $adId;

  // Create ad extension using existing id.
  $adExtension = new AdExtension();
  $adExtension->id = $campaignAdExtensionId;
  $adExtensionOverride->adExtension = $adExtension;

  // Create operations.
  $operation = new AdExtensionOverrideOperation();
  $operation->operand = $adExtensionOverride;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Add ad extension override.
  $result = $adExtensionOverrideService->mutate($operations);

  // Display ad extension overrides.
  if (isset($result->value)) {
    foreach ($result->value as $adExtensionOverride) {
      print 'Ad extension override with ad id "' . $adExtensionOverride->adId
          . '", ad extension id "' . $adExtensionOverride->adExtension->id
          . '", and type "' . $adExtensionOverride->adExtension->AdExtensionType
          . "\" was added.\n";
    }
  } else {
    print "No ad extension overrides were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
