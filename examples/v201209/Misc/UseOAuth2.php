<?php
/**
 * This example demonstrates how to authenticate using OAuth2.  This example
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

// Enter parameters required by the code example.
// To obtain a client ID and secret register your application at:
// https://code.google.com/apis/console#access. Go to the "API Access" tab and
// ensure you select the Application type "Installed application."
$clientId = 'INSERT_OAUTH2_CLIENT_ID_HERE';
$clientSecret = 'INSERT_OAUTH2_CLIENT_SECRET_HERE';

/**
 * Runs the example.
 * @param string $clientId the OAuth2 client ID
 * @param string $clientSecret the OAuth2 client secret
 */
function UseOAuth2Example($clientId, $clientSecret) {
  // Set the OAuth2 client ID and secret.
  $oauth2Info = array('client_id' => $clientId,
      'client_secret' => $clientSecret);

  // Create the AdWordsUser and set the OAuth2 info.
  $user = new AdWordsUser();
  $user->SetOAuth2Info($oauth2Info);
  $user->LogAll();

  // Get the authorization URL for the OAuth2 token.
  // No redirect URL is being used since this is an installed application. A web
  // application would pass in a redirect URL back to the application,
  // ensuring it's one that has been configured in the API console.
  // Passing true for the second parameter ($offline) will provide us a refresh
  // token which can used be refresh the access token when it expires.
  $authorizationUrl = $user->GetOAuth2AuthorizationUrl(NULL, TRUE);

  // In a web application you would redirect the user to the authorization URL
  // and after approving the token they would be redirected back to the
  // redirect URL, with the URL parameter "code" added. For desktop
  // or server applications, spawn a browser to the URL and then have the user
  // enter the authorization code that is displayed.
  printf("Log in to your AdWords account and open the following URL: %s\n",
      $authorizationUrl);
  print 'After approving the token enter the authorization code here: ';
  $stdin = fopen('php://stdin', 'r');
  $code = trim(fgets($stdin));
  fclose($stdin);

  // Get the access token using the authorization code. Ensure you use the same
  // redirect URL used when requesting authorization.
  $user->GetOAuth2AccessToken($code, NULL);

  // The access token expires but the refresh token obtained for offline use
  // doesn't, and should be stored for later use.
  $oauth2Info = $user->GetOAuth2Info();
  print "OAuth2 authorization successful.\n";
  print_r($oauth2Info);

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
  UseOAuth2Example($clientId, $clientSecret);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
