<?php
/**
 * User class for all API modules using the Ads API.
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
 * @subpackage Lib
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

require_once dirname(__FILE__) . '/../Util/Logger.php';
require_once dirname(__FILE__) . '/../Util/OAuthUtils.php';
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

  /**
   * Constructor for AdsUser.
   * @access protected
   */
  protected function __construct() {
    $this->requestHeaderElements = array();
    $this->logsDirectory = '.';
    $this->authServer = 'https://www.google.com';
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
   * @param string $serviceGroup the service group. Can be <var>NULL</var>
   *     if the product has not implemented service groups yet
   * @param string $serviceGroupUrlOverride the name of the service group to be
   *     used in the location url
   * @param string $serviceGroupHeaderNamespaceOverride the name of the service
   *     group to use in the header namespace
   * @return SoapClient the instantiated service
   */
  public function GetServiceSoapClient($serviceName,
      SoapClientFactory $serviceFactory, $serviceGroup = NULL,
      $serviceGroupUrlOverride = NULL,
      $serviceGroupHeaderNamespaceOverride = NULL) {
    return $serviceFactory->GenerateSoapClient($serviceName, $serviceGroup,
        $serviceGroupUrlOverride, $serviceGroupHeaderNamespaceOverride);
  }

  /**
   * Initiates the default logging behavior of logging all HTTP headers and
   * SOAP XML to the soap_xml.log file and all request information to the
   * request_info.log file under the logs directory.
   */
  public function LogDefaults() {
    Logger::logToFile(Logger::$SOAP_XML_LOG,
        $this->logsDirectory . "/soap_xml.log");
    Logger::logToFile(Logger::$REQUEST_INFO_LOG,
        $this->logsDirectory . "/request_info.log");
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

    $settingsIni = parse_ini_file($settingsIniPath, true);

    if (isset($settingsIni)) {
      // Logging settings.
      if ($settingsIni['LOGGING']['PATH_RELATIVE'] == 1) {
        $path = realpath($logsRelativePathBase . '/'
            . $settingsIni['LOGGING']['LIB_LOG_DIR_PATH']);
        if ($path === false) {
          $this->logsDirectory = $defaultLogsDir;
        } else {
          $this->logsDirectory = $path;
        }
      } else {
        $this->logsDirectory = $settingsIni['LOGGING']['LIB_LOG_DIR_PATH'];
      }

      // Server settings.
      if (array_key_exists('SERVER', $settingsIni)
          && array_key_exists('DEFAULT_VERSION', $settingsIni['SERVER'])) {
        $this->defaultVersion = $settingsIni['SERVER']['DEFAULT_VERSION'];
      } else {
        $this->defaultVersion = $defaultVersion;
      }
      if (array_key_exists('SERVER', $settingsIni)
          && array_key_exists('DEFAULT_SERVER', $settingsIni['SERVER'])) {
        $this->defaultServer = $settingsIni['SERVER']['DEFAULT_SERVER'];
      } else {
        $this->defaultServer = $defaultServer;
      }

      // SOAP settings.
      if (array_key_exists('SOAP', $settingsIni)
          && array_key_exists('COMPRESSION', $settingsIni['SOAP'])) {
        $this->soapCompression = (bool) $settingsIni['SOAP']['COMPRESSION'];
      } else {
        // Default to using compression.
        $this->soapCompression = TRUE;
      }
      if (array_key_exists('SOAP', $settingsIni)
          && array_key_exists('COMPRESSION_LEVEL', $settingsIni['SOAP'])
          && $settingsIni['SOAP']['COMPRESSION_LEVEL'] >= 1
          && $settingsIni['SOAP']['COMPRESSION_LEVEL'] <= 9) {
        $this->soapCompressionLevel =
            (int) $settingsIni['SOAP']['COMPRESSION_LEVEL'];
      } else {
        // Default to using compression level 1.
        $this->soapCompressionLevel = 1;
      }
      if (array_key_exists('SOAP', $settingsIni)
          && array_key_exists('WSDL_CACHE', $settingsIni['SOAP'])
          && $settingsIni['SOAP']['WSDL_CACHE'] >= 0
          && $settingsIni['SOAP']['WSDL_CACHE'] <= 3) {
        $this->wsdlCache = (int) $settingsIni['SOAP']['WSDL_CACHE'];
      } else {
        // Default to none.
        $this->wsdlCache = WSDL_CACHE_NONE;
      }

      // Proxy settings.
      if (array_key_exists('PROXY', $settingsIni)) {
        if (array_key_exists('HOST', $settingsIni['PROXY'])) {
          define('HTTP_PROXY_HOST', $settingsIni['PROXY']['HOST']);
        }
        if (array_key_exists('PORT', $settingsIni['PROXY'])) {
          define('HTTP_PROXY_PORT', (int) $settingsIni['PROXY']['PORT']);
        }
        if (array_key_exists('USER', $settingsIni['PROXY'])) {
          define('HTTP_PROXY_USER', $settingsIni['PROXY']['USER']);
        }
        if (array_key_exists('PASSWORD', $settingsIni['PROXY'])) {
          define('HTTP_PROXY_PASSWORD', $settingsIni['PROXY']['PASSWORD']);
        }
      }

      // Auth settings.
      if (array_key_exists('AUTH', $settingsIni)) {
        if (array_key_exists('AUTH_SERVER', $settingsIni['AUTH'])) {
          $this->authServer = $settingsIni['AUTH']['AUTH_SERVER'];
        }
      }

      // SSL settings.
      if (array_key_exists('SSL', $settingsIni)) {
        if (array_key_exists('VERIFY_PEER', $settingsIni['SSL'])) {
          define('SSL_VERIFY_PEER', $settingsIni['SSL']['VERIFY_PEER']);
        }
        if (array_key_exists('CA_PATH', $settingsIni['SSL'])) {
          define('SSL_CA_PATH', $settingsIni['SSL']['CA_PATH']);
        }
        if (array_key_exists('CA_FILE', $settingsIni['SSL'])) {
          define('SSL_CA_FILE', $settingsIni['SSL']['CA_FILE']);
        }
      }
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
   * Gets the client library identifier used for user-agent fields.
   * @return string a unique client library identifier
   */
  abstract public function GetClientLibraryIdentifier();

  /**
   * Requests a new OAuth token.
   * @param $callbackUrl the URL to return to after the token is authorized
   * @param $server the AdWords API server that requests will be made to
   */
  public function RequestOAuthToken($callbackUrl = NULL, $server = NULL) {
    $server = isset($server) ? $server : $this->GetDefaultServer();
    $scope = $this->GetOAuthScope($server);
    $this->oauthInfo = OAuthUtils::GetRequestToken($this->oauthInfo, $scope,
        $this->GetAuthServer(), $callbackUrl);
  }

  /**
   * Gets the OAuth authorization URL for the OAuth token.
   * @returns string the URL used to authorize the token
   */
  public function GetOAuthAuthorizationUrl() {
    return OAuthUtils::GetAuthorizationUrl($this->oauthInfo,
        $this->GetAuthServer());
  }

  /**
   * Upgrades the authorized OAuth token.
   * @param string $verifier the verifier string returned from authorizing the
   *     token
   */
  public function UpgradeOAuthToken($verifier) {
    $this->oauthInfo = OAuthUtils::GetAccessToken($this->oauthInfo, $verifier,
        $this->GetAuthServer());
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
   * Gets the OAuth scope for this user.
   * @param string $server the AdWords API server that requests will be made to
   * @return string the scope to use when requesting an OAuth token
   */
  abstract protected function GetOAuthScope($server = NULL);
}
