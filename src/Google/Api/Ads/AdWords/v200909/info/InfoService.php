<?php
/**
 * Contains all client objects for the InfoService service.
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

if (!class_exists("DateRange")) {
/**
 * Represents a range of dates that has either an upper or a lower bound.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class DateRange {
	/**
	 * @access public
	 * @var string
	 */
	public $min;
	/**
	 * @access public
	 * @var string
	 */
	public $max;

	public function __construct($min = NULL, $max = NULL) {
		if(get_parent_class('DateRange')) parent::__construct();
		$this->min = $min;
		$this->max = $max;
	}
}}

if (!class_exists("SoapRequestHeader")) {
/**
 * Defines the required and optional elements within the header of a SOAP request.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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

if (!class_exists("ApiError")) {
/**
 * A service api error base class that provides error details.
 * 1) the OGNL field path is provided for parsers.
 * 2) the OGNL field path with debug comments easily helps track causes.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class ClientTermsErrorReason {

	public function __construct() {
		if(get_parent_class('ClientTermsErrorReason')) parent::__construct();
	}
}}

if (!class_exists("EntityNotFoundReason")) {
/**
 * The specified id refered to an entity which either doesn't exist or is not accessible to the
 * customer. e.g. campaign belongs to another customer.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class EntityNotFoundReason {

	public function __construct() {
		if(get_parent_class('EntityNotFoundReason')) parent::__construct();
	}
}}

if (!class_exists("InternalApiErrorReason")) {
/**
 * The single reason for the internal API error.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class InternalApiErrorReason {

	public function __construct() {
		if(get_parent_class('InternalApiErrorReason')) parent::__construct();
	}
}}

if (!class_exists("NotEmptyErrorReason")) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class NullErrorReason {

	public function __construct() {
		if(get_parent_class('NullErrorReason')) parent::__construct();
	}
}}

if (!class_exists("Operator")) {
/**
 * This represents an operator that may be presented to an adsapi service.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class Operator {

	public function __construct() {
		if(get_parent_class('Operator')) parent::__construct();
	}
}}

if (!class_exists("OperatorErrorReason")) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class OperatorErrorReason {

	public function __construct() {
		if(get_parent_class('OperatorErrorReason')) parent::__construct();
	}
}}

if (!class_exists("QuotaCheckErrorReason")) {
/**
 * Enums for all the reasons an error can be thrown to the user during
 * billing quota checks.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class QuotaExceededErrorReason {

	public function __construct() {
		if(get_parent_class('QuotaExceededErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ReadOnlyErrorReason")) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
 */
class SizeLimitErrorReason {

	public function __construct() {
		if(get_parent_class('SizeLimitErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ApiUsageError")) {
/**
 * Represents possible error codes in InfoService.
 */
class ApiUsageError extends ApiError {
	/**
	 * @access public
	 * @var tnsApiUsageErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('ApiUsageError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("ApiUsageRecord")) {
/**
 * Data record for per client API units.
 */
class ApiUsageRecord {
	/**
	 * @access public
	 * @var string
	 */
	public $clientEmail;
	/**
	 * @access public
	 * @var integer
	 */
	public $cost;

	public function __construct($clientEmail = NULL, $cost = NULL) {
		if(get_parent_class('ApiUsageRecord')) parent::__construct();
		$this->clientEmail = $clientEmail;
		$this->cost = $cost;
	}
}}

if (!class_exists("InfoSelector")) {
/**
 * Specifies the type of API usage information to be returned. API usage information
 * returned is based on the {@link #apiUsageType API usage type} specified.
 * 
 * <p>For each of the <code>apiUsageType</code> values, other <code>InfoSelector</code>
 * fields must also be set as described below:</p>
 * 
 * <ul>
 * <li><code>FREE_USAGE_API_UNITS_PER_MONTH</code> : Retrieves the number of
 * <a href="http://www.google.com/support/adwordsapi/bin/answer.py?answer=45891">
 * free API units</a> that can be used by the developer token being used to make
 * the call for this month. Specify only the apiUsageType parameter.</li>
 * <li><code>TOTAL_USAGE_API_UNITS_PER_MONTH</code> : Retrieves the total number of API units for
 * this entire month that can be used by the developer token being used to make this call.
 * Includes both free and paid API units. Specify only the apiUsageType parameter.</li>
 * <li><code>OPERATION_COUNT</code> : Retrieves the number of operations recorded for the
 * developer token being used to make this call over the given date range. The given dates are
 * inclusive; to get the operation count for a single day, supply it as both
 * the start and end date. Specify the apiUsageType and dateRange parameters. </li>
 * <li><code>UNIT_COUNT</code> : Retrieves the number of API units recorded for the developer
 * token being used to make this call.
 * <ul>
 * <li>Specify the apiUsageType and dateRange parameters to retrieve
 * the units recorded over the given date range.</li>
 * <li>Specify the apiUsageType, serviceName, methodName, operator, dateRange to
 * retrieve the units recorded over the given date range for a specified method.</li>
 * </ul>
 * </li>
 * <li><code>UNIT_COUNT_FOR_CLIENTS</code> : Retrieves the number of API units recorded for a
 * subset of clients over the given date range for the developer token being used
 * to make this call. The given dates are inclusive; to get the unit count for a single day,
 * supply it as both the start and end date. Specify the apiUsageType, dateRange and
 * clientEmails parameters.</li>
 * <li><code>METHOD_COST</code> : Retrieves the cost, in API units per operation, of the given
 * method on a specific date for the developer token being used to make this call. Methods
 * default to a cost of 1. Specify the apiUsageType, dateRange (start date and end date
 * should be the same), serviceName, methodName, operator parameters.</li>
 * </ul>
 */
class InfoSelector {
	/**
	 * @access public
	 * @var string
	 */
	public $serviceName;
	/**
	 * @access public
	 * @var string
	 */
	public $methodName;
	/**
	 * @access public
	 * @var cmOperator
	 */
	public $operator;
	/**
	 * @access public
	 * @var DateRange
	 */
	public $dateRange;
	/**
	 * @access public
	 * @var string[]
	 */
	public $clientEmails;
	/**
	 * @access public
	 * @var tnsApiUsageType
	 */
	public $apiUsageType;

	public function __construct($serviceName = NULL, $methodName = NULL, $operator = NULL, $dateRange = NULL, $clientEmails = NULL, $apiUsageType = NULL) {
		if(get_parent_class('InfoSelector')) parent::__construct();
		$this->serviceName = $serviceName;
		$this->methodName = $methodName;
		$this->operator = $operator;
		$this->dateRange = $dateRange;
		$this->clientEmails = $clientEmails;
		$this->apiUsageType = $apiUsageType;
	}
}}

if (!class_exists("ApiUsageInfo")) {
/**
 * Represents the API usage information.
 */
class ApiUsageInfo {
	/**
	 * @access public
	 * @var ApiUsageRecord[]
	 */
	public $apiUsageRecords;
	/**
	 * @access public
	 * @var integer
	 */
	public $cost;

	public function __construct($apiUsageRecords = NULL, $cost = NULL) {
		if(get_parent_class('ApiUsageInfo')) parent::__construct();
		$this->apiUsageRecords = $apiUsageRecords;
		$this->cost = $cost;
	}
}}

if (!class_exists("ApiUsageErrorReason")) {
/**
 * Enum used to represent the errors
 */
class ApiUsageErrorReason {

	public function __construct() {
		if(get_parent_class('ApiUsageErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ApiUsageType")) {
/**
 * Enum to represent the type of API usage.
 */
class ApiUsageType {

	public function __construct() {
		if(get_parent_class('ApiUsageType')) parent::__construct();
	}
}}

if (!class_exists("InfoServiceGet")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns the API usage information based on the selection criteria specified in
 * the selector.
 * 
 * @param selector Specifies the type of usage information to return.
 * @return The API usage information.
 * @throws ApiException when there is at least one error with the request.
 */
class InfoServiceGet {
	/**
	 * @access public
	 * @var InfoSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('InfoServiceGet')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("InfoServiceGetResponse")) {
/**
 * 
 */
class InfoServiceGetResponse {
	/**
	 * @access public
	 * @var ApiUsageInfo
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('InfoServiceGetResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AuthenticationError")) {
/**
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * 
 * 
 * 
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

if (!class_exists("EntityNotFound")) {
/**
 * An id did not correspond to an entity, or it referred to an entity which does not belong to the
 * customer.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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

if (!class_exists("NotEmptyError")) {
/**
 * A list of all errors associated with the @NotEmpty constraints.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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

if (!class_exists("QuotaCheckError")) {
/**
 * Encapsulates the errors thrown during developer quota checks for webapi
 * calls.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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
 * Encapsulates the errors thrown during client terms checks for adwords.
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

if (!class_exists("ApiException")) {
/**
 * Exception class for holding a list of service errors.
 * 
 * 
 * 
 * Encapsulates the errors thrown during client terms checks for adwords.
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

if (!class_exists("InfoService")) {
/**
 * InfoService
 * @author WSDLInterpreter
 */
class InfoService extends AdWordsSoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	public static $classmap = array(
		"getResponse" => "InfoServiceGetResponse",
		"get" => "InfoServiceGet",
		"mutate" => "InfoServiceMutate",
		"mutateResponse" => "InfoServiceMutateResponse",
		"DateTime" => "AdWordsDateTime",
		"Target" => "AdWordsTarget",
		"SoapHeader" => "SoapRequestHeader",
		"AuthenticationError" => "AuthenticationError",
		"ApiError" => "ApiError",
		"AuthorizationError" => "AuthorizationError",
		"ClientTermsError" => "ClientTermsError",
		"DateRange" => "DateRange",
		"EntityNotFound" => "EntityNotFound",
		"InternalApiError" => "InternalApiError",
		"NotEmptyError" => "NotEmptyError",
		"NotWhitelistedError" => "NotWhitelistedError",
		"NullError" => "NullError",
		"OperatorError" => "OperatorError",
		"QuotaCheckError" => "QuotaCheckError",
		"QuotaExceededError" => "QuotaExceededError",
		"ReadOnlyError" => "ReadOnlyError",
		"RequiredError" => "RequiredError",
		"SizeLimitError" => "SizeLimitError",
		"SoapResponseHeader" => "SoapResponseHeader",
		"ApiException" => "ApiException",
		"ApplicationException" => "ApplicationException",
		"AuthenticationError.Reason" => "AuthenticationErrorReason",
		"AuthorizationError.Reason" => "AuthorizationErrorReason",
		"ClientTermsError.Reason" => "ClientTermsErrorReason",
		"EntityNotFound.Reason" => "EntityNotFoundReason",
		"InternalApiError.Reason" => "InternalApiErrorReason",
		"NotEmptyError.Reason" => "NotEmptyErrorReason",
		"NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
		"NullError.Reason" => "NullErrorReason",
		"Operator" => "Operator",
		"OperatorError.Reason" => "OperatorErrorReason",
		"QuotaCheckError.Reason" => "QuotaCheckErrorReason",
		"QuotaExceededError.Reason" => "QuotaExceededErrorReason",
		"ReadOnlyError.Reason" => "ReadOnlyErrorReason",
		"RequiredError.Reason" => "RequiredErrorReason",
		"SizeLimitError.Reason" => "SizeLimitErrorReason",
		"ApiUsageError" => "ApiUsageError",
		"ApiUsageRecord" => "ApiUsageRecord",
		"InfoSelector" => "InfoSelector",
		"ApiUsageInfo" => "ApiUsageInfo",
		"ApiUsageError.Reason" => "ApiUsageErrorReason",
		"ApiUsageType" => "ApiUsageType",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl=null, $options, $user) {
		$options["classmap"] = InfoService::$classmap;
		parent::__construct($wsdl, $options, $user, 'InfoService');
	}

	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Returns the API usage information based on the selection criteria specified in
	 * the selector.
	 * 
	 * @param selector Specifies the type of usage information to return.
	 * @return The API usage information.
	 * @throws ApiException when there is at least one error with the request.
	 */
	public function get($selector) {
		$arg = new InfoServiceGet($selector);
		$result = $this->__soapCall("get", array($arg));
		return $result->rval;
	}


}}

?>