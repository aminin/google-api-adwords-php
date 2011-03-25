<?php
/**
 * Contains all client objects for the TargetingIdeaService service.
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
 * @subpackage v201101
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

/** Required the SoapClient class. **/
require_once dirname(__FILE__) . "/../../Lib/AdWordsSoapClient.php";

if (!class_exists("Address", FALSE)) {
/**
 * Structure to specify an address location.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Address";
  }

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

if (!class_exists("ApiError", FALSE)) {
/**
 * The API error base class that provides details about an error that occurred
 * while processing a service request.
 * 
 * <p>The OGNL field path is provided for parsers to identify the request data
 * element that may have caused the error.</p>
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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
  public $errorString;

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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ApiError";
  }

  public function __construct($fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('ApiError')) parent::__construct();
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("ApplicationException", FALSE)) {
/**
 * Base class for exceptions.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ApplicationException";
  }

  public function __construct($message = NULL, $ApplicationExceptionType = NULL) {
    if(get_parent_class('ApplicationException')) parent::__construct();
    $this->message = $message;
    $this->ApplicationExceptionType = $ApplicationExceptionType;
  }
}}

if (!class_exists("AuthenticationError", FALSE)) {
/**
 * Errors returned when Authentication failed.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AuthenticationError extends ApiError {
  /**
   * @access public
   * @var tnsAuthenticationErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AuthenticationError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('AuthenticationError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("AuthorizationError", FALSE)) {
/**
 * Errors that are thrown due to an authorization problem.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AuthorizationError extends ApiError {
  /**
   * @access public
   * @var tnsAuthorizationErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AuthorizationError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('AuthorizationError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("BidLandscapeLandscapePoint", FALSE)) {
/**
 * A set of estimates for a criterion's performance for a specific bid
 * amount.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BidLandscapeLandscapePoint {
  /**
   * @access public
   * @var Money
   */
  public $bid;

  /**
   * @access public
   * @var integer
   */
  public $clicks;

  /**
   * @access public
   * @var Money
   */
  public $cost;

  /**
   * @access public
   * @var Money
   */
  public $marginalCpc;

  /**
   * @access public
   * @var integer
   */
  public $impressions;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BidLandscape.LandscapePoint";
  }

  public function __construct($bid = NULL, $clicks = NULL, $cost = NULL, $marginalCpc = NULL, $impressions = NULL) {
    if(get_parent_class('BidLandscapeLandscapePoint')) parent::__construct();
    $this->bid = $bid;
    $this->clicks = $clicks;
    $this->cost = $cost;
    $this->marginalCpc = $marginalCpc;
    $this->impressions = $impressions;
  }
}}

if (!class_exists("BiddingError", FALSE)) {
/**
 * Represents bidding errors.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BiddingError extends ApiError {
  /**
   * @access public
   * @var tnsBiddingErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BiddingError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('BiddingError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("BudgetError", FALSE)) {
/**
 * A list of all the error codes being used by the common budget domain package.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BudgetError extends ApiError {
  /**
   * @access public
   * @var tnsBudgetErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BudgetError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('BudgetError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("ClientTermsError", FALSE)) {
/**
 * Encapsulates the errors thrown during client terms checks for adwords.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ClientTermsError extends ApiError {
  /**
   * @access public
   * @var tnsClientTermsErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ClientTermsError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('ClientTermsError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("ComparableValue", FALSE)) {
/**
 * Comparable types for constructing ranges with.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ComparableValue";
  }

  public function __construct($ComparableValueType = NULL) {
    if(get_parent_class('ComparableValue')) parent::__construct();
    $this->ComparableValueType = $ComparableValueType;
  }
}}

if (!class_exists("Criterion", FALSE)) {
/**
 * Represents a criterion (such as a keyword, placement, or vertical).
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Criterion";
  }

  public function __construct($id = NULL, $CriterionType = NULL) {
    if(get_parent_class('Criterion')) parent::__construct();
    $this->id = $id;
    $this->CriterionType = $CriterionType;
  }
}}

if (!class_exists("DatabaseError", FALSE)) {
/**
 * Errors that are thrown due to a database access problem.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DatabaseError extends ApiError {
  /**
   * @access public
   * @var tnsDatabaseErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DatabaseError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('DatabaseError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("DateError", FALSE)) {
/**
 * Errors associated with invalid dates and date ranges.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DateError extends ApiError {
  /**
   * @access public
   * @var tnsDateErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DateError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('DateError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("DistinctError", FALSE)) {
/**
 * Errors related to distinct ids or content.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DistinctError extends ApiError {
  /**
   * @access public
   * @var tnsDistinctErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DistinctError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('DistinctError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("EntityCountLimitExceeded", FALSE)) {
/**
 * Signals that an entity count limit was exceeded for some level.
 * For example, too many criteria for a campaign.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class EntityCountLimitExceeded extends ApiError {
  /**
   * @access public
   * @var tnsEntityCountLimitExceededReason
   */
  public $reason;

  /**
   * @access public
   * @var string
   */
  public $enclosingId;

  /**
   * @access public
   * @var integer
   */
  public $limit;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "EntityCountLimitExceeded";
  }

  public function __construct($reason = NULL, $enclosingId = NULL, $limit = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('EntityCountLimitExceeded')) parent::__construct();
    $this->reason = $reason;
    $this->enclosingId = $enclosingId;
    $this->limit = $limit;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("EntityNotFound", FALSE)) {
/**
 * An id did not correspond to an entity, or it referred to an entity which does not belong to the
 * customer.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class EntityNotFound extends ApiError {
  /**
   * @access public
   * @var tnsEntityNotFoundReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "EntityNotFound";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('EntityNotFound')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("GeoPoint", FALSE)) {
/**
 * Specifies a geo location with the supplied latitude/longitude.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "GeoPoint";
  }

  public function __construct($latitudeInMicroDegrees = NULL, $longitudeInMicroDegrees = NULL) {
    if(get_parent_class('GeoPoint')) parent::__construct();
    $this->latitudeInMicroDegrees = $latitudeInMicroDegrees;
    $this->longitudeInMicroDegrees = $longitudeInMicroDegrees;
  }
}}

if (!class_exists("InternalApiError", FALSE)) {
/**
 * Indicates that a server-side error has occured. {@code InternalApiError}s
 * are generally not the result of an invalid request or message sent by the
 * client.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class InternalApiError extends ApiError {
  /**
   * @access public
   * @var tnsInternalApiErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "InternalApiError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('InternalApiError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("Keyword", FALSE)) {
/**
 * Represents a keyword.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Keyword";
  }

  public function __construct($text = NULL, $matchType = NULL, $id = NULL, $CriterionType = NULL) {
    if(get_parent_class('Keyword')) parent::__construct();
    $this->text = $text;
    $this->matchType = $matchType;
    $this->id = $id;
    $this->CriterionType = $CriterionType;
  }
}}

if (!class_exists("Money", FALSE)) {
/**
 * Represents a money amount.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class Money extends ComparableValue {
  /**
   * @access public
   * @var integer
   */
  public $microAmount;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Money";
  }

  public function __construct($microAmount = NULL, $ComparableValueType = NULL) {
    if(get_parent_class('Money')) parent::__construct();
    $this->microAmount = $microAmount;
    $this->ComparableValueType = $ComparableValueType;
  }
}}

if (!class_exists("NotEmptyError", FALSE)) {
/**
 * A list of all errors associated with the @NotEmpty constraints.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class NotEmptyError extends ApiError {
  /**
   * @access public
   * @var tnsNotEmptyErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "NotEmptyError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('NotEmptyError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("NotWhitelistedError", FALSE)) {
/**
 * Indicates that the customer is not whitelisted for accessing the API.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class NotWhitelistedError extends ApiError {
  /**
   * @access public
   * @var tnsNotWhitelistedErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "NotWhitelistedError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('NotWhitelistedError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("NullError", FALSE)) {
/**
 * Errors associated with contents not null constraint.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class NullError extends ApiError {
  /**
   * @access public
   * @var tnsNullErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "NullError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('NullError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("NumberValue", FALSE)) {
/**
 * Number value types for constructing number valued ranges.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class NumberValue extends ComparableValue {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "NumberValue";
  }

  public function __construct($ComparableValueType = NULL) {
    if(get_parent_class('NumberValue')) parent::__construct();
    $this->ComparableValueType = $ComparableValueType;
  }
}}

if (!class_exists("Paging", FALSE)) {
/**
 * Specifies the page of results to return in the response. A page is specified
 * by the result position to start at and the maximum number of results to
 * return.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Paging";
  }

  public function __construct($startIndex = NULL, $numberResults = NULL) {
    if(get_parent_class('Paging')) parent::__construct();
    $this->startIndex = $startIndex;
    $this->numberResults = $numberResults;
  }
}}

if (!class_exists("Placement", FALSE)) {
/**
 * A placement used for modifying bids for sites when targeting the content
 * network.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class Placement extends Criterion {
  /**
   * @access public
   * @var string
   */
  public $url;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Placement";
  }

  public function __construct($url = NULL, $id = NULL, $CriterionType = NULL) {
    if(get_parent_class('Placement')) parent::__construct();
    $this->url = $url;
    $this->id = $id;
    $this->CriterionType = $CriterionType;
  }
}}

if (!class_exists("PolicyViolationError", FALSE)) {
/**
 * Represents violations of a single policy by some text in a field.
 * 
 * Violations of a single policy by the same string in multiple places
 * within a field is reported in one instace of this class and only one
 * exemption needs to be filed.
 * Violations of a single policy by two different strings is reported
 * as two separate instances of this class.
 * 
 * e.g. If 'ACME' violates 'capitalization' and occurs twice in a text ad it
 * would be represented by one instance. If the ad also contains 'INC' which
 * also violates 'capitalization' it would be represented in a separate
 * instance.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PolicyViolationError extends ApiError {
  /**
   * @access public
   * @var PolicyViolationKey
   */
  public $key;

  /**
   * @access public
   * @var string
   */
  public $externalPolicyName;

  /**
   * @access public
   * @var string
   */
  public $externalPolicyUrl;

  /**
   * @access public
   * @var string
   */
  public $externalPolicyDescription;

  /**
   * @access public
   * @var boolean
   */
  public $isExemptable;

  /**
   * @access public
   * @var PolicyViolationErrorPart[]
   */
  public $violatingParts;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PolicyViolationError";
  }

  public function __construct($key = NULL, $externalPolicyName = NULL, $externalPolicyUrl = NULL, $externalPolicyDescription = NULL, $isExemptable = NULL, $violatingParts = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('PolicyViolationError')) parent::__construct();
    $this->key = $key;
    $this->externalPolicyName = $externalPolicyName;
    $this->externalPolicyUrl = $externalPolicyUrl;
    $this->externalPolicyDescription = $externalPolicyDescription;
    $this->isExemptable = $isExemptable;
    $this->violatingParts = $violatingParts;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("PolicyViolationErrorPart", FALSE)) {
/**
 * Points to a substring within an ad field or criterion.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PolicyViolationErrorPart {
  /**
   * @access public
   * @var integer
   */
  public $index;

  /**
   * @access public
   * @var integer
   */
  public $length;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PolicyViolationError.Part";
  }

  public function __construct($index = NULL, $length = NULL) {
    if(get_parent_class('PolicyViolationErrorPart')) parent::__construct();
    $this->index = $index;
    $this->length = $length;
  }
}}

