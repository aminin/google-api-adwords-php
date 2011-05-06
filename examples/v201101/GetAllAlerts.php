<?php
/**
 * This example gets all alerts for all clients of an MCC account. The effective
 * user (clientEmail, clientCustomerId, or authToken) must be an MCC user to
 * get results.
 *
 * Tags: AlertService.get
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
 * @subpackage v201101
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

  // Get the AlertService.
  $alertService = $user->GetAlertService('v201101');

  // Create alert query.
  $alertQuery = new AlertQuery();
  $alertQuery->clientSpec = 'ALL';
  $alertQuery->filterSpec = 'ALL';
  $alertQuery->types = array('ACCOUNT_BUDGET_BURN_RATE','ACCOUNT_BUDGET_ENDING',
      'ACCOUNT_ON_TARGET','CAMPAIGN_ENDED','CAMPAIGN_ENDING',
      'CREDIT_CARD_EXPIRING','DECLINED_PAYMENT',
      'MANAGER_LINK_PENDING','MISSING_BANK_REFERENCE_NUMBER',
      'PAYMENT_NOT_ENTERED','TV_ACCOUNT_BUDGET_ENDING','TV_ACCOUNT_ON_TARGET',
      'TV_ZERO_DAILY_SPENDING_LIMIT','USER_INVITE_ACCEPTED',
      'USER_INVITE_PENDING','ZERO_DAILY_SPENDING_LIMIT');
  $alertQuery->severities = array('GREEN', 'YELLOW', 'RED');
  $alertQuery->triggerTimeSpec = 'ALL_TIME';

  // Create selector.
  $selector = new AlertSelector();
  $selector->query = $alertQuery;
  $selector->paging = new Paging(0, 100);

  // Get alerts.
  $page = $alertService->get($selector);

  // Display alerts.
  if (isset($page->entries)) {
    foreach ($page->entries as $alert) {
      printf("Alert of type '%s' and severity '%s' for account '%d' was "
          . "found.\n", $alert->alertType, $alert->alertSeverity,
          $alert->clientCustomerId);
    }
  } else {
    print "No alerts were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
