<?php
/**
 * Phing Task to call WSDLInterpreter on each service WSDL from a build script.
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
 * @package   GoogleAdsApiCommmon
 * @copyright 2009, Google Inc. All Rights Reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author    Adam Rogal <api.arogal@gmail.com>
 */

require_once 'phing/Task.php';
require_once 'WSDLInterpreter/WSDLInterpreter.php';

/**
 * A Phing task used to generate an Ads API service from a WSDL URL.
 */
class Wsdl2PhpTask extends Task {
  /**
   * The URL passed in the buildfile for the WSDL.
   * @var string the URL of the WSDL
   * @access private
   */
  private $url = NULL;

  /**
   * The SOAP client classname of the API.
   * @var string the SoapClient class extension to extend
   * @access private
   */
  private $soapClientClassName = NULL;

  /**
   * The SOAP client class path of the API.
   * @var string the path of the SoapClient class extension to extend
   * @access private
   */
  private $soapClientClassPath = NULL;

  /**
   * The output directory for the php file. This can be a relative path
   * from the current directory from which the task is called, or an
   * absolute path.
   * @var string the output directory of the task
   * @access private
   */
  private $outputDir = NULL;

  /**
   * The namespace for the WSDL.
   * @var string the namespace for the WSDL
   * @access private
   */
  private $namespace = NULL;

  /**
   * The classmap of 'Wsdl Type => PHP Class' for the WSDL.
   * @var array the classmap for the WSDL type to PHP class
   * @access private
   */
  private $classmap = NULL;

  /**
   * The author of the service to be included in the file header.
   * @var string the author of the service
   * @access private
   */
  private $author = NULL;

  /**
   * The name of the service being worked on.
   * @var string the name of the service being worked on
   * @access private
   */
  private $serviceName = NULL;

  /**
   * The version of the service being worked on
   * @var string the version of the service being worked
   * @access private
   */
  private $version = NULL;

  /**
   * The package name to be included in the file header.
   * @var the package name to be included in the file header
   * @access private
   */
  private $package = NULL;

  /**
   * The setter for the attribute <var>$url</var>.
   * @param string $url the URL of the WSDL file
   */
  public function setUrl($url) {
    $this->url = $url;
  }

  /**
   * The setter for the attribute <var>$soapClientClassName</var>.
   * @param string $soapClientClassName the soap client classname to extend for
   *     each soap client
   */
  public function setSoapClientClassName($soapClientClassName) {
    $this->soapClientClassName = $soapClientClassName;
  }

  /**
   * The setter for the attribute <var>$soapClientClassPath</var>.
   * @param string $soapClientClassPath the soap client class path to require
   *     in each service class file
   */
  public function setSoapClientClassPath($soapClientClassPath) {
    $this->soapClientClassPath = $soapClientClassPath;
  }

  /**
   * The setter for the attribute <var>$outputDir</var>.
   * @param string $path the output directory where the generated PHP
   *     file will be placed
   */
  public function setOutputDir($outputDir) {
    $this->outputDir = $outputDir;
  }

  /**
   * The setter for the attribute <var>$namespace</var>.
   * @param string $namespace the target namespace of the WSDL
   */
  public function setNamespace($namespace) {
    $this->namespace = $namespace;
  }

  /**
   * The setter for the attribute <var>$classmap</var>.
   * @param string $classmap code-string of the classmap of
   *     'Wsdl Type => PHP Class'
   */
  public function setClassmap($classmap) {
    $this->classmap = $classmap;
  }

  /**
   * The setter for the attribute <var>$author</var>.
   * @param string $author the author for the file header of the generated file
   */
  public function setAuthor($author) {
    $this->author = $author;
  }

  /**
   * The setter for the attribute <var>$version</var>.
   * @param string $version the version of the API for the generated service
   */
  public function SetVersion($version) {
    $this->version = $version;
  }

  /**
   * The setter for the attribute <var>$package</var>.
   * @param string $package the pacakge to be inserted into the file header
   */
  public function SetPackage($package) {
    $this->package = $package;
  }

  /**
   * The setter of the attribute <var>$serviceName</var>.
   * @param string $serviceName the name of the generated service
   */
  public function SetServiceName($serviceName) {
    $this->serviceName = $serviceName;
  }

  /**
   * Nothing to initilize for the task.
   */
  public function init() {}

  /**
   * The main entry point method for the task.
   */
  public function main() {
    eval($this->classmap);

    print 'Starting: ' . $this->url . ' to ' . $this->outputDir . "\n";

    $wsdlInterpreter =
        new WSDLInterpreter($this->url, $this->soapClientClassName,
            array('location' => $this->url, 'uri' => $this->namespace,
                'classmap' => $this->classmap),
            $this->serviceName, $this->version, $this->author, $this->package,
            $this->soapClientClassPath);
    $wsdlInterpreter->savePHP($this->outputDir);
    print 'Done: ' . $this->url . "\n";
  }
}
