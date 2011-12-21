<?php
/**
 * This example illustrates how to find a client customer ID for a client email.
 * We recommend to use this script as a one off to convert your identifiers to
 * IDs and store them for future use.
 *
 * Tags: InfoService.get
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

  // Ensure the clientCustomerId is not set, so that requests are made to the
  // MCC.
  $user->SetClientId(NULL);

  // Get the InfoService.
  $infoService = $user->GetService('InfoService', 'v201109');

  $clientEmail = 'INSERT_EMAIL_ADDRESS_HERE';

  // Create selector.
  $selector = new InfoSelector();
  $selector->clientEmails = array($clientEmail);
  $selector->includeSubAccounts = TRUE;
  $selector->apiUsageType = 'UNIT_COUNT_FOR_CLIENTS';
  // The date used doesn't matter, so use today.
  $selector->dateRange = new DateRange(date('Ymd'), date('Ymd'));

  // Get the information for the client email address.
  $info = $infoService->get($selector);

  foreach ($info->apiUsageRecords as $record) {
    printf("Found record with client email '%s' and customer ID '%s'.\n",
        $record->clientEmail, $record->clientCustomerId);
  }
} catch (Exception $e) {
  print $e->getMessage();
}
