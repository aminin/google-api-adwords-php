<?php
/**
 * Contains all client objects for the BulkOpportunityService service.
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

require_once dirname(__FILE__) . "/../../Lib/AdWordsSoapClient.php";

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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "Bid".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("ClientTermsError", FALSE)) {
/**
 * Encapsulates the errors thrown during client terms checks for adwords.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "Id".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null} when it is contained within {@link Operator}s : SET, REMOVE.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("InternalApiError", FALSE)) {
/**
 * Indicates that a server-side error has occured. {@code InternalApiError}s
 * are generally not the result of an invalid request or message sent by the
 * client.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "KeywordText".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint MatchesRegex">This string must match the regular expression '[^\x00]*'</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("NotWhitelistedError", FALSE)) {
/**
 * Indicates that the customer is not whitelisted for accessing the API.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint InRange">This field must be greater than or equal to 0.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "PlacementUrl".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("Product", FALSE)) {
/**
 * <span class="constraint Selectable">This field can be selected using the value "Text".</span>
 * <span class="constraint ReadOnly">This field is read only and should not be set.  If this field is sent to the API, it will be ignored.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "Argument".</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "Operand".</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * <span class="constraint StringLength">This string must not be empty.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("RateExceededError", FALSE)) {
/**
 * Signals that a call failed because a measured rate exceeded.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("RequestError", FALSE)) {
/**
 * Encapsulates the generic errors thrown when there's an error with user
 * request.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("DataEntry", FALSE)) {
/**
 * This field indicates the subtype of DataEntry of this instance.  It is ignored
 * on input, and instead xsi:type should be specified.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("CriterionUserInterest", FALSE)) {
/**
 * <span class="constraint Selectable">This field can be selected using the value "UserInterestId".</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "UserListId".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "Path".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("AuthenticationErrorReason", FALSE)) {
/**
 * The single reason for the authentication failure.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("ClientTermsErrorReason", FALSE)) {
/**
 * Enums for the various reasons an error can be thrown as a result of
 * ClientTerms violation.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("InternalApiErrorReason", FALSE)) {
/**
 * The single reason for the internal API error.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("NotWhitelistedErrorReason", FALSE)) {
/**
 * The single reason for the whitelist error.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("QuotaCheckErrorReason", FALSE)) {
/**
 * Enums for all the reasons an error can be thrown to the user during
 * billing quota checks.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("RateExceededErrorReason", FALSE)) {
/**
 * The reason for the rate exceeded error.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("RequestErrorReason", FALSE)) {
/**
 * Error reason is unknown.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("CriterionUserListMembershipStatus", FALSE)) {
/**
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * This field indicates the subtype of Attribute of this instance.  It is ignored
 * on input, and instead xsi:type should be specified.
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("BulkOpportunityPage", FALSE)) {
/**
 * 
 */
class BulkOpportunityPage {
  /**
   * @access public
   * @var Opportunity[]
   */
  public $entries;

  /**
   * @access public
   * @var integer
   */
  public $totalNumEntries;

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
    return "BulkOpportunityPage";
  }

  public function __construct($entries = NULL, $totalNumEntries = NULL) {
    if(get_parent_class('BulkOpportunityPage')) parent::__construct();
    $this->entries = $entries;
    $this->totalNumEntries = $totalNumEntries;
  }
}}

if (!class_exists("BulkOpportunitySelector", FALSE)) {
/**
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 */
class BulkOpportunitySelector {
  /**
   * @access public
   * @var tnsOpportunityIdeaType[]
   */
  public $ideaTypes;

  /**
   * @access public
   * @var tnsOpportunityAttributeType[]
   */
  public $requestedAttributeTypes;

  /**
   * @access public
   * @var Paging
   */
  public $paging;

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
    return "BulkOpportunitySelector";
  }

  public function __construct($ideaTypes = NULL, $requestedAttributeTypes = NULL, $paging = NULL) {
    if(get_parent_class('BulkOpportunitySelector')) parent::__construct();
    $this->ideaTypes = $ideaTypes;
    $this->requestedAttributeTypes = $requestedAttributeTypes;
    $this->paging = $paging;
  }
}}

