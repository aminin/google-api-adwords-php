<?php
/**
 * This example demonstrates how to detect and handle 2-step authorization
 * errors.
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
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  $user->SetEmail('2steptester@gmail.com');
  $user->SetPassword('testaccount');

  try {
    $authToken = $user->GetAuthToken();
    printf("Successfully retrieved auth token for the account '%s': '%s'\n",
        $user->GetEmail(), $authToken);
  } catch (AuthTokenException $e) {
    if (strpos($e->GetError(), 'InvalidSecondFactor') !== FALSE) {
      // See http://goo.gl/SHgXV for more details.
      print "The account has 2-step verification enabled, so an "
          . "application-specific password must be used instead.\n";
    } else {
      print "Invalid email or password.\n";
    }
  }
} catch (Exception $e) {
  print $e->getMessage();
}
