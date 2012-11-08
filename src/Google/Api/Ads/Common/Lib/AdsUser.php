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
 * @subpackage Lib
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <eric.koleda@google.com>
 * @author     Vincent Tsao <api.vtsao@gmail.com>
 */
require_once dirname(__FILE__) . '/../Util/Logger.php';
require_once dirname(__FILE__) . '/../Util/PeclOAuthHandler.php';
require_once dirname(__FILE__) . '/../Util/AndySmithOAuthHandler.php';
require_once dirname(__FILE__) . '/../Util/SimpleOAuth2Handler.php';
require_once 'SoapClientFactory.php';
require_once 'ValidationException.php';

/**
 * User class for all API modules using the Ads API.
 */
abstract class AdsUser {

  private $requestHeaderElements;
  private $defaultServer;
  private $defaultVersion;
  private $logsDirectory;
  private $soapCompression;
  private $soapCompressionLevel;
  private $wsdlCache;
  private $authServer;
  private $oauthInfo;
  private $oauthHandler;
  private $oauth2Info;
  private $oauth2Handler;

  /**
   * Constructor for AdsUser.
   * @access protected
   */
  protected function __construct() {
    $this->requestHeaderElements = array();
  }

  /**
   * Gets the authenticaiton value for the <var>$authVar</var> supplied. If
   * the <var>$authVar</var> is set, it is is used. Otherwirse, the supplied
   * <var>$authenticationIni</var> is queired for the variable. If none is found
   * <var>NULL</var> is returned.
   * @param string $authVar the default value for the authenticaiton variable
   * @param string $authVarName the name of the authencation variable
   * @param array $authIni the array of authentication variables from
   *     an INI file
   * @return string the authentication variable value
   * @access protected
   */
  protected function GetAuthVarValue($authVar, $authVarName,
      array $authIni) {
    if (isset($authVar)) {
      return $authVar;
    } else {
      if (array_key_exists($authVarName, $authIni)) {
        return $authIni[$authVarName];
      } else {
        return NULL;
      }
    }
  }

  /**
   * Gets the names of all registered request header elements.
   * @return array the names of the request header elements
   */
  public function GetHeaderNames() {
    return array_keys($this->requestHeaderElements);
  }

  /**
   * Gets the value for a registered request header element.
   * @param string $key the name of the request header element
   * @return string the value of the request header element or NULL if not found
   */
  public function GetHeaderValue($key) {
    if (array_key_exists($key, $this->requestHeaderElements)) {
      return $this->requestHeaderElements[$key];
    } else {
      return NULL;
    }
  }

  /**
   * Sets the value for a request header.
   * @param string $key the name of the request header element
   * @param string $value the value for the request header element
   */
  public function SetHeaderValue($key, $value) {
    $this->requestHeaderElements[$key] = $value;
  }

  /**
   * Gets the service by its service name.
   * @param string $serviceName the service name
   * @param SoapClientFactory $serviceFactory the service factory
   * @return SoapClient the instantiated service
   */
  public function GetServiceSoapClient($serviceName,
      SoapClientFactory $serviceFactory) {
    return $serviceFactory->GenerateSoapClient($serviceName);
  }

  /**
   * Initializes the logging mechanism used by services created by this user.
   * HTTP headers and SOAP XML are logged to the soap_xml.log file and all
   * request information is logged to the request_info.log file under the logs
   * directory.
   */
  protected function InitLogs() {
    Logger::LogToFile(Logger::$SOAP_XML_LOG,
        $this->logsDirectory . "/soap_xml.log");
    Logger::LogToFile(Logger::$REQUEST_INFO_LOG,
        $this->logsDirectory . "/request_info.log");
    Logger::SetLogLevel(Logger::$SOAP_XML_LOG, Logger::$FATAL);
    Logger::SetLogLevel(Logger::$REQUEST_INFO_LOG, Logger::$FATAL);
  }

  /**
   * Configures the library to log basic information about all requests and
   * the full SOAP XML request and response only when an error occurs.
   */
  public function LogDefaults() {
    Logger::SetLogLevel(Logger::$SOAP_XML_LOG, Logger::$ERROR);
    Logger::SetLogLevel(Logger::$REQUEST_INFO_LOG, Logger::$INFO);
  }

  /**
   * Configures the library to only log requests that return an error.
   */
  public function LogErrors() {
    Logger::SetLogLevel(Logger::$SOAP_XML_LOG, Logger::$ERROR);
    Logger::SetLogLevel(Logger::$REQUEST_INFO_LOG, Logger::$ERROR);
  }

