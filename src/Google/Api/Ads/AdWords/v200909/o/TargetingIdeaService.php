<?php
/**
 * Contains all client objects for the TargetingIdeaService service.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("Paging")) {
/**
 * Specifies what kind of paging wanted for the result of a get.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("ComparableValue")) {
/**
 * Comparable types for constructing ranges with.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class ComparableValue {
	/**
	 * @access public
	 * @var string
	 */
	public $ComparableValueType;
	private $_parameterMap = array (
		"ComparableValue.Type" => "ComparableValueType",
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

	public function __construct($ComparableValueType = NULL) {
		if(get_parent_class('ComparableValue')) parent::__construct();
		$this->ComparableValueType = $ComparableValueType;
	}
}}

if (!class_exists("Criterion")) {
/**
 * <span class="constraint ReadOnly">This field is read only and should not be set for following {@link Operator}s : ADD.</span>
 * <span class="constraint Required">This field is required and should not be {@code null} when it is contained within {@link Operator}s : SET, REMOVE.</span>
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class Criterion {
	/**
	 * @access public
	 * @var integer
	 */
	public $id;
	/**
	 * @access public
	 * @var string
	 */
	public $CriterionType;
	private $_parameterMap = array (
		"Criterion.Type" => "CriterionType",
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

	public function __construct($id = NULL, $CriterionType = NULL) {
		if(get_parent_class('Criterion')) parent::__construct();
		$this->id = $id;
		$this->CriterionType = $CriterionType;
	}
}}

if (!class_exists("AdWordsTarget")) {
/**
 * Target abstract class.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("AgeTargetAge")) {
/**
 * Age segments.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class AgeTargetAge {

	public function __construct() {
		if(get_parent_class('AgeTargetAge')) parent::__construct();
	}
}}

if (!class_exists("AuthenticationErrorReason")) {
/**
 * The single reason for the authentication failure.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class AuthenticationErrorReason {

	public function __construct() {
		if(get_parent_class('AuthenticationErrorReason')) parent::__construct();
	}
}}

if (!class_exists("AuthorizationErrorReason")) {
/**
 * The reasons for the database error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class AuthorizationErrorReason {

	public function __construct() {
		if(get_parent_class('AuthorizationErrorReason')) parent::__construct();
	}
}}

if (!class_exists("BiddingErrorReason")) {
/**
 * Reason for bidding error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class BiddingErrorReason {

	public function __construct() {
		if(get_parent_class('BiddingErrorReason')) parent::__construct();
	}
}}

if (!class_exists("BudgetErrorReason")) {
/**
 * The reasons for the budget error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class BudgetErrorReason {

	public function __construct() {
		if(get_parent_class('BudgetErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ClientTermsErrorReason")) {
/**
 * Enums for the various reasons an error can be thrown as a result of
 * ClientTerms violation.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class ClientTermsErrorReason {

	public function __construct() {
		if(get_parent_class('ClientTermsErrorReason')) parent::__construct();
	}
}}

if (!class_exists("DatabaseErrorReason")) {
/**
 * The reasons for the database error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class DatabaseErrorReason {

	public function __construct() {
		if(get_parent_class('DatabaseErrorReason')) parent::__construct();
	}
}}

if (!class_exists("DateErrorReason")) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class DateErrorReason {

	public function __construct() {
		if(get_parent_class('DateErrorReason')) parent::__construct();
	}
}}

if (!class_exists("DayOfWeek")) {
/**
 * Days of the week.
 * 
 * 
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class DayOfWeek {

	public function __construct() {
		if(get_parent_class('DayOfWeek')) parent::__construct();
	}
}}

if (!class_exists("DistinctErrorReason")) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class EntityNotFoundReason {

	public function __construct() {
		if(get_parent_class('EntityNotFoundReason')) parent::__construct();
	}
}}

if (!class_exists("GenderTargetGender")) {
/**
 * Gender segments.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class GenderTargetGender {

	public function __construct() {
		if(get_parent_class('GenderTargetGender')) parent::__construct();
	}
}}

if (!class_exists("InternalApiErrorReason")) {
/**
 * The single reason for the internal API error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class InternalApiErrorReason {

	public function __construct() {
		if(get_parent_class('InternalApiErrorReason')) parent::__construct();
	}
}}

if (!class_exists("KeywordMatchType")) {
/**
 * Match type of a keyword. i.e. the way we match a keyword string with
 * search queries.
 * 
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class KeywordMatchType {

	public function __construct() {
		if(get_parent_class('KeywordMatchType')) parent::__construct();
	}
}}

if (!class_exists("MinuteOfHour")) {
/**
 * Minutes in an hour.  Currently only 0, 15, 30, and 45 are supported
 * 
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class MinuteOfHour {

	public function __construct() {
		if(get_parent_class('MinuteOfHour')) parent::__construct();
	}
}}

if (!class_exists("NetworkCoverageType")) {
/**
 * Network coverage types.
 * 
 * 
 * 
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class NetworkCoverageType {

	public function __construct() {
		if(get_parent_class('NetworkCoverageType')) parent::__construct();
	}
}}

if (!class_exists("NotEmptyErrorReason")) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class NotEmptyErrorReason {

	public function __construct() {
		if(get_parent_class('NotEmptyErrorReason')) parent::__construct();
	}
}}

if (!class_exists("NotWhitelistedErrorReason")) {
/**
 * The single reason for the whitelist error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class NotWhitelistedErrorReason {

	public function __construct() {
		if(get_parent_class('NotWhitelistedErrorReason')) parent::__construct();
	}
}}

if (!class_exists("NullErrorReason")) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class NullErrorReason {

	public function __construct() {
		if(get_parent_class('NullErrorReason')) parent::__construct();
	}
}}

if (!class_exists("PlatformType")) {
/**
 * Platform types.
 * 
 * 
 * 
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class PlatformType {

	public function __construct() {
		if(get_parent_class('PlatformType')) parent::__construct();
	}
}}

if (!class_exists("ProximityTargetDistanceUnits")) {
/**
 * The radius distance is expressed in either kilometers or miles.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class QuotaCheckErrorReason {

	public function __construct() {
		if(get_parent_class('QuotaCheckErrorReason')) parent::__construct();
	}
}}

if (!class_exists("QuotaExceededErrorReason")) {
/**
 * The single reason for the quota error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class QuotaExceededErrorReason {

	public function __construct() {
		if(get_parent_class('QuotaExceededErrorReason')) parent::__construct();
	}
}}

if (!class_exists("RangeErrorReason")) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class RangeErrorReason {

	public function __construct() {
		if(get_parent_class('RangeErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ReadOnlyErrorReason")) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class ReadOnlyErrorReason {

	public function __construct() {
		if(get_parent_class('ReadOnlyErrorReason')) parent::__construct();
	}
}}

if (!class_exists("RequiredErrorReason")) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class RequiredErrorReason {

	public function __construct() {
		if(get_parent_class('RequiredErrorReason')) parent::__construct();
	}
}}

if (!class_exists("SizeLimitErrorReason")) {
/**
 * The reasons for Ad Scheduling errors.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class SizeLimitErrorReason {

	public function __construct() {
		if(get_parent_class('SizeLimitErrorReason')) parent::__construct();
	}
}}

if (!class_exists("StatsQueryErrorReason")) {
/**
 * The reasons for errors when querying for stats.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class StatsQueryErrorReason {

	public function __construct() {
		if(get_parent_class('StatsQueryErrorReason')) parent::__construct();
	}
}}

if (!class_exists("StringLengthErrorReason")) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class StringLengthErrorReason {

	public function __construct() {
		if(get_parent_class('StringLengthErrorReason')) parent::__construct();
	}
}}

if (!class_exists("AdFormatSpec")) {
/**
 * A placement response object which provides information about one of the ad formats
 * supported by a placement.
 */
class AdFormatSpec {
	/**
	 * @access public
	 * @var tnsSiteConstantsAdFormat
	 */
	public $format;

	public function __construct($format = NULL) {
		if(get_parent_class('AdFormatSpec')) parent::__construct();
		$this->format = $format;
	}
}}

