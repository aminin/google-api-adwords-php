<?php
/**
 * This example demonstrates how to authenticate using OAuth.  This example
 * is meant to be run from the command line and requires user input.
 *
 * Copyright 2012, Google Inc. All Rights Reserved.
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
 * @subpackage Other
 * @category   WebServices
 * @copyright  2012, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <eric.koleda@google.com>
 */

// Include the initialization file
require_once dirname(dirname(__FILE__)) . '/init.php';

/**
 * Runs the example.
 */
function UseOAuthExample() {
  // Set the OAuth consumer key and secret. Anonymous values can be used for
  // testing, and real values can be obtained by registering your application:
  // http://code.google.com/apis/accounts/docs/RegistrationForWebAppsAuto.html
  $oauthInfo = array('oauth_consumer_key' => 'anonymous',
      'oauth_consumer_secret' => 'anonymous');

  // Create the AdWordsUser and set the OAuth info.
  $user = new AdWordsUser();
  $user->SetOAuthInfo($oauthInfo);
  $user->LogAll();

  // Request a new OAuth token. Web applications should pass in a callback URL
  // to redirect the user to after authorizing the token.
  $user->RequestOAuthToken();

  // Get the authorization URL for the OAuth token.
  $authorizationUrl = $user->GetOAuthAuthorizationUrl();

  // In a web application you would redirect the user to the authorization URL
  // and after approving the token they would be redirected back to the
  // callback URL, with the URL parameter "oauth_verifier" added. For desktop
  // or server applications, spawn a browser to the URL and then have the user
  // enter the verification code that is displayed.
  printf("Log in to your AdWords account and open the following URL: %s\n",
      $authorizationUrl);
  print 'After approving the token enter the verification code here: ';
  $stdin = fopen('php://stdin', 'r');
  $verifier = trim(fgets($stdin));
  fclose($stdin);

  // Upgrade the authorized token.
  $user->UpgradeOAuthToken($verifier);

  // An upgraded token does not expire and should be stored and reused for
  // every request to the API.
  $oauthInfo = $user->GetOAuthInfo();
  print "OAuth authorization successful.\n";
  print_r($oauthInfo);

  // Get the number of campaigns in the account.
  $campaignService = $user->GetService('CampaignService', ADWORDS_VERSION);
  $selector = new Selector();
  $selector->fields = array('Id');
  $selector->paging = new Paging(0, 0);
  $page = $campaignService->get($selector);

  // Display number of campaigns.
  printf("Found %d campaigns.\n", $page->totalNumEntries);
}

// Don't run the example if the file is being included.
if (__FILE__ != realpath($_SERVER['PHP_SELF'])) {
  return;
}

try {
  // Run the example.
  UseOAuthExample();
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