  /**
   * Configures the library to log all requests.
   */
  public function LogAll() {
    Logger::SetLogLevel(Logger::$SOAP_XML_LOG, Logger::$INFO);
    Logger::SetLogLevel(Logger::$REQUEST_INFO_LOG, Logger::$INFO);
  }


  /**
   * Loads the settings for this client library. If the settings INI file
   * located at <var>$settingsIniPath</var> cannot be loaded, then the
   * parameters passed into this method are used.
   * @param string $settingsIniPath the path to the settings INI file
   * @param string $defaultVersion the default version if the settings INI file
   *     cannot be loaded
   * @param string $defaultServer the default server if the settings INI file
   *     cannot be loaded
   * @param string $defaultLogsDir the default logs directory if the settings
   *     INI file cannot be loaded
   * @param string $logsRelativePathBase the relative path base for the logs
   *     directory
   */
  public function LoadSettings($settingsIniPath, $defaultVersion,
      $defaultServer, $defaultLogsDir, $logsRelativePathBase) {
    // Set no time limit for PHP operations.
    set_time_limit(0);
    ini_set('default_socket_timeout', 480);

    $settingsIni = parse_ini_file($settingsIniPath, TRUE);

    // Logging settings.
    $pathRelative = $this->GetSetting($settingsIni, 'LOGGING',
        'PATH_RELATIVE', FALSE);
    $libLogDirPath = $this->GetSetting($settingsIni, 'LOGGING',
        'LIB_LOG_DIR_PATH', $defaultLogsDir);
    $relativePath = realpath($logsRelativePathBase . '/' . $libLogDirPath);
    if ($pathRelative && $relativePath) {
      $this->logsDirectory = $relativePath;
    } elseif (!$pathRelative && $libLogDirPath) {
      $this->logsDirectory = $libLogDirPath;
    } else {
      $this->logsDirectory = $defaultLogsDir;
    }
    $this->InitLogs();

    // Server settings.
    $this->defaultVersion = $this->GetSetting($settingsIni, 'SERVER',
        'DEFAULT_VERSION', $defaultVersion);
    $this->defaultServer = $this->GetSetting($settingsIni, 'SERVER',
        'DEFAULT_SERVER', $defaultServer);

    // SOAP settings.
    $this->soapCompression = (bool) $this->GetSetting($settingsIni, 'SOAP',
        'COMPRESSION', TRUE);
    $this->soapCompressionLevel = $this->GetSetting($settingsIni, 'SOAP',
        'COMPRESSION_LEVEL', 1);
    if ($this->soapCompressionLevel < 1 || $this->soapCompressionLevel > 9) {
      $this->soapCompressionLevel = 1;
    }
    $this->wsdlCache = (int) $this->GetSetting($settingsIni, 'SOAP',
        'WSDL_CACHE', WSDL_CACHE_NONE);
    if ($this->wsdlCache < 0 || $this->wsdlCache > 3) {
      $this->wsdlCache = WSDL_CACHE_NONE;
    }

    // Proxy settings.
    $proxyHost = $this->GetSetting($settingsIni, 'PROXY', 'HOST');
    if (isset($proxyHost)) {
      $this->Define('HTTP_PROXY_HOST', $proxyHost);
    }
    $proxyPort = $this->GetSetting($settingsIni, 'PROXY', 'PORT');
    if (isset($proxyPort)) {
      $this->Define('HTTP_PROXY_PORT', (int) $proxyPort);
    }
    $proxyUser = $this->GetSetting($settingsIni, 'PROXY', 'USER');
    if (isset($proxyUser)) {
      $this->Define('HTTP_PROXY_USER', $proxyUser);
    }
    $proxyPassword = $this->GetSetting($settingsIni, 'PROXY', 'PASSWORD');
    if (isset($proxyPassword)) {
      $this->Define('HTTP_PROXY_PASSWORD', $proxyPassword);
    }

    // Auth settings.
    $this->authServer = $this->GetSetting($settingsIni, 'AUTH', 'AUTH_SERVER',
        'https://accounts.google.com');
    // OAuth 1.0a.
    $oauthHandlerClass = $this->GetSetting($settingsIni, 'AUTH',
        'OAUTH_HANDLER_CLASS');
    if (!isset($oauthHandlerClass)) {
      $extensions = get_loaded_extensions();
      if (in_array('OAuth', $extensions)) {
        $oauthHandlerClass = 'PeclOAuthHandler';
      } else {
        $oauthHandlerClass = 'AndySmithOAuthHandler';
      }
    }
    $this->oauthHandler = new $oauthHandlerClass();
    // OAuth2.
    $oauth2HandlerClass = $this->GetSetting($settingsIni, 'AUTH',
        'OAUTH2_HANDLER_CLASS');
    if (!isset($oauth2HandlerClass)) {
      $oauth2HandlerClass = 'SimpleOAuth2Handler';
    }
    $this->oauth2Handler = new $oauth2HandlerClass($this->authServer);

    // SSL settings.
    $sslVerifyPeer = $this->GetSetting($settingsIni, 'SSL', 'VERIFY_PEER');
    if (isset($sslVerifyPeer)) {
      $this->Define('SSL_VERIFY_PEER', $sslVerifyPeer);
    }
    $sslVerifyHost = $this->GetSetting($settingsIni, 'SSL', 'VERIFY_HOST');
    if (isset($sslVerifyHost)) {
      $this->Define('SSL_VERIFY_HOST', (int) $sslVerifyHost);
    }
    $sslCaPath = $this->GetSetting($settingsIni, 'SSL', 'CA_PATH');
    if (isset($sslCaPath)) {
      $this->Define('SSL_CA_PATH', $sslCaPath);
    }
    $sslCaFile = $this->GetSetting($settingsIni, 'SSL', 'CA_FILE');
    if (isset($sslCaFile)) {
      $this->Define('SSL_CA_FILE', $sslCaFile);
    }
  }