if (!class_exists("BulkOpportunityServiceError", FALSE)) {
/**
 * 
 */
class BulkOpportunityServiceError extends ApiError {
  /**
   * @access public
   * @var tnsBulkOpportunityServiceErrorReason
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
    return "BulkOpportunityServiceError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('BulkOpportunityServiceError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("CriterionAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("DoubleAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("IdeaTypeAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("LongRangeAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("MoneyAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("Opportunity", FALSE)) {
/**
 * 
 */
class Opportunity {
  /**
   * @access public
   * @var OpportunityIdea[]
   */
  public $opportunityIdeas;

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
    return "Opportunity";
  }

  public function __construct($opportunityIdeas = NULL) {
    if(get_parent_class('Opportunity')) parent::__construct();
    $this->opportunityIdeas = $opportunityIdeas;
  }
}}

if (!class_exists("OpportunityAttribute_AttributeMapEntry", FALSE)) {
/**
 * This represents an entry in a map with a key of type OpportunityAttribute
 * and value of type Attribute.
 */
class OpportunityAttribute_AttributeMapEntry {
  /**
   * @access public
   * @var tnsOpportunityAttributeType
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
    return "OpportunityAttribute_AttributeMapEntry";
  }

  public function __construct($key = NULL, $value = NULL) {
    if(get_parent_class('OpportunityAttribute_AttributeMapEntry')) parent::__construct();
    $this->key = $key;
    $this->value = $value;
  }
}}

if (!class_exists("OpportunityError", FALSE)) {
/**
 * 
 */
class OpportunityError extends ApiError {
  /**
   * @access public
   * @var tnsOpportunityErrorReason
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
    return "OpportunityError";
  }

  public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $errorString = NULL, $ApiErrorType = NULL) {
    if(get_parent_class('OpportunityError')) parent::__construct();
    $this->reason = $reason;
    $this->fieldPath = $fieldPath;
    $this->trigger = $trigger;
    $this->errorString = $errorString;
    $this->ApiErrorType = $ApiErrorType;
  }
}}

if (!class_exists("OpportunityIdea", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 */
class OpportunityIdea {
  /**
   * @access public
   * @var OpportunityAttribute_AttributeMapEntry[]
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
    return "OpportunityIdea";
  }

  public function __construct($data = NULL) {
    if(get_parent_class('OpportunityIdea')) parent::__construct();
    $this->data = $data;
  }
}}

if (!class_exists("OpportunityIdeaTypeAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("StringAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("WebpageDescriptor", FALSE)) {
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
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("BulkOpportunityServiceErrorReason", FALSE)) {
/**
 * 
 */
class BulkOpportunityServiceErrorReason {
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
    return "BulkOpportunityServiceError.Reason";
  }

  public function __construct() {
    if(get_parent_class('BulkOpportunityServiceErrorReason')) parent::__construct();
  }
}}

if (!class_exists("IdeaType", FALSE)) {
/**
 * 
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

if (!class_exists("OpportunityAttributeType", FALSE)) {
/**
 * Represents the type of
 * {@link com.google.ads.api.services.common.optimization.attributes.Attribute}.
 * <p><b>{@link OpportunityIdeaType} KEYWORD supports the following {@link OpportunityAttributeType}s:</b><br/>
 * <ul><li>{@link #ADGROUP_ID}</li>
 * <li>{@link #AVERAGE_MONTHLY_SEARCHES}</li>
 * <li>{@link #CAMPAIGN_ID}</li>
 * <li>{@link #CUSTOMER_ID}</li>
 * <li>{@link #IDEA_TYPE}</li>
 * <li>{@link #KEYWORD}</li>
 * </ul>
 * <p><b>{@link OpportunityIdeaType} BID supports the following {@link OpportunityAttributeType}s:</b><br/>
 * <ul><li>{@link #ADGROUP_ID}</li>
 * <li>{@link #BID_LANDSCAPE}</li>
 * <li>{@link #CAMPAIGN_ID}</li>
 * <li>{@link #CLICKS_CHANGE}</li>
 * <li>{@link #COST_CHANGE}</li>
 * <li>{@link #CURRENT_BID}</li>
 * <li>{@link #CUSTOMER_ID}</li>
 * <li>{@link #IDEA_TYPE}</li>
 * <li>{@link #IMPRESSIONS_CHANGE}</li>
 * <li>{@link #KEYWORD}</li>
 * <li>{@link #NEW_BID}</li>
 * </ul>
 * <p><b>{@link OpportunityIdeaType} BUDGET supports the following {@link OpportunityAttributeType}s:</b><br/>
 * <ul><li>{@link #ADGROUP_ID}</li>
 * <li>{@link #CAMPAIGN_ID}</li>
 * <li>{@link #CLICKS_CHANGE}</li>
 * <li>{@link #COST_CHANGE}</li>
 * <li>{@link #CURRENT_BUDGET}</li>
 * <li>{@link #CUSTOMER_ID}</li>
 * <li>{@link #IDEA_TYPE}</li>
 * <li>{@link #IMPRESSIONS_CHANGE}</li>
 * <li>{@link #NEW_BUDGET}</li>
 * </ul>
 */
class OpportunityAttributeType {
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
    return "OpportunityAttributeType";
  }

  public function __construct() {
    if(get_parent_class('OpportunityAttributeType')) parent::__construct();
  }
}}

if (!class_exists("OpportunityErrorReason", FALSE)) {
/**
 * 
 */
class OpportunityErrorReason {
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
    return "OpportunityError.Reason";
  }

  public function __construct() {
    if(get_parent_class('OpportunityErrorReason')) parent::__construct();
  }
}}

