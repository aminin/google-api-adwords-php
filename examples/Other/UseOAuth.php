<?php
/**
 * This example demonstrates how to authenticate using OAuth.  This example
 * is meant to be run from the command line and requires user input.
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
 * @subpackage Other
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
  // Set the OAuth consumer key and secret. Anonymous values can be used for
  // testing, and real values can be obtained by registering your application:
  // http://code.google.com/apis/accounts/docs/RegistrationForWebAppsAuto.html
  $oauthInfo = array('oauth_consumer_key' => 'anonymous',
      'oauth_consumer_secret' => 'anonymous');

  // Create the AdWordsUser and set the OAuth info.
  $user = new AdWordsUser();
  $user->LogDefaults();
  $user->SetOAuthInfo($oauthInfo);

  // Request a new OAuth token. For a web application, pass in the optional
  // callbackUrl parameter to have the user automatically redirected back
  // to your application after authorizing the token.
  $user->RequestOAuthToken();

  // Get the authorization URL for the OAuth token.
  $authorizationUrl = $user->GetOAuthAuthorizationUrl();

  // In a web application you would redirect the user to the authorization URL
  // and after approving the token they would be redirected back to the
  // callbackUrl. For desktop application spawn a browser to the URL and
  // then have the user enter the generated verification code.
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

  // Get all campaigns.
  $campaignService = $user->GetCampaignService();
  $selector = new CampaignSelector();
  $page = $campaignService->get($selector);

  // Display number of campaigns.
  printf("Found %d campaigns.\n", $page->totalNumEntries);
} catch (Exception $e) {
  print $e->getMessage();
}
