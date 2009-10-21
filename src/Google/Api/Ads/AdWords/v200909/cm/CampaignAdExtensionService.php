<?php
/**
 * Contains all client objects for the CampaignAdExtensionService service.
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
 * @package    GoogleApiAdsAdWords
 * @subpackage ${service.version}
 * @category   WebServices
 * @copyright  2009, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

require_once dirname(__FILE__) . "/../../Lib/AdWordsSoapClient.php";

if (!class_exists("Address")) {
/**
 * <span class="constraint StringLength">This string must not be empty.</span>
 */
class Address {
	/**
	 * @access public
	 * @var string
	 */
	public $streetAddress;
	/**
	 * @access public
	 * @var string
	 */
	public $streetAddress2;
	/**
	 * @access public
	 * @var string
	 */
	public $cityName;
	/**
	 * @access public
	 * @var string
	 */
	public $provinceCode;
	/**
	 * @access public
	 * @var string
	 */
	public $provinceName;
	/**
	 * @access public
	 * @var string
	 */
	public $postalCode;
	/**
	 * @access public
	 * @var string
	 */
	public $countryCode;

	public function __construct($streetAddress = NULL, $streetAddress2 = NULL, $cityName = NULL, $provinceCode = NULL, $provinceName = NULL, $postalCode = NULL, $countryCode = NULL) {
		if(get_parent_class('Address')) parent::__construct();
		$this->streetAddress = $streetAddress;
		$this->streetAddress2 = $streetAddress2;
		$this->cityName = $cityName;
		$this->provinceCode = $provinceCode;
		$this->provinceName = $provinceName;
		$this->postalCode = $postalCode;
		$this->countryCode = $countryCode;
	}
}}

if (!class_exists("GeoPoint")) {
/**
 * Specifies a geo location with the supplied lat/long.
 */
class GeoPoint {
	/**
	 * @access public
	 * @var integer
	 */
	public $latitudeInMicroDegrees;
	/**
	 * @access public
	 * @var integer
	 */
	public $longitudeInMicroDegrees;

	public function __construct($latitudeInMicroDegrees = NULL, $longitudeInMicroDegrees = NULL) {
		if(get_parent_class('GeoPoint')) parent::__construct();
		$this->latitudeInMicroDegrees = $latitudeInMicroDegrees;
		$this->longitudeInMicroDegrees = $longitudeInMicroDegrees;
	}
}}

if (!class_exists("LbcListingData")) {
/**
 * Represents a lbc listing data entry.
 */
class LbcListingData {
	/**
	 * @access public
	 * @var integer
	 */
	public $adExtensionId;
	/**
	 * @access public
	 * @var integer
	 */
	public $lbcKey;
	/**
	 * @access public
	 * @var string
	 */
	public $displayState;
	/**
	 * @access public
	 * @var tnsLbcListingDataContentCheckStatus
	 */
	public $contentCheckStatus;
	/**
	 * @access public
	 * @var boolean
	 */
	public $ownerVerified;

	public function __construct($adExtensionId = NULL, $lbcKey = NULL, $displayState = NULL, $contentCheckStatus = NULL, $ownerVerified = NULL) {
		if(get_parent_class('LbcListingData')) parent::__construct();
		$this->adExtensionId = $adExtensionId;
		$this->lbcKey = $lbcKey;
		$this->displayState = $displayState;
		$this->contentCheckStatus = $contentCheckStatus;
		$this->ownerVerified = $ownerVerified;
	}
}}

if (!class_exists("Paging")) {
/**
 * Specifies what kind of paging wanted for the result of a get.
 */
class Paging {
	/**
	 * @access public
	 * @var integer
	 */
	public $startIndex;
	/**
	 * @access public
	 * @var integer
	 */
	public $numberResults;

	public function __construct($startIndex = NULL, $numberResults = NULL) {
		if(get_parent_class('Paging')) parent::__construct();
		$this->startIndex = $startIndex;
		$this->numberResults = $numberResults;
	}
}}

if (!class_exists("SoapRequestHeader")) {
/**
 * Defines the required and optional elements within the header of a SOAP request.
 */
class SoapRequestHeader {
	/**
	 * @access public
	 * @var string
	 */
	public $applicationToken;
	/**
	 * @access public
	 * @var string
	 */
	public $authToken;
	/**
	 * @access public
	 * @var string
	 */
	public $clientCustomerId;
	/**
	 * @access public
	 * @var string
	 */
	public $clientEmail;
	/**
	 * @access public
	 * @var string
	 */
	public $developerToken;
	/**
	 * @access public
	 * @var string
	 */
	public $userAgent;
	/**
	 * @access public
	 * @var boolean
	 */
	public $validateOnly;

	public function __construct($applicationToken = NULL, $authToken = NULL, $clientCustomerId = NULL, $clientEmail = NULL, $developerToken = NULL, $userAgent = NULL, $validateOnly = NULL) {
		if(get_parent_class('SoapRequestHeader')) parent::__construct();
		$this->applicationToken = $applicationToken;
		$this->authToken = $authToken;
		$this->clientCustomerId = $clientCustomerId;
		$this->clientEmail = $clientEmail;
		$this->developerToken = $developerToken;
		$this->userAgent = $userAgent;
		$this->validateOnly = $validateOnly;
	}
}}

