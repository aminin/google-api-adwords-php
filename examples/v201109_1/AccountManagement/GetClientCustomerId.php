<?php
/**
 * This example illustrates how to find a client customer ID for a client email.
 * We recommend to use this script as a one off to convert your identifiers to
 * IDs and store them for future use.
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
 * @subpackage v201109_1
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
$clientEmail = 'INSERT_EMAIL_ADDRESS_HERE';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 * @param string $clientEmail the email address of the client to lookup
 */
function GetClientCustomerIdExample(AdWordsUser $user, $clientEmail) {
  // Get the service, which loads the required classes.
  $infoService = $user->GetService('InfoService', 'v201109_1');

  // Create selector.
  $selector = new InfoSelector();
  $selector->clientEmails = array($clientEmail);
  $selector->includeSubAccounts = TRUE;
  $selector->apiUsageType = 'UNIT_COUNT_FOR_CLIENTS';
  // The date used doesn't matter, but it's best to use yesterday to avoid
  // timezone issues.
  $yesterday = date('Ymd', strtotime('-1 day'));
  $selector->dateRange = new DateRange($yesterday, $yesterday);

  // Make the get request.
  $info = $infoService->get($selector);

  // Display result.
  $record = $info->apiUsageRecords[0];
  printf("Found record with client email '%s' and customer ID '%s'.\n",
      $record->clientEmail, $record->clientCustomerId);
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
  GetClientCustomerIdExample($user, $clientEmail);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
