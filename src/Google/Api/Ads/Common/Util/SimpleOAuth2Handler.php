<?php
/**
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
 * @author     Vincent Tsao <api.vtsao@gmail.com>
 */
require_once 'OAuth2Handler.php';
require_once 'CurlUtils.php';

/**
 * A simple OAuth 2.0 handler.
 * @link http://oauth.googlecode.com/svn/code/php/OAuth.php
 */
class SimpleOAuth2Handler extends OAuth2Handler {

  private $curlUtils;

  /**
   * Creates a new instance of this OAuth handler.
   * @param string $server the auth server to make OAuth2 request against
   * @param CurlUtils $curlUtils an instance of CurlUtils
   */
  public function __construct($server = NULL, $curlUtils = NULL) {
    parent::__construct($server);
    $this->curlUtils = is_null($curlUtils) ? new CurlUtils() : $curlUtils;
  }

  /**
   * @see OAuth2Hanlder::GetAccessToken()
   */
  public function GetAccessToken(array $credentials, $code,
      $redirectUri = NULL) {
    if (empty($credentials['client_id'])) {
      throw new OAuth2Exception('client_id required.');
    }
    if (empty($credentials['client_secret'])) {
      throw new OAuth2Exception('client_secret required.');
    }
    if (empty($redirectUri)) {
      $redirectUri = self::$DEFAULT_REDIRECT_URI;
    }
    $params = array(
        'code' => $code,
        'client_id' => $credentials['client_id'],
        'client_secret' => $credentials['client_secret'],
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code'
    );
    $endpoint = $this->GetAccessEndpoint();
    $response = $this->MakeRequest($endpoint, $params);
    return array_merge($credentials, $response, array('timestamp' => time()));
  }

  /**
   * @see OAuth2Hanlder::RefreshAccessToken()
   */
  public function RefreshAccessToken(array $credentials) {
    if (empty($credentials['refresh_token'])) {
      throw new OAuth2Exception('Offline access (refresh_token) required.');
    }
    if (empty($credentials['client_id'])) {
      throw new OAuth2Exception('client_id required.');
    }
    if (empty($credentials['client_secret'])) {
      throw new OAuth2Exception('client_secret required.');
    }
    $params = array(
        'refresh_token' => $credentials['refresh_token'],
        'client_id' => $credentials['client_id'],
        'client_secret' => $credentials['client_secret'],
        'grant_type' => 'refresh_token'
    );
    $endpoint = $this->GetAccessEndpoint();
    $response = $this->MakeRequest($endpoint, $params);
    return array_merge($credentials, $response, array('timestamp' => time()));
  }

  /**
   * Makes an HTTP request to the given URL and extracts the returned OAuth2
   * response.
   * @param string $url the URL to make the request to
   * @param array $params the parameters to include in the POST body
   * @return OAuthToken the returned token
   */
  protected function MakeRequest($url, $params) {
    $ch = $this->curlUtils->CreateSession($url);
    $this->curlUtils->SetOpt($ch, CURLOPT_POSTFIELDS, $params);
    $response = $this->curlUtils->Exec($ch);
    $error = $this->curlUtils->Error($ch);
    $httpCode = $this->curlUtils->GetInfo($ch, CURLINFO_HTTP_CODE);
    $this->curlUtils->Close($ch);

    if (!empty($error)) {
      throw new OAuth2Exception($error, $httpCode);
    }
    if ($httpCode != 200) {
      throw new OAuth2Exception($response, $httpCode);
    }
    return json_decode($response, TRUE);
  }
}