if (!class_exists("SoapResponseHeader")) {
/**
 * Defines the elements within the header of a SOAP response.
 */
class SoapResponseHeader {
	/**
	 * @access public
	 * @var string
	 */
	public $requestId;
	/**
	 * @access public
	 * @var integer
	 */
	public $operations;
	/**
	 * @access public
	 * @var integer
	 */
	public $responseTime;
	/**
	 * @access public
	 * @var integer
	 */
	public $units;

	public function __construct($requestId = NULL, $operations = NULL, $responseTime = NULL, $units = NULL) {
		if(get_parent_class('SoapResponseHeader')) parent::__construct();
		$this->requestId = $requestId;
		$this->operations = $operations;
		$this->responseTime = $responseTime;
		$this->units = $units;
	}
}}

if (!class_exists("AdExtension")) {
/**
 * Base class for AdExtension objects. An AdExtension is an extension to
 * an existing ad or metadata that will process into an extension.
 * The class is concrete, so ad extensions can be added/removed to campaigns
 * by referring to the id.
 */
class AdExtension {
	/**
	 * @access public
	 * @var integer
	 */
	public $id;
	/**
	 * @access public
	 * @var string
	 */
	public $AdExtensionType;
	private $_parameterMap = array (
		"AdExtension.Type" => "AdExtensionType",
	);

	/**
	 * Provided for setting non-php-standard named variables
	 * @param $var Variable name to set
	 * @param $value Value to set
	 */
	public function __set($var, $value) { $this->{$this->_parameterMap[$var]} = $value; }

	/**
	 * Provided for getting non-php-standard named variables
	 * @param $var Variable name to get.
	 * @return mixed Variable value
	 */
	public function __get($var) {
		if (!array_key_exists($var, $this->_parameterMap)) {
			return NULL;
		} else {
			return $this->{$this->_parameterMap[$var]};
		}
	}

	/**
	 * Provided for getting non-php-standard named variables
	 * @return array parameter map
	 */
	protected function getParameterMap() {
		return $this->_parameterMap;
	}

	public function __construct($id = NULL, $AdExtensionType = NULL) {
		if(get_parent_class('AdExtension')) parent::__construct();
		$this->id = $id;
		$this->AdExtensionType = $AdExtensionType;
	}
}}

