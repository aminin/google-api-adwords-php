<?php
/**
 * This example adds a new remarketing list audience to the account and
 * retrieves the associated remarketing tag code.
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

// Constants used in the example.
define('WAIT_TIME', 1);

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 */
function AddAudienceExample(AdWordsUser $user) {
  // Get the services, which loads the required classes.
  $userListService = $user->GetService('UserListService', 'v201109');
  $conversionTrackerService =
      $user->GetService('ConversionTrackerService', 'v201109');

  // Create conversion type (tag).
  $conversionType = new UserListConversionType();
  $conversionType->name = 'Mars cruise customers #' . uniqid();

  // Create remarketing user list.
  $userList = new RemarketingUserList();
  $userList->name = 'Mars cruise customers #' . uniqid();
  $userList->description = 'A list of mars cruise customers in the last year';
  $userList->membershipLifeSpan = 365;
  $userList->conversionTypes = array($conversionType);

  // Create operation.
  $operation = new UserListOperation();
  $operation->operand = $userList;
  $operation->operator = 'ADD';

  $operations = array($operation);

  // Make the mutate request.
  $result = $userListService->mutate($operations);
  $userList = $result->value[0];

  // Wait a moment before retrieving the conversion snippet.
  sleep(WAIT_TIME);

  // Create the selector.
  $selector = new Selector();
  $selector->fields = array('Id');
  $selector->predicates[] =
      new Predicate('Id', 'IN', array($userList->conversionTypes[0]->id));

  // Make the get request.
  $page = $conversionTrackerService->get($selector);
  $conversionTracker = $page->entries[0];

  // Display result.
  printf("Audience with name '%s' and id '%.0f' was added.\n", $userList->name,
      $userList->id);
  printf("Tag code:\n%s\n", $conversionTracker->snippet);
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
  AddAudienceExample($user);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
