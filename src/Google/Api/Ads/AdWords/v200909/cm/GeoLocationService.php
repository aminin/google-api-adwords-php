<?php
/**
 * Contains all client objects for the GeoLocationService service.
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

if (!class_exists("GeoLocationSelector")) {
/**
 * A selector used to fetch geographic coordinates for given addresses.
 */
class GeoLocationSelector {
	/**
	 * @access public
	 * @var Address[]
	 */
	public $addresses;

	public function __construct($addresses = NULL) {
		if(get_parent_class('GeoLocationSelector')) parent::__construct();
		$this->addresses = $addresses;
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

if (!class_exists("GeoLocation")) {
/**
 * Class representing a location with its geographic coordinates.
 */
class GeoLocation {
	/**
	 * @access public
	 * @var GeoPoint
	 */
	public $geoPoint;
	/**
	 * @access public
	 * @var Address
	 */
	public $address;
	/**
	 * @access public
	 * @var base64Binary
	 */
	public $encodedLocation;
	/**
	 * @access public
	 * @var string
	 */
	public $GeoLocationType;
	private $_parameterMap = array (
		"GeoLocation.Type" => "GeoLocationType",
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

	public function __construct($geoPoint = NULL, $address = NULL, $encodedLocation = NULL, $GeoLocationType = NULL) {
		if(get_parent_class('GeoLocation')) parent::__construct();
		$this->geoPoint = $geoPoint;
		$this->address = $address;
		$this->encodedLocation = $encodedLocation;
		$this->GeoLocationType = $GeoLocationType;
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

if (!class_exists("GeoLocationErrorReason")) {
/**
 * The reasons for the geolocation errors.
 */
class GeoLocationErrorReason {

	public function __construct() {
		if(get_parent_class('GeoLocationErrorReason')) parent::__construct();
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

if (!class_exists("GeoLocationServiceGet")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Retrieves the geographic location information for the address specified.
 * 
 * @param selector specifies the addresses.
 * @return list of {@link GeoLocation} objects. Returns {@link InvalidGeoLocation} object if
 * the address cannot be geocoded.
 * @throws ApiException if problems occurred while retrieving the location information
 */
class GeoLocationServiceGet {
	/**
	 * @access public
	 * @var GeoLocationSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('GeoLocationServiceGet')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("GeoLocationServiceGetResponse")) {
/**
 * 
 */
class GeoLocationServiceGetResponse {
	/**
	 * @access public
	 * @var GeoLocation[]
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('GeoLocationServiceGetResponse')) parent::__construct();
		$this->rval = $rval;
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

if (!class_exists("GeoLocationError")) {
/**
 * Errors for {@link GeoLocationService}
 */
class GeoLocationError extends ApiError {
	/**
	 * @access public
	 * @var tnsGeoLocationErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('GeoLocationError')) parent::__construct();
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

if (!class_exists("InvalidGeoLocation")) {
/**
 * Invalid GeoLocation object.
 */
class InvalidGeoLocation extends GeoLocation {

	public function __construct($geoPoint = NULL, $address = NULL, $encodedLocation = NULL, $GeoLocationType = NULL) {
		if(get_parent_class('InvalidGeoLocation')) parent::__construct();
		$this->geoPoint = $geoPoint;
		$this->address = $address;
		$this->encodedLocation = $encodedLocation;
		$this->GeoLocationType = $GeoLocationType;
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

if (!class_exists("GeoLocationService")) {
/**
 * GeoLocationService
 * @author WSDLInterpreter
 */
class GeoLocationService extends AdWordsSoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	public static $classmap = array(
		"getResponse" => "GeoLocationServiceGetResponse",
		"get" => "GeoLocationServiceGet",
		"mutate" => "GeoLocationServiceMutate",
		"mutateResponse" => "GeoLocationServiceMutateResponse",
		"DateTime" => "AdWordsDateTime",
		"Target" => "AdWordsTarget",
		"SoapHeader" => "SoapRequestHeader",
		"Address" => "Address",
		"AuthenticationError" => "AuthenticationError",
		"ApiError" => "ApiError",
		"AuthorizationError" => "AuthorizationError",
		"ClientTermsError" => "ClientTermsError",
		"GeoLocationError" => "GeoLocationError",
		"GeoLocationSelector" => "GeoLocationSelector",
		"GeoPoint" => "GeoPoint",
		"InternalApiError" => "InternalApiError",
		"InvalidGeoLocation" => "InvalidGeoLocation",
		"GeoLocation" => "GeoLocation",
		"NotEmptyError" => "NotEmptyError",
		"NotWhitelistedError" => "NotWhitelistedError",
		"NullError" => "NullError",
		"QuotaCheckError" => "QuotaCheckError",
		"QuotaExceededError" => "QuotaExceededError",
		"RegionCodeError" => "RegionCodeError",
		"RequiredError" => "RequiredError",
		"SizeLimitError" => "SizeLimitError",
		"SoapResponseHeader" => "SoapResponseHeader",
		"StringLengthError" => "StringLengthError",
		"ApiException" => "ApiException",
		"ApplicationException" => "ApplicationException",
		"AuthenticationError.Reason" => "AuthenticationErrorReason",
		"AuthorizationError.Reason" => "AuthorizationErrorReason",
		"ClientTermsError.Reason" => "ClientTermsErrorReason",
		"GeoLocationError.Reason" => "GeoLocationErrorReason",
		"InternalApiError.Reason" => "InternalApiErrorReason",
		"NotEmptyError.Reason" => "NotEmptyErrorReason",
		"NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
		"NullError.Reason" => "NullErrorReason",
		"QuotaCheckError.Reason" => "QuotaCheckErrorReason",
		"QuotaExceededError.Reason" => "QuotaExceededErrorReason",
		"RegionCodeError.Reason" => "RegionCodeErrorReason",
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
		$options["classmap"] = GeoLocationService::$classmap;
		parent::__construct($wsdl, $options, $user, 'GeoLocationService');
	}

	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Retrieves the geographic location information for the address specified.
	 * 
	 * @param selector specifies the addresses.
	 * @return list of {@link GeoLocation} objects. Returns {@link InvalidGeoLocation} object if
	 * the address cannot be geocoded.
	 * @throws ApiException if problems occurred while retrieving the location information
	 */
	public function get($selector) {
		$arg = new GeoLocationServiceGet($selector);
		$result = $this->__soapCall("get", array($arg));
		return $result->rval;
	}


}}

?>