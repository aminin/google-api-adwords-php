<?php
/**
 * Unit tests for OAuth2Handler.
 *
 * PHP version 5
 *
 * Copyright 2012, Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the 'License');
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an 'AS IS' BASIS,
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

error_reporting(E_STRICT | E_ALL);

$path = dirname(__FILE__) . '/../../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'PHPUnit/Framework.php';
require_once 'Google/Api/Ads/Common/Util/OAuth2Handler.php';

/**
 * Unit tests for OAuth2Handler.
 *
 * @author eric.koleda@google.com
 */
class OAuth2HandlerTest extends PHPUnit_Framework_TestCase {
  private $oauth2Handler;

  public function setup() {
    $this->oauth2Handler = new TestOAuth2Handler();
  }

  public function testGetAuthorizationUrl() {
    $credentials = array('client_id' => 'TEST_CLIENT_ID');
    $scope = 'TEST_SCOPE';

    $url = $this->oauth2Handler->GetAuthorizationUrl($credentials, $scope);

    $urlParts = parse_url($url);
    $this->assertEquals('https', $urlParts['scheme']);
    $this->assertEquals('accounts.google.com', $urlParts['host']);
    $this->assertFalse(isset($urlParts['port']));
    $this->assertFalse(isset($urlParts['user']));
    $this->assertFalse(isset($urlParts['pass']));
    $this->assertEquals('/o/oauth2/auth', $urlParts['path']);
    $this->assertFalse(isset($urlParts['fragment']));

    $params = array();
    parse_str($urlParts['query'], $params);
    $this->assertEquals('code', $params['response_type']);
    $this->assertEquals('TEST_CLIENT_ID', $params['client_id']);
    $this->assertEquals('urn:ietf:wg:oauth:2.0:oob', $params['redirect_uri']);
    $this->assertEquals('TEST_SCOPE', $params['scope']);
    $this->assertEquals('online', $params['access_type']);
  }

  public function testGetAuthorizationUrl_AlternateServer() {
    $this->oauth2Handler = new TestOAuth2Handler('http://www.foo.com');
    $credentials = array('client_id' => 'TEST_CLIENT_ID');
    $scope = 'TEST_SCOPE';

    $url = $this->oauth2Handler->GetAuthorizationUrl($credentials, $scope);

    $urlParts = parse_url($url);
    $this->assertEquals('http', $urlParts['scheme']);
    $this->assertEquals('www.foo.com', $urlParts['host']);
  }

  /**
   * @expectedException OAuth2Exception
   */
  public function testGetAuthorizationUrl_MissingClientId() {
    $credentials = array();
    $scope = 'TEST_SCOPE';

    $url = $this->oauth2Handler->GetAuthorizationUrl($credentials, $scope);
  }

  public function testGetAuthorizationUrl_RedirectUri() {
    $credentials = array('client_id' => 'TEST_CLIENT_ID');
    $scope = 'TEST_SCOPE';
    $redirectUri = 'http://www.foo.com/callback';

    $url = $this->oauth2Handler->GetAuthorizationUrl($credentials, $scope,
        $redirectUri);

    $urlParts = parse_url($url);
    $params = array();
    parse_str($urlParts['query'], $params);
    $this->assertEquals($redirectUri, $params['redirect_uri']);
  }

  public function testGetAuthorizationUrl_Offline() {
    $credentials = array('client_id' => 'TEST_CLIENT_ID');
    $scope = 'TEST_SCOPE';

    $url = $this->oauth2Handler->GetAuthorizationUrl($credentials, $scope, NULL,
        TRUE);

    $urlParts = parse_url($url);
    $params = array();
    parse_str($urlParts['query'], $params);
    $this->assertEquals('offline', $params['access_type']);
  }

  public function testGetAuthorizationUrl_Params() {
    $credentials = array('client_id' => 'TEST_CLIENT_ID');
    $scope = 'TEST_SCOPE';
    $params = array('foo' => 'bar');

    $url = $this->oauth2Handler->GetAuthorizationUrl($credentials, $scope, NULL,
        NULL, $params);

    $urlParts = parse_url($url);
    $params = array();
    parse_str($urlParts['query'], $params);
    $this->assertEquals('bar', $params['foo']);
  }

