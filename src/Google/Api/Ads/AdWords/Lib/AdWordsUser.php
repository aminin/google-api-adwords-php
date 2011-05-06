<?php
/**
 * User class for the AdWords API to create SOAP clients to the available API
 * services.
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
 * @package    GoogleApiAdsAdWords
 * @subpackage Lib
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 * @see        AdsUser
 */

/** Required classes. **/
require_once dirname(__FILE__) . '/../../Common/Util/Logger.php';
require_once dirname(__FILE__) . '/../../Common/Util/AuthToken.php';
require_once dirname(__FILE__) . '/../../Common/Lib/AdsUser.php';
require_once 'AdWordsSoapClientFactory.php';

/**
 * User class for the AdWords API to create SOAP clients to the available API
 * services.
 * @package GoogleApiAdsAdWords
 * @subpackage Lib
 */
class AdWordsUser extends AdsUser {
  private static $LIB_VERSION = '2.6.1';
  private static $LIB_NAME = 'AwApi';

  /**
   * The default version that is loaded if the settings INI cannot be loaded.
   * @var string default version of the API
   */
  private static $DEFAULT_VERSION = 'v201101';

  /**
   * The default server that is loaded if the settings INI cannot be loaded.
   * @var string default server of the API
   */
  private static $DEFAULT_SERVER = 'https://adwords.google.com';

  private $email;
  private $password;

  /**
   * The AdWordsUser constructor.
   * <p>The AdWordsUser class can be configured in one of two ways:
   * <ol><li>Using an authenitcation INI file</li>
   * <li>Using supplied credentials</li></ol></p>
   * <p>If an authentication INI file is provided and successfully loaded, those
   * values will be used unless a corresponding parameter overwrites it.
   * If the authentication INI file is not provided (e.g. it is <var>NULL</var>)
   * the class will attempt to load the default authentication file at the path
   * of "../auth.ini" relative to this file's directory. Any corresponding
   * parameter, which is not <var>NULL</var>, will, however, overwrite any
   * parameter loaded from the default INI.</p>
   * <p>Likewise, if a custom settings INI file is not provided, the default
   * settings INI file will be loaded from the path of "../settings.ini"
   * relative to this file's directory.</p>
   * @param string $authenticationIniPath the absolute path to the
   *     authentication INI or relative to the current directory (cwd). If
   *     <var>NULL</var>, the default authentication INI file will attempt to be
   *     loaded
   * @param string $email the email of the user (required header). Will
   *     overwrite the email entry loaded from any INI file
   * @param string $password the password of the user (required header). Will
   *     overwrite the password entry loaded from any INI file
   * @param string $developerToken the developer token (required header). Will
   *     overwrite the developer token entry loaded from any INI file
   * @param string $applicationToken the application token (required header).
   *     Will overwrite the application token entry loaded from any INI file
   * @param string $userAgent the user agent name (required header). Will
   *     be prepended with the library name and version. Will also overwrite the
   *     userAgent entry in any INI file
   * @param string $clientId the client email or ID to make the request against
   *     (optional header). Will overwrite the clientId, clientEmail, or
   *     clientCustomerId entries loaded from any INI file
   * @param string $settingsIniPath the path to the settings INI file. If
   *     <var>NULL</var>, the default settings INI file will be loaded
   * @param string $authToken the authToken to use for requests
   * @param array $oauthInfo the OAuth information to use for requests
   */
  public function __construct($authenticationIniPath = NULL, $email = NULL,
      $password = NULL, $developerToken = NULL, $applicationToken = NULL,
      $userAgent = NULL, $clientId = NULL, $settingsIniPath = NULL,
      $authToken = NULL, $oauthInfo = NULL) {
    parent::__construct();

    if (isset($authenticationIniPath)) {
      $authenticationIni =
          parse_ini_file(realpath($authenticationIniPath), TRUE);
    } else {
      $authenticationIni =
          parse_ini_file(dirname(__FILE__) . '/../auth.ini', TRUE);
    }

    $email = $this->GetAuthVarValue($email, 'email', $authenticationIni);
    $password = $this->GetAuthVarValue($password, 'password',
        $authenticationIni);
    $developerToken = $this->GetAuthVarValue($developerToken, 'developerToken',
        $authenticationIni);
    $applicationToken = $this->GetAuthVarValue($applicationToken,
        'applicationToken', $authenticationIni);
    $userAgent = $this->GetAuthVarValue($userAgent, 'userAgent',
        $authenticationIni);
    $clientId = $this->GetAuthVarValue($clientId, 'clientId',
        $authenticationIni);
    $clientId = $this->GetAuthVarValue($clientId, 'clientEmail',
        $authenticationIni);
    $clientId = $this->GetAuthVarValue($clientId, 'clientCustomerId',
        $authenticationIni);
    $authToken = $this->GetAuthVarValue($authToken, 'authToken',
        $authenticationIni);
    $oauthInfo = $this->GetAuthVarValue($oauthInfo, 'OAUTH',
        $authenticationIni);

    $this->SetEmail($email);
    $this->SetPassword($password);
    $this->SetAuthToken($authToken);
    $this->SetOAuthInfo($oauthInfo);
    $this->SetClientLibraryUserAgent($userAgent);
    $this->SetClientId($clientId);
    $this->SetDeveloperToken($developerToken);
    $this->SetApplicationToken($applicationToken);

    if (!isset($settingsIniPath)) {
      $settingsIniPath = dirname(__FILE__) . '/../settings.ini';
    }

    $this->LoadSettings($settingsIniPath,
        AdWordsUser::$DEFAULT_VERSION,
        AdWordsUser::$DEFAULT_SERVER,
        dirname(__FILE__), dirname(__FILE__));
  }