  /**
   * Gets the value for a given setting based on the contents of the parsed INI
   * file.
   * @param array $settings the parsed settings INI file
   * @param string $section the name of the section containing the setting
   * @param string $name the name of the setting
   * @param mixed $default the default value of the setting
   * @return string the value of the setting
   */
  private function GetSetting($settings, $section, $name, $default = NULL) {
    if (!$settings || !array_key_exists($section, $settings)
        || !array_key_exists($name, $settings[$section])
        || $settings[$section][$name] == NULL
        || $settings[$section][$name] == '') {
      return $default;
    }
    return $settings[$section][$name];
  }

  /**
   * Define a constant if it isn't already defined. If it is defined but the
   * value is different then attempt to redefine it, which will fail and throw
   * the appropriate error.
   * @param string $name the name of the constant
   * @param string $value the value of the constant
   */
  private function Define($name, $value) {
    if (!defined($name) || (constant($name) != $value)) {
      define($name, $value);
    }
  }

  /**
   * Gets the default server.
   * @return string the default server
   */
  public function GetDefaultServer() {
    return $this->defaultServer;
  }

  /**
   * Sets the default server.
   * @param string $defaultServer the default server
   */
  public function SetDefaultServer($defaultServer) {
    $this->defaultServer = $defaultServer;
  }

  /**
   * Gets the default version.
   * @return string the default version
   */
  public function GetDefaultVersion() {
    return $this->defaultVersion;
  }

  /**
   * Sets the default version.
   * @param string $defaultVersion the default version
   */
  public function SetDefaultVersion($defaultVersion) {
    $this->defaultVersion = $defaultVersion;
  }

  /**
   * Gets the logs directory.
   * @return string the logs directory
   */
  public function GetLogsDirectory() {
    return $this->logsDirectory;
  }

  /**
   * Is SOAP compression enabled.
   * @return bool is SOAP compression enabled
   */
  public function IsSoapCompressionEnabled() {
    return $this->soapCompression;
  }

  /**
   * Gets the SOAP compression level.
   * @return int the SOAP compression level
   */
  public function GetSoapCompressionLevel() {
    return $this->soapCompressionLevel;
  }

  /**
   * Gets the type of WSDL caching in use.
   * @return int the type of WSDL caching in use
   */
  public function GetWsdlCacheType() {
    return $this->wsdlCache;
  }

  /**
   * Gets the server used for authentication.
   * @return string the server used for authentiation
   */
  public function GetAuthServer() {
    return $this->authServer;
  }

  /**
   * Gets the OAuth info for this user.
   * @return array the OAuth info for this user
   */
  public function GetOAuthInfo() {
    return $this->oauthInfo;
  }

  /**
   * Sets the OAuth info for this user.
   * @param array $oauthInfo the OAuth info for this user
   */
  public function SetOAuthInfo($oauthInfo) {
    $this->oauthInfo = $oauthInfo;
  }