  public function testIsAccessTokenValid() {
    $credentials = array(
        'access_token' => 'TEST_ACCESS_TOKEN',
        'expires_in' => '3600',
        'timestamp' => time()
    );
    $this->assertTrue($this->oauth2Handler->IsAccessTokenValid($credentials));
  }

  public function testIsAccessTokenValid_Expired() {
    $credentials = array(
        'access_token' => 'TEST_ACCESS_TOKEN',
        'expires_in' => '3600',
        'timestamp' => strtotime('-1 day')
    );
    $this->assertFalse($this->oauth2Handler->IsAccessTokenValid($credentials));
  }

  public function testIsAccessTokenValid_MissingAccessToken() {
    $credentials = array(
        'expires_in' => '3600',
        'timestamp' => time()
    );
    $this->assertFalse($this->oauth2Handler->IsAccessTokenValid($credentials));
  }

  public function testIsAccessTokenValid_MissingExpiresIn() {
    $credentials = array(
        'access_token' => 'TEST_ACCESS_TOKEN',
        'timestamp' => time()
    );
    $this->assertTrue($this->oauth2Handler->IsAccessTokenValid($credentials));
  }

  public function testIsAccessTokenValid_MissingTimestamp() {
    $credentials = array(
        'access_token' => 'TEST_ACCESS_TOKEN',
        'expires_in' => '3600'
    );
    $this->assertTrue($this->oauth2Handler->IsAccessTokenValid($credentials));
  }

  public function testCanRefreshAccessToken() {
    $credentials = array('refresh_token' => 'TEST_REFRESH_TOKEN');
    $this->assertTrue(
        $this->oauth2Handler->CanRefreshAccessToken($credentials));
  }

  public function testCanRefreshAccessToken_MissingRefreshToken() {
    $credentials = array();
    $this->assertFalse(
        $this->oauth2Handler->CanRefreshAccessToken($credentials));
  }

  public function testFormatCredentialsForUrl() {
    $credentials = array('access_token' => 'TEST_ACCESS_TOKEN');
    $value = $this->oauth2Handler->FormatCredentialsForUrl($credentials);
    $this->assertEquals('access_token=TEST_ACCESS_TOKEN', $value);
  }

  /**
   * @expectedException OAuth2Exception
   */
  public function testFormatCredentialsForUrl_MissingToken() {
    $credentials = array();
    $value = $this->oauth2Handler->FormatCredentialsForUrl($credentials);
  }

  public function testFormatCredentialsForHeader() {
    $credentials = array('access_token' => 'TEST_ACCESS_TOKEN');
    $value = $this->oauth2Handler->FormatCredentialsForHeader($credentials);
    $this->assertEquals('Bearer TEST_ACCESS_TOKEN', $value);
  }

  public function testFormatCredentialsForHeader_DifferentTokenType() {
    $credentials = array(
        'access_token' => 'TEST_ACCESS_TOKEN',
        'token_type' => 'TEST_TOKEN_TYPE'
    );
    $value = $this->oauth2Handler->FormatCredentialsForHeader($credentials);
    $this->assertEquals('TEST_TOKEN_TYPE TEST_ACCESS_TOKEN', $value);
  }

  /**
   * @expectedException OAuth2Exception
   */
  public function testFormatCredentialsForHeader_MissingToken() {
    $credentials = array();
    $value = $this->oauth2Handler->FormatCredentialsForHeader($credentials);
  }

}

class TestOAuth2Handler extends OAuth2Handler {
  public function __construct($server = NULL) {
    parent::__construct($server);
  }

  public function GetAccessToken(array $credentials, $code,
      $redirectUri = NULL) {
    throw Exception('Not implemented.');
  }

  public function RefreshAccessToken(array $credentials) {
    throw Exception('Not implemented.');
  }
}
