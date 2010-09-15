<?php
/**
 * Unit tests for AuthToken.
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/Common/Util/AuthToken.php';

/**
 * Unit tests for AuthToken.
 *
 * @author api.ekoleda@gmail.com
 */
class AuthTokenTest extends PHPUnit_Framework_TestCase {
  private static $SERVICE = 'adwords';
  private static $SOURCE = 'Ads PHP Client Library Unit Tests';

  private $email = NULL;
  private $password = NULL;
  private $server = NULL;

  /**
   * Sets up the test.
   */
  public function setup() {
    $authIniPath =
        dirname(__FILE__) . '/../../../../../../test_data/test_auth.ini';
    $settingsIniPath =
        dirname(__FILE__) . '/../../../../../../test_data/test_settings.ini';
    $authIni = parse_ini_file($authIniPath, true);
    $settingsIni = parse_ini_file($settingsIniPath, true);
    $this->assertNotNull($authIni, 'The file test_auth.ini was not found.');
    $this->assertNotNull($settingsIni,
        'The file test_settings.ini was not found.');
    $this->assertTrue(isset($authIni['email']),
        'The email field was not found in test_auth.ini.');
    $this->assertTrue(isset($authIni['password']),
        'The password field was not found in test_auth.ini.');
    $this->email = $authIni['email'];
    $this->password = $authIni['password'];
    if (array_key_exists('AUTH', $settingsIni) &&
        array_key_exists('AUTH_SERVER', $settingsIni['AUTH'])) {
      $this->server = $settingsIni['AUTH']['AUTH_SERVER'];
    }
  }

  /**
   * Tests getting an authToken.
   * @dataProvider ServiceProvider
   * @covers AuthToken::GetAuthToken
   */
  public function testGetAuthToken($service) {
    $authToken = new AuthToken($this->email, $this->password, $service,
        AuthTokenTest::$SOURCE, NULL, $this->server);
    $result = $authToken->GetAuthToken();
    $this->assertNotNull($authToken->GetAuthToken());
  }

  /**
   * Provides services that authTokens are retrieved for.
   * @return array an array of arrays of services
   */
  public function ServiceProvider() {
    $data = array();

    // AdWords
    $data[] = array('adwords');
    // DFP
    $data[] = array('gam');

    return $data;
  }

  /**
   * Tests using invalid credentials to get an authToken.
   * @covers AuthToken::GetAuthToken
   * @expectedException AuthTokenException
   */
  public function testBadCredentials() {
    $authToken = new AuthToken($this->email, 'foo', AuthTokenTest::$SERVICE,
        AuthTokenTest::$SOURCE);
    $result = $authToken->GetAuthToken();
  }

  /**
   * Tests using a invalid server to get an authToken.
   * @covers AuthToken::GetAuthToken
   * @expectedException AuthTokenException
   */
  public function testBadServer() {
    $authToken = new AuthToken($this->email, $this->password,
        AuthTokenTest::$SERVICE, AuthTokenTest::$SOURCE, NULL,
        'https://foo.google.com');
    $result = $authToken->GetAuthToken();
  }

  /**
   * Tests using a invalid service to get an authToken.
   * @covers AuthToken::GetAuthToken
   * @expectedException AuthTokenException
   */
  public function testBadService() {
    $authToken = new AuthToken($this->email, $this->password,
        'foo', AuthTokenTest::$SOURCE);
    $result = $authToken->GetAuthToken();
  }
}
