<?php
/**
 * This example gets all conversions trackers. To add a conversion tracker, run
 * AddConversionTracker.php.
 *
 * Tags: ConversionTrackerService.get
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
 * @author     Adam Rogal <api.arogal@gmail.com>
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

  // Get the ConversionTrackerService.get.
  $conversionTrackerService =
      $user->GetService('ConversionTrackerService', 'v201109');

  // Create selector.
  $selector = new Selector();
  $selector->fields = array('Name', 'Status', 'Category');
  $selector->ordering = array(new OrderBy('Name', 'ASCENDING'));

  // Get all conversion trackers.
  $page = $conversionTrackerService->get($selector);

  // Display conversion trackers.
  if (isset($page->entries)) {
    foreach ($page->entries as $conversionTracker) {
      printf("Conversion tracker with name '%s', id '%.0f', status '%s', and "
          . "category '%s' was found.\n", $conversionTracker->name,
          $conversionTracker->id, $conversionTracker->status,
          $conversionTracker->category);
    }
  } else {
    print "No conversion trackers were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
