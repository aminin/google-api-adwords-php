<?php
/**
 * This example adds a remarketing user list.
 *
 * Tags: UserListService.mutate, ConversionTrackerService.mutate
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
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
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

  // Get the services.
  $userListService = $user->GetUserListService('v201101');
  $conversionTrackerService = $user->GetConversionTrackerService('v201101');

  // Create conversion type (tag).
  $conversionType = new UserListConversionType();
  $conversionType->name = 'Mars cruise customers #' . uniqid();

  // Create remarketing user list.
  $userList = new RemarketingUserList();
  $userList->name = 'Mars cruise customers #' . uniqid();
  $userList->description = 'A list of mars cruise customers in the last year';
  $userList->membershipLifeSpan = 365;
  $userList->conversionTypes = array($conversionType);

  // Create operations.
  $operation = new UserListOperation();
  $operation->operand = $userList;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Add user list.
  $result = $userListService->mutate($operations);

  if (isset($result->value)) {
    // Get conversion snippets.
    $conversionIds = array();
    foreach ($result->value as $userList) {
      foreach($userList->conversionTypes as $conversion) {
        $conversionIds[] = $conversion->id;
      }
    }

    $selector = new Selector();
    $selector->fields = array('Id');
    $selector->predicates = array(new Predicate('Id', 'IN', $conversionIds));
    $page = $conversionTrackerService->get($selector);

    $conversionSnippets = array();
    foreach($page->entries as $conversionTracker) {
      $conversionSnippets[$conversionTracker->id] = $conversionTracker->snippet;
    }

    // Display user lists and snippets.
    foreach ($result->value as $userList) {
      printf("User list with name '%s' and id '%.0f' was added.\n",
          $userList->name, $userList->id);
      foreach($userList->conversionTypes as $conversionType) {
        printf("JavaScript snippet:\n%s\n",
            $conversionSnippets[$conversionType->id]);
      }
    }
  } else {
    print "No user lists were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