if (!class_exists("PolicyViolationKey", FALSE)) {
/**
 * Key of the violation. The key is used for referring to a violation when
 * filing an exemption request.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PolicyViolationKey {
  /**
   * @access public
   * @var string
   */
  public $policyName;

  /**
   * @access public
   * @var string
   */
  public $violatingText;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PolicyViolationKey";
  }

  public function __construct($policyName = NULL, $violatingText = NULL) {
    if(get_parent_class('PolicyViolationKey')) parent::__construct();
    $this->policyName = $policyName;
    $this->violatingText = $violatingText;
  }
}}

if (!class_exists("Product", FALSE)) {
/**
 * Product targeting criteria, represents a filter for products in the
 * product feed that is defined by the advertiser. The criteria is used to
 * determine the products in a Merchant Center account to be used with the
 * ProductAds in the AdGroup. This criteria is available only to some advertisers.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class Product extends Criterion {
  /**
   * @access public
   * @var ProductCondition[]
   */
  public $conditions;

  /**
   * @access public
   * @var string
   */
  public $text;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Product";
  }

  public function __construct($conditions = NULL, $text = NULL, $id = NULL, $CriterionType = NULL) {
    if(get_parent_class('Product')) parent::__construct();
    $this->conditions = $conditions;
    $this->text = $text;
    $this->id = $id;
    $this->CriterionType = $CriterionType;
  }
}}

if (!class_exists("ProductCondition", FALSE)) {
/**
 * Conditions to filter the products defined in product feed for targeting.
 * The condition is defined as operand=argument.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ProductCondition {
  /**
   * @access public
   * @var string
   */
  public $argument;

  /**
   * @access public
   * @var ProductConditionOperand
   */
  public $operand;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ProductCondition";
  }

  public function __construct($argument = NULL, $operand = NULL) {
    if(get_parent_class('ProductCondition')) parent::__construct();
    $this->argument = $argument;
    $this->operand = $operand;
  }
}}

if (!class_exists("ProductConditionOperand", FALSE)) {
/**
 * Attribute for the product condition.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ProductConditionOperand {
  /**
   * @access public
   * @var string
   */
  public $operand;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ProductConditionOperand";
  }

  public function __construct($operand = NULL) {
    if(get_parent_class('ProductConditionOperand')) parent::__construct();
    $this->operand = $operand;
  }
}}

if (!class_exists("QuotaCheckError", FALSE)) {
/**
 * Encapsulates the errors thrown during developer quota checks.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class QuotaCheckError extends ApiError {
  /**
   * @access public
   * @var tnsQuotaCheckErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "QuotaCheckError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('QuotaCheckError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("RangeError", FALSE)) {
/**
 * A list of all errors associated with the Range constraint.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RangeError extends ApiError {
  /**
   * @access public
   * @var tnsRangeErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RangeError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('RangeError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("RateExceededError", FALSE)) {
/**
 * Signals that a call failed because a measured rate exceeded.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RateExceededError extends ApiError {
  /**
   * @access public
   * @var tnsRateExceededErrorReason
   */
  public $reason;

  /**
   * @access public
   * @var string
   */
  public $rateName;

  /**
   * @access public
   * @var string
   */
  public $rateScope;

  /**
   * @access public
   * @var integer
   */
  public $retryAfterSeconds;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RateExceededError";
  }

  public function __construct($reason = NULL, $rateName = NULL, $rateScope = NULL, $retryAfterSeconds = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('RateExceededError')) parent::__construct();
    $this->reason = $reason;
    $this->rateName = $rateName;
    $this->rateScope = $rateScope;
    $this->retryAfterSeconds = $retryAfterSeconds;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("ReadOnlyError", FALSE)) {
/**
 * A list of all errors associated with the @ReadOnly constraint.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ReadOnlyError extends ApiError {
  /**
   * @access public
   * @var tnsReadOnlyErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ReadOnlyError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('ReadOnlyError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("RegionCodeError", FALSE)) {
/**
 * A list of all errors associated with the @RegionCode constraints.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RegionCodeError extends ApiError {
  /**
   * @access public
   * @var tnsRegionCodeErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RegionCodeError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('RegionCodeError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("RequestError", FALSE)) {
/**
 * Encapsulates the generic errors thrown when there's an error with user
 * request.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RequestError extends ApiError {
  /**
   * @access public
   * @var tnsRequestErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RequestError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('RequestError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("RequiredError", FALSE)) {
/**
 * Errors due to missing required field.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RequiredError extends ApiError {
  /**
   * @access public
   * @var tnsRequiredErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RequiredError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('RequiredError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("SizeLimitError", FALSE)) {
/**
 * Indicates that the number of entries in the request or response exceeds the system limit.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SizeLimitError extends ApiError {
  /**
   * @access public
   * @var tnsSizeLimitErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SizeLimitError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('SizeLimitError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("SoapRequestHeader", FALSE)) {
/**
 * Defines the required and optional elements within the header of a SOAP request.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SoapRequestHeader {
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

  /**
   * @access public
   * @var boolean
   */
  public $partialFailure;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SoapHeader";
  }

  public function __construct($authToken = NULL, $clientCustomerId = NULL, $clientEmail = NULL, $developerToken = NULL, $userAgent = NULL, $validateOnly = NULL, $partialFailure = NULL) {
    if(get_parent_class('SoapRequestHeader')) parent::__construct();
    $this->authToken = $authToken;
    $this->clientCustomerId = $clientCustomerId;
    $this->clientEmail = $clientEmail;
    $this->developerToken = $developerToken;
    $this->userAgent = $userAgent;
    $this->validateOnly = $validateOnly;
    $this->partialFailure = $partialFailure;
  }
}}

if (!class_exists("SoapResponseHeader", FALSE)) {
/**
 * Defines the elements within the header of a SOAP response.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SoapResponseHeader";
  }

  public function __construct($requestId = NULL, $operations = NULL, $responseTime = NULL, $units = NULL) {
    if(get_parent_class('SoapResponseHeader')) parent::__construct();
    $this->requestId = $requestId;
    $this->operations = $operations;
    $this->responseTime = $responseTime;
    $this->units = $units;
  }
}}

if (!class_exists("StatsQueryError", FALSE)) {
/**
 * Represents possible error codes when querying for stats.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class StatsQueryError extends ApiError {
  /**
   * @access public
   * @var tnsStatsQueryErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "StatsQueryError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('StatsQueryError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("StringLengthError", FALSE)) {
/**
 * A list of all errors associated with the @ContentsString constraint.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class StringLengthError extends ApiError {
  /**
   * @access public
   * @var tnsStringLengthErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "StringLengthError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('StringLengthError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("DataEntry", FALSE)) {
/**
 * The base class of all return types of the table service.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DataEntry {
  /**
   * @access public
   * @var string
   */
  public $DataEntryType;

  private $_parameterMap = array (
    "DataEntry.Type" => "DataEntryType",
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DataEntry";
  }

  public function __construct($DataEntryType = NULL) {
    if(get_parent_class('DataEntry')) parent::__construct();
    $this->DataEntryType = $DataEntryType;
  }
}}

if (!class_exists("AdWordsTarget", FALSE)) {
/**
 * Target abstract class.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Target";
  }

  public function __construct($TargetType = NULL) {
    if(get_parent_class('AdWordsTarget')) parent::__construct();
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("TargetError", FALSE)) {
/**
 * A list of all the error codes being used by the common targeting package.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class TargetError extends ApiError {
  /**
   * @access public
   * @var tnsTargetErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "TargetError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('TargetError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("CriterionUserInterest", FALSE)) {
/**
 * User Interest - represents a particular interest based vertical to be targeted.
 * Targeting UserInterest is currently in a limited beta.  If you'd like access
 * please speak with your account representative.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CriterionUserInterest extends Criterion {
  /**
   * @access public
   * @var integer
   */
  public $userInterestId;

  /**
   * @access public
   * @var string
   */
  public $userInterestName;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CriterionUserInterest";
  }

  public function __construct($userInterestId = NULL, $userInterestName = NULL, $id = NULL, $CriterionType = NULL) {
    if(get_parent_class('CriterionUserInterest')) parent::__construct();
    $this->userInterestId = $userInterestId;
    $this->userInterestName = $userInterestName;
    $this->id = $id;
    $this->CriterionType = $CriterionType;
  }
}}

if (!class_exists("CriterionUserList", FALSE)) {
/**
 * UserList - represents a user list that is defined by the advertiser to be targeted.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CriterionUserList extends Criterion {
  /**
   * @access public
   * @var integer
   */
  public $userListId;

  /**
   * @access public
   * @var string
   */
  public $userListName;

  /**
   * @access public
   * @var tnsCriterionUserListMembershipStatus
   */
  public $userListMembershipStatus;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CriterionUserList";
  }

  public function __construct($userListId = NULL, $userListName = NULL, $userListMembershipStatus = NULL, $id = NULL, $CriterionType = NULL) {
    if(get_parent_class('CriterionUserList')) parent::__construct();
    $this->userListId = $userListId;
    $this->userListName = $userListName;
    $this->userListMembershipStatus = $userListMembershipStatus;
    $this->id = $id;
    $this->CriterionType = $CriterionType;
  }
}}

if (!class_exists("Vertical", FALSE)) {
/**
 * Use verticals to target or exclude placements in the Google Display Network
 * based on the category into which the placement falls (for example, "Pets &amp;
 * Animals/Pets/Dogs").
 * <a href="/apis/adwords/docs/appendix/verticals.html">View the complete list
 * of available vertical categories.</a>
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class Vertical extends Criterion {
  /**
   * @access public
   * @var string[]
   */
  public $path;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Vertical";
  }

  public function __construct($path = NULL, $id = NULL, $CriterionType = NULL) {
    if(get_parent_class('Vertical')) parent::__construct();
    $this->path = $path;
    $this->id = $id;
    $this->CriterionType = $CriterionType;
  }
}}