  /**
   * Gets the AdExtensionOverrideService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return AdExtensionOverrideService the instantiated ad extension override
   *     service
   */
  public function GetAdExtensionOverrideService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('AdExtensionOverrideService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the AdGroupAdService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return AdGroupAdService the instantiated ad group ad service
   */
  public function GetAdGroupAdService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('AdGroupAdService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the AdGroupCriterionService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @param bool $partialFailure if the service should be created in
   *     partialFailure mode
   * @return AdGroupCriterionService the instantiated ad group criterion service
   */
  public function GetAdGroupCriterionService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL, $partialFailure = NULL) {
    return $this->GetService('AdGroupCriterionService', $version, $server,
        $serviceFactory, $validateOnly, $partialFailure);
  }

  /**
   * Gets the AdGroupService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return AdGroupService the instantiated ad group service
   */
  public function GetAdGroupService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('AdGroupService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the AdParamService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return AdParamService the instantiated ad group service
   */
  public function GetAdParamService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('AdParamService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the AlertService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return AlertService the instantiated alert service
   */
  public function GetAlertService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('AlertService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the BidLandscapeService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return BidLandscapeService the instantiated bid landscape service
   */
  public function GetBidLandscapeService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('BidLandscapeService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the BulkMutateJobService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return BulkMutateJobService the instantiated bulk mutate job service
   */
  public function GetBulkMutateJobService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('BulkMutateJobService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the BulkOpportunityService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return BulkOpportunityService the instantiated bulk opportunity service
   */
  public function GetBulkOpportunityService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('BulkOpportunityService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the CampaignAdExtensionService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return CampaignAdExtensionService the instantiated campaign ad extension
   *     service
   */
  public function GetCampaignAdExtensionService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('CampaignAdExtensionService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the CampaignCriterionService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return CampaignCriterionService the instantiated campaign criterion
   *     service
   */
  public function GetCampaignCriterionService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('CampaignCriterionService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the CampaignService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return CampaignService the instantiated campaign service
   */
  public function GetCampaignService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('CampaignService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the CampaignTargetService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return CampaignTargetService the instantiated campaign target service
   */
  public function GetCampaignTargetService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('CampaignTargetService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the ConversionTrackerService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return ConversionTrackerService the instantiated conversion tracker
   *     service
   */
  public function GetConversionTrackerService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('ConversionTrackerService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the CustomerSyncService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return CustomerSyncService the instantiated customer sync service
   */
  public function GetCustomerSyncService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('CustomerSyncService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the DataService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return DataService the instantiated data service
   */
  public function GetDataService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('DataService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the ExperimentService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return ExperimentService the instantiated experiment service
   */
  public function GetExperimentService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('ExperimentService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the GeoLocationService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return GeoLocationService the instantiated geo location service
   */
  public function GetGeoLocationService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('GeoLocationService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the InfoService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return InfoService the instantiated info service
   */
  public function GetInfoService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('InfoService', $version, $server, $serviceFactory,
        $validateOnly);
  }

  /**
   * Gets the MediaService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return MediaService the instantiated media service
   */
  public function GetMediaService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('MediaService', $version, $server, $serviceFactory,
        $validateOnly);
  }

  /**
   * Gets the ReportDefinitionService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return ReportDefinitionService the instantiated report definition service
   */
  public function GetReportDefinitionService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('ReportDefinitionService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the ServicedAccountService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return ServicedAccountService the instantiated report definition service
   */
  public function GetServicedAccountService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('ServicedAccountService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the TargetingIdeaService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return TargetingIdeaService the instantiated targeting idea service
   */
  public function GetTargetingIdeaService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('TargetingIdeaService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the TrafficEstimatorService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return TrafficEstimatorService the instantiated traffic estimator service
   */
  public function GetTrafficEstimatorService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('TrafficEstimatorService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the UserListService SOAP client.
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @return TrafficEstimatorService the instantiated traffic estimator service
   */
  public function GetUserListService($version = NULL,
      $server = NULL, SoapClientFactory $serviceFactory = NULL,
      $validateOnly = NULL) {
    return $this->GetService('UserListService', $version, $server,
        $serviceFactory, $validateOnly);
  }

  /**
   * Gets the service by its service name and group.
   * @param $serviceName the service name
   * @param string $version the version of the service to get. If
   *     <var>NULL</var>, then the default version will be used
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param SoapClientFactory $serviceFactory the factory to create the client.
   *     If <var>NULL</var>, then the built-in SOAP client factory will be used
   * @param bool $validateOnly if the service should be created in validateOnly
   *     mode
   * @param bool $partialFailure if the service should be created in
   *     partialFailure mode
   * @return SoapClient the instantiated service
   * @access private
   */
  private function GetService($serviceName, $version = NULL, $server = NULL,
      SoapClientFactory $serviceFactory = NULL, $validateOnly = NULL,
      $partialFailure = NULL) {
    $this->ValidateUser();
    if (!isset($serviceFactory)) {
      if (!isset($version)) {
        $version = $this->GetDefaultVersion();
      }

      if (!isset($server)) {
        $server = $this->GetDefaultServer();
      }

      $serviceFactory = new AdWordsSoapClientFactory($this, $version, $server,
          $validateOnly, $partialFailure);
    }

    return parent::GetServiceSoapClient($serviceName, $serviceFactory);
  }

  /**
   * Regenerates the authentication token and sets it for this user.
   * @param string $server the sever to retrieve the token from
   * @return string the newly generated auth token
   */
  public function RegenerateAuthToken($server = NULL) {
    if (!isset($server)) {
      $server = $this->GetAuthServer();
    }
    $authTokenClient = new AuthToken($this->email, $this->password, 'adwords',
        $this->GetUserAgent(), 'GOOGLE', $server);
    $authToken = $authTokenClient->GetAuthToken();
    $this->SetAuthToken($authToken);
    return $authToken;
  }

  /**
   * Gets the authentication token.
   * @return string the auth token
   */
  public function GetAuthToken() {
    $authToken = $this->GetHeaderValue('authToken');
    if (!isset($authToken) && isset($this->email) && isset($this->password)) {
      $authToken = $this->RegenerateAuthToken();
    }
    return $authToken;
  }

  /**
   * Sets the authentication token.
   * @param string $authToken the auth token to set
   */
  public function SetAuthToken($authToken) {
    $this->SetHeaderValue('authToken', $authToken);
  }

  /**
   * Gets the developer token for this user.
   * @return string the developer token
   */
  public function GetDeveloperToken() {
    return $this->GetHeaderValue('developerToken');
  }

  /**
   * Sets the developer token for this user.
   * @param string $developerToken the developer token
   */
  public function SetDeveloperToken($developerToken) {
    $this->SetHeaderValue('developerToken', $developerToken);
  }

  /**
   * Gets the application token that this user.
   * @return string the application token
   */
  public function GetApplicationToken() {
    return $this->GetHeaderValue('applicationToken');
  }

  /**
   * Sets the application token for this user.
   * @param string $applicationToken the application token
   */
  public function SetApplicationToken($applicationToken) {
    $this->SetHeaderValue('applicationToken', $applicationToken);
  }

  /**
   * Gets the client ID for this user. Can be the client email or client
   * customer ID.
   * @return string the client ID for this user
   */
  public function GetClientId() {
    if ($this->GetHeaderValue('clientEmail')) {
      return $this->GetHeaderValue('clientEmail');
    } else if ($this->GetHeaderValue('clientCustomerId')) {
      return $this->GetHeaderValue('clientCustomerId');
    }
  }

  /**
   * Sets the client ID for this user. Can be the client email or client
   * customer ID. Setting <var>$clientId</var> to <var>NULL</var> will result
   * in removing both the clientEmail and clientCustomerId fields.
   * @param string $clientId the client ID for this user
   */
  public function SetClientId($clientId) {
    if (!isset($clientId)) {
      $this->SetHeaderValue('clientCustomerId', NULL);
      $this->SetHeaderValue('clientEmail', NULL);
    } else if (strpos($clientId, '@') === FALSE) {
      $this->SetHeaderValue('clientCustomerId', $clientId);
    } else {
      $this->SetHeaderValue('clientEmail', $clientId);
    }
  }

  /**
   * Gets the user agent for this library.
   * @return string the user agent
   */
  public function GetUserAgent() {
    return $this->GetHeaderValue('userAgent');
  }

  /**
   * Sets the user agent for this library.
   * @param string $userAgent the user agent. Will be prepended
   *     with the library name and version.
   */
  public function SetClientLibraryUserAgent($userAgent) {
    $this->SetHeaderValue('userAgent', AdWordsUser::$LIB_NAME . '-PHP-'.
        AdWordsUser::$LIB_VERSION . '-' . $userAgent);
  }

  /**
   * Gets the email address of the user login.
   * @return string the user login email
   */
  public function GetEmail() {
    return $this->email;
  }

  /**
   * Sets the email address of the user login.
   * @param string $email the user login email
   */
  public function SetEmail($email) {
    $this->email = $email;
  }

  /**
   * Gets the password for this user.
   * @return string the password for this user
   */
  public function GetPassword() {
    return $this->password;
  }

  /**
   * Sets the password for this user.
   * @param string $password the password for this user
   */
  public function SetPassword($password) {
    $this->password = $password;
  }

  /**
   * Gets the client library identifier used for user-agent fields.
   * @return string a unique client library identifier
   */
  public function GetClientLibraryIdentifier() {
    return $this->GetUserAgent();
  }

  /**
   * Validates the user and throws a validation error if there are any errors.
   * @throws ValidationException if there are any validation errors
   */
  public function ValidateUser() {
    if ($this->GetOAuthInfo() != NULL) {
      parent::ValidateOAuthInfo();
    } else if ($this->GetAuthToken() == NULL) {
      if (!isset($this->email)) {
        throw new ValidationException('email', NULL,
            'email is required and cannot be NULL.');
      }

      if (!isset($this->password)) {
        throw new ValidationException('password', NULL,
            'password is required and cannot be NULL.');
      }
      // Generate an authToken.
      $this->RegenerateAuthToken();
    }

    if ($this->GetUserAgent() == NULL) {
      throw new ValidationException('userAgent', NULL,
          'userAgent is required and cannot be NULL.');
    }

    if ($this->GetDeveloperToken() == NULL) {
      throw new ValidationException('developerToken', NULL,
          'developerToken is required and cannot be NULL.');
    }
  }

  /**
   * Gets the OAuth scope for this user.
   * @param string $server the AdWords API server that requests will be made to
   * @return string the OAuth scope to use when requesting the token
   */
  protected function GetOAuthScope($server = NULL) {
    $server = isset($server) ? $server : $this->GetDefaultServer();
    if (substr($server, -1) == '/') {
      $server = substr($server, 0, -1);
    }
    return $server . '/api/adwords/';
  }
}