if (!class_exists("ApiError")) {
/**
 * A service api error base class that provides error details.
 * 1) the OGNL field path is provided for parsers.
 * 2) the OGNL field path with debug comments easily helps track causes.
 */
class ApiError {
	/**
	 * @access public
	 * @var string
	 */
	public $fieldPath;
	/**
	 * @access public
	 * @var string
	 */
	public $trigger;
	/**
	 * @access public
	 * @var string
	 */
	public $ApiErrorType;
	private $_parameterMap = array (
		"ApiError.Type" => "ApiErrorType",
	);

	/**
	 * Provided for setting non-php-standard named variables
	 * @param $var Variable name to set
	 * @param $value Value to set
	 */
	public function __set($var, $value) { $this->{$this->_parameterMap[$var]} = $value; }

	/**
	 * Provided for getting non-php-standard named variables
	 * @param $var Variable name to get.
	 * @return mixed Variable value
	 */
	public function __get($var) {
		if (!array_key_exists($var, $this->_parameterMap)) {
			return NULL;
		} else {
			return $this->{$this->_parameterMap[$var]};
		}
	}

	/**
	 * Provided for getting non-php-standard named variables
	 * @return array parameter map
	 */
	protected function getParameterMap() {
		return $this->_parameterMap;
	}

	public function __construct($fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('ApiError')) parent::__construct();
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("ApplicationException")) {
/**
 * Base class for exceptions.
 */
class ApplicationException {
	/**
	 * @access public
	 * @var string
	 */
	public $message;
	/**
	 * @access public
	 * @var string
	 */
	public $ApplicationExceptionType;
	private $_parameterMap = array (
		"ApplicationException.Type" => "ApplicationExceptionType",
	);

	/**
	 * Provided for setting non-php-standard named variables
	 * @param $var Variable name to set
	 * @param $value Value to set
	 */
	public function __set($var, $value) { $this->{$this->_parameterMap[$var]} = $value; }

	/**
	 * Provided for getting non-php-standard named variables
	 * @param $var Variable name to get.
	 * @return mixed Variable value
	 */
	public function __get($var) {
		if (!array_key_exists($var, $this->_parameterMap)) {
			return NULL;
		} else {
			return $this->{$this->_parameterMap[$var]};
		}
	}

	/**
	 * Provided for getting non-php-standard named variables
	 * @return array parameter map
	 */
	protected function getParameterMap() {
		return $this->_parameterMap;
	}

	public function __construct($message = NULL, $ApplicationExceptionType = NULL) {
		if(get_parent_class('ApplicationException')) parent::__construct();
		$this->message = $message;
		$this->ApplicationExceptionType = $ApplicationExceptionType;
	}
}}

if (!class_exists("CampaignAdExtension")) {
/**
 * Represents a campaign level ad extension. A campaign ad extension specifies
 * a campaign and an ad extension which can extend any ad under that campaign.
 */
class CampaignAdExtension {
	/**
	 * @access public
	 * @var integer
	 */
	public $campaignId;
	/**
	 * @access public
	 * @var AdExtension
	 */
	public $adExtension;
	/**
	 * @access public
	 * @var tnsCampaignAdExtensionStatus
	 */
	public $status;
	/**
	 * @access public
	 * @var tnsCampaignAdExtensionApprovalStatus
	 */
	public $approvalStatus;

	public function __construct($campaignId = NULL, $adExtension = NULL, $status = NULL, $approvalStatus = NULL) {
		if(get_parent_class('CampaignAdExtension')) parent::__construct();
		$this->campaignId = $campaignId;
		$this->adExtension = $adExtension;
		$this->status = $status;
		$this->approvalStatus = $approvalStatus;
	}
}}

if (!class_exists("CampaignAdExtensionSelector")) {
/**
 * Specifies criteria for selecting a set of CampaignAdExtensions.
 */
class CampaignAdExtensionSelector {
	/**
	 * @access public
	 * @var integer[]
	 */
	public $campaignIds;
	/**
	 * @access public
	 * @var tnsCampaignAdExtensionStatus[]
	 */
	public $statuses;
	/**
	 * @access public
	 * @var Paging
	 */
	public $paging;

	public function __construct($campaignIds = NULL, $statuses = NULL, $paging = NULL) {
		if(get_parent_class('CampaignAdExtensionSelector')) parent::__construct();
		$this->campaignIds = $campaignIds;
		$this->statuses = $statuses;
		$this->paging = $paging;
	}
}}

if (!class_exists("ListReturnValue")) {
/**
 * Base list return value type.
 */
class ListReturnValue {
	/**
	 * @access public
	 * @var string
	 */
	public $ListReturnValueType;
	private $_parameterMap = array (
		"ListReturnValue.Type" => "ListReturnValueType",
	);

	/**
	 * Provided for setting non-php-standard named variables
	 * @param $var Variable name to set
	 * @param $value Value to set
	 */
	public function __set($var, $value) { $this->{$this->_parameterMap[$var]} = $value; }

	/**
	 * Provided for getting non-php-standard named variables
	 * @param $var Variable name to get.
	 * @return mixed Variable value
	 */
	public function __get($var) {
		if (!array_key_exists($var, $this->_parameterMap)) {
			return NULL;
		} else {
			return $this->{$this->_parameterMap[$var]};
		}
	}

	/**
	 * Provided for getting non-php-standard named variables
	 * @return array parameter map
	 */
	protected function getParameterMap() {
		return $this->_parameterMap;
	}

	public function __construct($ListReturnValueType = NULL) {
		if(get_parent_class('ListReturnValue')) parent::__construct();
		$this->ListReturnValueType = $ListReturnValueType;
	}
}}

if (!class_exists("Operation")) {
/**
 * This represents an operation that includes an operator and an operand
 * specified type.
 */
class Operation {
	/**
	 * @access public
	 * @var tnsOperator
	 */
	public $operator;
	/**
	 * @access public
	 * @var string
	 */
	public $OperationType;
	private $_parameterMap = array (
		"Operation.Type" => "OperationType",
	);

	/**
	 * Provided for setting non-php-standard named variables
	 * @param $var Variable name to set
	 * @param $value Value to set
	 */
	public function __set($var, $value) { $this->{$this->_parameterMap[$var]} = $value; }

	/**
	 * Provided for getting non-php-standard named variables
	 * @param $var Variable name to get.
	 * @return mixed Variable value
	 */
	public function __get($var) {
		if (!array_key_exists($var, $this->_parameterMap)) {
			return NULL;
		} else {
			return $this->{$this->_parameterMap[$var]};
		}
	}

	/**
	 * Provided for getting non-php-standard named variables
	 * @return array parameter map
	 */
	protected function getParameterMap() {
		return $this->_parameterMap;
	}

	public function __construct($operator = NULL, $OperationType = NULL) {
		if(get_parent_class('Operation')) parent::__construct();
		$this->operator = $operator;
		$this->OperationType = $OperationType;
	}
}}

if (!class_exists("Page")) {
/**
 * Contains the results from a get call.
 */
class Page {
	/**
	 * @access public
	 * @var integer
	 */
	public $totalNumEntries;
	/**
	 * @access public
	 * @var string
	 */
	public $PageType;
	private $_parameterMap = array (
		"Page.Type" => "PageType",
	);

	/**
	 * Provided for setting non-php-standard named variables
	 * @param $var Variable name to set
	 * @param $value Value to set
	 */
	public function __set($var, $value) { $this->{$this->_parameterMap[$var]} = $value; }

	/**
	 * Provided for getting non-php-standard named variables
	 * @param $var Variable name to get.
	 * @return mixed Variable value
	 */
	public function __get($var) {
		if (!array_key_exists($var, $this->_parameterMap)) {
			return NULL;
		} else {
			return $this->{$this->_parameterMap[$var]};
		}
	}

	/**
	 * Provided for getting non-php-standard named variables
	 * @return array parameter map
	 */
	protected function getParameterMap() {
		return $this->_parameterMap;
	}

	public function __construct($totalNumEntries = NULL, $PageType = NULL) {
		if(get_parent_class('Page')) parent::__construct();
		$this->totalNumEntries = $totalNumEntries;
		$this->PageType = $PageType;
	}
}}

if (!class_exists("AdExtensionErrorReason")) {
/**
 * Cannot have multiple location sync extensions per campaign
 */
class AdExtensionErrorReason {

	public function __construct() {
		if(get_parent_class('AdExtensionErrorReason')) parent::__construct();
	}
}}

if (!class_exists("AuthenticationErrorReason")) {
/**
 * The single reason for the authentication failure.
 */
class AuthenticationErrorReason {

	public function __construct() {
		if(get_parent_class('AuthenticationErrorReason')) parent::__construct();
	}
}}

if (!class_exists("AuthorizationErrorReason")) {
/**
 * The reasons for the database error.
 */
class AuthorizationErrorReason {

	public function __construct() {
		if(get_parent_class('AuthorizationErrorReason')) parent::__construct();
	}
}}

if (!class_exists("CampaignAdExtensionApprovalStatus")) {
/**
 * 
 */
class CampaignAdExtensionApprovalStatus {

	public function __construct() {
		if(get_parent_class('CampaignAdExtensionApprovalStatus')) parent::__construct();
	}
}}

if (!class_exists("CampaignAdExtensionStatus")) {
/**
 * 
 */
class CampaignAdExtensionStatus {

	public function __construct() {
		if(get_parent_class('CampaignAdExtensionStatus')) parent::__construct();
	}
}}

if (!class_exists("CampaignAdExtensionErrorReason")) {
/**
 * Cannot operate on an adextensions under the wrong campaign
 */
class CampaignAdExtensionErrorReason {

	public function __construct() {
		if(get_parent_class('CampaignAdExtensionErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ClientTermsErrorReason")) {
/**
 * Enums for the various reasons an error can be thrown as a result of
 * ClientTerms violation.
 */
class ClientTermsErrorReason {

	public function __construct() {
		if(get_parent_class('ClientTermsErrorReason')) parent::__construct();
	}
}}

if (!class_exists("DatabaseErrorReason")) {
/**
 * The reasons for the database error.
 */
class DatabaseErrorReason {

	public function __construct() {
		if(get_parent_class('DatabaseErrorReason')) parent::__construct();
	}
}}

if (!class_exists("DistinctErrorReason")) {
/**
 * The reasons for the validation error.
 */
class DistinctErrorReason {

	public function __construct() {
		if(get_parent_class('DistinctErrorReason')) parent::__construct();
	}
}}

if (!class_exists("EntityNotFoundReason")) {
/**
 * The specified id refered to an entity which either doesn't exist or is not accessible to the
 * customer. e.g. campaign belongs to another customer.
 */
class EntityNotFoundReason {

	public function __construct() {
		if(get_parent_class('EntityNotFoundReason')) parent::__construct();
	}
}}

if (!class_exists("InternalApiErrorReason")) {
/**
 * The single reason for the internal API error.
 */
class InternalApiErrorReason {

	public function __construct() {
		if(get_parent_class('InternalApiErrorReason')) parent::__construct();
	}
}}

if (!class_exists("LbcListingDataContentCheckStatus")) {
/**
 * 
 */
class LbcListingDataContentCheckStatus {

	public function __construct() {
		if(get_parent_class('LbcListingDataContentCheckStatus')) parent::__construct();
	}
}}

if (!class_exists("LocationExtensionSource")) {
/**
 * From manual entry in adwords frontend
 */
class LocationExtensionSource {

	public function __construct() {
		if(get_parent_class('LocationExtensionSource')) parent::__construct();
	}
}}

if (!class_exists("NotEmptyErrorReason")) {
/**
 * The reasons for the validation error.
 */
class NotEmptyErrorReason {

	public function __construct() {
		if(get_parent_class('NotEmptyErrorReason')) parent::__construct();
	}
}}

if (!class_exists("NotWhitelistedErrorReason")) {
/**
 * The single reason for the whitelist error.
 */
class NotWhitelistedErrorReason {

	public function __construct() {
		if(get_parent_class('NotWhitelistedErrorReason')) parent::__construct();
	}
}}

if (!class_exists("NullErrorReason")) {
/**
 * The reasons for the validation error.
 */
class NullErrorReason {

	public function __construct() {
		if(get_parent_class('NullErrorReason')) parent::__construct();
	}
}}

if (!class_exists("Operator")) {
/**
 * This represents an operator that may be presented to an adsapi service.
 */
class Operator {

	public function __construct() {
		if(get_parent_class('Operator')) parent::__construct();
	}
}}

if (!class_exists("OperatorErrorReason")) {
/**
 * The reasons for the validation error.
 */
class OperatorErrorReason {

	public function __construct() {
		if(get_parent_class('OperatorErrorReason')) parent::__construct();
	}
}}

if (!class_exists("PagingErrorReason")) {
/**
 * The reasons for errors when using pagination.
 */
class PagingErrorReason {

	public function __construct() {
		if(get_parent_class('PagingErrorReason')) parent::__construct();
	}
}}

if (!class_exists("QuotaCheckErrorReason")) {
/**
 * Enums for all the reasons an error can be thrown to the user during
 * billing quota checks.
 */
class QuotaCheckErrorReason {

	public function __construct() {
		if(get_parent_class('QuotaCheckErrorReason')) parent::__construct();
	}
}}

if (!class_exists("QuotaExceededErrorReason")) {
/**
 * The single reason for the quota error.
 */
class QuotaExceededErrorReason {

	public function __construct() {
		if(get_parent_class('QuotaExceededErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ReadOnlyErrorReason")) {
/**
 * The reasons for the target error.
 */
class ReadOnlyErrorReason {

	public function __construct() {
		if(get_parent_class('ReadOnlyErrorReason')) parent::__construct();
	}
}}

if (!class_exists("RequiredErrorReason")) {
/**
 * The reasons for the target error.
 */
class RequiredErrorReason {

	public function __construct() {
		if(get_parent_class('RequiredErrorReason')) parent::__construct();
	}
}}

if (!class_exists("SizeLimitErrorReason")) {
/**
 * The reasons for Ad Scheduling errors.
 */
class SizeLimitErrorReason {

	public function __construct() {
		if(get_parent_class('SizeLimitErrorReason')) parent::__construct();
	}
}}

if (!class_exists("StringLengthErrorReason")) {
/**
 * The reasons for the target error.
 */
class StringLengthErrorReason {

	public function __construct() {
		if(get_parent_class('StringLengthErrorReason')) parent::__construct();
	}
}}

if (!class_exists("CampaignAdExtensionServiceGet")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns a list of CampaignAdExtensions based on a
 * CampaignAdExtensionSelector.
 * @param selector the selector specifying the query
 * @return the page containing the CampaignAdExtensions which meet the
 * criteria specified by the selector
 */
class CampaignAdExtensionServiceGet {
	/**
	 * @access public
	 * @var CampaignAdExtensionSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('CampaignAdExtensionServiceGet')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("CampaignAdExtensionServiceGetResponse")) {
/**
 * 
 */
class CampaignAdExtensionServiceGetResponse {
	/**
	 * @access public
	 * @var CampaignAdExtensionPage
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('CampaignAdExtensionServiceGetResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("CampaignAdExtensionServiceMutate")) {
/**
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 * <span class="constraint DistinctIds">Elements in this field must have distinct IDs for following {@link Operator}s : SET, REMOVE.</span>
 * <span class="constraint NotEmpty">This field must contain at least one element.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint SuppoprtedOperators">The following {@link Operator}s are supported: ADD, REMOVE.</span>
 * 
 * 
 * 
 * Applies the list of mutate operations.
 * @param operations the operations to apply. The same campaign ad extension
 * cannot be specified in more than one operation.
 * @return the applied campaign ad extensions
 */
class CampaignAdExtensionServiceMutate {
	/**
	 * @access public
	 * @var CampaignAdExtensionOperation[]
	 */
	public $operations;

	public function __construct($operations = NULL) {
		if(get_parent_class('CampaignAdExtensionServiceMutate')) parent::__construct();
		$this->operations = $operations;
	}
}}

if (!class_exists("CampaignAdExtensionServiceMutateResponse")) {
/**
 * 
 */
class CampaignAdExtensionServiceMutateResponse {
	/**
	 * @access public
	 * @var CampaignAdExtensionReturnValue
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('CampaignAdExtensionServiceMutateResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AdExtensionError")) {
/**
 * AdExtension errors.
 */
class AdExtensionError extends ApiError {
	/**
	 * @access public
	 * @var tnsAdExtensionErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AdExtensionError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("AuthenticationError")) {
/**
 * 
 */
class AuthenticationError extends ApiError {
	/**
	 * @access public
	 * @var tnsAuthenticationErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AuthenticationError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("AuthorizationError")) {
/**
 * 
 */
class AuthorizationError extends ApiError {
	/**
	 * @access public
	 * @var tnsAuthorizationErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AuthorizationError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("CampaignAdExtensionError")) {
/**
 * CampaignAdExtension errors.
 */
class CampaignAdExtensionError extends ApiError {
	/**
	 * @access public
	 * @var tnsCampaignAdExtensionErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('CampaignAdExtensionError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("ClientTermsError")) {
/**
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class ClientTermsError extends ApiError {
	/**
	 * @access public
	 * @var tnsClientTermsErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('ClientTermsError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("DatabaseError")) {
/**
 * 
 */
class DatabaseError extends ApiError {
	/**
	 * @access public
	 * @var tnsDatabaseErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('DatabaseError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("DistinctError")) {
/**
 * Errors related to distinct ids or content.
 */
class DistinctError extends ApiError {
	/**
	 * @access public
	 * @var tnsDistinctErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('DistinctError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("EntityNotFound")) {
/**
 * An id did not correspond to an entity, or it referred to an entity which does not belong to the
 * customer.
 */
class EntityNotFound extends ApiError {
	/**
	 * @access public
	 * @var tnsEntityNotFoundReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('EntityNotFound')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("InternalApiError")) {
/**
 * Indicates that a server-side error has occured. {@code InternalApiError}s
 * are generally not the result of an invalid request or message sent by the
 * client.
 */
class InternalApiError extends ApiError {
	/**
	 * @access public
	 * @var tnsInternalApiErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('InternalApiError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("LbcListingDataOperation")) {
/**
 * LbcListingData service operation.
 */
class LbcListingDataOperation extends Operation {
	/**
	 * @access public
	 * @var LbcListingData
	 */
	public $operand;

	public function __construct($operand = NULL, $operator = NULL, $OperationType = NULL) {
		if(get_parent_class('LbcListingDataOperation')) parent::__construct();
		$this->operand = $operand;
		$this->operator = $operator;
		$this->OperationType = $OperationType;
	}
}}

if (!class_exists("LocationExtension")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 */
class LocationExtension extends AdExtension {
	/**
	 * @access public
	 * @var Address
	 */
	public $address;
	/**
	 * @access public
	 * @var GeoPoint
	 */
	public $geoPoint;
	/**
	 * @access public
	 * @var base64Binary
	 */
	public $encodedLocation;
	/**
	 * @access public
	 * @var string
	 */
	public $companyName;
	/**
	 * @access public
	 * @var string
	 */
	public $phoneNumber;
	/**
	 * @access public
	 * @var tnsLocationExtensionSource
	 */
	public $source;
	/**
	 * @access public
	 * @var integer
	 */
	public $iconMediaId;
	/**
	 * @access public
	 * @var integer
	 */
	public $imageMediaId;

	public function __construct($address = NULL, $geoPoint = NULL, $encodedLocation = NULL, $companyName = NULL, $phoneNumber = NULL, $source = NULL, $iconMediaId = NULL, $imageMediaId = NULL, $id = NULL, $AdExtensionType = NULL) {
		if(get_parent_class('LocationExtension')) parent::__construct();
		$this->address = $address;
		$this->geoPoint = $geoPoint;
		$this->encodedLocation = $encodedLocation;
		$this->companyName = $companyName;
		$this->phoneNumber = $phoneNumber;
		$this->source = $source;
		$this->iconMediaId = $iconMediaId;
		$this->imageMediaId = $imageMediaId;
		$this->id = $id;
		$this->AdExtensionType = $AdExtensionType;
	}
}}

if (!class_exists("NotEmptyError")) {
/**
 * A list of all errors associated with the @NotEmpty constraints.
 */
class NotEmptyError extends ApiError {
	/**
	 * @access public
	 * @var tnsNotEmptyErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('NotEmptyError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("NotWhitelistedError")) {
/**
 * Indicates that the customer is not whitelisted for accessing the API.
 */
class NotWhitelistedError extends ApiError {
	/**
	 * @access public
	 * @var tnsNotWhitelistedErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('NotWhitelistedError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("NullError")) {
/**
 * Errors associated with contents not null constraint.
 */
class NullError extends ApiError {
	/**
	 * @access public
	 * @var tnsNullErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('NullError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("OperatorError")) {
/**
 * A list of all errors associated with the @SupportedOperators constraints.
 */
class OperatorError extends ApiError {
	/**
	 * @access public
	 * @var tnsOperatorErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('OperatorError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("PagingError")) {
/**
 * Error codes for pagination.
 * See {@link com.google.ads.api.services.common.pagination.Paging}.
 */
class PagingError extends ApiError {
	/**
	 * @access public
	 * @var tnsPagingErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('PagingError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("QuotaCheckError")) {
/**
 * Encapsulates the errors thrown during developer quota checks for webapi
 * calls.
 */
class QuotaCheckError extends ApiError {
	/**
	 * @access public
	 * @var tnsQuotaCheckErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('QuotaCheckError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("QuotaExceededError")) {
/**
 * 
 */
class QuotaExceededError extends ApiError {
	/**
	 * @access public
	 * @var tnsQuotaExceededErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('QuotaExceededError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("ReadOnlyError")) {
/**
 * A list of all errors associated with the @ReadOnly constraint.
 */
class ReadOnlyError extends ApiError {
	/**
	 * @access public
	 * @var tnsReadOnlyErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('ReadOnlyError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("RequiredError")) {
/**
 * Errors due to missing required field.
 */
class RequiredError extends ApiError {
	/**
	 * @access public
	 * @var tnsRequiredErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('RequiredError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("SizeLimitError")) {
/**
 * Indicates that the number of entries in the request or response exceeds the system limit.
 */
class SizeLimitError extends ApiError {
	/**
	 * @access public
	 * @var tnsSizeLimitErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('SizeLimitError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("StringLengthError")) {
/**
 * A list of all errors associated with the @ContentsString constraint.
 */
class StringLengthError extends ApiError {
	/**
	 * @access public
	 * @var tnsStringLengthErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('StringLengthError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("ApiException")) {
/**
 * Exception class for holding a list of service errors.
 */
class ApiException extends ApplicationException {
	/**
	 * @access public
	 * @var ApiError[]
	 */
	public $errors;

	public function __construct($errors = NULL, $message = NULL, $ApplicationExceptionType = NULL) {
		if(get_parent_class('ApiException')) parent::__construct();
		$this->errors = $errors;
		$this->message = $message;
		$this->ApplicationExceptionType = $ApplicationExceptionType;
	}
}}

if (!class_exists("CampaignAdExtensionOperation")) {
/**
 * CampaignAdExtension service operation.
 */
class CampaignAdExtensionOperation extends Operation {
	/**
	 * @access public
	 * @var CampaignAdExtension
	 */
	public $operand;

	public function __construct($operand = NULL, $operator = NULL, $OperationType = NULL) {
		if(get_parent_class('CampaignAdExtensionOperation')) parent::__construct();
		$this->operand = $operand;
		$this->operator = $operator;
		$this->OperationType = $OperationType;
	}
}}

if (!class_exists("CampaignAdExtensionPage")) {
/**
 * Represents a page of {@link CampaignAdExtension}s resulting from the query
 * done by {@link CampaignAdExtensionService}.
 */
class CampaignAdExtensionPage extends Page {
	/**
	 * @access public
	 * @var CampaignAdExtension[]
	 */
	public $entries;

	public function __construct($entries = NULL, $totalNumEntries = NULL, $PageType = NULL) {
		if(get_parent_class('CampaignAdExtensionPage')) parent::__construct();
		$this->entries = $entries;
		$this->totalNumEntries = $totalNumEntries;
		$this->PageType = $PageType;
	}
}}

if (!class_exists("CampaignAdExtensionReturnValue")) {
/**
 * A container for return values from the CampaignAdExtensionService.muate().
 */
class CampaignAdExtensionReturnValue extends ListReturnValue {
	/**
	 * @access public
	 * @var CampaignAdExtension[]
	 */
	public $value;

	public function __construct($value = NULL, $ListReturnValueType = NULL) {
		if(get_parent_class('CampaignAdExtensionReturnValue')) parent::__construct();
		$this->value = $value;
		$this->ListReturnValueType = $ListReturnValueType;
	}
}}

if (!class_exists("CampaignAdExtensionService")) {
/**
 * CampaignAdExtensionService
 * @author WSDLInterpreter
 */
class CampaignAdExtensionService extends AdWordsSoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	public static $classmap = array(
		"getResponse" => "CampaignAdExtensionServiceGetResponse",
		"get" => "CampaignAdExtensionServiceGet",
		"mutate" => "CampaignAdExtensionServiceMutate",
		"mutateResponse" => "CampaignAdExtensionServiceMutateResponse",
		"DateTime" => "AdWordsDateTime",
		"Target" => "AdWordsTarget",
		"SoapHeader" => "SoapRequestHeader",
		"AdExtensionError" => "AdExtensionError",
		"ApiError" => "ApiError",
		"Address" => "Address",
		"AuthenticationError" => "AuthenticationError",
		"AuthorizationError" => "AuthorizationError",
		"CampaignAdExtensionError" => "CampaignAdExtensionError",
		"ClientTermsError" => "ClientTermsError",
		"DatabaseError" => "DatabaseError",
		"DistinctError" => "DistinctError",
		"EntityNotFound" => "EntityNotFound",
		"GeoPoint" => "GeoPoint",
		"InternalApiError" => "InternalApiError",
		"LbcListingData" => "LbcListingData",
		"LbcListingDataOperation" => "LbcListingDataOperation",
		"Operation" => "Operation",
		"LocationExtension" => "LocationExtension",
		"AdExtension" => "AdExtension",
		"NotEmptyError" => "NotEmptyError",
		"NotWhitelistedError" => "NotWhitelistedError",
		"NullError" => "NullError",
		"OperatorError" => "OperatorError",
		"Paging" => "Paging",
		"PagingError" => "PagingError",
		"QuotaCheckError" => "QuotaCheckError",
		"QuotaExceededError" => "QuotaExceededError",
		"ReadOnlyError" => "ReadOnlyError",
		"RequiredError" => "RequiredError",
		"SizeLimitError" => "SizeLimitError",
		"SoapResponseHeader" => "SoapResponseHeader",
		"StringLengthError" => "StringLengthError",
		"ApiException" => "ApiException",
		"ApplicationException" => "ApplicationException",
		"CampaignAdExtension" => "CampaignAdExtension",
		"CampaignAdExtensionOperation" => "CampaignAdExtensionOperation",
		"CampaignAdExtensionPage" => "CampaignAdExtensionPage",
		"Page" => "Page",
		"CampaignAdExtensionReturnValue" => "CampaignAdExtensionReturnValue",
		"ListReturnValue" => "ListReturnValue",
		"CampaignAdExtensionSelector" => "CampaignAdExtensionSelector",
		"AdExtensionError.Reason" => "AdExtensionErrorReason",
		"AuthenticationError.Reason" => "AuthenticationErrorReason",
		"AuthorizationError.Reason" => "AuthorizationErrorReason",
		"CampaignAdExtension.ApprovalStatus" => "CampaignAdExtensionApprovalStatus",
		"CampaignAdExtension.Status" => "CampaignAdExtensionStatus",
		"CampaignAdExtensionError.Reason" => "CampaignAdExtensionErrorReason",
		"ClientTermsError.Reason" => "ClientTermsErrorReason",
		"DatabaseError.Reason" => "DatabaseErrorReason",
		"DistinctError.Reason" => "DistinctErrorReason",
		"EntityNotFound.Reason" => "EntityNotFoundReason",
		"InternalApiError.Reason" => "InternalApiErrorReason",
		"LbcListingData.ContentCheckStatus" => "LbcListingDataContentCheckStatus",
		"LocationExtension.Source" => "LocationExtensionSource",
		"NotEmptyError.Reason" => "NotEmptyErrorReason",
		"NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
		"NullError.Reason" => "NullErrorReason",
		"Operator" => "Operator",
		"OperatorError.Reason" => "OperatorErrorReason",
		"PagingError.Reason" => "PagingErrorReason",
		"QuotaCheckError.Reason" => "QuotaCheckErrorReason",
		"QuotaExceededError.Reason" => "QuotaExceededErrorReason",
		"ReadOnlyError.Reason" => "ReadOnlyErrorReason",
		"RequiredError.Reason" => "RequiredErrorReason",
		"SizeLimitError.Reason" => "SizeLimitErrorReason",
		"StringLengthError.Reason" => "StringLengthErrorReason",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl=null, $options, $user) {
		$options["classmap"] = CampaignAdExtensionService::$classmap;
		parent::__construct($wsdl, $options, $user, 'CampaignAdExtensionService');
	}

	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Returns a list of CampaignAdExtensions based on a
	 * CampaignAdExtensionSelector.
	 * @param selector the selector specifying the query
	 * @return the page containing the CampaignAdExtensions which meet the
	 * criteria specified by the selector
	 */
	public function get($selector) {
		$arg = new CampaignAdExtensionServiceGet($selector);
		$result = $this->__soapCall("get", array($arg));
		return $result->rval;
	}


	/**
	 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
	 * <span class="constraint DistinctIds">Elements in this field must have distinct IDs for following {@link Operator}s : SET, REMOVE.</span>
	 * <span class="constraint NotEmpty">This field must contain at least one element.</span>
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * <span class="constraint SuppoprtedOperators">The following {@link Operator}s are supported: ADD, REMOVE.</span>
	 * 
	 * 
	 * 
	 * Applies the list of mutate operations.
	 * @param operations the operations to apply. The same campaign ad extension
	 * cannot be specified in more than one operation.
	 * @return the applied campaign ad extensions
	 */
	public function mutate($operations) {
		$arg = new CampaignAdExtensionServiceMutate($operations);
		$result = $this->__soapCall("mutate", array($arg));
		return $result->rval;
	}


}}

?>