if (!class_exists("AdGroupBidLandscapeType", FALSE)) {
/**
 * Used to specify the type of {@code AdGroupLandscape}
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdGroupBidLandscapeType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdGroupBidLandscape.Type";
  }

  public function __construct() {
    if(get_parent_class('AdGroupBidLandscapeType')) parent::__construct();
  }
}}

if (!class_exists("AdGroupCriterionErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdGroupCriterionErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdGroupCriterionError.Reason";
  }

  public function __construct() {
    if(get_parent_class('AdGroupCriterionErrorReason')) parent::__construct();
  }
}}

if (!class_exists("AdGroupCriterionLimitExceededCriteriaLimitType", FALSE)) {
/**
 * The entity type that exceeded the limit.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdGroupCriterionLimitExceededCriteriaLimitType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdGroupCriterionLimitExceeded.CriteriaLimitType";
  }

  public function __construct() {
    if(get_parent_class('AdGroupCriterionLimitExceededCriteriaLimitType')) parent::__construct();
  }
}}

if (!class_exists("AgeTargetAge", FALSE)) {
/**
 * Age segments.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AgeTargetAge {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AgeTarget.Age";
  }

  public function __construct() {
    if(get_parent_class('AgeTargetAge')) parent::__construct();
  }
}}

if (!class_exists("AuthenticationErrorReason", FALSE)) {
/**
 * The single reason for the authentication failure.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AuthenticationErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AuthenticationError.Reason";
  }

  public function __construct() {
    if(get_parent_class('AuthenticationErrorReason')) parent::__construct();
  }
}}

if (!class_exists("AuthorizationErrorReason", FALSE)) {
/**
 * The reasons for the database error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AuthorizationErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AuthorizationError.Reason";
  }

  public function __construct() {
    if(get_parent_class('AuthorizationErrorReason')) parent::__construct();
  }
}}

if (!class_exists("BiddingErrorReason", FALSE)) {
/**
 * Reason for bidding error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BiddingErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BiddingError.Reason";
  }

  public function __construct() {
    if(get_parent_class('BiddingErrorReason')) parent::__construct();
  }
}}

if (!class_exists("BudgetErrorReason", FALSE)) {
/**
 * The reasons for the budget error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BudgetErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BudgetError.Reason";
  }

  public function __construct() {
    if(get_parent_class('BudgetErrorReason')) parent::__construct();
  }
}}

if (!class_exists("ClientTermsErrorReason", FALSE)) {
/**
 * Enums for the various reasons an error can be thrown as a result of
 * ClientTerms violation.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ClientTermsErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ClientTermsError.Reason";
  }

  public function __construct() {
    if(get_parent_class('ClientTermsErrorReason')) parent::__construct();
  }
}}

if (!class_exists("DatabaseErrorReason", FALSE)) {
/**
 * The reasons for the database error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DatabaseErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DatabaseError.Reason";
  }

  public function __construct() {
    if(get_parent_class('DatabaseErrorReason')) parent::__construct();
  }
}}

if (!class_exists("DateErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DateErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DateError.Reason";
  }

  public function __construct() {
    if(get_parent_class('DateErrorReason')) parent::__construct();
  }
}}

if (!class_exists("DayOfWeek", FALSE)) {
/**
 * Days of the week.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DayOfWeek {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DayOfWeek";
  }

  public function __construct() {
    if(get_parent_class('DayOfWeek')) parent::__construct();
  }
}}

if (!class_exists("DistinctErrorReason", FALSE)) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DistinctErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DistinctError.Reason";
  }

  public function __construct() {
    if(get_parent_class('DistinctErrorReason')) parent::__construct();
  }
}}

if (!class_exists("EntityCountLimitExceededReason", FALSE)) {
/**
 * Limits at various levels of the account.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class EntityCountLimitExceededReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "EntityCountLimitExceeded.Reason";
  }

  public function __construct() {
    if(get_parent_class('EntityCountLimitExceededReason')) parent::__construct();
  }
}}

if (!class_exists("EntityNotFoundReason", FALSE)) {
/**
 * The specified id refered to an entity which either doesn't exist or is not accessible to the
 * customer. e.g. campaign belongs to another customer.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class EntityNotFoundReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "EntityNotFound.Reason";
  }

  public function __construct() {
    if(get_parent_class('EntityNotFoundReason')) parent::__construct();
  }
}}

if (!class_exists("GenderTargetGender", FALSE)) {
/**
 * Gender segments.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class GenderTargetGender {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "GenderTarget.Gender";
  }

  public function __construct() {
    if(get_parent_class('GenderTargetGender')) parent::__construct();
  }
}}

if (!class_exists("InternalApiErrorReason", FALSE)) {
/**
 * The single reason for the internal API error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class InternalApiErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "InternalApiError.Reason";
  }

  public function __construct() {
    if(get_parent_class('InternalApiErrorReason')) parent::__construct();
  }
}}

if (!class_exists("KeywordMatchType", FALSE)) {
/**
 * Match type of a keyword. i.e. the way we match a keyword string with
 * search queries.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class KeywordMatchType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "KeywordMatchType";
  }

  public function __construct() {
    if(get_parent_class('KeywordMatchType')) parent::__construct();
  }
}}

if (!class_exists("MinuteOfHour", FALSE)) {
/**
 * Minutes in an hour.  Currently only 0, 15, 30, and 45 are supported
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MinuteOfHour {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MinuteOfHour";
  }

  public function __construct() {
    if(get_parent_class('MinuteOfHour')) parent::__construct();
  }
}}

if (!class_exists("NotEmptyErrorReason", FALSE)) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class NotEmptyErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "NotEmptyError.Reason";
  }

  public function __construct() {
    if(get_parent_class('NotEmptyErrorReason')) parent::__construct();
  }
}}

if (!class_exists("NotWhitelistedErrorReason", FALSE)) {
/**
 * The single reason for the whitelist error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class NotWhitelistedErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "NotWhitelistedError.Reason";
  }

  public function __construct() {
    if(get_parent_class('NotWhitelistedErrorReason')) parent::__construct();
  }
}}

if (!class_exists("NullErrorReason", FALSE)) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class NullErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "NullError.Reason";
  }

  public function __construct() {
    if(get_parent_class('NullErrorReason')) parent::__construct();
  }
}}

if (!class_exists("PlatformType", FALSE)) {
/**
 * Platform types.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PlatformType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PlatformType";
  }

  public function __construct() {
    if(get_parent_class('PlatformType')) parent::__construct();
  }
}}

if (!class_exists("ProximityTargetDistanceUnits", FALSE)) {
/**
 * The radius distance is expressed in either kilometers or miles.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ProximityTargetDistanceUnits {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ProximityTarget.DistanceUnits";
  }

  public function __construct() {
    if(get_parent_class('ProximityTargetDistanceUnits')) parent::__construct();
  }
}}

if (!class_exists("QuotaCheckErrorReason", FALSE)) {
/**
 * Enums for all the reasons an error can be thrown to the user during
 * billing quota checks.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class QuotaCheckErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "QuotaCheckError.Reason";
  }

  public function __construct() {
    if(get_parent_class('QuotaCheckErrorReason')) parent::__construct();
  }
}}

if (!class_exists("RangeErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RangeErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RangeError.Reason";
  }

  public function __construct() {
    if(get_parent_class('RangeErrorReason')) parent::__construct();
  }
}}

if (!class_exists("RateExceededErrorReason", FALSE)) {
/**
 * The reason for the rate exceeded error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RateExceededErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RateExceededError.Reason";
  }

  public function __construct() {
    if(get_parent_class('RateExceededErrorReason')) parent::__construct();
  }
}}

if (!class_exists("ReadOnlyErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ReadOnlyErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ReadOnlyError.Reason";
  }

  public function __construct() {
    if(get_parent_class('ReadOnlyErrorReason')) parent::__construct();
  }
}}

if (!class_exists("RegionCodeErrorReason", FALSE)) {
/**
 * The reasons for the validation error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RegionCodeErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RegionCodeError.Reason";
  }

  public function __construct() {
    if(get_parent_class('RegionCodeErrorReason')) parent::__construct();
  }
}}

if (!class_exists("RequestErrorReason", FALSE)) {
/**
 * Error reason is unknown.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RequestErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RequestError.Reason";
  }

  public function __construct() {
    if(get_parent_class('RequestErrorReason')) parent::__construct();
  }
}}

if (!class_exists("RequiredErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RequiredErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RequiredError.Reason";
  }

  public function __construct() {
    if(get_parent_class('RequiredErrorReason')) parent::__construct();
  }
}}

if (!class_exists("SizeLimitErrorReason", FALSE)) {
/**
 * The reasons for Ad Scheduling errors.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SizeLimitErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SizeLimitError.Reason";
  }

  public function __construct() {
    if(get_parent_class('SizeLimitErrorReason')) parent::__construct();
  }
}}

if (!class_exists("StatsQueryErrorReason", FALSE)) {
/**
 * The reasons for errors when querying for stats.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class StatsQueryErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "StatsQueryError.Reason";
  }

  public function __construct() {
    if(get_parent_class('StatsQueryErrorReason')) parent::__construct();
  }
}}

if (!class_exists("StringLengthErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class StringLengthErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "StringLengthError.Reason";
  }

  public function __construct() {
    if(get_parent_class('StringLengthErrorReason')) parent::__construct();
  }
}}

if (!class_exists("TargetErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class TargetErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "TargetError.Reason";
  }

  public function __construct() {
    if(get_parent_class('TargetErrorReason')) parent::__construct();
  }
}}

if (!class_exists("CriterionUserListMembershipStatus", FALSE)) {
/**
 * Membership status of the user list.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CriterionUserListMembershipStatus {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CriterionUserList.MembershipStatus";
  }

  public function __construct() {
    if(get_parent_class('CriterionUserListMembershipStatus')) parent::__construct();
  }
}}

if (!class_exists("AdFormatSpec", FALSE)) {
/**
 * A placement response object which provides information about one of the ad formats
 * supported by a placement.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdFormatSpec {
  /**
   * @access public
   * @var tnsSiteConstantsAdFormat
   */
  public $format;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdFormatSpec";
  }

  public function __construct($format = NULL) {
    if(get_parent_class('AdFormatSpec')) parent::__construct();
    $this->format = $format;
  }
}}

if (!class_exists("Attribute", FALSE)) {
/**
 * {@link Attribute}s encompass the core information about a particular
 * {@link com.google.ads.api.services.targetingideas.TargetingIdea}. Some
 * attributes are for {@code KEYWORD} {@link IdeaType}s, some are for
 * {@code PLACEMENT} {@link IdeaType}s, and some are for both. Ultimately, an
 * {@link Attribute} instance simply wraps an actual value of interest. For
 * example, {@link KeywordAttribute} wraps the keyword itself, while a
 * {@link BooleanAttribute} simply wraps a boolean describing some information
 * about the keyword idea.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Attribute";
  }

  public function __construct($AttributeType = NULL) {
    if(get_parent_class('Attribute')) parent::__construct();
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("BidLandscapeAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link BidLandscape} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BidLandscapeAttribute extends Attribute {
  /**
   * @access public
   * @var BidLandscape
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BidLandscapeAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('BidLandscapeAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("BooleanAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a boolean value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BooleanAttribute extends Attribute {
  /**
   * @access public
   * @var boolean
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BooleanAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('BooleanAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("CollectionSizeError", FALSE)) {
/**
 * A list of all errors associated with the @ContentsSize constraint.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CollectionSizeError extends ApiError {
  /**
   * @access public
   * @var tnsCollectionSizeErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CollectionSizeError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('CollectionSizeError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("CriterionAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link Criterion} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CriterionAttribute extends Attribute {
  /**
   * @access public
   * @var Criterion
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CriterionAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('CriterionAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("CurrencyCodeError", FALSE)) {
/**
 * Errors for currency codes.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CurrencyCodeError extends ApiError {
  /**
   * @access public
   * @var tnsCurrencyCodeErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CurrencyCodeError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('CurrencyCodeError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("DoubleAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a double value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DoubleAttribute extends Attribute {
  /**
   * @access public
   * @var double
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DoubleAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('DoubleAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("DoubleComparisonOperation", FALSE)) {
/**
 * Object representing double comparison operations. This is usually used within
 * a particular
 * {@link com.google.ads.api.services.targetingideas.search.SearchParameter} to
 * specify the valid values requested for the specific
 * {@link com.google.ads.api.services.targetingideas.attributes.Attribute}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DoubleComparisonOperation {
  /**
   * @access public
   * @var double
   */
  public $minimum;

  /**
   * @access public
   * @var double
   */
  public $maximum;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DoubleComparisonOperation";
  }

  public function __construct($minimum = NULL, $maximum = NULL) {
    if(get_parent_class('DoubleComparisonOperation')) parent::__construct();
    $this->minimum = $minimum;
    $this->maximum = $maximum;
  }
}}

