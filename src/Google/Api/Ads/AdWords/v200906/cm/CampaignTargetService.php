<?php
/**
 * Contains all client objects for the CampaignTargetService service.
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

	public function __construct($applicationToken = NULL, $authToken = NULL, $clientCustomerId = NULL, $clientEmail = NULL, $developerToken = NULL, $userAgent = NULL) {
		if(get_parent_class('SoapRequestHeader')) parent::__construct();
		$this->applicationToken = $applicationToken;
		$this->authToken = $authToken;
		$this->clientCustomerId = $clientCustomerId;
		$this->clientEmail = $clientEmail;
		$this->developerToken = $developerToken;
		$this->userAgent = $userAgent;
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

if (!class_exists("CampaignTargetSelector")) {
/**
 * <span class="constraint ContentsDistinct">This field must contain distinct elements.</span>
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 */
class CampaignTargetSelector {
	/**
	 * @access public
	 * @var integer[]
	 */
	public $campaignIds;

	public function __construct($campaignIds = NULL) {
		if(get_parent_class('CampaignTargetSelector')) parent::__construct();
		$this->campaignIds = $campaignIds;
	}
}}

if (!class_exists("AdWordsTarget")) {
/**
 * Target abstract class.
 */
class AdWordsTarget {
	/**
	 * @access public
	 * @var string
	 */
	public $TargetType;
	private $_parameterMap = array (
		"Target.Type" => "TargetType",
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

	public function __construct($TargetType = NULL) {
		if(get_parent_class('AdWordsTarget')) parent::__construct();
		$this->TargetType = $TargetType;
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

if (!class_exists("TargetList")) {
/**
 * Targets list abstract class (a list of a given type of targets along with their campaign ID).
 */
class TargetList {
	/**
	 * @access public
	 * @var integer
	 */
	public $campaignId;
	/**
	 * @access public
	 * @var string
	 */
	public $TargetListType;
	private $_parameterMap = array (
		"TargetList.Type" => "TargetListType",
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

	public function __construct($campaignId = NULL, $TargetListType = NULL) {
		if(get_parent_class('TargetList')) parent::__construct();
		$this->campaignId = $campaignId;
		$this->TargetListType = $TargetListType;
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

if (!class_exists("AgeTargetAge")) {
/**
 * Age segments.
 */
class AgeTargetAge {

	public function __construct() {
		if(get_parent_class('AgeTargetAge')) parent::__construct();
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

if (!class_exists("BiddingErrorReason")) {
/**
 * Reason for bidding error.
 */
class BiddingErrorReason {

	public function __construct() {
		if(get_parent_class('BiddingErrorReason')) parent::__construct();
	}
}}

if (!class_exists("CampaignErrorReason")) {
/**
 * The reasons for the target error.
 */
class CampaignErrorReason {

	public function __construct() {
		if(get_parent_class('CampaignErrorReason')) parent::__construct();
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

if (!class_exists("DayOfWeek")) {
/**
 * Days of the week.
 */
class DayOfWeek {

	public function __construct() {
		if(get_parent_class('DayOfWeek')) parent::__construct();
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

if (!class_exists("GenderTargetGender")) {
/**
 * Gender segments.
 */
class GenderTargetGender {

	public function __construct() {
		if(get_parent_class('GenderTargetGender')) parent::__construct();
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

if (!class_exists("MinuteOfHour")) {
/**
 * Minutes in an hour.  Currently only 0, 15, 30, and 45 are supported
 */
class MinuteOfHour {

	public function __construct() {
		if(get_parent_class('MinuteOfHour')) parent::__construct();
	}
}}

if (!class_exists("NetworkCoverageType")) {
/**
 * Network coverage types.
 */
class NetworkCoverageType {

	public function __construct() {
		if(get_parent_class('NetworkCoverageType')) parent::__construct();
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

if (!class_exists("OperationAccessDeniedReason")) {
/**
 * The reasons for the operation access error.
 */
class OperationAccessDeniedReason {

	public function __construct() {
		if(get_parent_class('OperationAccessDeniedReason')) parent::__construct();
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

if (!class_exists("PlatformType")) {
/**
 * Platform types.
 */
class PlatformType {

	public function __construct() {
		if(get_parent_class('PlatformType')) parent::__construct();
	}
}}

if (!class_exists("ProximityTargetDistanceUnits")) {
/**
 * The radius distance is expressed in either kilometers or miles.
 */
class ProximityTargetDistanceUnits {

	public function __construct() {
		if(get_parent_class('ProximityTargetDistanceUnits')) parent::__construct();
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

if (!class_exists("QuotaErrorReason")) {
/**
 * The reasons for the quota error.
 */
class QuotaErrorReason {

	public function __construct() {
		if(get_parent_class('QuotaErrorReason')) parent::__construct();
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

if (!class_exists("RangeErrorReason")) {
/**
 * The reasons for the target error.
 */
class RangeErrorReason {

	public function __construct() {
		if(get_parent_class('RangeErrorReason')) parent::__construct();
	}
}}

if (!class_exists("RegionCodeErrorReason")) {
/**
 * The reasons for the validation error.
 */
class RegionCodeErrorReason {

	public function __construct() {
		if(get_parent_class('RegionCodeErrorReason')) parent::__construct();
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

if (!class_exists("TargetErrorReason")) {
/**
 * The reasons for the target error.
 */
class TargetErrorReason {

	public function __construct() {
		if(get_parent_class('TargetErrorReason')) parent::__construct();
	}
}}

if (!class_exists("CampaignTargetServiceGet")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns the targets for each of the campaigns identified in the campaign target selector.
 * @param selector a list of campaigns' ids and optional filter of target types.
 * @return page of lists of the requested campaign targets.
 * @throws ApiException if problems occurred while fetching campaign targeting information.
 */
class CampaignTargetServiceGet {
	/**
	 * @access public
	 * @var CampaignTargetSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('CampaignTargetServiceGet')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("CampaignTargetServiceGetResponse")) {
/**
 * 
 */
class CampaignTargetServiceGetResponse {
	/**
	 * @access public
	 * @var CampaignTargetPage
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('CampaignTargetServiceGetResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("CampaignTargetServiceMutate")) {
/**
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 * <span class="constraint NotEmpty">This field must contain at least one element.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint SuppoprtedOperators">The following {@link Operator}s are supported: SET.</span>
 * 
 * 
 * 
 * Mutates (sets) targets for specified campaign identified in the campaign operations.
 * @param operations list of operations associating targets with campaign ids.
 * @return the added campaign targets, not necessarily in the same order in which they came in.
 * @throws ApiException if problems occurred while adding campaign targeting information.
 */
class CampaignTargetServiceMutate {
	/**
	 * @access public
	 * @var CampaignTargetOperation[]
	 */
	public $operations;

	public function __construct($operations = NULL) {
		if(get_parent_class('CampaignTargetServiceMutate')) parent::__construct();
		$this->operations = $operations;
	}
}}

if (!class_exists("CampaignTargetServiceMutateResponse")) {
/**
 * 
 */
class CampaignTargetServiceMutateResponse {
	/**
	 * @access public
	 * @var CampaignTargetReturnValue
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('CampaignTargetServiceMutateResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AdScheduleTarget")) {
/**
 * Immutable structure to hold an ad schedule target.
 */
class AdScheduleTarget extends AdWordsTarget {
	/**
	 * @access public
	 * @var tnsDayOfWeek
	 */
	public $dayOfWeek;
	/**
	 * @access public
	 * @var integer
	 */
	public $startHour;
	/**
	 * @access public
	 * @var tnsMinuteOfHour
	 */
	public $startMinute;
	/**
	 * @access public
	 * @var integer
	 */
	public $endHour;
	/**
	 * @access public
	 * @var tnsMinuteOfHour
	 */
	public $endMinute;
	/**
	 * @access public
	 * @var double
	 */
	public $bidMultiplier;

	public function __construct($dayOfWeek = NULL, $startHour = NULL, $startMinute = NULL, $endHour = NULL, $endMinute = NULL, $bidMultiplier = NULL, $TargetType = NULL) {
		if(get_parent_class('AdScheduleTarget')) parent::__construct();
		$this->dayOfWeek = $dayOfWeek;
		$this->startHour = $startHour;
		$this->startMinute = $startMinute;
		$this->endHour = $endHour;
		$this->endMinute = $endMinute;
		$this->bidMultiplier = $bidMultiplier;
		$this->TargetType = $TargetType;
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

if (!class_exists("BiddingError")) {
/**
 * Represents bidding errors.
 */
class BiddingError extends ApiError {
	/**
	 * @access public
	 * @var tnsBiddingErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('BiddingError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("CampaignError")) {
/**
 * 
 */
class CampaignError extends ApiError {
	/**
	 * @access public
	 * @var tnsCampaignErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('CampaignError')) parent::__construct();
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

if (!class_exists("LanguageTarget")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint StringLength">This string must not be empty.</span>
 */
class LanguageTarget extends AdWordsTarget {
	/**
	 * @access public
	 * @var string
	 */
	public $languageCode;

	public function __construct($languageCode = NULL, $TargetType = NULL) {
		if(get_parent_class('LanguageTarget')) parent::__construct();
		$this->languageCode = $languageCode;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("NetworkTarget")) {
/**
 * Immutable structure to hold a network coverage target.
 */
class NetworkTarget extends AdWordsTarget {
	/**
	 * @access public
	 * @var tnsNetworkCoverageType
	 */
	public $networkCoverageType;

	public function __construct($networkCoverageType = NULL, $TargetType = NULL) {
		if(get_parent_class('NetworkTarget')) parent::__construct();
		$this->networkCoverageType = $networkCoverageType;
		$this->TargetType = $TargetType;
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

if (!class_exists("OperationAccessDenied")) {
/**
 * Unauthorized access errors as determined by the invoked service's
 * access policy.
 */
class OperationAccessDenied extends ApiError {
	/**
	 * @access public
	 * @var tnsOperationAccessDeniedReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('OperationAccessDenied')) parent::__construct();
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

if (!class_exists("PlatformTarget")) {
/**
 * Immutable structure to hold a platform target.
 */
class PlatformTarget extends AdWordsTarget {
	/**
	 * @access public
	 * @var tnsPlatformType
	 */
	public $platformType;

	public function __construct($platformType = NULL, $TargetType = NULL) {
		if(get_parent_class('PlatformTarget')) parent::__construct();
		$this->platformType = $platformType;
		$this->TargetType = $TargetType;
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

if (!class_exists("QuotaError")) {
/**
 * Errors that are thrown if a quota limit is exceeded.
 */
class QuotaError extends ApiError {
	/**
	 * @access public
	 * @var tnsQuotaErrorReason
	 */
	public $reason;
	/**
	 * @access public
	 * @var integer
	 */
	public $limit;

	public function __construct($reason = NULL, $limit = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('QuotaError')) parent::__construct();
		$this->reason = $reason;
		$this->limit = $limit;
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

if (!class_exists("RangeError")) {
/**
 * A list of all errors associated with the Range constraint.
 */
class RangeError extends ApiError {
	/**
	 * @access public
	 * @var tnsRangeErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('RangeError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("RegionCodeError")) {
/**
 * A list of all errors associated with the @RegionCode constraints.
 */
class RegionCodeError extends ApiError {
	/**
	 * @access public
	 * @var tnsRegionCodeErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('RegionCodeError')) parent::__construct();
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

if (!class_exists("TargetError")) {
/**
 * A list of all the error codes being used by the common targeting package.
 */
class TargetError extends ApiError {
	/**
	 * @access public
	 * @var tnsTargetErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('TargetError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("DemographicTarget")) {
/**
 * Abstract class to identify a demographic target.
 */
class DemographicTarget extends AdWordsTarget {
	/**
	 * @access public
	 * @var integer
	 */
	public $bidModifier;

	public function __construct($bidModifier = NULL, $TargetType = NULL) {
		if(get_parent_class('DemographicTarget')) parent::__construct();
		$this->bidModifier = $bidModifier;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("GeoTarget")) {
/**
 * Abstract class to identify a geographic target.
 */
class GeoTarget extends AdWordsTarget {
	/**
	 * @access public
	 * @var boolean
	 */
	public $excluded;

	public function __construct($excluded = NULL, $TargetType = NULL) {
		if(get_parent_class('GeoTarget')) parent::__construct();
		$this->excluded = $excluded;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("AdScheduleTargetList")) {
/**
 * List of ad schedule targets.
 */
class AdScheduleTargetList extends TargetList {
	/**
	 * @access public
	 * @var AdScheduleTarget[]
	 */
	public $targets;

	public function __construct($targets = NULL, $campaignId = NULL, $TargetListType = NULL) {
		if(get_parent_class('AdScheduleTargetList')) parent::__construct();
		$this->targets = $targets;
		$this->campaignId = $campaignId;
		$this->TargetListType = $TargetListType;
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

if (!class_exists("DemographicTargetList")) {
/**
 * List of demographic targets.
 */
class DemographicTargetList extends TargetList {
	/**
	 * @access public
	 * @var DemographicTarget[]
	 */
	public $targets;

	public function __construct($targets = NULL, $campaignId = NULL, $TargetListType = NULL) {
		if(get_parent_class('DemographicTargetList')) parent::__construct();
		$this->targets = $targets;
		$this->campaignId = $campaignId;
		$this->TargetListType = $TargetListType;
	}
}}

if (!class_exists("GeoTargetList")) {
/**
 * List of geographic targets.
 */
class GeoTargetList extends TargetList {
	/**
	 * @access public
	 * @var GeoTarget[]
	 */
	public $targets;

	public function __construct($targets = NULL, $campaignId = NULL, $TargetListType = NULL) {
		if(get_parent_class('GeoTargetList')) parent::__construct();
		$this->targets = $targets;
		$this->campaignId = $campaignId;
		$this->TargetListType = $TargetListType;
	}
}}

if (!class_exists("LanguageTargetList")) {
/**
 * List of language targets.
 */
class LanguageTargetList extends TargetList {
	/**
	 * @access public
	 * @var LanguageTarget[]
	 */
	public $targets;

	public function __construct($targets = NULL, $campaignId = NULL, $TargetListType = NULL) {
		if(get_parent_class('LanguageTargetList')) parent::__construct();
		$this->targets = $targets;
		$this->campaignId = $campaignId;
		$this->TargetListType = $TargetListType;
	}
}}

if (!class_exists("NetworkTargetList")) {
/**
 * List of network targets.
 */
class NetworkTargetList extends TargetList {
	/**
	 * @access public
	 * @var NetworkTarget[]
	 */
	public $targets;

	public function __construct($targets = NULL, $campaignId = NULL, $TargetListType = NULL) {
		if(get_parent_class('NetworkTargetList')) parent::__construct();
		$this->targets = $targets;
		$this->campaignId = $campaignId;
		$this->TargetListType = $TargetListType;
	}
}}

if (!class_exists("PlatformTargetList")) {
/**
 * List of platform targets.
 */
class PlatformTargetList extends TargetList {
	/**
	 * @access public
	 * @var PlatformTarget[]
	 */
	public $targets;

	public function __construct($targets = NULL, $campaignId = NULL, $TargetListType = NULL) {
		if(get_parent_class('PlatformTargetList')) parent::__construct();
		$this->targets = $targets;
		$this->campaignId = $campaignId;
		$this->TargetListType = $TargetListType;
	}
}}

if (!class_exists("CampaignTargetOperation")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 */
class CampaignTargetOperation extends Operation {
	/**
	 * @access public
	 * @var TargetList
	 */
	public $operand;

	public function __construct($operand = NULL, $operator = NULL, $OperationType = NULL) {
		if(get_parent_class('CampaignTargetOperation')) parent::__construct();
		$this->operand = $operand;
		$this->operator = $operator;
		$this->OperationType = $OperationType;
	}
}}

if (!class_exists("CampaignTargetPage")) {
/**
 * Contains a subset of campaign targets resulting from the filtering and paging of the
 * {@link CampaignTargetService#get} call.
 */
class CampaignTargetPage extends Page {
	/**
	 * @access public
	 * @var TargetList[]
	 */
	public $entries;

	public function __construct($entries = NULL, $totalNumEntries = NULL, $PageType = NULL) {
		if(get_parent_class('CampaignTargetPage')) parent::__construct();
		$this->entries = $entries;
		$this->totalNumEntries = $totalNumEntries;
		$this->PageType = $PageType;
	}
}}

if (!class_exists("CampaignTargetReturnValue")) {
/**
 * A container for return values from the {@link CampaignTargetService#mutate(java.util.List)}.
 */
class CampaignTargetReturnValue extends ListReturnValue {
	/**
	 * @access public
	 * @var TargetList[]
	 */
	public $value;

	public function __construct($value = NULL, $ListReturnValueType = NULL) {
		if(get_parent_class('CampaignTargetReturnValue')) parent::__construct();
		$this->value = $value;
		$this->ListReturnValueType = $ListReturnValueType;
	}
}}

if (!class_exists("AgeTarget")) {
/**
 * Immutable structure to hold an age target.
 */
class AgeTarget extends DemographicTarget {
	/**
	 * @access public
	 * @var tnsAgeTargetAge
	 */
	public $age;

	public function __construct($age = NULL, $bidModifier = NULL, $TargetType = NULL) {
		if(get_parent_class('AgeTarget')) parent::__construct();
		$this->age = $age;
		$this->bidModifier = $bidModifier;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("CityTarget")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint StringLength">This string must not be empty.</span>
 */
class CityTarget extends GeoTarget {
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
	public $countryCode;

	public function __construct($cityName = NULL, $provinceCode = NULL, $countryCode = NULL, $excluded = NULL, $TargetType = NULL) {
		if(get_parent_class('CityTarget')) parent::__construct();
		$this->cityName = $cityName;
		$this->provinceCode = $provinceCode;
		$this->countryCode = $countryCode;
		$this->excluded = $excluded;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("CountryTarget")) {
/**
 * Immutable structure to specify a geographic target for a country.
 */
class CountryTarget extends GeoTarget {
	/**
	 * @access public
	 * @var string
	 */
	public $countryCode;

	public function __construct($countryCode = NULL, $excluded = NULL, $TargetType = NULL) {
		if(get_parent_class('CountryTarget')) parent::__construct();
		$this->countryCode = $countryCode;
		$this->excluded = $excluded;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("GenderTarget")) {
/**
 * Immutable structure to hold a gender target.
 */
class GenderTarget extends DemographicTarget {
	/**
	 * @access public
	 * @var tnsGenderTargetGender
	 */
	public $gender;

	public function __construct($gender = NULL, $bidModifier = NULL, $TargetType = NULL) {
		if(get_parent_class('GenderTarget')) parent::__construct();
		$this->gender = $gender;
		$this->bidModifier = $bidModifier;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("MetroTarget")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint StringLength">This string must not be empty.</span>
 */
class MetroTarget extends GeoTarget {
	/**
	 * @access public
	 * @var string
	 */
	public $metroCode;

	public function __construct($metroCode = NULL, $excluded = NULL, $TargetType = NULL) {
		if(get_parent_class('MetroTarget')) parent::__construct();
		$this->metroCode = $metroCode;
		$this->excluded = $excluded;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("PolygonTarget")) {
/**
 * Structure to specify a geographic target for a polygon location.
 * 
 * This polygon target consists of a list of vertices;
 * each vertex is a geo point defined by a latitude and longitude.
 */
class PolygonTarget extends GeoTarget {
	/**
	 * @access public
	 * @var GeoPoint[]
	 */
	public $vertices;

	public function __construct($vertices = NULL, $excluded = NULL, $TargetType = NULL) {
		if(get_parent_class('PolygonTarget')) parent::__construct();
		$this->vertices = $vertices;
		$this->excluded = $excluded;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("ProvinceTarget")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint StringLength">This string must not be empty.</span>
 */
class ProvinceTarget extends GeoTarget {
	/**
	 * @access public
	 * @var string
	 */
	public $provinceCode;

	public function __construct($provinceCode = NULL, $excluded = NULL, $TargetType = NULL) {
		if(get_parent_class('ProvinceTarget')) parent::__construct();
		$this->provinceCode = $provinceCode;
		$this->excluded = $excluded;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("ProximityTarget")) {
/**
 * Structure to specify a geographic target for a proximity location.
 * 
 * This proximity target doesn't support taking in an address location in place of a lat/long,
 * geocoding it, and creating a proximity target for the campaign like AWFE does.
 * The caller must ensure the address fields are valid and consistent with the supplied lat/long.
 */
class ProximityTarget extends GeoTarget {
	/**
	 * @access public
	 * @var GeoPoint
	 */
	public $geoPoint;
	/**
	 * @access public
	 * @var tnsProximityTargetDistanceUnits
	 */
	public $radiusDistanceUnits;
	/**
	 * @access public
	 * @var double
	 */
	public $radiusInUnits;
	/**
	 * @access public
	 * @var Address
	 */
	public $address;
	/**
	 * @access public
	 * @var boolean
	 */
	public $allowServiceOfAddress;

	public function __construct($geoPoint = NULL, $radiusDistanceUnits = NULL, $radiusInUnits = NULL, $address = NULL, $allowServiceOfAddress = NULL, $excluded = NULL, $TargetType = NULL) {
		if(get_parent_class('ProximityTarget')) parent::__construct();
		$this->geoPoint = $geoPoint;
		$this->radiusDistanceUnits = $radiusDistanceUnits;
		$this->radiusInUnits = $radiusInUnits;
		$this->address = $address;
		$this->allowServiceOfAddress = $allowServiceOfAddress;
		$this->excluded = $excluded;
		$this->TargetType = $TargetType;
	}
}}

if (!class_exists("CampaignTargetService")) {
/**
 * CampaignTargetService
 * @author WSDLInterpreter
 */
class CampaignTargetService extends AdWordsSoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	public static $classmap = array(
		"getResponse" => "CampaignTargetServiceGetResponse",
		"get" => "CampaignTargetServiceGet",
		"mutate" => "CampaignTargetServiceMutate",
		"mutateResponse" => "CampaignTargetServiceMutateResponse",
		"DateTime" => "AdWordsDateTime",
		"Target" => "AdWordsTarget",
		"SoapHeader" => "SoapRequestHeader",
		"AdScheduleTarget" => "AdScheduleTarget",
		"Address" => "Address",
		"AgeTarget" => "AgeTarget",
		"DemographicTarget" => "DemographicTarget",
		"AuthenticationError" => "AuthenticationError",
		"ApiError" => "ApiError",
		"AuthorizationError" => "AuthorizationError",
		"BiddingError" => "BiddingError",
		"CampaignError" => "CampaignError",
		"CityTarget" => "CityTarget",
		"GeoTarget" => "GeoTarget",
		"ClientTermsError" => "ClientTermsError",
		"CountryTarget" => "CountryTarget",
		"DatabaseError" => "DatabaseError",
		"DistinctError" => "DistinctError",
		"EntityNotFound" => "EntityNotFound",
		"GenderTarget" => "GenderTarget",
		"GeoPoint" => "GeoPoint",
		"InternalApiError" => "InternalApiError",
		"LanguageTarget" => "LanguageTarget",
		"MetroTarget" => "MetroTarget",
		"NetworkTarget" => "NetworkTarget",
		"NotEmptyError" => "NotEmptyError",
		"NotWhitelistedError" => "NotWhitelistedError",
		"NullError" => "NullError",
		"OperationAccessDenied" => "OperationAccessDenied",
		"OperatorError" => "OperatorError",
		"PlatformTarget" => "PlatformTarget",
		"PolygonTarget" => "PolygonTarget",
		"ProvinceTarget" => "ProvinceTarget",
		"ProximityTarget" => "ProximityTarget",
		"QuotaCheckError" => "QuotaCheckError",
		"QuotaError" => "QuotaError",
		"QuotaExceededError" => "QuotaExceededError",
		"RangeError" => "RangeError",
		"RegionCodeError" => "RegionCodeError",
		"RequiredError" => "RequiredError",
		"SizeLimitError" => "SizeLimitError",
		"SoapResponseHeader" => "SoapResponseHeader",
		"StringLengthError" => "StringLengthError",
		"TargetError" => "TargetError",
		"CampaignTargetSelector" => "CampaignTargetSelector",
		"AdScheduleTargetList" => "AdScheduleTargetList",
		"TargetList" => "TargetList",
		"ApiException" => "ApiException",
		"ApplicationException" => "ApplicationException",
		"DemographicTargetList" => "DemographicTargetList",
		"GeoTargetList" => "GeoTargetList",
		"LanguageTargetList" => "LanguageTargetList",
		"NetworkTargetList" => "NetworkTargetList",
		"PlatformTargetList" => "PlatformTargetList",
		"CampaignTargetOperation" => "CampaignTargetOperation",
		"Operation" => "Operation",
		"CampaignTargetPage" => "CampaignTargetPage",
		"Page" => "Page",
		"CampaignTargetReturnValue" => "CampaignTargetReturnValue",
		"ListReturnValue" => "ListReturnValue",
		"AgeTarget.Age" => "AgeTargetAge",
		"AuthenticationError.Reason" => "AuthenticationErrorReason",
		"AuthorizationError.Reason" => "AuthorizationErrorReason",
		"BiddingError.Reason" => "BiddingErrorReason",
		"CampaignError.Reason" => "CampaignErrorReason",
		"ClientTermsError.Reason" => "ClientTermsErrorReason",
		"DatabaseError.Reason" => "DatabaseErrorReason",
		"DayOfWeek" => "DayOfWeek",
		"DistinctError.Reason" => "DistinctErrorReason",
		"EntityNotFound.Reason" => "EntityNotFoundReason",
		"GenderTarget.Gender" => "GenderTargetGender",
		"InternalApiError.Reason" => "InternalApiErrorReason",
		"MinuteOfHour" => "MinuteOfHour",
		"NetworkCoverageType" => "NetworkCoverageType",
		"NotEmptyError.Reason" => "NotEmptyErrorReason",
		"NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
		"NullError.Reason" => "NullErrorReason",
		"OperationAccessDenied.Reason" => "OperationAccessDeniedReason",
		"Operator" => "Operator",
		"OperatorError.Reason" => "OperatorErrorReason",
		"PlatformType" => "PlatformType",
		"ProximityTarget.DistanceUnits" => "ProximityTargetDistanceUnits",
		"QuotaCheckError.Reason" => "QuotaCheckErrorReason",
		"QuotaError.Reason" => "QuotaErrorReason",
		"QuotaExceededError.Reason" => "QuotaExceededErrorReason",
		"RangeError.Reason" => "RangeErrorReason",
		"RegionCodeError.Reason" => "RegionCodeErrorReason",
		"RequiredError.Reason" => "RequiredErrorReason",
		"SizeLimitError.Reason" => "SizeLimitErrorReason",
		"StringLengthError.Reason" => "StringLengthErrorReason",
		"TargetError.Reason" => "TargetErrorReason",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl=null, $options, $user) {
		$options["classmap"] = CampaignTargetService::$classmap;
		parent::__construct($wsdl, $options, $user, 'CampaignTargetService');
	}

	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Returns the targets for each of the campaigns identified in the campaign target selector.
	 * @param selector a list of campaigns' ids and optional filter of target types.
	 * @return page of lists of the requested campaign targets.
	 * @throws ApiException if problems occurred while fetching campaign targeting information.
	 */
	public function get($selector) {
		$arg = new CampaignTargetServiceGet($selector);
		$result = $this->__soapCall("get", array($arg));
		return $result->rval;
	}


	/**
	 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
	 * <span class="constraint NotEmpty">This field must contain at least one element.</span>
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * <span class="constraint SuppoprtedOperators">The following {@link Operator}s are supported: SET.</span>
	 * 
	 * 
	 * 
	 * Mutates (sets) targets for specified campaign identified in the campaign operations.
	 * @param operations list of operations associating targets with campaign ids.
	 * @return the added campaign targets, not necessarily in the same order in which they came in.
	 * @throws ApiException if problems occurred while adding campaign targeting information.
	 */
	public function mutate($operations) {
		$arg = new CampaignTargetServiceMutate($operations);
		$result = $this->__soapCall("mutate", array($arg));
		return $result->rval;
	}


}}

?>