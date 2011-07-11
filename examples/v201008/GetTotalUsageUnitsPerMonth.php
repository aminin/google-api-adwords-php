<?php
/**
 * This example gets the total number of API units that can be used in a month
 * for a given developer token. This example must be run as the MCC user that
 * owns the developer token.
 *
 * Tags: InfoService.get
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

  // Get the InfoService.
  $infoService = $user->GetService('InfoService', 'v201008');

  // Create selector.
  $selector = new InfoSelector();
  $selector->apiUsageType = 'TOTAL_USAGE_API_UNITS_PER_MONTH';

  // Get api usage info.
  $apiUsageInfo = $infoService->get($selector);

  // Display api usage info.
  if (isset($apiUsageInfo)) {
    print 'The total number of API units available per month is "'
        . $apiUsageInfo->cost . "\".\n";
  } else {
    print "No api usage information was returned.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