if (!class_exists("IdeaTypeAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains an {@link IdeaType} value. For example,
 * if a {@link com.google.ads.api.services.targetingideas.TargetingIdea}
 * represents a keyword idea, its {@link IdeaTypeAttribute} would contain a
 * {@code KEYWORD} {@link IdeaType}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class IdeaTypeAttribute extends Attribute {
  /**
   * @access public
   * @var tnsIdeaType
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "IdeaTypeAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('IdeaTypeAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("InStreamAdInfo", FALSE)) {
/**
 * Information specific to the instream ad format. Instream ads are video ads
 * which play as part of the delivery of video content, either before, during,
 * or after the content itself.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "InStreamAdInfo";
  }

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

if (!class_exists("InStreamAdInfoAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains an {@link InStreamAdInfo} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class InStreamAdInfoAttribute extends Attribute {
  /**
   * @access public
   * @var InStreamAdInfo
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "InStreamAdInfoAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('InStreamAdInfoAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("IntegerAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains an integer value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class IntegerAttribute extends Attribute {
  /**
   * @access public
   * @var integer
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "IntegerAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('IntegerAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("IntegerSetAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a Set of integer values.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class IntegerSetAttribute extends Attribute {
  /**
   * @access public
   * @var integer[]
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "IntegerSetAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('IntegerSetAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("KeywordAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link Keyword} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class KeywordAttribute extends Attribute {
  /**
   * @access public
   * @var Keyword
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "KeywordAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('KeywordAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("LongAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a long value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class LongAttribute extends Attribute {
  /**
   * @access public
   * @var integer
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "LongAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('LongAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("LongComparisonOperation", FALSE)) {
/**
 * Pojo representing integer comparison operations. This is usually used within
 * a particular
 * {@link com.google.ads.api.services.targetingideas.search.SearchParameter} to
 * specify the valid values requested for the specific
 * {@link com.google.ads.api.services.targetingideas.attributes.Attribute}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "LongComparisonOperation";
  }

  public function __construct($minimum = NULL, $maximum = NULL) {
    if(get_parent_class('LongComparisonOperation')) parent::__construct();
    $this->minimum = $minimum;
    $this->maximum = $maximum;
  }
}}

if (!class_exists("LongRangeAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link Range} of {@link LongValue}
 * values.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class LongRangeAttribute extends Attribute {
  /**
   * @access public
   * @var Range
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "LongRangeAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('LongRangeAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("MatchesRegexError", FALSE)) {
/**
 * A list of all errors associated with the
 * {@link com.google.ads.api.services.common.validation.constraints.MatchesRegex}
 * constraint.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MatchesRegexError extends ApiError {
  /**
   * @access public
   * @var tnsMatchesRegexErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MatchesRegexError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('MatchesRegexError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("MoneyAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link Money} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MoneyAttribute extends Attribute {
  /**
   * @access public
   * @var Money
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MoneyAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('MoneyAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("MonthlySearchVolume", FALSE)) {
/**
 * A keyword response value representing search volume for a single month. An
 * instance with a {@code null} count is valid, indicating that the information
 * is unavailable.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MonthlySearchVolume";
  }

  public function __construct($year = NULL, $month = NULL, $count = NULL) {
    if(get_parent_class('MonthlySearchVolume')) parent::__construct();
    $this->year = $year;
    $this->month = $month;
    $this->count = $count;
  }
}}

if (!class_exists("MonthlySearchVolumeAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a list of {@link MonthlySearchVolume}
 * values. The list contains the past 12 {@link MonthlySearchVolume}s
 * (excluding the current month). The first item is the data for the most
 * recent month and the last item is the data for the oldest month.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MonthlySearchVolumeAttribute extends Attribute {
  /**
   * @access public
   * @var MonthlySearchVolume[]
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MonthlySearchVolumeAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('MonthlySearchVolumeAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("OpportunityIdeaTypeAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains an {@link OpportunityIdeaType} value.
 * For example, if a
 * {@link com.google.ads.api.services.optimization.bulkopportunity.OpportunityIdea}
 * represents a keyword idea, its {@link OpportunityIdeaTypeAttribute} would
 * contain a {@code KEYWORD} {@link OpportunityIdeaType}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class OpportunityIdeaTypeAttribute extends Attribute {
  /**
   * @access public
   * @var tnsOpportunityIdeaType
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "OpportunityIdeaTypeAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('OpportunityIdeaTypeAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("PlacementAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link Placement} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PlacementAttribute extends Attribute {
  /**
   * @access public
   * @var Placement
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PlacementAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('PlacementAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("PlacementTypeAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link PlacementType} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PlacementTypeAttribute extends Attribute {
  /**
   * @access public
   * @var tnsSiteConstantsPlacementType
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PlacementTypeAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('PlacementTypeAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("Range", FALSE)) {
/**
 * Represents a range of values that has either an upper or a lower bound.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Range";
  }

  public function __construct($min = NULL, $max = NULL) {
    if(get_parent_class('Range')) parent::__construct();
    $this->min = $min;
    $this->max = $max;
  }
}}

if (!class_exists("SearchParameter", FALSE)) {
/**
 * A set of {@link SearchParameter}s are supplied to the
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector}
 * to specify how the user wants to filter the set of all possible
 * {@link com.google.ads.api.services.targetingideas.TargetingIdea}s.
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
 * <li>{@link CategoryProductsAndServicesSearchParameter}</li>
 * <li>{@link RelatedToKeywordSearchParameter}</li>
 * <li>{@link RelatedToUrlSearchParameter}</li>
 * <li>{@link SeedAdGroupIdSearchParameter}</li>
 * </ul><p>
 * <p><b>{@link IdeaType} KEYWORD supports following {@link SearchParameter}s:</b><br/>
 * <ul>
 * <li>{@link AdShareSearchParameter}</li>
 * <li>{@link AverageTargetedMonthlySearchesSearchParameter}</li>
 * <li>{@link CompetitionSearchParameter}</li>
 * <li>{@link CountryTargetSearchParameter}</li>
 * <li>{@link DeviceTypeSearchParameter}</li>
 * <li>{@link ExcludedKeywordSearchParameter}</li>
 * <li>{@link GlobalMonthlySearchesSearchParameter}</li>
 * <li>{@link IdeaTextMatchesSearchParameter}</li>
 * <li>{@link IncludeAdultContentSearchParameter}</li>
 * <li>{@link KeywordCategoryIdSearchParameter}</li>
 * <li>{@link CategoryProductsAndServicesSearchParameter}</li>
 * <li>{@link KeywordMatchTypeSearchParameter}</li>
 * <li>{@link LanguageTargetSearchParameter}</li>
 * <li>{@link MobileSearchParameter}</li>
 * <li>{@link NgramGroupsSearchParameter}</li>
 * <li>{@link RelatedToKeywordSearchParameter}</li>
 * <li>{@link RelatedToUrlSearchParameter}</li>
 * <li>{@link SearchShareSearchParameter}</li>
 * <li>{@link SeedAdGroupIdSearchParameter}</li>
 * </ul><p>
 * <p><b>{@link IdeaType} PLACEMENT supports following {@link SearchParameter}s:</b><br/>
 * <ul>
 * <li>{@link AdTypeSearchParameter}</li>
 * <li>{@link CountryTargetSearchParameter}</li>
 * <li>{@link DeviceTypeSearchParameter}</li>
 * <li>{@link LanguageTargetSearchParameter}</li>
 * <li>{@link MobileSearchParameter}</li>
 * <li>{@link PlacementTypeSearchParameter}</li>
 * <li>{@link RelatedToKeywordSearchParameter}</li>
 * <li>{@link RelatedToUrlSearchParameter}</li>
 * </ul><p>
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SearchParameter";
  }

  public function __construct($SearchParameterType = NULL) {
    if(get_parent_class('SearchParameter')) parent::__construct();
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("SearchShareSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} that specifies the percentage of search share
 * expected in results. Absence of a {@link SearchShareSearchParameter} in a
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector} is
 * equivalent to having no constraint on search share specified. This search
 * parameter has a direct relationship to
 * {@link com.google.ads.api.services.targetingideas.external.AttributeType#SEARCH_SHARE}.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SearchShareSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var DoubleComparisonOperation
   */
  public $operation;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SearchShareSearchParameter";
  }

  public function __construct($operation = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('SearchShareSearchParameter')) parent::__construct();
    $this->operation = $operation;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("SeedAdGroupIdSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s
 * that specifies that the supplied AdGroup should be used as a seed
 * for generating new ideas. For example, an AdGroup's keywords
 * would be used to generate new and related keywords.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SeedAdGroupIdSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var integer
   */
  public $adGroupId;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SeedAdGroupIdSearchParameter";
  }

  public function __construct($adGroupId = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('SeedAdGroupIdSearchParameter')) parent::__construct();
    $this->adGroupId = $adGroupId;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("StringAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a string value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class StringAttribute extends Attribute {
  /**
   * @access public
   * @var string
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "StringAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('StringAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("TargetingIdea", FALSE)) {
/**
 * Represents a {@link TargetingIdea} returned by search criteria specified in
 * the {@link TargetingIdeaSelector}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class TargetingIdea {
  /**
   * @access public
   * @var Type_AttributeMapEntry[]
   */
  public $data;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "TargetingIdea";
  }

  public function __construct($data = NULL) {
    if(get_parent_class('TargetingIdea')) parent::__construct();
    $this->data = $data;
  }
}}

