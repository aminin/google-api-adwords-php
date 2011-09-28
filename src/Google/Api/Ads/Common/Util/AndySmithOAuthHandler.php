<?php
/**
 * An OAuth handler that uses the a popular OAuth implementation written by
 * Andy Smith.
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
 * @link       http://oauth.googlecode.com/svn/code/php/OAuth.php
 */

/** Required classes. **/
require_once 'OAuthHandler.php';
require_once 'CurlUtils.php';

/**
 * An OAuth hanlder that uses the a popular OAuth implementation written by
 * Andy Smith.
 * @package GoogleApiAdsCommon
 * @subpackage Util
 */
class AndySmithOAuthHandler extends OAuthHandler {
  /**
   * Constructor.
   */
  public function __construct() {}

  private function DoRequireOnce() {
    // Require the file at runtime because it conflicts with the OAuth PECL.
    require_once dirname(__FILE__)
        . '/../../../../../third_party/oauth/OAuth.php';
  }

  /**
   * @see OAuthHanlder::GetRequestToken()
   */
  public function GetRequestToken($credentials, $scope, $server = NULL,
      $callbackUrl = NULL, $applicationName = NULL) {
    $this->DoRequireOnce();
    $consumer = new OAuthConsumer($credentials['oauth_consumer_key'],
        $credentials['oauth_consumer_secret']);
    $signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();

    $params = array('oauth_version' => '1.0a', 'scope' => $scope);
    if (isset($applicationName)) {
      $params['xoauth_displayname'] = $applicationName;
    }
    if (isset($callbackUrl)) {
      $params['oauth_callback'] = $callbackUrl;
    } else {
      $params['oauth_callback'] = parent::$DEFAULT_CALLBACK_URL;
    }
    $endpoint = $this->GetRequestEndpoint($server);

    $request = OAuthRequest::from_consumer_and_token($consumer, NULL, 'GET',
        $endpoint, $params);
    $request->sign_request($signatureMethod, $consumer, NULL);

    $token = $this->GetTokenFromUrl($request->to_url());
    $credentials['oauth_token'] = $token->key;
    $credentials['oauth_token_secret'] = $token->secret;
    return $credentials;
  }

  /**
   * @see OAuthHanlder::GetAccessToken()
   */
  public function GetAccessToken($credentials, $verifier, $server = NULL) {
    $this->DoRequireOnce();
    $consumer = new OAuthConsumer($credentials['oauth_consumer_key'],
        $credentials['oauth_consumer_secret']);
    $token = new OAuthToken($credentials['oauth_token'],
        $credentials['oauth_token_secret']);
    $signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();

    $params = array('oauth_version' => '1.0a', 'oauth_verifier' => $verifier);
    $endpoint = $this->GetAccessEndpoint($server);

    $request = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET',
        $endpoint, $params);
    $request->sign_request($signatureMethod, $consumer, $token);

    $token = $this->GetTokenFromUrl($request->to_url());
    $credentials['oauth_token'] = $token->key;
    $credentials['oauth_token_secret'] = $token->secret;
    return $credentials;
  }

  /**
   * @see OAuthHanlder::GetSignedRequestParameters()
   */
  public function GetSignedRequestParameters($credentials, $url) {
    $this->DoRequireOnce();
    $consumer = new OAuthConsumer($credentials['oauth_consumer_key'],
        $credentials['oauth_consumer_secret']);
    $token = new OAuthToken($credentials['oauth_token'],
        $credentials['oauth_token_secret']);
    $signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();

    $params = array('oauth_version' => '1.0a');
    $request = OAuthRequest::from_consumer_and_token($consumer, $token, 'POST',
        $url, $params);
    $request->sign_request($signatureMethod, $consumer, $token);
    return $request->get_parameters();
  }

  /**
   * Makes an HTTP request to the given URL and extracts the returned OAuth
   * token.
   * @param string $url the URL to make the request to
   * @return OAuthToken the returned token
   */
  private function GetTokenFromUrl($url) {
    $ch = CurlUtils::CreateSession($url);
    $response = curl_exec($ch);
    $headers = curl_getinfo($ch);
    curl_close($ch);

    if ($headers['http_code'] != 200) {
      throw new Exception($response);
    }

    return self::GetTokenFromQueryString($response);
  }

  /**
   * Parses a query string and extracts the OAuth token.
   * @param string $queryString the query string
   * @return OAuthToken the token contained within the query string
   */
  private function GetTokenFromQueryString($queryString) {
    $values = array();
    parse_str($queryString, $values);
    return new OAuthToken($values['oauth_token'],
        $values['oauth_token_secret']);
  }
}
