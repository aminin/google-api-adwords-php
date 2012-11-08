<?php
/**
 * This example gets the account hierarchy under the current account. Note: this
 * example must be run using the credentials of an MCC account.
 *
 * Tags: ServicedAccountService.get
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

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 */
function GetAccountHierarchyExample(AdWordsUser $user) {
  // Get the service, which loads the required classes.
  $servicedAccountService =
      $user->GetService('ServicedAccountService', 'v201109_1');

  // Create selector.
  $selector = new ServicedAccountSelector();
  // To get the links paging must be disabled.
  $selector->enablePaging = FALSE;

  // Make the get request.
  $graph = $servicedAccountService->get($selector);

  // Display serviced account graph.
  if (isset($graph->accounts)) {
    // Create map from customerId to parent and child links.
    $childLinks = array();
    $parentLinks = array();
    if (isset($graph->links)) {
      foreach ($graph->links as $link) {
        $childLinks[$link->managerId->id][] = $link;
        $parentLinks[$link->clientId->id][] = $link;
      }
    }
    // Create map from customerID to account, and find root account.
    $accounts = array();
    $rootAccount = NULL;
    foreach ($graph->accounts as $account) {
      $accounts[$account->customerId] = $account;
      if (!array_key_exists($account->customerId, $parentLinks)) {
        $rootAccount = $account;
      }
    }
    // The root account may not be returned in the sandbox.
    if (!isset($rootAccount)) {
      $rootAccount = new Account();
      $rootAccount->customerId = 0;
      $rootAccount->login = $user->GetEmail();
    }
    // Display account tree.
    print "(Customer Id, Account Name/Login, Link Status)\n";
    DisplayAccountTree($rootAccount, NULL, $accounts, $childLinks, 0);
  } else {
    print "No serviced accounts were found.\n";
  }
}

/**
 * Displays an account tree, starting at the account and link provided, and
 * recursing to all child accounts.
 * @param Account $account the account to display
 * @param Link $link the link used to reach this account
 * @param array $accounts a map from customerId to account
 * @param array $links a map from customerId to child links
 * @param int $depth the depth of the current account in the tree
 */
function DisplayAccountTree($account, $link, $accounts, $links, $depth) {
  print str_repeat('-', $depth * 2);
  printf("%s, %s, %s\n", $account->customerId,
      !empty($link->descriptiveName) ? $link->descriptiveName :$account->login,
      isset($link) ? $link->typeOfLink : 'N/A');
  if (array_key_exists($account->customerId, $links)) {
    foreach ($links[$account->customerId] as $childLink) {
      $childAccount = $accounts[$childLink->clientId->id];
      DisplayAccountTree($childAccount, $childLink, $accounts, $links,
          $depth +1);
    }
  }
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
  GetAccountHierarchyExample($user);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