if (!class_exists("TargetingIdeaError", FALSE)) {
/**
 * Base error class for the
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaService}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class TargetingIdeaError extends ApiError {
  /**
   * @access public
   * @var tnsTargetingIdeaErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "TargetingIdeaError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('TargetingIdeaError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("TargetingIdeaPage", FALSE)) {
/**
 * Contains a subset of {@link TargetingIdea}s from the search criteria
 * specified by a {@link TargetingIdeaSelector}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "TargetingIdeaPage";
  }

  public function __construct($totalNumEntries = NULL, $entries = NULL) {
    if(get_parent_class('TargetingIdeaPage')) parent::__construct();
    $this->totalNumEntries = $totalNumEntries;
    $this->entries = $entries;
  }
}}

if (!class_exists("TargetingIdeaSelector", FALSE)) {
/**
 * A descriptor for finding {@link TargetingIdea}s that match the specified
 * criteria.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "TargetingIdeaSelector";
  }

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

if (!class_exists("Type_AttributeMapEntry", FALSE)) {
/**
 * This represents an entry in a map with a key of type Type
 * and value of type Attribute.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "Type_AttributeMapEntry";
  }

  public function __construct($key = NULL, $value = NULL) {
    if(get_parent_class('Type_AttributeMapEntry')) parent::__construct();
    $this->key = $key;
    $this->value = $value;
  }
}}

if (!class_exists("WebpageDescriptor", FALSE)) {
/**
 * Basic information about a webpage.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "WebpageDescriptor";
  }

  public function __construct($url = NULL, $title = NULL) {
    if(get_parent_class('WebpageDescriptor')) parent::__construct();
    $this->url = $url;
    $this->title = $title;
  }
}}

if (!class_exists("WebpageDescriptorAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a {@link WebpageDescriptor} value.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class WebpageDescriptorAttribute extends Attribute {
  /**
   * @access public
   * @var WebpageDescriptor
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "WebpageDescriptorAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('WebpageDescriptorAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("AttributeType", FALSE)) {
/**
 * Represents the type of
 * {@link com.google.ads.api.services.targetingideas.attributes.Attribute}.
 * <p><b>{@link IdeaType} KEYWORD supports the following {@link AttributeType}s:</b><br/>
 * <ul><li>{@link #AD_SHARE}</li>
 * <li>{@link #AVERAGE_TARGETED_MONTHLY_SEARCHES}</li>
 * <li>{@link #CATEGORY_PRODUCTS_AND_SERVICES}</li>
 * <li>{@link #COMPETITION}</li>
 * <li>{@link #CRITERION}</li>
 * <li>{@link #EXTRACTED_FROM_WEBPAGE}</li>
 * <li>{@link #GLOBAL_MONTHLY_SEARCHES}</li>
 * <li>{@link #IDEA_TYPE}</li>
 * <li>{@link #KEYWORD}</li>
 * <li>{@link #KEYWORD_CATEGORY}</li>
 * <li>{@link #NEGATIVE_KEYWORDS}</li>
 * <li>{@link #NGRAM_GROUP}</li>
 * <li>{@link #SEARCH_SHARE}</li>
 * <li>{@link #TARGETED_MONTHLY_SEARCHES}</li>
 * </ul>
 * <p><b>{@link IdeaType} PLACEMENT supports the following {@link AttributeType}s:</b><br/>
 * <ul><li>{@link #APPROX_CONTENT_IMPRESSIONS_PER_DAY}</li>
 * <li>{@link #CRITERION}</li>
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
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AttributeType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AttributeType";
  }

  public function __construct() {
    if(get_parent_class('AttributeType')) parent::__construct();
  }
}}

if (!class_exists("CollectionSizeErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CollectionSizeErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CollectionSizeError.Reason";
  }

  public function __construct() {
    if(get_parent_class('CollectionSizeErrorReason')) parent::__construct();
  }
}}

if (!class_exists("CompetitionSearchParameterLevel", FALSE)) {
/**
 * An enumeration of possible values to be used in conjunction with the
 * {@link CompetitionSearchParameter} to specify the granularity of
 * competition to be filtered.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CompetitionSearchParameterLevel {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CompetitionSearchParameter.Level";
  }

  public function __construct() {
    if(get_parent_class('CompetitionSearchParameterLevel')) parent::__construct();
  }
}}

if (!class_exists("CurrencyCodeErrorReason", FALSE)) {
/**
 * Encodes the reason (cause) of a particular {@link CurrencyCodeError}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CurrencyCodeErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CurrencyCodeError.Reason";
  }

  public function __construct() {
    if(get_parent_class('CurrencyCodeErrorReason')) parent::__construct();
  }
}}

if (!class_exists("DeviceType", FALSE)) {
/**
 * The device types that we can request ideas and stats for.
 * 
 * NOTE: If the stats for a given browser class are not available, no stats
 * will be returned.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DeviceType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DeviceType";
  }

  public function __construct() {
    if(get_parent_class('DeviceType')) parent::__construct();
  }
}}

if (!class_exists("IdeaType", FALSE)) {
/**
 * Represents the type of idea.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class IdeaType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "IdeaType";
  }

  public function __construct() {
    if(get_parent_class('IdeaType')) parent::__construct();
  }
}}

if (!class_exists("MatchAction", FALSE)) {
/**
 * Specifies the filtering action to take when matching a term to an idea.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MatchAction {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MatchAction";
  }

  public function __construct() {
    if(get_parent_class('MatchAction')) parent::__construct();
  }
}}

if (!class_exists("MatchesRegexErrorReason", FALSE)) {
/**
 * The reasons for the target error.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MatchesRegexErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MatchesRegexError.Reason";
  }

  public function __construct() {
    if(get_parent_class('MatchesRegexErrorReason')) parent::__construct();
  }
}}

if (!class_exists("OpportunityIdeaType", FALSE)) {
/**
 * Represents the type of opportunity.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class OpportunityIdeaType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "OpportunityIdeaType";
  }

  public function __construct() {
    if(get_parent_class('OpportunityIdeaType')) parent::__construct();
  }
}}

if (!class_exists("RequestType", FALSE)) {
/**
 * Represents the type of the request.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RequestType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RequestType";
  }

  public function __construct() {
    if(get_parent_class('RequestType')) parent::__construct();
  }
}}

if (!class_exists("SiteConstantsAdFormat", FALSE)) {
/**
 * Enumerates the ad formats which can be reported in search results.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SiteConstantsAdFormat {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SiteConstants.AdFormat";
  }

  public function __construct() {
    if(get_parent_class('SiteConstantsAdFormat')) parent::__construct();
  }
}}

if (!class_exists("SiteConstantsAdType", FALSE)) {
/**
 * Enumerates the ad types available for constraining searches.  Each corresponds
 * to one or more values from {@link AdFormat}.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SiteConstantsAdType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SiteConstants.AdType";
  }

  public function __construct() {
    if(get_parent_class('SiteConstantsAdType')) parent::__construct();
  }
}}

if (!class_exists("SiteConstantsPlacementType", FALSE)) {
/**
 * A placement request and response value indicating the type of site or other medium
 * (for example, a web page, in a feed, in a video) where ads will appear.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class SiteConstantsPlacementType {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "SiteConstants.PlacementType";
  }

  public function __construct() {
    if(get_parent_class('SiteConstantsPlacementType')) parent::__construct();
  }
}}

if (!class_exists("TargetingIdeaErrorReason", FALSE)) {
/**
 * An enumeration of
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaService}
 * specific errors.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class TargetingIdeaErrorReason {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "TargetingIdeaError.Reason";
  }

  public function __construct() {
    if(get_parent_class('TargetingIdeaErrorReason')) parent::__construct();
  }
}}

if (!class_exists("TargetingIdeaServiceGet", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns a page of ideas that match the query described by the specified
 * {@link TargetingIdeaSelector}.
 * 
 * <p>The selector must specify a {@code paging} value, with {@code numberResults} set to 800 or
 * less.  Large result sets must be composed through multiple calls to this method, advancing the
 * paging {@code startIndex} value by {@code numberResults} with each call.
 * 
 * <p>Only a relatively small total number of results will be available through this method.
 * Much larger result sets may be available using
 * {@link #getBulkKeywordIdeas(TargetingIdeaSelector)} at the price of reduced flexibility in
 * selector options.
 * 
 * @param selector Query describing the types of results to return when
 * finding matches (similar keyword ideas/placement ideas).
 * @return A {@link TargetingIdeaPage} of results, that is a subset of the
 * list of possible ideas meeting the criteria of the
 * {@link TargetingIdeaSelector}.
 * @throws ApiException If problems occurred while querying for ideas.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class TargetingIdeaServiceGet {
  /**
   * @access public
   * @var TargetingIdeaSelector
   */
  public $selector;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "";
  }

  public function __construct($selector = NULL) {
    if(get_parent_class('TargetingIdeaServiceGet')) parent::__construct();
    $this->selector = $selector;
  }
}}

if (!class_exists("TargetingIdeaServiceGetResponse", FALSE)) {
/**
 * 
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class TargetingIdeaServiceGetResponse {
  /**
   * @access public
   * @var TargetingIdeaPage
   */
  public $rval;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "";
  }

  public function __construct($rval = NULL) {
    if(get_parent_class('TargetingIdeaServiceGetResponse')) parent::__construct();
    $this->rval = $rval;
  }
}}

if (!class_exists("getBulkKeywordIdeas", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns a page of ideas that match the query described by the specified
 * {@link TargetingIdeaSelector}.  This method is specialized for returning
 * bulk keyword ideas, and thus the selector must be set for
 * {@link com.google.ads.api.services.targetingideas.attributes.RequestType#IDEAS} and
 * {@link com.google.ads.api.services.common.optimization.attributes.IdeaType#KEYWORD}.
 * A limited, fixed set of attributes will be returned.
 * 
 * <p>A single-valued
 * {@link com.google.ads.api.services.targetingideas.search.RelatedToUrlSearchParameter}
 * must be supplied.  Single-valued
 * {@link com.google.ads.api.services.targetingideas.search.LanguageTargetSearchParameter} and
 * {@link com.google.ads.api.services.targetingideas.search.CountryTargetSearchParameter} are
 * both optional.  Other search parameters compatible with a keyword query may also be
 * supplied.
 * 
 * <p>The selector must specify a {@code paging} value, with {@code numberResults} set to 500 or
 * less. Large result sets must be composed through multiple calls to this method, advancing the
 * paging {@code startIndex} value by {@code numberResults} with each call.
 * 
 * <p>This method can make many more results available than {@link #get(TargetingIdeaSelector)},
 * but allows less control over the query. For fine-tuned queries that do not need large numbers
 * of results, prefer {@link #get(TargetingIdeaSelector)}.
 * 
 * @param selector Query describing the bulk keyword ideas to return.
 * @return A {@link TargetingIdeaPage} of results, that is a subset of the
 * list of possible ideas meeting the criteria of the
 * {@link TargetingIdeaSelector}.
 * @throws ApiException If problems occurred while querying for ideas.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class getBulkKeywordIdeas {
  /**
   * @access public
   * @var TargetingIdeaSelector
   */
  public $selector;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "";
  }

  public function __construct($selector = NULL) {
    if(get_parent_class('getBulkKeywordIdeas')) parent::__construct();
    $this->selector = $selector;
  }
}}

if (!class_exists("getBulkKeywordIdeasResponse", FALSE)) {
/**
 * 
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class getBulkKeywordIdeasResponse {
  /**
   * @access public
   * @var TargetingIdeaPage
   */
  public $rval;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "";
  }

  public function __construct($rval = NULL) {
    if(get_parent_class('getBulkKeywordIdeasResponse')) parent::__construct();
    $this->rval = $rval;
  }
}}

if (!class_exists("AdGroupCriterionError", FALSE)) {
/**
 * Base error class for Ad Group Criterion Service.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdGroupCriterionError extends ApiError {
  /**
   * @access public
   * @var tnsAdGroupCriterionErrorReason
   */
  public $reason;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdGroupCriterionError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('AdGroupCriterionError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("AdGroupCriterionLimitExceeded", FALSE)) {
/**
 * Signals that too many criteria were added to some ad group.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdGroupCriterionLimitExceeded extends EntityCountLimitExceeded {
  /**
   * @access public
   * @var tnsAdGroupCriterionLimitExceededCriteriaLimitType
   */
  public $limitType;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdGroupCriterionLimitExceeded";
  }

  public function __construct($limitType = NULL, $reason = NULL, $enclosingId = NULL, $limit = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('AdGroupCriterionLimitExceeded')) parent::__construct();
    $this->limitType = $limitType;
    $this->reason = $reason;
    $this->enclosingId = $enclosingId;
    $this->limit = $limit;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("AdScheduleTarget", FALSE)) {
/**
 * Immutable structure to hold an ad schedule target.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdScheduleTarget";
  }

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

if (!class_exists("ApiException", FALSE)) {
/**
 * Exception class for holding a list of service errors.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ApiException extends ApplicationException {
  /**
   * @access public
   * @var ApiError[]
   */
  public $errors;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ApiException";
  }

  public function __construct($errors = NULL, $message = NULL, $ApplicationExceptionType = NULL) {
    if(get_parent_class('ApiException')) parent::__construct();
    $this->errors = $errors;
    $this->message = $message;
    $this->ApplicationExceptionType = $ApplicationExceptionType;
  }
}}

