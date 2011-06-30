<?php
/**
 * An OAuth handler that uses the OAuth PECL extension.
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
 * @package    GoogleApiAdsCommon
 * @subpackage Util
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @link       http://www.php.net/manual/en/book.oauth.php
 */

/** Required classes. **/
require_once 'OAuthHandler.php';

/**
 * An OAuth handler that uses the OAuth PECL extension.
 * @package GoogleApiAdsCommon
 * @subpackage Util
 */
class PeclOAuthHandler extends OAuthHandler {
  /**
   * Constructor.
   */
  public function __construct() {}

  /**
   * @see OAuthHanlder::GetRequestToken()
   */
  public function GetRequestToken($credentials, $scope, $server = NULL,
      $callbackUrl = NULL, $applicationName = NULL) {
    $oauth = new OAuth($credentials['oauth_consumer_key'],
        $credentials['oauth_consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1,
        // Must use URI auth type due to bug in version 1.1.0.
        OAUTH_AUTH_TYPE_URI);
    $oauth->setRequestEngine(OAUTH_REQENGINE_CURL);
    $oauth->setVersion('1.0a');

    $params = array('scope' => $scope);
    if (!isset($callbackUrl)) {
      $callbackUrl = parent::$DEFAULT_CALLBACK_URL;
    }
    if (isset($applicationName)) {
      $params['xoauth_displayname'] = $applicationName;
    }
    $endpoint = $this->GetRequestEndpoint($server, $params);

    $response = $oauth->getRequestToken($endpoint, $callbackUrl);
    $credentials['oauth_token'] = $response['oauth_token'];
    $credentials['oauth_token_secret'] = $response['oauth_token_secret'];
    return $credentials;
  }

  /**
   * @see OAuthHanlder::GetAccessToken()
   */
  public function GetAccessToken($credentials, $verifier, $server = NULL) {
    $oauth = new OAuth($credentials['oauth_consumer_key'],
        $credentials['oauth_consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1,
        // Must use URI auth type due to bug in version 1.1.0.
        OAUTH_AUTH_TYPE_URI);
    $oauth->setRequestEngine(OAUTH_REQENGINE_CURL);
    $oauth->setVersion('1.0a');
    $oauth->setToken($credentials['oauth_token'],
        $credentials['oauth_token_secret']);

    $endpoint = $this->GetAccessEndpoint($server);

    $response = $oauth->getAccessToken($endpoint, NULL, $verifier);
    $credentials['oauth_token'] = $response['oauth_token'];
    $credentials['oauth_token_secret'] = $response['oauth_token_secret'];
    return $credentials;
  }

  /**
   * @see OAuthHanlder::GetSignedRequestParameters()
   */
  public function GetSignedRequestParameters($credentials, $url) {
    $params = array();
    $params['oauth_consumer_key'] = $credentials['oauth_consumer_key'];
    $params['oauth_token'] = $credentials['oauth_token'];
    $params['oauth_signature_method'] = 'HMAC-SHA1';
    $params['oauth_timestamp'] = time();
    $params['oauth_nonce'] = uniqid();
    $params['oauth_version'] = '1.0a';

    // This
    $oauth = new OAuth($credentials['oauth_consumer_key'],
        $credentials['oauth_consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1,
        // Must *NOT* use URI auth type due to bug in version 1.1.0.
        OAUTH_AUTH_TYPE_AUTHORIZATION);
    $oauth->setRequestEngine(OAUTH_REQENGINE_CURL);
    $oauth->setVersion('1.0a');
    $oauth->setToken($credentials['oauth_token'],
        $credentials['oauth_token_secret']);
    $oauth->setTimestamp($params['oauth_timestamp']);
    $oauth->setNonce($params['oauth_nonce']);
    $oauth->setVersion($params['oauth_version']);

    $signature = $oauth->generateSignature(OAUTH_HTTP_METHOD_POST, $url);
    $params['oauth_signature'] = $signature;

    return $params;
  }
}
