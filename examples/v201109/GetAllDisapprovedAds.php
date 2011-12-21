<?php
/**
 * This example gets all disapproved ads in an ad group. To add ads, run
 * AddAds.php. To get ad groups, run GetAllAdGroups.php.
 *
 * Tags: AdGroupAdService.get
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

  // Get the AdGroupAdService.
  $adGroupAdService = $user->GetService('AdGroupAdService', 'v201109');

  $adGroupId = 'INSERT_AD_GROUP_ID_HERE';

  // Create selector.
  $selector = new Selector();
  $selector->fields = array('Id', 'DisapprovalReasons');
  $selector->ordering = array(new OrderBy('Id', 'ASCENDING'));

  // Create predicates.
  $adGroupIdPredicate = new Predicate('AdGroupId', 'IN', array($adGroupId));
  $approvalStatusPredicate =
      new Predicate('CreativeApprovalStatus', 'IN', array('DISAPPROVED'));
  $selector->predicates = array($adGroupIdPredicate, $approvalStatusPredicate);

  // Get all ads.
  $page = $adGroupAdService->get($selector);

  // Display ads.
  if (isset($page->entries)) {
    foreach ($page->entries as $adGroupAd) {
      printf("Ad with id '%.0f', and type '%s' was disapproved for the "
          . "following reasons:\n", $adGroupAd->ad->id, $adGroupAd->ad->AdType);
      foreach ($adGroupAd->ad->disapprovalReasons as $reason) {
        printf("\t'%s'\n", $reason);
      }
    }
  } else {
    print "No disapproved ads were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
