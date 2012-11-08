<?php
/**
 * This example creates a new account under an MCC account. Note: this example
 * must be run using the credentials of an MCC account, and by default the new
 * account will only be accessible via the parent MCC account.
 *
 * Tags: ManagedCustomerService.mutate
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
 * @subpackage v201206
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

// Add the library to the include path. This is not neccessary if you've already
// done so in your php.ini file.
$path = dirname(__FILE__) . '/../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 */
function CreateAccountExample(AdWordsUser $user) {
  // Get the service, which loads the required classes.
  $managedCustomerService =
      $user->GetService('ManagedCustomerService', 'v201206');

  // Create customer.
  $customer = new ManagedCustomer();
  $customer->name = 'Account #' . uniqid();
  $customer->currencyCode = 'EUR';
  $customer->dateTimeZone = 'Europe/London';

  // Create operation.
  $operation = new ManagedCustomerOperation();
  $operation->operator = 'ADD';
  $operation->operand = $customer;

  $operations = array($operation);

  // Make the mutate request.
  $result = $managedCustomerService->mutate($operations);

  // Display result.
  $customer = $result->value[0];
  printf("Account with customer ID '%s' was created.\n",
      $customer->customerId);
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
  CreateAccountExample($user);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