if (!class_exists("Attribute")) {
/**
 * {@link Attribute}s encompass the core information about a particular
 * {@link com.google.ads.api.services.targetingideas.TargetingIdea}. Some
 * attributes are for {@code KEYWORD} {@link IdeaType}s, some are for
 * {@code PLACEMENT} {@link IdeaType}s, and some are for both. Ultimately, an
 * {@link Attribute} instance simply wraps an actual value of interest. For
 * example, {@link KeywordAttribute} wraps the keyword itself, while a
 * {@link BooleanAttribute} simply wraps a boolean describing some information
 * about the keyword idea.
 */
class Attribute {
	/**
	 * @access public
	 * @var string
	 */
	public $AttributeType;
	private $_parameterMap = array (
		"Attribute.Type" => "AttributeType",
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

	public function __construct($AttributeType = NULL) {
		if(get_parent_class('Attribute')) parent::__construct();
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("BooleanAttribute")) {
/**
 * {@link Attribute} type that contains a boolean value.
 */
class BooleanAttribute extends Attribute {
	/**
	 * @access public
	 * @var boolean
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('BooleanAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("CollectionSizeError")) {
/**
 * A list of all errors associated with the @ContentsSize constraint.
 */
class CollectionSizeError extends ApiError {
	/**
	 * @access public
	 * @var tnsCollectionSizeErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('CollectionSizeError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("DoubleAttribute")) {
/**
 * {@link Attribute} type that contains a double value.
 */
class DoubleAttribute extends Attribute {
	/**
	 * @access public
	 * @var double
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('DoubleAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("IdeaTypeAttribute")) {
/**
 * {@link Attribute} type that contains an {@link IdeaType} value. For example,
 * if a {@link com.google.ads.api.services.targetingideas.TargetingIdea}
 * represents a keyword idea, its {@link IdeaTypeAttribute} would contain a
 * {@code KEYWORD} {@link IdeaType}.
 */
class IdeaTypeAttribute extends Attribute {
	/**
	 * @access public
	 * @var tnsIdeaType
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('IdeaTypeAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("InStreamAdInfo")) {
/**
 * Information specific to the instream ad format. Instream ads are video ads
 * which play as part of the delivery of video content, either before, during,
 * or after the content itself.
 */
class InStreamAdInfo {
	/**
	 * @access public
	 * @var integer
	 */
	public $maxAdDuration;
	/**
	 * @access public
	 * @var integer
	 */
	public $minAdDuration;
	/**
	 * @access public
	 * @var integer
	 */
	public $medianAdDuration;
	/**
	 * @access public
	 * @var double
	 */
	public $preRollPercent;
	/**
	 * @access public
	 * @var double
	 */
	public $midRollPercent;
	/**
	 * @access public
	 * @var double
	 */
	public $postRollPercent;

	public function __construct($maxAdDuration = NULL, $minAdDuration = NULL, $medianAdDuration = NULL, $preRollPercent = NULL, $midRollPercent = NULL, $postRollPercent = NULL) {
		if(get_parent_class('InStreamAdInfo')) parent::__construct();
		$this->maxAdDuration = $maxAdDuration;
		$this->minAdDuration = $minAdDuration;
		$this->medianAdDuration = $medianAdDuration;
		$this->preRollPercent = $preRollPercent;
		$this->midRollPercent = $midRollPercent;
		$this->postRollPercent = $postRollPercent;
	}
}}

if (!class_exists("InStreamAdInfoAttribute")) {
/**
 * {@link Attribute} type that contains an {@link InStreamAdInfo} value.
 */
class InStreamAdInfoAttribute extends Attribute {
	/**
	 * @access public
	 * @var InStreamAdInfo
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('InStreamAdInfoAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("IntegerAttribute")) {
/**
 * {@link Attribute} type that contains an integer value.
 */
class IntegerAttribute extends Attribute {
	/**
	 * @access public
	 * @var integer
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('IntegerAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("IntegerSetAttribute")) {
/**
 * {@link Attribute} type that contains a Set of integer values.
 */
class IntegerSetAttribute extends Attribute {
	/**
	 * @access public
	 * @var integer[]
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('IntegerSetAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("KeywordAttribute")) {
/**
 * {@link Attribute} type that contains a {@link Keyword} value.
 */
class KeywordAttribute extends Attribute {
	/**
	 * @access public
	 * @var Keyword
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('KeywordAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("LongAttribute")) {
/**
 * {@link Attribute} type that contains a long value.
 */
class LongAttribute extends Attribute {
	/**
	 * @access public
	 * @var integer
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('LongAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("LongComparisonOperation")) {
/**
 * <span class="constraint ContentsDistinct">This field must contain distinct elements.</span>
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 */
class LongComparisonOperation {
	/**
	 * @access public
	 * @var integer
	 */
	public $minimum;
	/**
	 * @access public
	 * @var integer
	 */
	public $maximum;
	/**
	 * @access public
	 * @var integer[]
	 */
	public $excludes;

	public function __construct($minimum = NULL, $maximum = NULL, $excludes = NULL) {
		if(get_parent_class('LongComparisonOperation')) parent::__construct();
		$this->minimum = $minimum;
		$this->maximum = $maximum;
		$this->excludes = $excludes;
	}
}}

if (!class_exists("LongRangeAttribute")) {
/**
 * {@link Attribute} type that contains a {@link Range} of {@link LongValue}
 * values.
 */
class LongRangeAttribute extends Attribute {
	/**
	 * @access public
	 * @var Range
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('LongRangeAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("MoneyAttribute")) {
/**
 * {@link Attribute} type that contains a {@link Money} value.
 */
class MoneyAttribute extends Attribute {
	/**
	 * @access public
	 * @var Money
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('MoneyAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("MonthlySearchVolume")) {
/**
 * A keyword response value representing search volume for a single month. An
 * instance with a {@code null} count is valid, indicating that the information
 * is unavailable.
 */
class MonthlySearchVolume {
	/**
	 * @access public
	 * @var integer
	 */
	public $year;
	/**
	 * @access public
	 * @var integer
	 */
	public $month;
	/**
	 * @access public
	 * @var integer
	 */
	public $count;

	public function __construct($year = NULL, $month = NULL, $count = NULL) {
		if(get_parent_class('MonthlySearchVolume')) parent::__construct();
		$this->year = $year;
		$this->month = $month;
		$this->count = $count;
	}
}}

if (!class_exists("MonthlySearchVolumeAttribute")) {
/**
 * {@link Attribute} type that contains a list of {@link MonthlySearchVolume}
 * values. The list contains the past 12 {@link MonthlySearchVolume}s
 * (excluding the current month). The first item is the data for the most
 * recent month and the last item is the data for the oldest month.
 */
class MonthlySearchVolumeAttribute extends Attribute {
	/**
	 * @access public
	 * @var MonthlySearchVolume[]
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('MonthlySearchVolumeAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("PlacementAttribute")) {
/**
 * {@link Attribute} type that contains a {@link Placement} value.
 */
class PlacementAttribute extends Attribute {
	/**
	 * @access public
	 * @var Placement
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('PlacementAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("PlacementTypeAttribute")) {
/**
 * {@link Attribute} type that contains a {@link PlacementType} value.
 */
class PlacementTypeAttribute extends Attribute {
	/**
	 * @access public
	 * @var tnsSiteConstantsPlacementType
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('PlacementTypeAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("Range")) {
/**
 * Represents a range of values that has either an upper or a lower bound.
 */
class Range {
	/**
	 * @access public
	 * @var ComparableValue
	 */
	public $min;
	/**
	 * @access public
	 * @var ComparableValue
	 */
	public $max;

	public function __construct($min = NULL, $max = NULL) {
		if(get_parent_class('Range')) parent::__construct();
		$this->min = $min;
		$this->max = $max;
	}
}}

if (!class_exists("SearchParameter")) {
/**
 * A set of {@link SearchParameter}s are supplied to the
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector}
 * to specify how the user wants to filter the set of all possible
 * {@link TargetingIdea}s.
 * 
 * There is a {@link SearchParameter} for all types of inputs.
 * {@link SearchParameter}s can conceptually be broken down into two types.
 * <ul>
 * <li>Input {@link SearchParameter}s provide the seed information from which
 * ideas should be generated or statistic information is desired
 * (eg. {@link RelatedToKeywordSearchParameter},
 * {@link RelatedToUrlSearchParameter}, etc).
 * Such {@link SearchParameters} are required for valid requests.</li>
 * <li>Filter {@link SearchParameter}s are used to trim down the results based
 * on {@link com.google.ads.api.services.targetingideas.attributes.Attribute}
 * related information (eg. {@link CompetitionSearchParameter}, etc.).</li>
 * </ul><p>
 * 
 * A request should only contain one instance of each {@link SearchParameter}
 * <p>One or more of the following {@link SearchParameter}s are required:<br/>
 * <ul><li>{@link KeywordCategoryIdSearchParameter}</li>
 * <li>{@link RelatedToKeywordSearchParameter}</li>
 * <li>{@link RelatedToUrlSearchParameter}</li>
 * <li>{@link SeedAdGroupIdSearchParameter}</li>
 * </ul><p>
 * <p><b>{@link IdeaType} KEYWORD supports following {@link SearchParameter}s:</b><br/>
 * <ul>
 * <li>{@link AverageTargetedMonthlySearchesSearchParameter}</li>
 * <li>{@link CompetitionSearchParameter}</li>
 * <li>{@link CountryTargetSearchParameter}</li>
 * <li>{@link ExcludedKeywordSearchParameter}</li>
 * <li>{@link GlobalMonthlySearchesSearchParameter}</li>
 * <li>{@link IncludeAdultContentSearchParameter}</li>
 * <li>{@link KeywordCategoryIdSearchParameter}</li>
 * <li>{@link KeywordMatchTypeSearchParameter}</li>
 * <li>{@link LanguageTargetSearchParameter}</li>
 * <li>{@link MobileSearchParameter}</li>
 * <li>{@link NgramGroupsSearchParameter}</li>
 * <li>{@link RelatedToKeywordSearchParameter}</li>
 * <li>{@link RelatedToUrlSearchParameter}</li>
 * <li>{@link SeedAdGroupIdSearchParameter}</li>
 * </ul><p>
 * <p><b>{@link IdeaType} PLACEMENT supports following {@link SearchParameter}s:</b><br/>
 * <ul>
 * <li>{@link AdTypeSearchParameter}</li>
 * <li>{@link CountryTargetSearchParameter}</li>
 * <li>{@link LanguageTargetSearchParameter}</li>
 * <li>{@link PlacementTypeSearchParameter}</li>
 * <li>{@link RelatedToKeywordSearchParameter}</li>
 * <li>{@link RelatedToUrlSearchParameter}</li>
 * </ul><p>
 */
class SearchParameter {
	/**
	 * @access public
	 * @var string
	 */
	public $SearchParameterType;
	private $_parameterMap = array (
		"SearchParameter.Type" => "SearchParameterType",
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

	public function __construct($SearchParameterType = NULL) {
		if(get_parent_class('SearchParameter')) parent::__construct();
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("SeedAdGroupIdSearchParameter")) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s
 * that specifies that the supplied AdGroup should be used as a seed
 * for generating new ideas. For example, an AdGroup's keywords
 * would be used to generate new and related keywords.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class SeedAdGroupIdSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var integer
	 */
	public $adGroupId;

	public function __construct($adGroupId = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('SeedAdGroupIdSearchParameter')) parent::__construct();
		$this->adGroupId = $adGroupId;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("StringAttribute")) {
/**
 * {@link Attribute} type that contains a string value.
 */
class StringAttribute extends Attribute {
	/**
	 * @access public
	 * @var string
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('StringAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("TargetingIdea")) {
/**
 * Represents a {@link TargetingIdea} returned by search criteria specified in
 * the {@link TargetingIdeaSelector}.
 */
class TargetingIdea {
	/**
	 * @access public
	 * @var Type_AttributeMapEntry[]
	 */
	public $data;

	public function __construct($data = NULL) {
		if(get_parent_class('TargetingIdea')) parent::__construct();
		$this->data = $data;
	}
}}

if (!class_exists("TargetingIdeaError")) {
/**
 * 
 */
class TargetingIdeaError extends ApiError {
	/**
	 * @access public
	 * @var tnsTargetingIdeaErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('TargetingIdeaError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("TargetingIdeaPage")) {
/**
 * Contains a subset of {@link TargetingIdea}s from the search criteria
 * specified by a {@link TargetingIdeaSelector}.
 */
class TargetingIdeaPage {
	/**
	 * @access public
	 * @var integer
	 */
	public $totalNumEntries;
	/**
	 * @access public
	 * @var TargetingIdea[]
	 */
	public $entries;

	public function __construct($totalNumEntries = NULL, $entries = NULL) {
		if(get_parent_class('TargetingIdeaPage')) parent::__construct();
		$this->totalNumEntries = $totalNumEntries;
		$this->entries = $entries;
	}
}}

if (!class_exists("TargetingIdeaSelector")) {
/**
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 */
class TargetingIdeaSelector {
	/**
	 * @access public
	 * @var SearchParameter[]
	 */
	public $searchParameters;
	/**
	 * @access public
	 * @var tnsIdeaType
	 */
	public $ideaType;
	/**
	 * @access public
	 * @var tnsRequestType
	 */
	public $requestType;
	/**
	 * @access public
	 * @var tnsAttributeType[]
	 */
	public $requestedAttributeTypes;
	/**
	 * @access public
	 * @var Paging
	 */
	public $paging;
	/**
	 * @access public
	 * @var string
	 */
	public $localeCode;
	/**
	 * @access public
	 * @var string
	 */
	public $currencyCode;

	public function __construct($searchParameters = NULL, $ideaType = NULL, $requestType = NULL, $requestedAttributeTypes = NULL, $paging = NULL, $localeCode = NULL, $currencyCode = NULL) {
		if(get_parent_class('TargetingIdeaSelector')) parent::__construct();
		$this->searchParameters = $searchParameters;
		$this->ideaType = $ideaType;
		$this->requestType = $requestType;
		$this->requestedAttributeTypes = $requestedAttributeTypes;
		$this->paging = $paging;
		$this->localeCode = $localeCode;
		$this->currencyCode = $currencyCode;
	}
}}

if (!class_exists("Type_AttributeMapEntry")) {
/**
 * This represents an entry in a map with a key of type Type
 * and value of type Attribute.
 */
class Type_AttributeMapEntry {
	/**
	 * @access public
	 * @var tnsAttributeType
	 */
	public $key;
	/**
	 * @access public
	 * @var Attribute
	 */
	public $value;

	public function __construct($key = NULL, $value = NULL) {
		if(get_parent_class('Type_AttributeMapEntry')) parent::__construct();
		$this->key = $key;
		$this->value = $value;
	}
}}

if (!class_exists("WebpageDescriptor")) {
/**
 * Basic information about a webpage.
 */
class WebpageDescriptor {
	/**
	 * @access public
	 * @var string
	 */
	public $url;
	/**
	 * @access public
	 * @var string
	 */
	public $title;

	public function __construct($url = NULL, $title = NULL) {
		if(get_parent_class('WebpageDescriptor')) parent::__construct();
		$this->url = $url;
		$this->title = $title;
	}
}}

if (!class_exists("WebpageDescriptorAttribute")) {
/**
 * {@link Attribute} type that contains a {@link WebpageDescriptor} value.
 */
class WebpageDescriptorAttribute extends Attribute {
	/**
	 * @access public
	 * @var WebpageDescriptor
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('WebpageDescriptorAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("AttributeType")) {
/**
 * Represents the type of {@link Attribute}.
 * 
 * 
 * <p><b>{@link IdeaType} KEYWORD supports the following {@link AttributeType}s:</b><br/>
 * <ul><li>{@link #AD_SHARE}</li>
 * <li>{@link #AVERAGE_TARGETED_MONTHLY_SEARCHES}</li>
 * <li>{@link #COMPETITION}</li>
 * <li>{@link #EXTRACTED_FROM_WEBPAGE}</li>
 * <li>{@link #GLOBAL_MONTHLY_SEARCHES}</li>
 * <li>{@link #IDEA_TYPE}</li>
 * <li>{@link #KEYWORD}</li>
 * <li>{@link #KEYWORD_CATEGORY}</li>
 * <li>{@link #NGRAM_GROUP}</li>
 * <li>{@link #SEARCH_SHARE}</li>
 * <li>{@link #TARGETED_MONTHLY_SEARCHES}</li>
 * </ul>
 * <p><b>{@link IdeaType} PLACEMENT supports the following {@link AttributeType}s:</b><br/>
 * <ul><li>{@link #APPROX_CONTENT_IMPRESSIONS_PER_DAY}</li>
 * <li>{@link #FORMATS}</li>
 * <li>{@link #IDEA_TYPE}</li>
 * <li>{@link #IN_STREAM_AD_INFO}</li>
 * <li>{@link #PLACEMENT}</li>
 * <li>{@link #PLACEMENT_CATEGORY}</li>
 * <li>{@link #PLACEMENT_NAME}</li>
 * <li>{@link #PLACEMENT_TYPE}</li>
 * <li>{@link #PUBLISHER_DESCRIPTION}</li>
 * <li>{@link #SAMPLE_URL}</li>
 * </ul>
 */
class AttributeType {

	public function __construct() {
		if(get_parent_class('AttributeType')) parent::__construct();
	}
}}

if (!class_exists("CollectionSizeErrorReason")) {
/**
 * The reasons for the target error.
 */
class CollectionSizeErrorReason {

	public function __construct() {
		if(get_parent_class('CollectionSizeErrorReason')) parent::__construct();
	}
}}

if (!class_exists("CompetitionSearchParameterLevel")) {
/**
 * An enumeration of possible values to be used in conjunction with the
 * {@CompetitionSearchParameter} to specify the granularity of competition to
 * be filtered.
 */
class CompetitionSearchParameterLevel {

	public function __construct() {
		if(get_parent_class('CompetitionSearchParameterLevel')) parent::__construct();
	}
}}

if (!class_exists("IdeaType")) {
/**
 * Represents the type of idea.
 */
class IdeaType {

	public function __construct() {
		if(get_parent_class('IdeaType')) parent::__construct();
	}
}}

if (!class_exists("RequestType")) {
/**
 * Represents the type of the request.
 */
class RequestType {

	public function __construct() {
		if(get_parent_class('RequestType')) parent::__construct();
	}
}}

if (!class_exists("SiteConstantsAdFormat")) {
/**
 * Enumerates the ad formats which can be reported in search results.
 */
class SiteConstantsAdFormat {

	public function __construct() {
		if(get_parent_class('SiteConstantsAdFormat')) parent::__construct();
	}
}}

if (!class_exists("SiteConstantsAdType")) {
/**
 * Enumerates the ad types available for constraining searches.  Each corresponds
 * to one or more values from {@link AdFormat}.
 */
class SiteConstantsAdType {

	public function __construct() {
		if(get_parent_class('SiteConstantsAdType')) parent::__construct();
	}
}}

if (!class_exists("SiteConstantsPlacementType")) {
/**
 * A placement request and response value indicating the type of site or other medium
 * (for example, a web page, in a feed, in a video) where ads will appear.
 */
class SiteConstantsPlacementType {

	public function __construct() {
		if(get_parent_class('SiteConstantsPlacementType')) parent::__construct();
	}
}}

if (!class_exists("TargetingIdeaErrorReason")) {
/**
 * An enumeration of
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaService}
 * specific errors.
 */
class TargetingIdeaErrorReason {

	public function __construct() {
		if(get_parent_class('TargetingIdeaErrorReason')) parent::__construct();
	}
}}

if (!class_exists("TargetingIdeaServiceGet")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns a page of ideas that match the query described by the specified
 * {@link TargetingIdeaSelector}.
 * 
 * The selector must specify a Paging value, with {@code numberResults} set to 800 or less.
 * 
 * @param selector Query describing the types of results to return when
 * finding matches (similar keyword ideas/placement ideas).
 * @return A {@link TargetingIdeaPage} of results, that is a subset of the
 * list of possible ideas meeting the criteria of the
 * {@link TargetingIdeaSelector}.
 * @throws ApiException If problems occurred while querying for ideas.
 */
class TargetingIdeaServiceGet {
	/**
	 * @access public
	 * @var TargetingIdeaSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('TargetingIdeaServiceGet')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("TargetingIdeaServiceGetResponse")) {
/**
 * 
 */
class TargetingIdeaServiceGetResponse {
	/**
	 * @access public
	 * @var TargetingIdeaPage
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('TargetingIdeaServiceGetResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("getBulkKeywordIdeas")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns a page of ideas that match the query described by the specified
 * {@link TargetingIdeaSelector}.  This method is specialized for returning
 * bulk keyword ideas, and thus the selector must be set for
 * {@link com.google.ads.api.services.targetingideas.attributes.RequestType#IDEAS} and
 * {@link com.google.ads.api.services.targetingideas.attributes.IdeaType#KEYWORD}.
 * A limited, fixed set of attributes will be returned.<p>
 * 
 * A single-valued
 * {@link com.google.ads.api.services.targetingideas.search.RelatedToUrlSearchParameter}
 * must be supplied.  Single-valued
 * {@link com.google.ads.api.services.targetingideas.search.LanguageTargetSearchParameter} and
 * {@link com.google.ads.api.services.targetingideas.search.CountryTargetSearchParameter} are
 * both optional.  Other search parameters compatible with a keyword query may also be
 * supplied.<p>
 * 
 * The selector must specify a Paging value, with {@code numberResults} set to 500 or less.
 * Large result sets must be composed through multiple calls to this method, advancing the
 * Paging {@code startIndex} value by {@code numberResults} with each call.
 * 
 * @param selector Query describing the bulk keyword ideas to return.
 * @return A {@link TargetingIdeaPage} of results, that is a subset of the
 * list of possible ideas meeting the criteria of the
 * {@link TargetingIdeaSelector}.
 * @throws ApiException If problems occurred while querying for ideas.
 */
class getBulkKeywordIdeas {
	/**
	 * @access public
	 * @var TargetingIdeaSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('getBulkKeywordIdeas')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("getBulkKeywordIdeasResponse")) {
/**
 * 
 */
class getBulkKeywordIdeasResponse {
	/**
	 * @access public
	 * @var TargetingIdeaPage
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('getBulkKeywordIdeasResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AdScheduleTarget")) {
/**
 * Immutable structure to hold an ad schedule target.
 * 
 * 
 * 
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
 * Immutable structure to hold an ad schedule target.
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
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("BudgetError")) {
/**
 * Immutable structure to hold an ad schedule target.
 */
class BudgetError extends ApiError {
	/**
	 * @access public
	 * @var tnsBudgetErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('BudgetError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("ClientTermsError")) {
/**
 * Encapsulates the errors thrown during client terms checks for adwords.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("DateError")) {
/**
 * Immutable structure to hold an ad schedule target.
 */
class DateError extends ApiError {
	/**
	 * @access public
	 * @var tnsDateErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('DateError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("DistinctError")) {
/**
 * Errors related to distinct ids or content.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("Keyword")) {
/**
 * A keyword.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class Keyword extends Criterion {
	/**
	 * @access public
	 * @var string
	 */
	public $text;
	/**
	 * @access public
	 * @var tnsKeywordMatchType
	 */
	public $matchType;

	public function __construct($text = NULL, $matchType = NULL, $id = NULL, $CriterionType = NULL) {
		if(get_parent_class('Keyword')) parent::__construct();
		$this->text = $text;
		$this->matchType = $matchType;
		$this->id = $id;
		$this->CriterionType = $CriterionType;
	}
}}

if (!class_exists("LanguageTarget")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint StringLength">This string must not be empty.</span>
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("Money")) {
/**
 * Immutable structure to hold an ad schedule target.
 */
class Money extends ComparableValue {
	/**
	 * @access public
	 * @var integer
	 */
	public $microAmount;

	public function __construct($microAmount = NULL, $ComparableValueType = NULL) {
		if(get_parent_class('Money')) parent::__construct();
		$this->microAmount = $microAmount;
		$this->ComparableValueType = $ComparableValueType;
	}
}}

if (!class_exists("NetworkTarget")) {
/**
 * Immutable structure to hold a network coverage target.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("NumberValue")) {
/**
 * Number value types for constructing number valued ranges.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class NumberValue extends ComparableValue {

	public function __construct($ComparableValueType = NULL) {
		if(get_parent_class('NumberValue')) parent::__construct();
		$this->ComparableValueType = $ComparableValueType;
	}
}}

if (!class_exists("Placement")) {
/**
 * A placement used for modifying bids for sites when targeting the content
 * network.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class Placement extends Criterion {
	/**
	 * @access public
	 * @var string
	 */
	public $url;

	public function __construct($url = NULL, $id = NULL, $CriterionType = NULL) {
		if(get_parent_class('Placement')) parent::__construct();
		$this->url = $url;
		$this->id = $id;
		$this->CriterionType = $CriterionType;
	}
}}

if (!class_exists("PlatformTarget")) {
/**
 * Immutable structure to hold a platform target.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("ReadOnlyError")) {
/**
 * A list of all errors associated with the @ReadOnly constraint.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("StatsQueryError")) {
/**
 * Represents possible error codes when querying for stats.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class StatsQueryError extends ApiError {
	/**
	 * @access public
	 * @var tnsStatsQueryErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('StatsQueryError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("StringLengthError")) {
/**
 * A list of all errors associated with the @ContentsString constraint.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("DemographicTarget")) {
/**
 * Abstract class to identify a demographic target.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("ApiException")) {
/**
 * Exception class for holding a list of service errors.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("AdFormatSpecListAttribute")) {
/**
 * {@link Attribute} type that contains a list of {@link AdFormatSpec} values.
 */
class AdFormatSpecListAttribute extends Attribute {
	/**
	 * @access public
	 * @var AdFormatSpec[]
	 */
	public $value;

	public function __construct($value = NULL, $AttributeType = NULL) {
		if(get_parent_class('AdFormatSpecListAttribute')) parent::__construct();
		$this->value = $value;
		$this->AttributeType = $AttributeType;
	}
}}

if (!class_exists("AdTypeSearchParameter")) {
/**
 * A {@link SearchParameter} for {@code PLACEMENT} {@link IdeaType}s used to
 * filter the results by the {@link AdType}.
 * <p>This element is supported by following {@link IdeaType}s: PLACEMENT.
 */
class AdTypeSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var tnsSiteConstantsAdType[]
	 */
	public $adTypes;

	public function __construct($adTypes = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('AdTypeSearchParameter')) parent::__construct();
		$this->adTypes = $adTypes;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("AverageTargetedMonthlySearchesSearchParameter")) {
/**
 * A {@link SearchParameter} that constrains the approximate average number of
 * targeted monthly searches on ideas to be returned. Absence of a
 * {@link AverageTargetedMonthlySearchesSearchParameter} in a
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector} is
 * equivalent to having no constraint on average targeted monthly searches
 * pecified.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class AverageTargetedMonthlySearchesSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var LongComparisonOperation
	 */
	public $operation;

	public function __construct($operation = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('AverageTargetedMonthlySearchesSearchParameter')) parent::__construct();
		$this->operation = $operation;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("CompetitionSearchParameter")) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s used to
 * filter the results by the amount of competition (eg: LOW, MEDIUM, HIGH).
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class CompetitionSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var tnsCompetitionSearchParameterLevel[]
	 */
	public $levels;

	public function __construct($levels = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('CompetitionSearchParameter')) parent::__construct();
		$this->levels = $levels;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("CountryTargetSearchParameter")) {
/**
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method. It must be single-valued when used in a call to that method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 */
class CountryTargetSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var CountryTarget[]
	 */
	public $countryTargets;

	public function __construct($countryTargets = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('CountryTargetSearchParameter')) parent::__construct();
		$this->countryTargets = $countryTargets;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("ExcludedKeywordSearchParameter")) {
/**
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class ExcludedKeywordSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var Keyword[]
	 */
	public $keywords;

	public function __construct($keywords = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('ExcludedKeywordSearchParameter')) parent::__construct();
		$this->keywords = $keywords;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("GlobalMonthlySearchesSearchParameter")) {
/**
 * A {@link SearchParameter} that specifies the level of search volume expected
 * in results. Absence of a {@link GlobalMonthlySearchesSearchParameter} in a
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector} is
 * equivalent to having no constraint on search volume specified. This search
 * parameter has a direct relationship to
 * {@link com.google.ads.api.services.targetingideas.external.AttributeType#GLOBAL_MONTHLY_SEARCHES}.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class GlobalMonthlySearchesSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var LongComparisonOperation
	 */
	public $operation;

	public function __construct($operation = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('GlobalMonthlySearchesSearchParameter')) parent::__construct();
		$this->operation = $operation;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("IncludeAdultContentSearchParameter")) {
/**
 * {@link SearchParameter} that specifies whether adult content should be
 * returned.<p>
 * 
 * Presence of this {@link SearchParameter} will allow adult keywords
 * to be included in the results.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class IncludeAdultContentSearchParameter extends SearchParameter {

	public function __construct($SearchParameterType = NULL) {
		if(get_parent_class('IncludeAdultContentSearchParameter')) parent::__construct();
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("KeywordCategoryIdSearchParameter")) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s that
 * sets a keyword category that all search results should belong to.
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class KeywordCategoryIdSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var integer
	 */
	public $categoryId;

	public function __construct($categoryId = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('KeywordCategoryIdSearchParameter')) parent::__construct();
		$this->categoryId = $categoryId;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("KeywordMatchTypeSearchParameter")) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s that
 * specifies the {@link KeywordMatchType}s that all results must match.
 * For example, results may be limited to only Broad or Exact matches.
 * Setting no {@link KeywordMatchTypeSearchParameter} will match all
 * targeting ideas, regardless of {@link KeywordMatchType}. If multiple
 * {@link KeywordMatchType}s are set, a result need only match one
 * match type to be returned.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class KeywordMatchTypeSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var cmKeywordMatchType[]
	 */
	public $keywordMatchTypes;

	public function __construct($keywordMatchTypes = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('KeywordMatchTypeSearchParameter')) parent::__construct();
		$this->keywordMatchTypes = $keywordMatchTypes;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("LanguageTargetSearchParameter")) {
/**
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method. It must be single-valued when used in a call to that method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 */
class LanguageTargetSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var LanguageTarget[]
	 */
	public $languageTargets;

	public function __construct($languageTargets = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('LanguageTargetSearchParameter')) parent::__construct();
		$this->languageTargets = $languageTargets;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("MobileSearchParameter")) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s that
 * requires that all search results support mobile advertisements. Note
 * that the presence of this parameter is all that is needed to limit
 * search results. It is not necessary to set any properties.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class MobileSearchParameter extends SearchParameter {

	public function __construct($SearchParameterType = NULL) {
		if(get_parent_class('MobileSearchParameter')) parent::__construct();
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("NgramGroupsSearchParameter")) {
/**
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 */
class NgramGroupsSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var string[]
	 */
	public $ngramGroups;

	public function __construct($ngramGroups = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('NgramGroupsSearchParameter')) parent::__construct();
		$this->ngramGroups = $ngramGroups;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("PlacementTypeSearchParameter")) {
/**
 * A {@link SearchParameter} for {@code PLACEMENT} {@link IdeaType}s
 * used to filter results based on the type of website, known as
 * {@link com.google.ads.api.services.targetingideas.attributes.Type#PLACEMENT_TYPE},
 * that they appear in. For example, searches may be limited to find
 * results that only appear within mobile websites or feeds.
 * <p>This element is supported by following {@link IdeaType}s: PLACEMENT.
 */
class PlacementTypeSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var tnsSiteConstantsPlacementType[]
	 */
	public $placementTypes;

	public function __construct($placementTypes = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('PlacementTypeSearchParameter')) parent::__construct();
		$this->placementTypes = $placementTypes;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("RelatedToKeywordSearchParameter")) {
/**
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 */
class RelatedToKeywordSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var Keyword[]
	 */
	public $keywords;

	public function __construct($keywords = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('RelatedToKeywordSearchParameter')) parent::__construct();
		$this->keywords = $keywords;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("RelatedToUrlSearchParameter")) {
/**
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method. It must be single-valued when used in a call to that method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 */
class RelatedToUrlSearchParameter extends SearchParameter {
	/**
	 * @access public
	 * @var string[]
	 */
	public $urls;
	/**
	 * @access public
	 * @var boolean
	 */
	public $includeSubUrls;

	public function __construct($urls = NULL, $includeSubUrls = NULL, $SearchParameterType = NULL) {
		if(get_parent_class('RelatedToUrlSearchParameter')) parent::__construct();
		$this->urls = $urls;
		$this->includeSubUrls = $includeSubUrls;
		$this->SearchParameterType = $SearchParameterType;
	}
}}

if (!class_exists("AgeTarget")) {
/**
 * Immutable structure to hold an age target.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("DoubleValue")) {
/**
 * Number value type for constructing double valued ranges.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class DoubleValue extends NumberValue {
	/**
	 * @access public
	 * @var double
	 */
	public $number;

	public function __construct($number = NULL, $ComparableValueType = NULL) {
		if(get_parent_class('DoubleValue')) parent::__construct();
		$this->number = $number;
		$this->ComparableValueType = $ComparableValueType;
	}
}}

if (!class_exists("GenderTarget")) {
/**
 * Immutable structure to hold a gender target.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("LongValue")) {
/**
 * Number value type for constructing long valued ranges.
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
 */
class LongValue extends NumberValue {
	/**
	 * @access public
	 * @var integer
	 */
	public $number;

	public function __construct($number = NULL, $ComparableValueType = NULL) {
		if(get_parent_class('LongValue')) parent::__construct();
		$this->number = $number;
		$this->ComparableValueType = $ComparableValueType;
	}
}}

if (!class_exists("MetroTarget")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint StringLength">This string must not be empty.</span>
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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
 * 
 * 
 * 
 * Immutable structure to hold an ad schedule target.
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

if (!class_exists("TargetingIdeaService")) {
/**
 * TargetingIdeaService
 * @author WSDLInterpreter
 */
class TargetingIdeaService extends AdWordsSoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	public static $classmap = array(
		"getResponse" => "TargetingIdeaServiceGetResponse",
		"get" => "TargetingIdeaServiceGet",
		"mutate" => "TargetingIdeaServiceMutate",
		"mutateResponse" => "TargetingIdeaServiceMutateResponse",
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
		"BudgetError" => "BudgetError",
		"CityTarget" => "CityTarget",
		"GeoTarget" => "GeoTarget",
		"ClientTermsError" => "ClientTermsError",
		"CountryTarget" => "CountryTarget",
		"DatabaseError" => "DatabaseError",
		"DateError" => "DateError",
		"DistinctError" => "DistinctError",
		"DoubleValue" => "DoubleValue",
		"NumberValue" => "NumberValue",
		"EntityNotFound" => "EntityNotFound",
		"GenderTarget" => "GenderTarget",
		"GeoPoint" => "GeoPoint",
		"InternalApiError" => "InternalApiError",
		"Keyword" => "Keyword",
		"Criterion" => "Criterion",
		"LanguageTarget" => "LanguageTarget",
		"LongValue" => "LongValue",
		"MetroTarget" => "MetroTarget",
		"Money" => "Money",
		"ComparableValue" => "ComparableValue",
		"NetworkTarget" => "NetworkTarget",
		"NotEmptyError" => "NotEmptyError",
		"NotWhitelistedError" => "NotWhitelistedError",
		"NullError" => "NullError",
		"Paging" => "Paging",
		"Placement" => "Placement",
		"PlatformTarget" => "PlatformTarget",
		"PolygonTarget" => "PolygonTarget",
		"ProvinceTarget" => "ProvinceTarget",
		"ProximityTarget" => "ProximityTarget",
		"QuotaCheckError" => "QuotaCheckError",
		"QuotaExceededError" => "QuotaExceededError",
		"RangeError" => "RangeError",
		"ReadOnlyError" => "ReadOnlyError",
		"RequiredError" => "RequiredError",
		"SizeLimitError" => "SizeLimitError",
		"SoapResponseHeader" => "SoapResponseHeader",
		"StatsQueryError" => "StatsQueryError",
		"StringLengthError" => "StringLengthError",
		"ApiException" => "ApiException",
		"ApplicationException" => "ApplicationException",
		"AgeTarget.Age" => "AgeTargetAge",
		"AuthenticationError.Reason" => "AuthenticationErrorReason",
		"AuthorizationError.Reason" => "AuthorizationErrorReason",
		"BiddingError.Reason" => "BiddingErrorReason",
		"BudgetError.Reason" => "BudgetErrorReason",
		"ClientTermsError.Reason" => "ClientTermsErrorReason",
		"DatabaseError.Reason" => "DatabaseErrorReason",
		"DateError.Reason" => "DateErrorReason",
		"DayOfWeek" => "DayOfWeek",
		"DistinctError.Reason" => "DistinctErrorReason",
		"EntityNotFound.Reason" => "EntityNotFoundReason",
		"GenderTarget.Gender" => "GenderTargetGender",
		"InternalApiError.Reason" => "InternalApiErrorReason",
		"KeywordMatchType" => "KeywordMatchType",
		"MinuteOfHour" => "MinuteOfHour",
		"NetworkCoverageType" => "NetworkCoverageType",
		"NotEmptyError.Reason" => "NotEmptyErrorReason",
		"NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
		"NullError.Reason" => "NullErrorReason",
		"PlatformType" => "PlatformType",
		"ProximityTarget.DistanceUnits" => "ProximityTargetDistanceUnits",
		"QuotaCheckError.Reason" => "QuotaCheckErrorReason",
		"QuotaExceededError.Reason" => "QuotaExceededErrorReason",
		"RangeError.Reason" => "RangeErrorReason",
		"ReadOnlyError.Reason" => "ReadOnlyErrorReason",
		"RequiredError.Reason" => "RequiredErrorReason",
		"SizeLimitError.Reason" => "SizeLimitErrorReason",
		"StatsQueryError.Reason" => "StatsQueryErrorReason",
		"StringLengthError.Reason" => "StringLengthErrorReason",
		"AdFormatSpec" => "AdFormatSpec",
		"AdFormatSpecListAttribute" => "AdFormatSpecListAttribute",
		"Attribute" => "Attribute",
		"AdTypeSearchParameter" => "AdTypeSearchParameter",
		"SearchParameter" => "SearchParameter",
		"AverageTargetedMonthlySearchesSearchParameter" => "AverageTargetedMonthlySearchesSearchParameter",
		"BooleanAttribute" => "BooleanAttribute",
		"CollectionSizeError" => "CollectionSizeError",
		"CompetitionSearchParameter" => "CompetitionSearchParameter",
		"CountryTargetSearchParameter" => "CountryTargetSearchParameter",
		"DoubleAttribute" => "DoubleAttribute",
		"ExcludedKeywordSearchParameter" => "ExcludedKeywordSearchParameter",
		"GlobalMonthlySearchesSearchParameter" => "GlobalMonthlySearchesSearchParameter",
		"IdeaTypeAttribute" => "IdeaTypeAttribute",
		"InStreamAdInfo" => "InStreamAdInfo",
		"InStreamAdInfoAttribute" => "InStreamAdInfoAttribute",
		"IncludeAdultContentSearchParameter" => "IncludeAdultContentSearchParameter",
		"IntegerAttribute" => "IntegerAttribute",
		"IntegerSetAttribute" => "IntegerSetAttribute",
		"KeywordAttribute" => "KeywordAttribute",
		"KeywordCategoryIdSearchParameter" => "KeywordCategoryIdSearchParameter",
		"KeywordMatchTypeSearchParameter" => "KeywordMatchTypeSearchParameter",
		"LanguageTargetSearchParameter" => "LanguageTargetSearchParameter",
		"LongAttribute" => "LongAttribute",
		"LongComparisonOperation" => "LongComparisonOperation",
		"LongRangeAttribute" => "LongRangeAttribute",
		"MobileSearchParameter" => "MobileSearchParameter",
		"MoneyAttribute" => "MoneyAttribute",
		"MonthlySearchVolume" => "MonthlySearchVolume",
		"MonthlySearchVolumeAttribute" => "MonthlySearchVolumeAttribute",
		"NgramGroupsSearchParameter" => "NgramGroupsSearchParameter",
		"PlacementAttribute" => "PlacementAttribute",
		"PlacementTypeAttribute" => "PlacementTypeAttribute",
		"PlacementTypeSearchParameter" => "PlacementTypeSearchParameter",
		"Range" => "Range",
		"RelatedToKeywordSearchParameter" => "RelatedToKeywordSearchParameter",
		"RelatedToUrlSearchParameter" => "RelatedToUrlSearchParameter",
		"SeedAdGroupIdSearchParameter" => "SeedAdGroupIdSearchParameter",
		"StringAttribute" => "StringAttribute",
		"TargetingIdea" => "TargetingIdea",
		"TargetingIdeaError" => "TargetingIdeaError",
		"TargetingIdeaPage" => "TargetingIdeaPage",
		"TargetingIdeaSelector" => "TargetingIdeaSelector",
		"Type_AttributeMapEntry" => "Type_AttributeMapEntry",
		"WebpageDescriptor" => "WebpageDescriptor",
		"WebpageDescriptorAttribute" => "WebpageDescriptorAttribute",
		"AttributeType" => "AttributeType",
		"CollectionSizeError.Reason" => "CollectionSizeErrorReason",
		"CompetitionSearchParameter.Level" => "CompetitionSearchParameterLevel",
		"IdeaType" => "IdeaType",
		"RequestType" => "RequestType",
		"SiteConstants.AdFormat" => "SiteConstantsAdFormat",
		"SiteConstants.AdType" => "SiteConstantsAdType",
		"SiteConstants.PlacementType" => "SiteConstantsPlacementType",
		"TargetingIdeaError.Reason" => "TargetingIdeaErrorReason",
		"getBulkKeywordIdeas" => "getBulkKeywordIdeas",
		"getBulkKeywordIdeasResponse" => "getBulkKeywordIdeasResponse",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl=null, $options, $user) {
		$options["classmap"] = TargetingIdeaService::$classmap;
		parent::__construct($wsdl, $options, $user, 'TargetingIdeaService');
	}

	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Returns a page of ideas that match the query described by the specified
	 * {@link TargetingIdeaSelector}.
	 * 
	 * The selector must specify a Paging value, with {@code numberResults} set to 800 or less.
	 * 
	 * @param selector Query describing the types of results to return when
	 * finding matches (similar keyword ideas/placement ideas).
	 * @return A {@link TargetingIdeaPage} of results, that is a subset of the
	 * list of possible ideas meeting the criteria of the
	 * {@link TargetingIdeaSelector}.
	 * @throws ApiException If problems occurred while querying for ideas.
	 */
	public function get($selector) {
		$arg = new TargetingIdeaServiceGet($selector);
		$result = $this->__soapCall("get", array($arg));
		return $result->rval;
	}


	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Returns a page of ideas that match the query described by the specified
	 * {@link TargetingIdeaSelector}.  This method is specialized for returning
	 * bulk keyword ideas, and thus the selector must be set for
	 * {@link com.google.ads.api.services.targetingideas.attributes.RequestType#IDEAS} and
	 * {@link com.google.ads.api.services.targetingideas.attributes.IdeaType#KEYWORD}.
	 * A limited, fixed set of attributes will be returned.<p>
	 * 
	 * A single-valued
	 * {@link com.google.ads.api.services.targetingideas.search.RelatedToUrlSearchParameter}
	 * must be supplied.  Single-valued
	 * {@link com.google.ads.api.services.targetingideas.search.LanguageTargetSearchParameter} and
	 * {@link com.google.ads.api.services.targetingideas.search.CountryTargetSearchParameter} are
	 * both optional.  Other search parameters compatible with a keyword query may also be
	 * supplied.<p>
	 * 
	 * The selector must specify a Paging value, with {@code numberResults} set to 500 or less.
	 * Large result sets must be composed through multiple calls to this method, advancing the
	 * Paging {@code startIndex} value by {@code numberResults} with each call.
	 * 
	 * @param selector Query describing the bulk keyword ideas to return.
	 * @return A {@link TargetingIdeaPage} of results, that is a subset of the
	 * list of possible ideas meeting the criteria of the
	 * {@link TargetingIdeaSelector}.
	 * @throws ApiException If problems occurred while querying for ideas.
	 */
	public function getBulkKeywordIdeas($selector) {
		$arg = new getBulkKeywordIdeas($selector);
		$result = $this->__soapCall("getBulkKeywordIdeas", array($arg));
		return $result->rval;
	}


}}

?>