  /**
   * Gets the OAuth handler for this user.
   * @return OAuthHandler the OAuth handler for this user
   */
  public function GetOAuthHandler() {
    return $this->oauthHandler;
  }

  /**
   * Sets the OAuth handler for this user.
   * @param array $oauthHandler the OAuth handler for this user
   */
  public function SetOAuthHandler($oauthHandler) {
    $this->oauthHandler = $oauthHandler;
  }

  /**
   * Gets the OAuth2 info for this user.
   * @return array the OAuth2 info for this user
   */
  public function GetOAuth2Info() {
    return $this->oauth2Info;
  }

  /**
   * Sets the OAuth2 info for this user.
   * @param array $oauth2Info the OAuth2 info for this user
   */
  public function SetOAuth2Info($oauth2Info) {
    $this->oauth2Info = $oauth2Info;
  }

  /**
   * Gets the OAuth2 handler for this user.
   * @return OAuth2Handler the OAuth2 handler for this user
   */
  public function GetOAuth2Handler() {
    return $this->oauth2Handler;
  }

  /**
   * Sets the OAuth2 handler for this user.
   * @param array $oauth2Handler the OAuth2 handler for this user
   */
  public function SetOAuth2Handler($oauth2Handler) {
    $this->oauth2Handler = $oauth2Handler;
  }

  /**
   * Gets the appropriate user agent header name for the API this client library
   * is targeting.
   * @return string The user agent header name.
   */
  abstract protected function GetUserAgentHeaderName();

  /**
   * Gets the name and version of this client library.
   * @return array An array containing the name and version of this client
   *     library, e.g.: ['DfpApi-PHP', '2.13.0'].
   */
  abstract protected function GetClientLibraryNameAndVersion();

  /**
   * Gets common PHP user agent parts for ads client libraries such as PHP
   * version, operating system, browser, or if compression is being used or not.
   * @return array An array of arrays with each inner array representing a user
   *     agent parts, e.g.: ['php', '5.3.2'] or ['php', '5.4.0'].
   */
  private function GetCommonClientLibraryUserAgentParts() {
    return array(array('php', PHP_VERSION));
  }

  /**
   * Gets the user agent string that identifies this library for this user.
   * @return string A user agent string.
   */
  public function GetClientLibraryUserAgent() {
    return $this->GetHeaderValue($this->GetUserAgentHeaderName());
  }

  /**
   * Gets all the user agent parts that identify this client library.
   * @return array An array of all the user agent parts that identify this
   *     client library where each user agent part has been joined by a '/'
   *     (forward slash).
   */
  private function GetAllClientLibraryUserAgentParts() {
    $allUserAgentParts[] = implode('/',
        $this->GetClientLibraryNameAndVersion());

    foreach ($this->GetCommonClientLibraryUserAgentParts() as $userAgentPart) {
      $allUserAgentParts[] = implode('/', $userAgentPart);
    }

    return $allUserAgentParts;
  }

  /**
   * Sets the user agent string that identifies this library for this user.
   *
   * TODO(vtsao): The current contract requires that subclasses call this method
   * in their constructor.
   *
   * @param $applicationName The application name that will appear in this
   *     header.
   */
  public function SetClientLibraryUserAgent($applicationName) {
    $this->SetHeaderValue($this->GetUserAgentHeaderName(), sprintf("%s (%s)", $applicationName,
        implode(', ', $this->GetAllClientLibraryUserAgentParts())));
  }

  /**
   * Requests a new OAuth token.
   * @param $callbackUrl the URL to return to after the token is authorized
   * @param $server the AdWords API server that requests will be made to
   * @param $applicationName the optional application name to present to the
   *     user during token authorization
   */
  public function RequestOAuthToken($callbackUrl = NULL, $server = NULL,
      $applicationName = NULL) {
    $server = isset($server) ? $server : $this->GetDefaultServer();
    $scope = $this->GetOAuthScope($server);
    $this->oauthInfo = $this->GetOAuthHandler()->GetRequestToken(
        $this->oauthInfo, $scope, $this->GetAuthServer(), $callbackUrl,
        $applicationName);
  }

  /**
   * Gets the OAuth authorization URL for the OAuth token.
   * @returns string the URL used to authorize the token
   */
  public function GetOAuthAuthorizationUrl() {
    return $this->GetOAuthHandler()->GetAuthorizationUrl($this->oauthInfo,
        $this->GetAuthServer());
  }

