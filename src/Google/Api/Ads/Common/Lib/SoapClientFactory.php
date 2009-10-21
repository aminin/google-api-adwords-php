<?php
/**
 * Base class for all SOAP client factories of Ads client libraries.
 *
 * PHP version 5
 *
 * Copyright 2009, Google Inc. All Rights Reserved.
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
 * @copyright  2009, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

require_once 'AdsUser.php';

/**
 * Base class for all SOAP client factories of Ads client libraries.
 * @abstract
 */
abstract class SoapClientFactory {
  private $user;
  private $version;
  private $server;
  private $productName;

  /**
   * The constructor called by any sub-class.
   * @param AdsUser $user the user which the client will use for credentials
   * @param string $version the version to generate clients for
   * @param string $server the server to generate clients for
   * @param string $productName the product name (i.e. adwords)
   * @access protected
   */
  protected function __construct(AdsUser $user, $version, $server,
      $productName) {
    $this->user = $user;
    $this->version = $version;
    $this->server = $server;
    $this->productName = $productName;
  }

  /**
   * Initiates a require_once for the service.
   * @param string $serviceName the service to instantiate
   * @param string $serviceGroup the service group to use. Can be
   *     <var>NULL</var> if the product has not implemented service groups yet
   * @access protected
   */
  abstract protected function DoRequireOnce($serviceName, $serviceGroup = NULL);

  /**
   * Generates a SOAP client for the given service name. Generates a user level
   * error if this instalation of PHP does not have the extension for SOAP
   * installed.
   * @param string $serviceName the name of the service to generate a client for
   * @param string $serviceGroup the name of the service group. Can be
   *     <var>NULL</var> if the product has not implemented service groups yet
   * @param string $serviceGroupUrlOverride the name of the service group to be
   *     used in the location url
   * @param string $serviceGroupHeaderNamespaceOverride the name of the service
   *     group to use in the header namespace
   * @return AdsSoapClient an instantiated SOAP client
   */
  public function GenerateSoapClient($serviceName, $serviceGroup = NULL,
      $serviceGroupUrlOverride = NULL,
      $serviceGroupHeaderNamespaceOverride = NULL) {
    if (extension_loaded('soap')) {
      $this->DoRequireOnce($serviceName, $serviceGroup);
      $soapClient = $this->GenerateServiceClient($serviceName,
          isset($serviceGroupUrlOverride)
              ? $serviceGroupUrlOverride : $serviceGroup);

      $namespaceGroup = '';
      if (isset($serviceGroup)) {
        if (isset($serviceGroupHeaderNamespaceOverride)) {
          $namespaceGroup = $serviceGroupHeaderNamespaceOverride . '/';
        } else {
          $namespaceGroup = 'cm/';
        }
      }

      $soapClient->__setSoapHeaders($this->GenerateSoapHeader(
          'https://' . $this->GetProductName() . '.google.com/api/'
              . $this->GetProductName() . '/'
              . $namespaceGroup . $this->GetVersion()));
      return $soapClient;
    } else {
      trigger_error('This client library requires the SOAP extension to be'
          . ' activated. See http://php.net/manual/en/soap.installation.php for'
          . ' details.', E_USER_ERROR);
    }
  }

  /**
   * Generates the SOAP service client without the proper headers set yet.
   * @param string $serviceName the service to create a client for
   * @param string $serviceGroupo the group of the service
   * @return AdsSoapClient the SOAP service client
   * @access protected
   */
  protected function GenerateServiceClient($serviceName, $serviceGroup = NULL) {
    $location = $this->GetServiceLocation($serviceName, $serviceGroup);
    $wsdl = $location . '?wsdl';
    $options = array(
        'trace' => true,
        'compression' => true,
        'encoding' => 'utf-8',
        'connection_timeout' => 0,
        'user_agent' => $this->GetUser()->GetClientLibraryIdentifier(),
        'features' => SOAP_SINGLE_ELEMENT_ARRAYS);

    // TODO(api.arogal): Implement HTTP proxy.
    /*if (HTTP_PROXY_HOST != '') {
      $options['proxy_host'] = HTTP_PROXY_HOST;
    }
    if (HTTP_PROXY_PORT != '') {
      $options['proxy_port'] = HTTP_PROXY_PORT;
    }
    if (HTTP_PROXY_USER != '') {
      $options['proxy_login'] = HTTP_PROXY_USER;
    }
    if (HTTP_PROXY_PASSWORD != '') {
      $options['proxy_password'] = HTTP_PROXY_PASSWORD;
    }*/

    $soapClient = new $serviceName($wsdl, $options, $this->GetUser());
    $soapClient->__setLocation($location);
    return $soapClient;
  }

  /**
   * Generates the SOAP header for the client.
   * @param $soapHeaderNamespace the namespace for the SOAP header
   * @return SoapHeader the instantiated SoapHeader ready to set
   * @access protected
   */
  protected function GenerateSoapHeader($soapHeaderNamespace) {
    return $this->CreateSoapHeader('SoapRequestHeader',
        'RequestHeader', $soapHeaderNamespace);

  }

  /**
   * Creates a SOAP header for the client given the user. It assumes that
   * each element within the header to be filled in is a publicly acessible
   * feild of the SOAP header element.
   * @param string $soapHeaderClassName the class of the SOAP header to
   *     instantiate
   * @param string $soapHeaderElementName the SOAP element name of the header
   * @param string $namespace the namespace of the header
   * @return SoapHeader the wrapped SOAP header ready to be set
   * @access protected
   */
  protected function CreateSoapHeader($soapHeaderClassName,
      $soapHeaderElementName, $namespace) {
    $requestHeader = new $soapHeaderClassName();

    foreach (get_class_vars($soapHeaderClassName) as $classVar => $value) {
      $requestHeader->$classVar = $this->user->getHeaderValue($classVar);
    }

    $soapRequestHeader =
        new SoapVar($requestHeader, SOAP_ENC_OBJECT, $soapHeaderElementName,
            $namespace);

    return new SoapHeader($namespace, $soapHeaderElementName,
        $soapRequestHeader, false);
  }

  /**
   * Gets the end-point location of the service.
   * @param string $serviceName the service to instantiate
   * @param string $serviceGroup the service group to use. Can be
   *     <var>NULL</var> if the product has not implemented service groups yet
   * @return string the end-point location of the service.
   * @access protected
   */
  protected function GetServiceLocation($serviceName, $serviceGroup = NULL) {
    return implode('/', array($this->GetServer(), 'api',
        $this->GetProductName(), $serviceGroup, $this->GetVersion(),
        $serviceName));
  }

  /**
   * Gets the user associated with this factory.
   * @return AdsUser the user associated with this factory
   */
  public function GetUser() {
    return $this->user;
  }

  /**
   * Gets the version associated with this factory.
   * @return string the version associated with this factory
   */
  public function GetVersion() {
    return $this->version;
  }

  /**
   * Gets the server associated with this factory.
   * @return string the server associated with this factory
   */
  public function GetServer() {
    return $this->server;
  }

  /**
   * Gets the product name associated with this factory.
   * @return string the product name associated with this factory
   */
  public function GetProductName() {
    return $this->productName;
  }
}