if (!class_exists("OpportunityIdeaType", FALSE)) {
/**
 * 
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

if (!class_exists("SiteConstantsAdFormat", FALSE)) {
/**
 * Enumerates the ad formats which can be reported in search results.
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

if (!class_exists("SiteConstantsPlacementType", FALSE)) {
/**
 * A placement request and response value indicating the type of site or other medium
 * (for example, a web page, in a feed, in a video) where ads will appear.
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

if (!class_exists("BulkOpportunityServiceGet", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns a page of opportunities that match the query described by the
 * specified {@link BulkOpportunitySelector}.
 * 
 * The selector must specify a Paging value, with {@code numberResults} set to
 * 20 or less. Large result sets must be composed through multiple calls to
 * this method, advancing the Paging {@code startIndex} value by
 * {@code numberResults} with each call.
 * 
 * BulkOpportunityService is available only to a limited set of advertisers.
 * If you are not eligible to use this service, you will receive
 * an error when calling it. Addtionally, please read this
 * <a href="https://adwords.google.com/support/aw/bin/answer.py?hl=en&answer=1152907">
 * important notice</a>
 * before you use the results returned by this API.
 * 
 * @param selector Query describing the bulk opportunities to return.
 * @return A {@link BulkOpportunityPage} of results, that is a subset of the
 * list of possible opportunities meeting the criteria of the
 * {@link BulkOpportunitySelector}.
 * @throws ApiException If problems occurred while querying for opportunities.
 */
class BulkOpportunityServiceGet {
  /**
   * @access public
   * @var BulkOpportunitySelector
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
    if(get_parent_class('BulkOpportunityServiceGet')) parent::__construct();
    $this->selector = $selector;
  }
}}

if (!class_exists("BulkOpportunityServiceGetResponse", FALSE)) {
/**
 * 
 */
class BulkOpportunityServiceGetResponse {
  /**
   * @access public
   * @var BulkOpportunityPage
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
    if(get_parent_class('BulkOpportunityServiceGetResponse')) parent::__construct();
    $this->rval = $rval;
  }
}}

if (!class_exists("ApiException", FALSE)) {
/**
 * Exception class for holding a list of service errors.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "CampaignId".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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
 * <span class="constraint Selectable">This field can be selected using the value "CriterionId".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("DoubleValue", FALSE)) {
/**
 * Number value type for constructing double valued ranges.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("LongValue", FALSE)) {
/**
 * Number value type for constructing long valued ranges.
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("AdFormatSpecListAttribute", FALSE)) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("AdGroupBidLandscape", FALSE)) {
/**
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * <span class="constraint Selectable">This field can be selected using the value "LandscapeType".</span><span class="constraint Filterable">This field can be filtered on.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
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

if (!class_exists("BulkOpportunityService", FALSE)) {
/**
 * BulkOpportunityService
 * @author WSDLInterpreter
 */
class BulkOpportunityService extends AdWordsSoapClient {
  /**
   * Default class map for wsdl=>php
   * @access private
   * @var array
   */
  public static $classmap = array(
    "getResponse" => "BulkOpportunityServiceGetResponse",
    "get" => "BulkOpportunityServiceGet",
    "mutate" => "BulkOpportunityServiceMutate",
    "mutateResponse" => "BulkOpportunityServiceMutateResponse",
    "DateTime" => "AdWordsDateTime",
    "Target" => "AdWordsTarget",
    "SoapHeader" => "SoapRequestHeader",
    "AdGroupBidLandscape" => "AdGroupBidLandscape",
    "BidLandscape" => "BidLandscape",
    "ApiError" => "ApiError",
    "ApiException" => "ApiException",
    "ApplicationException" => "ApplicationException",
    "AuthenticationError" => "AuthenticationError",
    "AuthorizationError" => "AuthorizationError",
    "DataEntry" => "DataEntry",
    "BidLandscape.LandscapePoint" => "BidLandscapeLandscapePoint",
    "ClientTermsError" => "ClientTermsError",
    "ComparableValue" => "ComparableValue",
    "Criterion" => "Criterion",
    "CriterionBidLandscape" => "CriterionBidLandscape",
    "DatabaseError" => "DatabaseError",
    "DoubleValue" => "DoubleValue",
    "NumberValue" => "NumberValue",
    "InternalApiError" => "InternalApiError",
    "Keyword" => "Keyword",
    "LongValue" => "LongValue",
    "Money" => "Money",
    "NotWhitelistedError" => "NotWhitelistedError",
    "NullError" => "NullError",
    "Paging" => "Paging",
    "Placement" => "Placement",
    "Product" => "Product",
    "ProductCondition" => "ProductCondition",
    "ProductConditionOperand" => "ProductConditionOperand",
    "QuotaCheckError" => "QuotaCheckError",
    "RateExceededError" => "RateExceededError",
    "RequestError" => "RequestError",
    "RequiredError" => "RequiredError",
    "SizeLimitError" => "SizeLimitError",
    "SoapResponseHeader" => "SoapResponseHeader",
    "CriterionUserInterest" => "CriterionUserInterest",
    "CriterionUserList" => "CriterionUserList",
    "Vertical" => "Vertical",
    "AdGroupBidLandscape.Type" => "AdGroupBidLandscapeType",
    "AuthenticationError.Reason" => "AuthenticationErrorReason",
    "AuthorizationError.Reason" => "AuthorizationErrorReason",
    "ClientTermsError.Reason" => "ClientTermsErrorReason",
    "DatabaseError.Reason" => "DatabaseErrorReason",
    "InternalApiError.Reason" => "InternalApiErrorReason",
    "KeywordMatchType" => "KeywordMatchType",
    "NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
    "NullError.Reason" => "NullErrorReason",
    "QuotaCheckError.Reason" => "QuotaCheckErrorReason",
    "RateExceededError.Reason" => "RateExceededErrorReason",
    "RequestError.Reason" => "RequestErrorReason",
    "RequiredError.Reason" => "RequiredErrorReason",
    "SizeLimitError.Reason" => "SizeLimitErrorReason",
    "CriterionUserList.MembershipStatus" => "CriterionUserListMembershipStatus",
    "AdFormatSpec" => "AdFormatSpec",
    "AdFormatSpecListAttribute" => "AdFormatSpecListAttribute",
    "Attribute" => "Attribute",
    "BidLandscapeAttribute" => "BidLandscapeAttribute",
    "BooleanAttribute" => "BooleanAttribute",
    "BulkOpportunityPage" => "BulkOpportunityPage",
    "BulkOpportunitySelector" => "BulkOpportunitySelector",
    "BulkOpportunityServiceError" => "BulkOpportunityServiceError",
    "CriterionAttribute" => "CriterionAttribute",
    "DoubleAttribute" => "DoubleAttribute",
    "IdeaTypeAttribute" => "IdeaTypeAttribute",
    "InStreamAdInfo" => "InStreamAdInfo",
    "InStreamAdInfoAttribute" => "InStreamAdInfoAttribute",
    "IntegerAttribute" => "IntegerAttribute",
    "IntegerSetAttribute" => "IntegerSetAttribute",
    "KeywordAttribute" => "KeywordAttribute",
    "LongAttribute" => "LongAttribute",
    "LongRangeAttribute" => "LongRangeAttribute",
    "MoneyAttribute" => "MoneyAttribute",
    "MonthlySearchVolume" => "MonthlySearchVolume",
    "MonthlySearchVolumeAttribute" => "MonthlySearchVolumeAttribute",
    "Opportunity" => "Opportunity",
    "OpportunityAttribute_AttributeMapEntry" => "OpportunityAttribute_AttributeMapEntry",
    "OpportunityError" => "OpportunityError",
    "OpportunityIdea" => "OpportunityIdea",
    "OpportunityIdeaTypeAttribute" => "OpportunityIdeaTypeAttribute",
    "PlacementAttribute" => "PlacementAttribute",
    "PlacementTypeAttribute" => "PlacementTypeAttribute",
    "Range" => "Range",
    "StringAttribute" => "StringAttribute",
    "WebpageDescriptor" => "WebpageDescriptor",
    "WebpageDescriptorAttribute" => "WebpageDescriptorAttribute",
    "BulkOpportunityServiceError.Reason" => "BulkOpportunityServiceErrorReason",
    "IdeaType" => "IdeaType",
    "OpportunityAttributeType" => "OpportunityAttributeType",
    "OpportunityError.Reason" => "OpportunityErrorReason",
    "OpportunityIdeaType" => "OpportunityIdeaType",
    "SiteConstants.AdFormat" => "SiteConstantsAdFormat",
    "SiteConstants.PlacementType" => "SiteConstantsPlacementType",
  );

  /**
   * Constructor using wsdl location and options array
   * @param string $wsdl WSDL location for this service
   * @param array $options Options for the SoapClient
   */
  public function __construct($wsdl=null, $options, $user) {
    $options["classmap"] = BulkOpportunityService::$classmap;
    parent::__construct($wsdl, $options, $user, 'BulkOpportunityService', 'https://adwords.google.com/api/adwords/o/v201101');
  }

  /**
   * <span class="constraint Required">This field is required and should not be {@code null}.</span>
   * 
   * 
   * 
   * Returns a page of opportunities that match the query described by the
   * specified {@link BulkOpportunitySelector}.
   * 
   * The selector must specify a Paging value, with {@code numberResults} set to
   * 20 or less. Large result sets must be composed through multiple calls to
   * this method, advancing the Paging {@code startIndex} value by
   * {@code numberResults} with each call.
   * 
   * BulkOpportunityService is available only to a limited set of advertisers.
   * If you are not eligible to use this service, you will receive
   * an error when calling it. Addtionally, please read this
   * <a href="https://adwords.google.com/support/aw/bin/answer.py?hl=en&answer=1152907">
   * important notice</a>
   * before you use the results returned by this API.
   * 
   * @param selector Query describing the bulk opportunities to return.
   * @return A {@link BulkOpportunityPage} of results, that is a subset of the
   * list of possible opportunities meeting the criteria of the
   * {@link BulkOpportunitySelector}.
   * @throws ApiException If problems occurred while querying for opportunities.
   */
  public function get($selector) {
    $arg = new BulkOpportunityServiceGet($selector);
    $result = $this->__soapCall("get", array($arg));
    return $result->rval;
  }


}}

?>