  /**
   * Upgrades the authorized OAuth token.
   * @param string $verifier the verifier string returned from authorizing the
   *     token
   */
  public function UpgradeOAuthToken($verifier) {
    $this->oauthInfo = $this->GetOAuthHandler()->GetAccessToken(
        $this->oauthInfo, $verifier, $this->GetAuthServer());
  }

  /**
   * Validates that the OAuth info is complete.
   * @throws ValidationException if there are any validation errors
   * @access protected
   */
  protected function ValidateOAuthInfo() {
    if (!array_key_exists('oauth_consumer_key', $this->oauthInfo)) {
      throw new ValidationException('oauthInfo', NULL,
          'oauth_consumer_key is required and cannot be NULL.');
    }
    if (!array_key_exists('oauth_consumer_secret', $this->oauthInfo)) {
      throw new ValidationException('oauthInfo', NULL,
          'oauth_consumer_secret is required and cannot be NULL.');
    }
    if (!array_key_exists('oauth_token', $this->oauthInfo)) {
      throw new ValidationException('oauthInfo', NULL,
          'oauth_token is required and cannot be NULL.');
    }
    if (!array_key_exists('oauth_token_secret', $this->oauthInfo)) {
      throw new ValidationException('oauthInfo', NULL,
          'oauth_token_secret is required and cannot be NULL.');
    }
  }

  /**
   * Gets the OAuth2 authorization URL.
   * @param string $redirectUri optional callback URL
   * @param boolean $offline if offline mode is requested, false by default
   * @param array $params optional array of additional parameters to include
   *     in the URL
   * @return string the URL used to redirect the user to to authorize the token
   */
  public function GetOAuth2AuthorizationUrl($redirectUri = NULL,
      $offline = NULL, array $params = null) {
    $server = isset($server) ? $server : $this->GetDefaultServer();
    $scope = $this->GetOAuth2Scope($server);
    return $this->GetOAuth2Handler()->GetAuthorizationUrl($this->oauth2Info,
        $scope, $redirectUri, $offline, $params);
  }

  /**
   * Gets an OAuth2 access token after it's been authorized, also saving it
   * on the user.
   * @param string $code the authorization code returned in the response
   * @param string $redirectUri optional callback URL
   * @return array the updated OAuth2 info
   */
  public function GetOAuth2AccessToken($code, $redirectUri = NULL) {
    $this->oauth2Info = $this->GetOAuth2Handler()->GetAccessToken(
        $this->oauth2Info, $code, $redirectUri);
    return $this->oauth2Info;
  }

  /**
   * Determines if the OAuth2 access token is still valid.
   * @return boolean true if the access token is still valid
   */
  public function IsOAuth2AccessTokenValid() {
    return $this->GetOAuth2Handler()->IsAccessTokenValid($this->oauth2Info);
  }

  /**
   * Determines if the OAuth2 access token can be refreshed.
   * @return boolean true if the access token can be refreshed
   */
  public function CanRefreshOAuth2AccessToken() {
    return $this->GetOAuth2Handler()->CanRefreshAccessToken($this->oauth2Info);
  }

  /**
   * Refreshes the access token, saving it on the user.
   * @return array the updated OAuth2 info
   */
  public function RefreshOAuth2AccessToken() {
    $this->oauth2Info = $this->GetOAuth2Handler()->RefreshAccessToken(
        $this->oauth2Info);
    return $this->oauth2Info;
  }

  /**
   * Validates that the OAuth2 info is complete.
   * @throws ValidationException if there are any validation errors
   * @access protected
   */
  protected function ValidateOAuth2Info() {
    if (empty($this->oauth2Info['client_id'])) {
      throw new ValidationException('oauth2Info', NULL,
          'client_id is required.');
    }
    if (empty($this->oauth2Info['client_secret'])) {
      throw new ValidationException('oauth2Info', NULL,
          'client_secret is required.');
    }
    if (empty($this->oauth2Info['access_token']) &&
        empty($this->oauth2Info['refresh_token'])) {
      throw new ValidationException('oauth2Info', NULL,
          'access_token or refresh_token is required.');
    }
  }

  /**
   * Gets the OAuth scope for this user.
   * @param string $server the API server that requests will be made to
   * @return string the scope to use when requesting an OAuth token
   */
  abstract protected function GetOAuthScope($server = NULL);

  /**
   * Gets the OAuth2 scope for this user.
   * @param string $server the API server that requests will be made to
   * @return string the scope to use when requesting an OAuth2 token
   */
  abstract protected function GetOAuth2Scope($server = NULL);
}
