<?php
/**
 * A utility class for working with OAuth.
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

/**
 * A utility class for working with OAuth.
 */
class OAuthUtils {
  private static $REQUEST_ENDPOINT_FORMAT =
      '%s/accounts/OAuthGetRequestToken?%s';
  private static $AUTHORIZE_ENDPOINT_FORMAT =
      '%s/accounts/OAuthAuthorizeToken?%s';
  private static $ACCESS_ENDPOINT_FORMAT =
      '%s/accounts/OAuthGetAccessToken';

  /**
   * The OAuthUtils class is not meant to have any instances.
   * @access private
   */
  private function __construct() {}

  /**
   * Gets a request token.
   * @param array $oauthInfo the OAuth info, including the consumer key and
   *     consumer secret
   * @param string $scope the scope of the application to authorize
   * @param string $server the OAuth server to make the request against
   * @param string $callbackUrl optional callback URL
   * @param string $applicationName optional name of the application to display
   *     on the authorization redirect page
   * @return array the OAuth info, including the consumer key, consumer secret,
   *     token, and token secret
   * @see http://code.google.com/apis/accounts/docs/OAuth_ref.html#RequestToken
   */
  public static function GetRequestToken($oauthInfo, $scope, $server,
      $callbackUrl = NULL, $applicationName = NULL) {
    $oauth = new OAuth($oauthInfo['oauth_consumer_key'],
        $oauthInfo['oauth_consumer_secret']);

    $params = array();
    $params['scope'] = $scope;
    if (isset($applicationName)) {
      $params['xoauth_displayname'] = $applicationName;
    }
    $paramString = http_build_query($params, NULL, '&');
    $endpointUrl =
        sprintf(self::$REQUEST_ENDPOINT_FORMAT, $server, $paramString);

    $oauthTokenInfo = $oauth->getRequestToken($endpointUrl, $callbackUrl);
    $oauthInfo['oauth_token'] = $oauthTokenInfo['oauth_token'];
    $oauthInfo['oauth_token_secret'] = $oauthTokenInfo['oauth_token_secret'];
    return $oauthInfo;
  }

  /**
   * Gets the authorization URL for a request token.
   * @param array $oauthInfo the OAuth info, including the token
   * @param string $server the OAuth server to generate the URL for
   * @return string an authorization URL to redirect the user to
   * @see http://code.google.com/apis/accounts/docs/OAuth_ref.html#GetAuth
   */
  public static function GetAuthorizationUrl($oauthInfo, $server) {
    $params = array();
    $params['oauth_token'] = $oauthInfo['oauth_token'];
    $paramString = http_build_query($params, NULL, '&');

    $endpointUrl =
        sprintf(self::$AUTHORIZE_ENDPOINT_FORMAT, $server, $paramString);
    return $endpointUrl;
  }

  /**
   * Gets the access token for an authorized request token.
   * @param array $oauthInfo the OAuth info, including the consumer key,
   *     consumer secret, token, and token secret
   * @param string $verifier the OAuth verifier code returned with the callback
   * @param string $server the OAuth server to make the request against
   * @return array the OAuth info, including the consumer key, consumer secret,
   *     token, and token secret
   * @see http://code.google.com/apis/accounts/docs/OAuth_ref.html#AccessToken
   */
  public static function GetAccessToken($oauthInfo, $verifier, $server) {
    $oauth = new OAuth($oauthInfo['oauth_consumer_key'],
        $oauthInfo['oauth_consumer_secret']);
    $oauth->setToken($oauthInfo['oauth_token'],
        $oauthInfo['oauth_token_secret']);

    $endpointUrl = sprintf(self::$ACCESS_ENDPOINT_FORMAT, $server);

    $oauthTokenInfo = $oauth->getAccessToken($endpointUrl, NULL, $verifier);
    $oauthInfo['oauth_token'] = $oauthTokenInfo['oauth_token'];
    $oauthInfo['oauth_token_secret'] = $oauthTokenInfo['oauth_token_secret'];
    return $oauthInfo;
  }

  /**
   * Gets the signed OAuth parameters needed to make a request against the
   * given URL.
   * @param array $oauthInfo the OAuth info, including the consumer key,
   *     consumer secret, token, and token secret
   * @param string $url the URL the request will be made against
   * @return array an array of OAuth parameter names to values
   */
  public static function GetSignedRequestParameters($oauthInfo, $url) {
    // Set parameters
    $params = array();
    $params['oauth_consumer_key'] = $oauthInfo['oauth_consumer_key'];
    $params['oauth_token'] = $oauthInfo['oauth_token'];
    $params['oauth_signature_method'] = 'HMAC-SHA1';
    $params['oauth_timestamp'] = time();
    $params['oauth_nonce'] = uniqid();
    $params['oauth_version'] = '1.0';

    // Create OAuth client.
    $oauth = new OAuth($oauthInfo['oauth_consumer_key'],
        $oauthInfo['oauth_consumer_secret']);
    $oauth->setToken($oauthInfo['oauth_token'],
        $oauthInfo['oauth_token_secret']);
    $oauth->setTimestamp($params['oauth_timestamp']);
    $oauth->setNonce($params['oauth_nonce']);
    $oauth->setVersion($params['oauth_version']);

    // Generate signature.
    $signature = $oauth->generateSignature(OAUTH_HTTP_METHOD_POST, $url);
    $params['oauth_signature'] = $signature;

    // Return oauth parameters.
    return $params;
  }

  /**
   * Formats OAuth parameters for use in a URL.
   * For example: param1=value1&param2=value2.
   * @param array $oauthParameters the OAuth parameters
   * @return string the parameters formatted for use in a URL
   */
  public static function FormatParametersForUrl($oauthParameters) {
    return http_build_query($oauthParameters, NULL, '&');
  }

  /**
   * Formats OAuth parameters for use in an HTTP header.
   * For example: param1="value1", param2="value2"
   * @param array $oauthParameters the OAuth parameters
   * @return string the parameters formatted for use in an HTTP header
   */
  public static function FormatParametersForHeader($oauthParameters) {
    $parts = array();
    foreach($oauthParameters as $key => $value) {
      $parts[] = sprintf('%s="%s"', $key, urlencode($value));
    }
    return implode(', ', $parts);
  }
}
