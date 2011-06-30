<?php
/**
 * An abstract class for Google OAuth flow.
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
 */

/**
 * An abstract class for Google OAuth flow.
 * @package GoogleApiAdsCommon
 * @subpackage Util
 */
abstract class OAuthHandler {
  public static $DEFAULT_CALLBACK_URL = 'oob';

  private static $REQUEST_ENDPOINT =
      'https://www.google.com/accounts/OAuthGetRequestToken';
  private static $AUTHORIZE_ENDPOINT =
      'https://www.google.com/accounts/OAuthAuthorizeToken';
  private static $ACCESS_ENDPOINT =
      'https://www.google.com/accounts/OAuthGetAccessToken';

  /**
   * Gets a request token.
   * @param array $credentials the credentials, including the consumer key and
   *     consumer secret
   * @param string $scope the scope of the application to authorize
   * @param string $server optional OAuth server to make the request against
   * @param string $callbackUrl optional callback URL
   * @param string $applicationName optional name of the application to display
   *     on the authorization redirect page
   * @return array the credentials, including the consumer key, consumer secret,
   *     token, and token secret
   * @see http://code.google.com/apis/accounts/docs/OAuth_ref.html#RequestToken
   */
  public abstract function GetRequestToken($credentials, $scope, $server = NULL,
      $callbackUrl = NULL, $applicationName = NULL);

  /**
   * Gets the authorization URL for a request token.
   * @param array $credentials the credentials, including the token
   * @param string $server optional OAuth server to generate the URL for
   * @return string an authorization URL to redirect the user to
   * @see http://code.google.com/apis/accounts/docs/OAuth_ref.html#GetAuth
   */
  public function GetAuthorizationUrl($credentials, $server = NULL) {
    $endpoint = $this->GetAuthorizeEndpoint($server, NULL);

    $params = array('oauth_token' => $credentials['oauth_token']);
    return $this->AddParamsToUrl($endpoint, $params);
  }

  /**
   * Gets the access token for an authorized request token.
   * @param array $credentials the credentials, including the consumer key,
   *     consumer secret, token, and token secret
   * @param string $verifier the OAuth verifier code returned with the callback
   * @param string $server optional OAuth server to make the request against
   * @return array the credentials, including the consumer key, consumer secret,
   *     token, and token secret
   * @see http://code.google.com/apis/accounts/docs/OAuth_ref.html#AccessToken
   */
  public abstract function GetAccessToken($credentials, $verifier,
      $server = NULL);

  /**
   * Gets the signed OAuth parameters needed to make a request against the
   * given URL.
   * @param array $credentials the credentials, including the consumer key,
   *     consumer secret, token, and token secret
   * @param string $url the URL the request will be made against
   * @return array an array of OAuth parameter names to values
   */
  public abstract function GetSignedRequestParameters($credentials, $url);

  /**
   * Formats OAuth parameters for use in a URL.
   * For example: param1=value1&param2=value2.
   * @param array $params the OAuth parameters
   * @return string the parameters formatted for use in a URL
   */
  public function FormatParametersForUrl($params) {
    return http_build_query($params, NULL, '&');
  }

  /**
   * Formats OAuth parameters for use in an HTTP header.
   * For example: param1="value1", param2="value2"
   * @param array $params the OAuth parameters
   * @return string the parameters formatted for use in an HTTP header
   */
  public function FormatParametersForHeader($params) {
    $parts = array();
    foreach($params as $key => $value) {
      $parts[] = sprintf('%s="%s"', $key, urlencode($value));
    }
    return implode(', ', $parts);
  }

  /**
   * Gets the request endpoint using the given server and parameters.
   * @param string $server the service to get the endpoint for
   * @param array $params the parameters to include in the endpoint
   * @return string the request endpoint
   */
  protected function GetRequestEndpoint($server = NULL, $params = NULL) {
    return $this->GetEndpoint(self::$REQUEST_ENDPOINT, $server, $params);
  }

  /**
   * Gets the authorization endpoint using the given server and parameters.
   * @param string $server the service to get the endpoint for
   * @param array $params the parameters to include in the endpoint
   * @return string the authorization endpoint
   */
  protected function GetAuthorizeEndpoint($server = NULL, $params = NULL) {
    return $this->GetEndpoint(self::$AUTHORIZE_ENDPOINT, $server, $params);
  }

  /**
   * Gets the access endpoint using the given server and parameters.
   * @param string $server the service to get the endpoint for
   * @param array $params the parameters to include in the endpoint
   * @return string the access endpoint
   */
  protected function GetAccessEndpoint($server = NULL, $params = NULL) {
    return $this->GetEndpoint(self::$ACCESS_ENDPOINT, $server, $params);
  }

  /**
   * Gets an endpoint using the given server and parameters.
   * @param string $endpoint the base endpoint URL to use
   * @param string $server the service to get the endpoint for
   * @param array $params the parameters to include in the endpoint
   * @return string the endpoint
   */
  private function GetEndpoint($endpoint, $server = NULL, $params = NULL) {
    $endpoint = $this->AddParamsToUrl($endpoint, $params);
    if (!empty($server)) {
      $endpoint = $this->ReplaceServerInUrl($endpoint, $server);
    }
    return $endpoint;
  }

  /**
   * Replaces the protocol and server portion of a URL with another.
   * @param string $url the full URL
   * @param string $server the protocol and server to replace with
   * @return string the URL with the protocol and server replaced
   */
  protected function ReplaceServerInUrl($url, $server) {
    $urlParts = parse_url($url);
    $url = $server . $urlParts['path'];
    if (!empty($urlParts['query'])) {
      $url = $url . '?' . $urlParts['query'];
    }
    return $url;
  }

  /**
   * Adds parameters to a URL.
   * @param string $url the URL
   * @param array $params the parameters to add
   * @return string the new URL with the parameters added
   */
  protected function AddParamsToUrl($url, $params) {
    if (!isset($params) || sizeof($params) == 0) {
      return $url;
    } else {
      $paramString = http_build_query($params, NULL, '&');
      $query = parse_url($url, PHP_URL_QUERY);
      $separator = empty($query) ? '?' : '&';
      return $url . $separator . $paramString;
    }
  }
}
