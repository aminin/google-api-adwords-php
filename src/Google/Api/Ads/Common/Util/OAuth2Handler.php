<?php
/**
 * An abstract class for Google OAuth 2.0 flow.
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
 * @copyright  2012, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <eric.koleda@google.com>
 */

/** Required classes. **/
require_once 'UrlUtils.php';

/**
 * An abstract class for Google OAuth2 flow.
 * @package GoogleApiAdsCommon
 * @subpackage Util
 */
abstract class OAuth2Handler {
  public static $DEFAULT_REDIRECT_URI = 'urn:ietf:wg:oauth:2.0:oob';

  private static $AUTHORIZE_ENDPOINT =
      'https://accounts.google.com/o/oauth2/auth';
  private static $ACCESS_ENDPOINT =
      'https://accounts.google.com/o/oauth2/token';

  private $server;

  /**
   * Constructor.
   * @param string $server the auth server to make OAuth2 request against
   */
  public function __construct($server = NULL) {
    $this->server = $server;
  }

  /**
   * Gets the authorization URL to redirect to.
   * @param array $credentials the credentials, including client_id
   * @param string $scope the scope of the application to authorize
   * @param string $redirectUri optional callback URL
   * @param boolean $offline whether or not to request offline access (aka a
   *     refresh token), false by default
   * @param array $params optional array of additional parameters to include
   *     in the URL
   * @return string an authorization URL to redirect the user to
   * @see https://developers.google.com/accounts/docs/OAuth2WebServer#formingtheurl
   */
  public function GetAuthorizationUrl(array $credentials, $scope,
      $redirectUri = NULL, $offline = NULL, array $params = NULL) {
    if (empty($credentials['client_id'])) {
      throw new OAuth2Exception('client_id required.');
    }
    if (!isset($offline)) {
      $offline = FALSE;
    }
    if (!isset($params)) {
      $params = array();
    }
    if (empty($redirectUri)) {
      $redirectUri = self::$DEFAULT_REDIRECT_URI;
    }
    $params = array_merge($params, array(
        'response_type' => 'code',
        'client_id' => $credentials['client_id'],
        'redirect_uri' => $redirectUri,
        'scope' => $scope,
        'access_type' => $offline ? 'offline' : 'online'
    ));
    return $this->GetAuthorizeEndpoint($params);
  }

  /**
   * Gets the access token for an authorized request token.
   * @param array $credentials the credentials, including client_id and
   *     client_secret
   * @param string $code the authorization code returned in the response
   * @param string $redirectUri optional callback URL
   * @return array the credentials passed in plus access_token, expires_in,
   *     timestamp and optionally refresh_token if offline mode was requested
   * @see https://developers.google.com/accounts/docs/OAuth2WebServer#handlingtheresponse
   */
  public abstract function GetAccessToken(array $credentials, $code,
      $redirectUri = NULL);

  /**
   * Determines if the access token is still valid. If expiry information isn't
   * available then this function will assume it is.
   * @param array $credentials the credentials, including access_token,
   *     timestamp and expires_in
   * @return boolean true if the access token is valid or if expiring
   *     information isn't available
   */
  public function IsAccessTokenValid(array $credentials) {
    if (empty($credentials['access_token'])) {
      return FALSE;
    }
    if (empty($credentials['timestamp']) ||
        empty($credentials['expires_in'])) {
      return TRUE;
    }
    $expires = intval($credentials['timestamp']) +
        intval($credentials['expires_in']);
    return $expires > time();
  }

  /**
   * Determines if the access token can be refreshed.
   * @param array $credentials the credentials
   * @return boolean true if the credentials can be refreshed
   */
  public function CanRefreshAccessToken(array $credentials) {
    return !empty($credentials['refresh_token']);
  }

  /**
   * Refreshes the access token.
   * @param array $credentials the credentials, including the client_id,
   *     client_secret, refresh_token
   * @return array the credentials
   * @see https://developers.google.com/accounts/docs/OAuth2WebServer#offline
   */
  public abstract function RefreshAccessToken(array $credentials);

  /**
   * Formats OAuth2 credentials for use in a URL.
   * For example: access_token=token.
   * @param array $credentials the OAuth2 credentials
   * @return string the credentials formatted for use in a URL
   */
  public function FormatCredentialsForUrl($credentials) {
    if (empty($credentials['access_token'])) {
      throw new OAuth2Exception('access_token required.');
    }
    $params = array('access_token' => $credentials['access_token']);
    return http_build_query($params, NULL, '&');
  }

  /**
   * Formats OAuth2 credentials for use in an HTTP header.
   * For example: Bearer token
   * @param array $credentials the OAuth2 credentials
   * @return string the credentials formatted for use in an HTTP header
   */
  public function FormatCredentialsForHeader($credentials) {
    if (empty($credentials['access_token'])) {
      throw new OAuth2Exception('access_token required.');
    }
    $tokenType = !empty($credentials['token_type']) ?
        $credentials['token_type'] : 'Bearer';
    return sprintf('%s %s', $tokenType,
        urlencode($credentials['access_token']));
  }

  /**
   * Gets the authorization endpoint using the given server and parameters.
   * @param array $params the parameters to include in the endpoint
   * @return string the authorization endpoint
   */
  protected function GetAuthorizeEndpoint($params = NULL) {
    return $this->GetEndpoint(self::$AUTHORIZE_ENDPOINT, $params);
  }

  /**
   * Gets the access endpoint using the given server and parameters.
   * @param array $params the parameters to include in the endpoint
   * @return string the access endpoint
   */
  protected function GetAccessEndpoint($params = NULL) {
    return $this->GetEndpoint(self::$ACCESS_ENDPOINT, $params);
  }

  /**
   * Gets an endpoint using the given server and parameters.
   * @param string $endpoint the base endpoint URL to use
   * @param array $params the parameters to include in the endpoint
   * @return string the endpoint
   */
  private function GetEndpoint($endpoint, $params = NULL) {
    $endpoint = UrlUtils::AddParamsToUrl($endpoint, $params);
    if (!empty($this->server)) {
      $endpoint = UrlUtils::ReplaceServerInUrl($endpoint, $this->server);
    }
    return $endpoint;
  }
}

/**
 * Exception thrown when OAuth2 flow fails.
 */
class OAuth2Exception extends Exception {
  public function __construct($message, $code = NULL) {
    parent::__construct($message, $code);
  }
}