if (!class_exists("BidLandscape", FALSE)) {
/**
 * Represents data about a bid landscape for an ad group or criterion.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class BidLandscape extends DataEntry {
  /**
   * @access public
   * @var integer
   */
  public $campaignId;

  /**
   * @access public
   * @var integer
   */
  public $adGroupId;

  /**
   * @access public
   * @var string
   */
  public $startDate;

  /**
   * @access public
   * @var string
   */
  public $endDate;

  /**
   * @access public
   * @var BidLandscapeLandscapePoint[]
   */
  public $landscapePoints;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "BidLandscape";
  }

  public function __construct($campaignId = NULL, $adGroupId = NULL, $startDate = NULL, $endDate = NULL, $landscapePoints = NULL, $DataEntryType = NULL) {
    if(get_parent_class('BidLandscape')) parent::__construct();
    $this->campaignId = $campaignId;
    $this->adGroupId = $adGroupId;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->landscapePoints = $landscapePoints;
    $this->DataEntryType = $DataEntryType;
  }
}}

if (!class_exists("CriterionBidLandscape", FALSE)) {
/**
 * The bid landscape for a criterion.  A bid landscape estimates how a
 * a criterion will perform based on different bid amounts.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CriterionBidLandscape extends BidLandscape {
  /**
   * @access public
   * @var integer
   */
  public $criterionId;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CriterionBidLandscape";
  }

  public function __construct($criterionId = NULL, $campaignId = NULL, $adGroupId = NULL, $startDate = NULL, $endDate = NULL, $landscapePoints = NULL, $DataEntryType = NULL) {
    if(get_parent_class('CriterionBidLandscape')) parent::__construct();
    $this->criterionId = $criterionId;
    $this->campaignId = $campaignId;
    $this->adGroupId = $adGroupId;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->landscapePoints = $landscapePoints;
    $this->DataEntryType = $DataEntryType;
  }
}}

if (!class_exists("CriterionPolicyError", FALSE)) {
/**
 * Contains the policy violations for a single BiddableAdGroupCriterion.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CriterionPolicyError extends PolicyViolationError {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CriterionPolicyError";
  }

  public function __construct($key = NULL, $externalPolicyName = NULL, $externalPolicyUrl = NULL, $externalPolicyDescription = NULL, $isExemptable = NULL, $violatingParts = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('CriterionPolicyError')) parent::__construct();
    $this->key = $key;
    $this->externalPolicyName = $externalPolicyName;
    $this->externalPolicyUrl = $externalPolicyUrl;
    $this->externalPolicyDescription = $externalPolicyDescription;
    $this->isExemptable = $isExemptable;
    $this->violatingParts = $violatingParts;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("DemographicTarget", FALSE)) {
/**
 * Abstract class to identify a demographic target.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DemographicTarget extends AdWordsTarget {
  /**
   * @access public
   * @var integer
   */
  public $bidModifier;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DemographicTarget";
  }

  public function __construct($bidModifier = NULL, $TargetType = NULL) {
    if(get_parent_class('DemographicTarget')) parent::__construct();
    $this->bidModifier = $bidModifier;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("DoubleValue", FALSE)) {
/**
 * Number value type for constructing double valued ranges.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DoubleValue extends NumberValue {
  /**
   * @access public
   * @var double
   */
  public $number;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DoubleValue";
  }

  public function __construct($number = NULL, $ComparableValueType = NULL) {
    if(get_parent_class('DoubleValue')) parent::__construct();
    $this->number = $number;
    $this->ComparableValueType = $ComparableValueType;
  }
}}

if (!class_exists("GenderTarget", FALSE)) {
/**
 * Immutable structure to hold a gender target.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class GenderTarget extends DemographicTarget {
  /**
   * @access public
   * @var tnsGenderTargetGender
   */
  public $gender;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "GenderTarget";
  }

  public function __construct($gender = NULL, $bidModifier = NULL, $TargetType = NULL) {
    if(get_parent_class('GenderTarget')) parent::__construct();
    $this->gender = $gender;
    $this->bidModifier = $bidModifier;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("GeoTarget", FALSE)) {
/**
 * Abstract class to identify a geographic target.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class GeoTarget extends AdWordsTarget {
  /**
   * @access public
   * @var boolean
   */
  public $excluded;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "GeoTarget";
  }

  public function __construct($excluded = NULL, $TargetType = NULL) {
    if(get_parent_class('GeoTarget')) parent::__construct();
    $this->excluded = $excluded;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("LanguageTarget", FALSE)) {
/**
 * Represents language for targeting.
 * The list of languages available for targeting are listed
 * <a href = "http://code.google.com/apis/adwords/docs/appendix/languagecodes.html">
 * here.</a>
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class LanguageTarget extends AdWordsTarget {
  /**
   * @access public
   * @var string
   */
  public $languageCode;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "LanguageTarget";
  }

  public function __construct($languageCode = NULL, $TargetType = NULL) {
    if(get_parent_class('LanguageTarget')) parent::__construct();
    $this->languageCode = $languageCode;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("LongValue", FALSE)) {
/**
 * Number value type for constructing long valued ranges.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class LongValue extends NumberValue {
  /**
   * @access public
   * @var integer
   */
  public $number;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "LongValue";
  }

  public function __construct($number = NULL, $ComparableValueType = NULL) {
    if(get_parent_class('LongValue')) parent::__construct();
    $this->number = $number;
    $this->ComparableValueType = $ComparableValueType;
  }
}}

if (!class_exists("MetroTarget", FALSE)) {
/**
 * Represents US metropolitan regions (metros) for targeting.
 * The list of metros available for targeting are listed
 * <a href="http://code.google.com/apis/adwords/docs/appendix/metrocodes.html">
 * here.</a>
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MetroTarget extends GeoTarget {
  /**
   * @access public
   * @var string
   */
  public $metroCode;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MetroTarget";
  }

  public function __construct($metroCode = NULL, $excluded = NULL, $TargetType = NULL) {
    if(get_parent_class('MetroTarget')) parent::__construct();
    $this->metroCode = $metroCode;
    $this->excluded = $excluded;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("MobileTarget", FALSE)) {
/**
 * Abstract class to identify a mobile target.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MobileTarget extends AdWordsTarget {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MobileTarget";
  }

  public function __construct($TargetType = NULL) {
    if(get_parent_class('MobileTarget')) parent::__construct();
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("PlatformTarget", FALSE)) {
/**
 * A platform target is used to discriminate among the potential devices from
 * which the users access the web (ie, desktops vs. mobile devices).
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PlatformTarget extends AdWordsTarget {
  /**
   * @access public
   * @var tnsPlatformType
   */
  public $platformType;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PlatformTarget";
  }

  public function __construct($platformType = NULL, $TargetType = NULL) {
    if(get_parent_class('PlatformTarget')) parent::__construct();
    $this->platformType = $platformType;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("PolygonTarget", FALSE)) {
/**
 * Represents a geographic region enclosed by a set of vertices (points).
 * 
 * A polygon target is described by a list of at least three points,
 * where each point is a (<var>latitude</var>, <var>longitude</var>)
 * ordered pair. No point can be no more than 400km from the center of
 * the polygon. The points are specified in microdegrees, the precison
 * for the value is 1 second which is equal to 277 microdegrees.
 * Polygon targets cannot be used for exclusion, and
 * other targets cannot be used to exclude regions of polygon targets.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PolygonTarget extends GeoTarget {
  /**
   * @access public
   * @var GeoPoint[]
   */
  public $vertices;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PolygonTarget";
  }

  public function __construct($vertices = NULL, $excluded = NULL, $TargetType = NULL) {
    if(get_parent_class('PolygonTarget')) parent::__construct();
    $this->vertices = $vertices;
    $this->excluded = $excluded;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("ProvinceTarget", FALSE)) {
/**
 * Represents the worldwide province for targeting.
 * The list of provinces available for targeting are listed
 * <a href="http://code.google.com/apis/adwords/docs/appendix/provincecodes.html">
 * here</a>
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ProvinceTarget extends GeoTarget {
  /**
   * @access public
   * @var string
   */
  public $provinceCode;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ProvinceTarget";
  }

  public function __construct($provinceCode = NULL, $excluded = NULL, $TargetType = NULL) {
    if(get_parent_class('ProvinceTarget')) parent::__construct();
    $this->provinceCode = $provinceCode;
    $this->excluded = $excluded;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("ProximityTarget", FALSE)) {
/**
 * Structure to specify a geographic target for a proximity location.
 * 
 * This proximity target doesn't support taking in a location address in place
 * of a lat/long, geocoding it, and creating a proximity target for the
 * campaign. The caller must ensure the address fields are valid
 * and consistent with the supplied lat/long. GeoLocationService can be used
 * to find a valid GeoPoint for an address that can be used with this service.
 * Proximity targets cannot be used for exclusion, and other targets cannot be used
 * to exclude regions of proximity targets.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ProximityTarget";
  }

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

if (!class_exists("AdFormatSpecListAttribute", FALSE)) {
/**
 * {@link Attribute} type that contains a list of {@link AdFormatSpec} values.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdFormatSpecListAttribute extends Attribute {
  /**
   * @access public
   * @var AdFormatSpec[]
   */
  public $value;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdFormatSpecListAttribute";
  }

  public function __construct($value = NULL, $AttributeType = NULL) {
    if(get_parent_class('AdFormatSpecListAttribute')) parent::__construct();
    $this->value = $value;
    $this->AttributeType = $AttributeType;
  }
}}

if (!class_exists("AdShareSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} that specifies the percentage of ad share expected
 * in results. Absence of a {@link AdShareSearchParameter} in a
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector} is
 * equivalent to having no constraint on ad share specified. This search
 * parameter has a direct relationship to
 * {@link com.google.ads.api.services.targetingideas.external.AttributeType#AD_SHARE}.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdShareSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var DoubleComparisonOperation
   */
  public $operation;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdShareSearchParameter";
  }

  public function __construct($operation = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('AdShareSearchParameter')) parent::__construct();
    $this->operation = $operation;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("AdTypeSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code PLACEMENT} {@link IdeaType}s used to
 * filter the results by the {@link AdType}.
 * <p>This element is supported by following {@link IdeaType}s: PLACEMENT.
 * <p>This element is supported by following {@link RequestType}s: IDEAS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdTypeSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var tnsSiteConstantsAdType[]
   */
  public $adTypes;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdTypeSearchParameter";
  }

  public function __construct($adTypes = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('AdTypeSearchParameter')) parent::__construct();
    $this->adTypes = $adTypes;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("AverageTargetedMonthlySearchesSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} that constrains the approximate average number of
 * targeted monthly searches on ideas to be returned. Absence of a
 * {@link AverageTargetedMonthlySearchesSearchParameter} in a
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector} is
 * equivalent to having no constraint on average targeted monthly searches
 * pecified.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AverageTargetedMonthlySearchesSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var LongComparisonOperation
   */
  public $operation;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AverageTargetedMonthlySearchesSearchParameter";
  }

  public function __construct($operation = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('AverageTargetedMonthlySearchesSearchParameter')) parent::__construct();
    $this->operation = $operation;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("CompetitionSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s used to
 * filter the results by the amount of competition (eg: LOW, MEDIUM, HIGH).
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CompetitionSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var tnsCompetitionSearchParameterLevel[]
   */
  public $levels;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CompetitionSearchParameter";
  }

  public function __construct($levels = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('CompetitionSearchParameter')) parent::__construct();
    $this->levels = $levels;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("CountryTargetSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for both {@code PLACEMENT} and {@code KEYWORD}
 * {@link IdeaType}s used to indicate the countries being targeted. This can be
 * used, for example,  to search for {@code KEYWORD} {@link IdeaType}s that are
 * best for Japan and Korea.<p>
 * 
 * Note: The {@link CountryTarget}'s {@code excluded} attribute is ignored.
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method. It must be single-valued when used in a call to that method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CountryTargetSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var CountryTarget[]
   */
  public $countryTargets;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CountryTargetSearchParameter";
  }

  public function __construct($countryTargets = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('CountryTargetSearchParameter')) parent::__construct();
    $this->countryTargets = $countryTargets;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("DeviceTypeSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for choosing which device types to get ideas
 * and statistics for.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class DeviceTypeSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var tnsDeviceType
   */
  public $deviceType;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "DeviceTypeSearchParameter";
  }

  public function __construct($deviceType = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('DeviceTypeSearchParameter')) parent::__construct();
    $this->deviceType = $deviceType;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("ExcludedKeywordSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s that
 * specifies {@link Keyword}s that should be excluded from the results.<p>
 * 
 * The {@link KeywordMatchType} associated with these keywords is used to
 * provide various filtering strategies. For example, the excluded keyword
 * <b>"sony player"</b> will exclude ideas from the resulting ideas as
 * described by the table below.
 * 
 * <table border="1">
 * <tr style="font-weight: bold;">
 * <th>Idea</th>
 * <th>{@code BROAD}</th>
 * <th>{@code PHRASE}</th>
 * <th>{@code EXACT}</th>
 * </tr>
 * <tr>
 * <td>sony player</td>
 * <td>Exclude</td>
 * <td>Exclude</td>
 * <td>Exclude</td>
 * </tr>
 * <tr>
 * <td>blu-ray sony player</td>
 * <td>Exclude</td>
 * <td>Exclude</td>
 * <td>Include</td>
 * </tr>
 * <tr>
 * <td>sony dvd player</td>
 * <td>Exclude</td>
 * <td>Include</td>
 * <td>Include</td>
 * </tr>
 * <tr>
 * <td>sony dvd</td>
 * <td>Include</td>
 * <td>Include</td>
 * <td>Include</td>
 * </tr>
 * </table>
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class ExcludedKeywordSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var Keyword[]
   */
  public $keywords;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "ExcludedKeywordSearchParameter";
  }

  public function __construct($keywords = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('ExcludedKeywordSearchParameter')) parent::__construct();
    $this->keywords = $keywords;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("GlobalMonthlySearchesSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} that specifies the level of search volume expected
 * in results. Absence of a {@link GlobalMonthlySearchesSearchParameter} in a
 * {@link com.google.ads.api.services.targetingideas.TargetingIdeaSelector} is
 * equivalent to having no constraint on search volume specified. This search
 * parameter has a direct relationship to
 * {@link com.google.ads.api.services.targetingideas.external.AttributeType#GLOBAL_MONTHLY_SEARCHES}.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class GlobalMonthlySearchesSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var LongComparisonOperation
   */
  public $operation;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "GlobalMonthlySearchesSearchParameter";
  }

  public function __construct($operation = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('GlobalMonthlySearchesSearchParameter')) parent::__construct();
    $this->operation = $operation;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("IdeaTextMatchesSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s that
 * specifies a collection of strings by which the results should be
 * constrained. This guarantees that each idea in the result will match
 * at least one of the {@code included} values.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class IdeaTextMatchesSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var string[]
   */
  public $included;

  /**
   * @access public
   * @var string[]
   */
  public $excluded;

  /**
   * @access public
   * @var tnsMatchAction
   */
  public $priorityAction;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "IdeaTextMatchesSearchParameter";
  }

  public function __construct($included = NULL, $excluded = NULL, $priorityAction = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('IdeaTextMatchesSearchParameter')) parent::__construct();
    $this->included = $included;
    $this->excluded = $excluded;
    $this->priorityAction = $priorityAction;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("IncludeAdultContentSearchParameter", FALSE)) {
/**
 * {@link SearchParameter} that specifies whether adult content should be
 * returned.<p>
 * 
 * Presence of this {@link SearchParameter} will allow adult keywords
 * to be included in the results.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class IncludeAdultContentSearchParameter extends SearchParameter {
  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "IncludeAdultContentSearchParameter";
  }

  public function __construct($SearchParameterType = NULL) {
    if(get_parent_class('IncludeAdultContentSearchParameter')) parent::__construct();
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("KeywordCategoryIdSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s that
 * sets a keyword category that all search results should belong to.
 * This search parameter will be retired soon in favor of
 * {@link CategoryProductsAndServicesSearchParameter}, which uses the newer
 * "Products and Services" taxonomy.
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class KeywordCategoryIdSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var integer
   */
  public $categoryId;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "KeywordCategoryIdSearchParameter";
  }

  public function __construct($categoryId = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('KeywordCategoryIdSearchParameter')) parent::__construct();
    $this->categoryId = $categoryId;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("KeywordMatchTypeSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} {@link IdeaType}s that
 * specifies the {@link KeywordMatchType}s that all results must match.
 * For example, results may be limited to only Broad or Exact matches.
 * Setting no {@link KeywordMatchTypeSearchParameter} will match all
 * targeting ideas, regardless of {@link KeywordMatchType}. If multiple
 * {@link KeywordMatchType}s are set, a result need only match one
 * match type to be returned.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class KeywordMatchTypeSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var cmKeywordMatchType[]
   */
  public $keywordMatchTypes;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "KeywordMatchTypeSearchParameter";
  }

  public function __construct($keywordMatchTypes = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('KeywordMatchTypeSearchParameter')) parent::__construct();
    $this->keywordMatchTypes = $keywordMatchTypes;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("LanguageTargetSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for both {@code PLACEMENT} and {@code KEYWORD}
 * {@link IdeaType}s used to indicate the languages being targeted. This can
 * be used, for example, to search for {@code KEYWORD} {@link IdeaType}s that
 * are best for Japanese and Korean languages.
 * <p>
 * Note: The {@link LanguageTarget}'s {@code excluded} attribute is ignored.
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method. It must be single-valued when used in a call to that method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class LanguageTargetSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var LanguageTarget[]
   */
  public $languageTargets;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "LanguageTargetSearchParameter";
  }

  public function __construct($languageTargets = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('LanguageTargetSearchParameter')) parent::__construct();
    $this->languageTargets = $languageTargets;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("PlacementTypeSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code PLACEMENT} {@link IdeaType}s
 * used to filter results based on the type of website, known as
 * {@link com.google.ads.api.services.targetingideas.attributes.Type#PLACEMENT_TYPE},
 * that they appear in. For example, searches may be limited to find
 * results that only appear within mobile websites or feeds.
 * <p>This element is supported by following {@link IdeaType}s: PLACEMENT.
 * <p>This element is supported by following {@link RequestType}s: IDEAS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class PlacementTypeSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var tnsSiteConstantsPlacementType[]
   */
  public $placementTypes;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "PlacementTypeSearchParameter";
  }

  public function __construct($placementTypes = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('PlacementTypeSearchParameter')) parent::__construct();
    $this->placementTypes = $placementTypes;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("RelatedToKeywordSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} and {@code PLACEMENT}
 * {@link IdeaType}s that specifies a generic keyword that results should
 * be related to.
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class RelatedToKeywordSearchParameter extends SearchParameter {
  /**
   * @access public
   * @var Keyword[]
   */
  public $keywords;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RelatedToKeywordSearchParameter";
  }

  public function __construct($keywords = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('RelatedToKeywordSearchParameter')) parent::__construct();
    $this->keywords = $keywords;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("RelatedToUrlSearchParameter", FALSE)) {
/**
 * A {@link SearchParameter} for {@code KEYWORD} and {@code PLACEMENT}
 * {@link IdeaType}s that specifies a set of URLs that results should
 * in some way be related too. For example, keyword results would be
 * similar to content keywords found on the related URLs.
 * <p>This search parameter can be used in bulk keyword requests through the {@link com.google.ads.api.services.targetingideas.TargetingIdeaService#getBulkKeywordIdeas(TargetingIdeaSelector)} method. It must be single-valued when used in a call to that method.
 * <p>This element is supported by following {@link IdeaType}s: KEYWORD, PLACEMENT.
 * <p>This element is supported by following {@link RequestType}s: IDEAS, STATS.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/o/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "RelatedToUrlSearchParameter";
  }

  public function __construct($urls = NULL, $includeSubUrls = NULL, $SearchParameterType = NULL) {
    if(get_parent_class('RelatedToUrlSearchParameter')) parent::__construct();
    $this->urls = $urls;
    $this->includeSubUrls = $includeSubUrls;
    $this->SearchParameterType = $SearchParameterType;
  }
}}

if (!class_exists("AdGroupBidLandscape", FALSE)) {
/**
 * Represents data about a bidlandscape for an adgroup.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AdGroupBidLandscape extends BidLandscape {
  /**
   * @access public
   * @var tnsAdGroupBidLandscapeType
   */
  public $type;

  /**
   * @access public
   * @var boolean
   */
  public $landscapeCurrent;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AdGroupBidLandscape";
  }

  public function __construct($type = NULL, $landscapeCurrent = NULL, $campaignId = NULL, $adGroupId = NULL, $startDate = NULL, $endDate = NULL, $landscapePoints = NULL, $DataEntryType = NULL) {
    if(get_parent_class('AdGroupBidLandscape')) parent::__construct();
    $this->type = $type;
    $this->landscapeCurrent = $landscapeCurrent;
    $this->campaignId = $campaignId;
    $this->adGroupId = $adGroupId;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->landscapePoints = $landscapePoints;
    $this->DataEntryType = $DataEntryType;
  }
}}

if (!class_exists("AgeTarget", FALSE)) {
/**
 * Immutable structure to hold an age target.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class AgeTarget extends DemographicTarget {
  /**
   * @access public
   * @var tnsAgeTargetAge
   */
  public $age;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "AgeTarget";
  }

  public function __construct($age = NULL, $bidModifier = NULL, $TargetType = NULL) {
    if(get_parent_class('AgeTarget')) parent::__construct();
    $this->age = $age;
    $this->bidModifier = $bidModifier;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("CityTarget", FALSE)) {
/**
 * Represents cities for targeting.
 * The list of cities around the world available for targeting are listed
 * <a href="http://code.google.com/apis/adwords/docs/appendix/cities_world.html">
 * here.</a>
 * The list of cities within US available for targeting are listed
 * <a href="http://code.google.com/apis/adwords/docs/appendix/cities_us.html">
 * here.</a>
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CityTarget";
  }

  public function __construct($cityName = NULL, $provinceCode = NULL, $countryCode = NULL, $excluded = NULL, $TargetType = NULL) {
    if(get_parent_class('CityTarget')) parent::__construct();
    $this->cityName = $cityName;
    $this->provinceCode = $provinceCode;
    $this->countryCode = $countryCode;
    $this->excluded = $excluded;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("CountryTarget", FALSE)) {
/**
 * Represents countries in the world for targeting.
 * The list of countries of the world available for targeting are listed
 * <a href="http://code.google.com/apis/adwords/docs/appendix/countrycodes.html">
 * here.</a>
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class CountryTarget extends GeoTarget {
  /**
   * @access public
   * @var string
   */
  public $countryCode;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "CountryTarget";
  }

  public function __construct($countryCode = NULL, $excluded = NULL, $TargetType = NULL) {
    if(get_parent_class('CountryTarget')) parent::__construct();
    $this->countryCode = $countryCode;
    $this->excluded = $excluded;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("MobileCarrierTarget", FALSE)) {
/**
 * Represents a mobile carrier for a particular country. See
 * <a href="/apis/adwords/docs/appendix/mobilecarriers.html">
 * available carriers</a> for each country code.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MobileCarrierTarget extends MobileTarget {
  /**
   * @access public
   * @var string
   */
  public $carrierName;

  /**
   * @access public
   * @var string
   */
  public $countryCode;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MobileCarrierTarget";
  }

  public function __construct($carrierName = NULL, $countryCode = NULL, $TargetType = NULL) {
    if(get_parent_class('MobileCarrierTarget')) parent::__construct();
    $this->carrierName = $carrierName;
    $this->countryCode = $countryCode;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("MobilePlatformTarget", FALSE)) {
/**
 * Represents a mobile operating system platform. See
 * <a href="/apis/adwords/docs/appendix/mobileplatforms.html">
 * available platforms</a>.
 * 
 * 
 * 
 * Represents data about a bidlandscape for an adgroup.
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
 */
class MobilePlatformTarget extends MobileTarget {
  /**
   * @access public
   * @var string
   */
  public $platformName;

  /**
   * Gets the namesapce of this class
   * @return the namespace of this class
   */
  public function getNamespace() {
    return "https://adwords.google.com/api/adwords/cm/v201101";
  }

  /**
   * Gets the xsi:type name of this class
   * @return the xsi:type name of this class
   */
  public function getXsiTypeName() {
    return "MobilePlatformTarget";
  }

  public function __construct($platformName = NULL, $TargetType = NULL) {
    if(get_parent_class('MobilePlatformTarget')) parent::__construct();
    $this->platformName = $platformName;
    $this->TargetType = $TargetType;
  }
}}

if (!class_exists("TargetingIdeaService", FALSE)) {
/**
 * TargetingIdeaService
 * @package GoogleApiAdsAdWords
 * @subpackage v201101
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
    "AdGroupBidLandscape" => "AdGroupBidLandscape",
    "BidLandscape" => "BidLandscape",
    "AdGroupCriterionError" => "AdGroupCriterionError",
    "ApiError" => "ApiError",
    "AdGroupCriterionLimitExceeded" => "AdGroupCriterionLimitExceeded",
    "EntityCountLimitExceeded" => "EntityCountLimitExceeded",
    "AdScheduleTarget" => "AdScheduleTarget",
    "Address" => "Address",
    "AgeTarget" => "AgeTarget",
    "DemographicTarget" => "DemographicTarget",
    "ApiException" => "ApiException",
    "ApplicationException" => "ApplicationException",
    "AuthenticationError" => "AuthenticationError",
    "AuthorizationError" => "AuthorizationError",
    "DataEntry" => "DataEntry",
    "BidLandscape.LandscapePoint" => "BidLandscapeLandscapePoint",
    "BiddingError" => "BiddingError",
    "BudgetError" => "BudgetError",
    "CityTarget" => "CityTarget",
    "GeoTarget" => "GeoTarget",
    "ClientTermsError" => "ClientTermsError",
    "ComparableValue" => "ComparableValue",
    "CountryTarget" => "CountryTarget",
    "Criterion" => "Criterion",
    "CriterionBidLandscape" => "CriterionBidLandscape",
    "CriterionPolicyError" => "CriterionPolicyError",
    "PolicyViolationError" => "PolicyViolationError",
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
    "LanguageTarget" => "LanguageTarget",
    "LongValue" => "LongValue",
    "MetroTarget" => "MetroTarget",
    "MobileCarrierTarget" => "MobileCarrierTarget",
    "MobileTarget" => "MobileTarget",
    "MobilePlatformTarget" => "MobilePlatformTarget",
    "Money" => "Money",
    "NotEmptyError" => "NotEmptyError",
    "NotWhitelistedError" => "NotWhitelistedError",
    "NullError" => "NullError",
    "Paging" => "Paging",
    "Placement" => "Placement",
    "PlatformTarget" => "PlatformTarget",
    "PolicyViolationError.Part" => "PolicyViolationErrorPart",
    "PolicyViolationKey" => "PolicyViolationKey",
    "PolygonTarget" => "PolygonTarget",
    "Product" => "Product",
    "ProductCondition" => "ProductCondition",
    "ProductConditionOperand" => "ProductConditionOperand",
    "ProvinceTarget" => "ProvinceTarget",
    "ProximityTarget" => "ProximityTarget",
    "QuotaCheckError" => "QuotaCheckError",
    "RangeError" => "RangeError",
    "RateExceededError" => "RateExceededError",
    "ReadOnlyError" => "ReadOnlyError",
    "RegionCodeError" => "RegionCodeError",
    "RequestError" => "RequestError",
    "RequiredError" => "RequiredError",
    "SizeLimitError" => "SizeLimitError",
    "SoapResponseHeader" => "SoapResponseHeader",
    "StatsQueryError" => "StatsQueryError",
    "StringLengthError" => "StringLengthError",
    "TargetError" => "TargetError",
    "CriterionUserInterest" => "CriterionUserInterest",
    "CriterionUserList" => "CriterionUserList",
    "Vertical" => "Vertical",
    "AdGroupBidLandscape.Type" => "AdGroupBidLandscapeType",
    "AdGroupCriterionError.Reason" => "AdGroupCriterionErrorReason",
    "AdGroupCriterionLimitExceeded.CriteriaLimitType" => "AdGroupCriterionLimitExceededCriteriaLimitType",
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
    "EntityCountLimitExceeded.Reason" => "EntityCountLimitExceededReason",
    "EntityNotFound.Reason" => "EntityNotFoundReason",
    "GenderTarget.Gender" => "GenderTargetGender",
    "InternalApiError.Reason" => "InternalApiErrorReason",
    "KeywordMatchType" => "KeywordMatchType",
    "MinuteOfHour" => "MinuteOfHour",
    "NotEmptyError.Reason" => "NotEmptyErrorReason",
    "NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
    "NullError.Reason" => "NullErrorReason",
    "PlatformType" => "PlatformType",
    "ProximityTarget.DistanceUnits" => "ProximityTargetDistanceUnits",
    "QuotaCheckError.Reason" => "QuotaCheckErrorReason",
    "RangeError.Reason" => "RangeErrorReason",
    "RateExceededError.Reason" => "RateExceededErrorReason",
    "ReadOnlyError.Reason" => "ReadOnlyErrorReason",
    "RegionCodeError.Reason" => "RegionCodeErrorReason",
    "RequestError.Reason" => "RequestErrorReason",
    "RequiredError.Reason" => "RequiredErrorReason",
    "SizeLimitError.Reason" => "SizeLimitErrorReason",
    "StatsQueryError.Reason" => "StatsQueryErrorReason",
    "StringLengthError.Reason" => "StringLengthErrorReason",
    "TargetError.Reason" => "TargetErrorReason",
    "CriterionUserList.MembershipStatus" => "CriterionUserListMembershipStatus",
    "AdFormatSpec" => "AdFormatSpec",
    "AdFormatSpecListAttribute" => "AdFormatSpecListAttribute",
    "Attribute" => "Attribute",
    "AdShareSearchParameter" => "AdShareSearchParameter",
    "SearchParameter" => "SearchParameter",
    "AdTypeSearchParameter" => "AdTypeSearchParameter",
    "AverageTargetedMonthlySearchesSearchParameter" => "AverageTargetedMonthlySearchesSearchParameter",
    "BidLandscapeAttribute" => "BidLandscapeAttribute",
    "BooleanAttribute" => "BooleanAttribute",
    "CollectionSizeError" => "CollectionSizeError",
    "CompetitionSearchParameter" => "CompetitionSearchParameter",
    "CountryTargetSearchParameter" => "CountryTargetSearchParameter",
    "CriterionAttribute" => "CriterionAttribute",
    "CurrencyCodeError" => "CurrencyCodeError",
    "DeviceTypeSearchParameter" => "DeviceTypeSearchParameter",
    "DoubleAttribute" => "DoubleAttribute",
    "DoubleComparisonOperation" => "DoubleComparisonOperation",
    "ExcludedKeywordSearchParameter" => "ExcludedKeywordSearchParameter",
    "GlobalMonthlySearchesSearchParameter" => "GlobalMonthlySearchesSearchParameter",
    "IdeaTextMatchesSearchParameter" => "IdeaTextMatchesSearchParameter",
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
    "MatchesRegexError" => "MatchesRegexError",
    "MoneyAttribute" => "MoneyAttribute",
    "MonthlySearchVolume" => "MonthlySearchVolume",
    "MonthlySearchVolumeAttribute" => "MonthlySearchVolumeAttribute",
    "OpportunityIdeaTypeAttribute" => "OpportunityIdeaTypeAttribute",
    "PlacementAttribute" => "PlacementAttribute",
    "PlacementTypeAttribute" => "PlacementTypeAttribute",
    "PlacementTypeSearchParameter" => "PlacementTypeSearchParameter",
    "Range" => "Range",
    "RelatedToKeywordSearchParameter" => "RelatedToKeywordSearchParameter",
    "RelatedToUrlSearchParameter" => "RelatedToUrlSearchParameter",
    "SearchShareSearchParameter" => "SearchShareSearchParameter",
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
    "CurrencyCodeError.Reason" => "CurrencyCodeErrorReason",
    "DeviceType" => "DeviceType",
    "IdeaType" => "IdeaType",
    "MatchAction" => "MatchAction",
    "MatchesRegexError.Reason" => "MatchesRegexErrorReason",
    "OpportunityIdeaType" => "OpportunityIdeaType",
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
    parent::__construct($wsdl, $options, $user, 'TargetingIdeaService', 'https://adwords.google.com/api/adwords/o/v201101');
  }

  /**
   * <span class="constraint Required">This field is required and should not be {@code null}.</span>
   * 
   * 
   * 
   * Returns a page of ideas that match the query described by the specified
   * {@link TargetingIdeaSelector}.
   * 
   * <p>The selector must specify a {@code paging} value, with {@code numberResults} set to 800 or
   * less.  Large result sets must be composed through multiple calls to this method, advancing the
   * paging {@code startIndex} value by {@code numberResults} with each call.
   * 
   * <p>Only a relatively small total number of results will be available through this method.
   * Much larger result sets may be available using
   * {@link #getBulkKeywordIdeas(TargetingIdeaSelector)} at the price of reduced flexibility in
   * selector options.
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
   * {@link com.google.ads.api.services.common.optimization.attributes.IdeaType#KEYWORD}.
   * A limited, fixed set of attributes will be returned.
   * 
   * <p>A single-valued
   * {@link com.google.ads.api.services.targetingideas.search.RelatedToUrlSearchParameter}
   * must be supplied.  Single-valued
   * {@link com.google.ads.api.services.targetingideas.search.LanguageTargetSearchParameter} and
   * {@link com.google.ads.api.services.targetingideas.search.CountryTargetSearchParameter} are
   * both optional.  Other search parameters compatible with a keyword query may also be
   * supplied.
   * 
   * <p>The selector must specify a {@code paging} value, with {@code numberResults} set to 500 or
   * less. Large result sets must be composed through multiple calls to this method, advancing the
   * paging {@code startIndex} value by {@code numberResults} with each call.
   * 
   * <p>This method can make many more results available than {@link #get(TargetingIdeaSelector)},
   * but allows less control over the query. For fine-tuned queries that do not need large numbers
   * of results, prefer {@link #get(TargetingIdeaSelector)}.
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