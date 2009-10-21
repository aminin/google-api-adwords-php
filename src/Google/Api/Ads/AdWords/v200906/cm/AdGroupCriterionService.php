<?php
/**
 * Contains all client objects for the AdGroupCriterionService service.
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

if (!class_exists("AdGroupCriterionIdFilter")) {
/**
 * Used to refer to adgroup criterion using ids.
 * Allows referring to:
 * <ul>
 * <li>all adgroup criteria under a campaign - only set campaignId</li>
 * <li>all adgroup criteria under an adgroup - only set adgroupId</li>
 * <li>a single adgroup criterion - set both adgroupId, criterionId</li>
 * </ul>
 */
class AdGroupCriterionIdFilter {
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
	 * @var integer
	 */
	public $criterionId;

	public function __construct($campaignId = NULL, $adGroupId = NULL, $criterionId = NULL) {
		if(get_parent_class('AdGroupCriterionIdFilter')) parent::__construct();
		$this->campaignId = $campaignId;
		$this->adGroupId = $adGroupId;
		$this->criterionId = $criterionId;
	}
}}

if (!class_exists("DateRange")) {
/**
 * Represents a range of dates that has either an upper or a lower bound.
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

if (!class_exists("PolicyViolationErrorPart")) {
/**
 * Points to a substring within an ad field or criterion.
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

	public function __construct($index = NULL, $length = NULL) {
		if(get_parent_class('PolicyViolationErrorPart')) parent::__construct();
		$this->index = $index;
		$this->length = $length;
	}
}}

if (!class_exists("PolicyViolationKey")) {
/**
 * Key of the violation. The key is used for referring to a violation when
 * filing an exemption request.
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

	public function __construct($policyName = NULL, $violatingText = NULL) {
		if(get_parent_class('PolicyViolationKey')) parent::__construct();
		$this->policyName = $policyName;
		$this->violatingText = $violatingText;
	}
}}

if (!class_exists("QualityInfo")) {
/**
 * Container for criterion quality information.
 */
class QualityInfo {
	/**
	 * @access public
	 * @var boolean
	 */
	public $isKeywordAdRelevanceAcceptable;
	/**
	 * @access public
	 * @var boolean
	 */
	public $isLandingPageQualityAcceptable;
	/**
	 * @access public
	 * @var boolean
	 */
	public $isLandingPageLatencyAcceptable;
	/**
	 * @access public
	 * @var integer
	 */
	public $qualityScore;

	public function __construct($isKeywordAdRelevanceAcceptable = NULL, $isLandingPageQualityAcceptable = NULL, $isLandingPageLatencyAcceptable = NULL, $qualityScore = NULL) {
		if(get_parent_class('QualityInfo')) parent::__construct();
		$this->isKeywordAdRelevanceAcceptable = $isKeywordAdRelevanceAcceptable;
		$this->isLandingPageQualityAcceptable = $isLandingPageQualityAcceptable;
		$this->isLandingPageLatencyAcceptable = $isLandingPageLatencyAcceptable;
		$this->qualityScore = $qualityScore;
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

if (!class_exists("StatsSelector")) {
/**
 * Selects statistics for date range.
 */
class StatsSelector {
	/**
	 * @access public
	 * @var DateRange
	 */
	public $dateRange;
	/**
	 * @access public
	 * @var string
	 */
	public $StatsSelectorType;
	private $_parameterMap = array (
		"StatsSelector.Type" => "StatsSelectorType",
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

	public function __construct($dateRange = NULL, $StatsSelectorType = NULL) {
		if(get_parent_class('StatsSelector')) parent::__construct();
		$this->dateRange = $dateRange;
		$this->StatsSelectorType = $StatsSelectorType;
	}
}}

if (!class_exists("ComparableValue")) {
/**
 * Comparable types for constructing ranges with.
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

if (!class_exists("ExemptionRequest")) {
/**
 * A request to be exempted from a {@link PolicyViolationError}.
 */
class ExemptionRequest {
	/**
	 * @access public
	 * @var PolicyViolationKey
	 */
	public $key;

	public function __construct($key = NULL) {
		if(get_parent_class('ExemptionRequest')) parent::__construct();
		$this->key = $key;
	}
}}

if (!class_exists("Stats")) {
/**
 * Statistics about an ad or criterion within an adgroup or campaign.
 */
class Stats {
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
	 * @var tnsStatsNetwork
	 */
	public $network;
	/**
	 * @access public
	 * @var integer
	 */
	public $clicks;
	/**
	 * @access public
	 * @var integer
	 */
	public $impressions;
	/**
	 * @access public
	 * @var Money
	 */
	public $cost;
	/**
	 * @access public
	 * @var double
	 */
	public $averagePosition;
	/**
	 * @access public
	 * @var Money
	 */
	public $averageCpc;
	/**
	 * @access public
	 * @var Money
	 */
	public $averageCpm;
	/**
	 * @access public
	 * @var double
	 */
	public $ctr;
	/**
	 * @access public
	 * @var integer
	 */
	public $conversions;
	/**
	 * @access public
	 * @var double
	 */
	public $conversionRate;
	/**
	 * @access public
	 * @var Money
	 */
	public $costPerConversion;
	/**
	 * @access public
	 * @var integer
	 */
	public $conversionsManyPerClick;
	/**
	 * @access public
	 * @var double
	 */
	public $conversionRateManyPerClick;
	/**
	 * @access public
	 * @var Money
	 */
	public $costPerConversionManyPerClick;
	/**
	 * @access public
	 * @var string
	 */
	public $StatsType;
	private $_parameterMap = array (
		"Stats.Type" => "StatsType",
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

	public function __construct($startDate = NULL, $endDate = NULL, $network = NULL, $clicks = NULL, $impressions = NULL, $cost = NULL, $averagePosition = NULL, $averageCpc = NULL, $averageCpm = NULL, $ctr = NULL, $conversions = NULL, $conversionRate = NULL, $costPerConversion = NULL, $conversionsManyPerClick = NULL, $conversionRateManyPerClick = NULL, $costPerConversionManyPerClick = NULL, $StatsType = NULL) {
		if(get_parent_class('Stats')) parent::__construct();
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->network = $network;
		$this->clicks = $clicks;
		$this->impressions = $impressions;
		$this->cost = $cost;
		$this->averagePosition = $averagePosition;
		$this->averageCpc = $averageCpc;
		$this->averageCpm = $averageCpm;
		$this->ctr = $ctr;
		$this->conversions = $conversions;
		$this->conversionRate = $conversionRate;
		$this->costPerConversion = $costPerConversion;
		$this->conversionsManyPerClick = $conversionsManyPerClick;
		$this->conversionRateManyPerClick = $conversionRateManyPerClick;
		$this->costPerConversionManyPerClick = $costPerConversionManyPerClick;
		$this->StatsType = $StatsType;
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

if (!class_exists("Bid")) {
/**
 * Represents a bid on a criterion.
 */
class Bid {
	/**
	 * @access public
	 * @var Money
	 */
	public $amount;

	public function __construct($amount = NULL) {
		if(get_parent_class('Bid')) parent::__construct();
		$this->amount = $amount;
	}
}}

if (!class_exists("PositionPreferenceAdGroupCriterionBids")) {
/**
 * AdGroupCriterion level bids used in manual cpc bidding strategy
 * when position preference is turned on.
 */
class PositionPreferenceAdGroupCriterionBids {
	/**
	 * @access public
	 * @var Bid
	 */
	public $proxyMaxCpc;
	/**
	 * @access public
	 * @var integer
	 */
	public $preferredPosition;
	/**
	 * @access public
	 * @var integer
	 */
	public $bottomPosition;

	public function __construct($proxyMaxCpc = NULL, $preferredPosition = NULL, $bottomPosition = NULL) {
		if(get_parent_class('PositionPreferenceAdGroupCriterionBids')) parent::__construct();
		$this->proxyMaxCpc = $proxyMaxCpc;
		$this->preferredPosition = $preferredPosition;
		$this->bottomPosition = $bottomPosition;
	}
}}

if (!class_exists("AdGroupCriterionBids")) {
/**
 * Represents criterion level bids.
 */
class AdGroupCriterionBids {
	/**
	 * @access public
	 * @var string
	 */
	public $AdGroupCriterionBidsType;
	private $_parameterMap = array (
		"AdGroupCriterionBids.Type" => "AdGroupCriterionBidsType",
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

	public function __construct($AdGroupCriterionBidsType = NULL) {
		if(get_parent_class('AdGroupCriterionBids')) parent::__construct();
		$this->AdGroupCriterionBidsType = $AdGroupCriterionBidsType;
	}
}}

if (!class_exists("AdGroupCriterion")) {
/**
 * Represents a crterion in an ad group.
 * 
 * <p>May be instantiated to refer to ad group criteria to be deleted.
 */
class AdGroupCriterion {
	/**
	 * @access public
	 * @var integer
	 */
	public $adGroupId;
	/**
	 * @access public
	 * @var Criterion
	 */
	public $criterion;
	/**
	 * @access public
	 * @var string
	 */
	public $AdGroupCriterionType;
	private $_parameterMap = array (
		"AdGroupCriterion.Type" => "AdGroupCriterionType",
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

	public function __construct($adGroupId = NULL, $criterion = NULL, $AdGroupCriterionType = NULL) {
		if(get_parent_class('AdGroupCriterion')) parent::__construct();
		$this->adGroupId = $adGroupId;
		$this->criterion = $criterion;
		$this->AdGroupCriterionType = $AdGroupCriterionType;
	}
}}

if (!class_exists("AdGroupCriterionSelector")) {
/**
 * Selects adgroup level criteria.
 * 
 * <p>Note:
 * <ul>
 * <li>You may not sort by biddable criterion-only fields if
 * biddable criteria are not being selected.</li>
 * <li>You may not filter on biddable criterion-only fields if only
 * negatives are being selected.</li>
 * <li>You may not filter on fields that are specific to a criterion
 * type (Keyword, for example) when that type is not being
 * selected.</li>
 * </ul>
 */
class AdGroupCriterionSelector {
	/**
	 * @access public
	 * @var AdGroupCriterionIdFilter[]
	 */
	public $idFilters;
	/**
	 * @access public
	 * @var tnsCriterionUse
	 */
	public $criterionUse;
	/**
	 * @access public
	 * @var tnsUserStatus[]
	 */
	public $userStatuses;
	/**
	 * @access public
	 * @var StatsSelector
	 */
	public $statsSelector;
	/**
	 * @access public
	 * @var Paging
	 */
	public $paging;

	public function __construct($idFilters = NULL, $criterionUse = NULL, $userStatuses = NULL, $statsSelector = NULL, $paging = NULL) {
		if(get_parent_class('AdGroupCriterionSelector')) parent::__construct();
		$this->idFilters = $idFilters;
		$this->criterionUse = $criterionUse;
		$this->userStatuses = $userStatuses;
		$this->statsSelector = $statsSelector;
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

if (!class_exists("AdGroupCriterionErrorReason")) {
/**
 * The reasons for the target error.
 */
class AdGroupCriterionErrorReason {

	public function __construct() {
		if(get_parent_class('AdGroupCriterionErrorReason')) parent::__construct();
	}
}}

if (!class_exists("AdGroupCriterionLimitExceededCriteriaLimitType")) {
/**
 * The entity type that exceeded the limit.
 */
class AdGroupCriterionLimitExceededCriteriaLimitType {

	public function __construct() {
		if(get_parent_class('AdGroupCriterionLimitExceededCriteriaLimitType')) parent::__construct();
	}
}}

if (!class_exists("ApprovalStatus")) {
/**
 * Approval status for the criterion.
 * Note: there are more states involved but we only expose two to users.
 */
class ApprovalStatus {

	public function __construct() {
		if(get_parent_class('ApprovalStatus')) parent::__construct();
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

if (!class_exists("BidSource")) {
/**
 * Indicate where a criterion's bid came from: criterion or the adgroup it
 * belongs to.
 */
class BidSource {

	public function __construct() {
		if(get_parent_class('BidSource')) parent::__construct();
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

if (!class_exists("CriterionUse")) {
/**
 * The way a criterion is used - biddable or negative.
 */
class CriterionUse {

	public function __construct() {
		if(get_parent_class('CriterionUse')) parent::__construct();
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

if (!class_exists("DateErrorReason")) {
/**
 * The reasons for the target error.
 */
class DateErrorReason {

	public function __construct() {
		if(get_parent_class('DateErrorReason')) parent::__construct();
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

if (!class_exists("EntityAccessDeniedReason")) {
/**
 * User did not have read access.
 */
class EntityAccessDeniedReason {

	public function __construct() {
		if(get_parent_class('EntityAccessDeniedReason')) parent::__construct();
	}
}}

if (!class_exists("EntityCountLimitExceededReason")) {
/**
 * Limits at various levels of the account.
 */
class EntityCountLimitExceededReason {

	public function __construct() {
		if(get_parent_class('EntityCountLimitExceededReason')) parent::__construct();
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

if (!class_exists("KeywordMatchType")) {
/**
 * Match type of a keyword. i.e. the way we match a keyword string with
 * search queries.
 */
class KeywordMatchType {

	public function __construct() {
		if(get_parent_class('KeywordMatchType')) parent::__construct();
	}
}}

if (!class_exists("NewEntityCreationErrorReason")) {
/**
 * Do not set the id field while creating new entities.
 */
class NewEntityCreationErrorReason {

	public function __construct() {
		if(get_parent_class('NewEntityCreationErrorReason')) parent::__construct();
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

if (!class_exists("StatsNetwork")) {
/**
 * Ad network.
 */
class StatsNetwork {

	public function __construct() {
		if(get_parent_class('StatsNetwork')) parent::__construct();
	}
}}

if (!class_exists("StatsQueryErrorReason")) {
/**
 * The reasons for errors when querying for stats.
 */
class StatsQueryErrorReason {

	public function __construct() {
		if(get_parent_class('StatsQueryErrorReason')) parent::__construct();
	}
}}

if (!class_exists("SystemServingStatus")) {
/**
 * Reported by system to reflect the criterion's serving status.
 */
class SystemServingStatus {

	public function __construct() {
		if(get_parent_class('SystemServingStatus')) parent::__construct();
	}
}}

if (!class_exists("UserStatus")) {
/**
 * Specified by user to pause or unpause a criterion.
 */
class UserStatus {

	public function __construct() {
		if(get_parent_class('UserStatus')) parent::__construct();
	}
}}

if (!class_exists("AdGroupCriterionServiceGet")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Gets adgroup criteria.
 * 
 * @param selector filters the adgroup criteria to be returned.
 * @return a page (subset) view of the criteria selected
 * @throws ApiException when there is at least one error with the request
 */
class AdGroupCriterionServiceGet {
	/**
	 * @access public
	 * @var AdGroupCriterionSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('AdGroupCriterionServiceGet')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("AdGroupCriterionServiceGetResponse")) {
/**
 * 
 */
class AdGroupCriterionServiceGetResponse {
	/**
	 * @access public
	 * @var AdGroupCriterionPage
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('AdGroupCriterionServiceGetResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AdGroupCriterionServiceMutate")) {
/**
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 * <span class="constraint DistinctIds">Elements in this field must have distinct IDs for following {@link Operator}s : SET, REMOVE.</span>
 * <span class="constraint NotEmpty">This field must contain at least one element.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Adds, removes or updates adgroup criteria.
 * 
 * @param operations operations to do
 * during checks on keywords to be added.
 * @return added and updated adgroup criteria (without optional parts)
 * @throws ApiException when there is at least one error with the request
 */
class AdGroupCriterionServiceMutate {
	/**
	 * @access public
	 * @var AdGroupCriterionOperation[]
	 */
	public $operations;

	public function __construct($operations = NULL) {
		if(get_parent_class('AdGroupCriterionServiceMutate')) parent::__construct();
		$this->operations = $operations;
	}
}}

if (!class_exists("AdGroupCriterionServiceMutateResponse")) {
/**
 * 
 */
class AdGroupCriterionServiceMutateResponse {
	/**
	 * @access public
	 * @var AdGroupCriterionReturnValue
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('AdGroupCriterionServiceMutateResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AdGroupCriterionError")) {
/**
 * 
 */
class AdGroupCriterionError extends ApiError {
	/**
	 * @access public
	 * @var tnsAdGroupCriterionErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AdGroupCriterionError')) parent::__construct();
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

if (!class_exists("ConversionOptimizerAdGroupCriterionBids")) {
/**
 * AdGroupCriterion level bids used in conversion optimizer bidding strategy.
 * This bidding strategy does not contain any bid information at the
 * AGC level.
 */
class ConversionOptimizerAdGroupCriterionBids extends AdGroupCriterionBids {

	public function __construct($AdGroupCriterionBidsType = NULL) {
		if(get_parent_class('ConversionOptimizerAdGroupCriterionBids')) parent::__construct();
		$this->AdGroupCriterionBidsType = $AdGroupCriterionBidsType;
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

if (!class_exists("DateError")) {
/**
 * 
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

if (!class_exists("EntityAccessDenied")) {
/**
 * Reports permission problems trying to access an entity.
 */
class EntityAccessDenied extends ApiError {
	/**
	 * @access public
	 * @var tnsEntityAccessDeniedReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('EntityAccessDenied')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("EntityCountLimitExceeded")) {
/**
 * Signals that an entity count limit was exceeded for some level.
 * For example, too many criteria for a campaign.
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

	public function __construct($reason = NULL, $enclosingId = NULL, $limit = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('EntityCountLimitExceeded')) parent::__construct();
		$this->reason = $reason;
		$this->enclosingId = $enclosingId;
		$this->limit = $limit;
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

if (!class_exists("Keyword")) {
/**
 * A keyword.
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

if (!class_exists("Money")) {
/**
 * 
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

if (!class_exists("NegativeAdGroupCriterion")) {
/**
 * A negative criterion in an adgroup.
 */
class NegativeAdGroupCriterion extends AdGroupCriterion {

	public function __construct($adGroupId = NULL, $criterion = NULL, $AdGroupCriterionType = NULL) {
		if(get_parent_class('NegativeAdGroupCriterion')) parent::__construct();
		$this->adGroupId = $adGroupId;
		$this->criterion = $criterion;
		$this->AdGroupCriterionType = $AdGroupCriterionType;
	}
}}

if (!class_exists("NewEntityCreationError")) {
/**
 * 
 */
class NewEntityCreationError extends ApiError {
	/**
	 * @access public
	 * @var tnsNewEntityCreationErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('NewEntityCreationError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
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

if (!class_exists("NumberValue")) {
/**
 * Number value types for constructing number valued ranges.
 */
class NumberValue extends ComparableValue {

	public function __construct($ComparableValueType = NULL) {
		if(get_parent_class('NumberValue')) parent::__construct();
		$this->ComparableValueType = $ComparableValueType;
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

if (!class_exists("Placement")) {
/**
 * A placement used for modifying bids for sites when targeting the content
 * network.
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

if (!class_exists("StatsQueryError")) {
/**
 * Represents possible error codes when querying for stats.
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

if (!class_exists("PolicyViolationError")) {
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

	public function __construct($key = NULL, $externalPolicyName = NULL, $externalPolicyUrl = NULL, $externalPolicyDescription = NULL, $isExemptable = NULL, $violatingParts = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('PolicyViolationError')) parent::__construct();
		$this->key = $key;
		$this->externalPolicyName = $externalPolicyName;
		$this->externalPolicyUrl = $externalPolicyUrl;
		$this->externalPolicyDescription = $externalPolicyDescription;
		$this->isExemptable = $isExemptable;
		$this->violatingParts = $violatingParts;
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

if (!class_exists("BudgetOptimizerAdGroupCriterionBids")) {
/**
 * AdGroupCriterion level bids used in budget optimizer bidding strategy.
 */
class BudgetOptimizerAdGroupCriterionBids extends AdGroupCriterionBids {
	/**
	 * @access public
	 * @var Bid
	 */
	public $proxyBid;

	public function __construct($proxyBid = NULL, $AdGroupCriterionBidsType = NULL) {
		if(get_parent_class('BudgetOptimizerAdGroupCriterionBids')) parent::__construct();
		$this->proxyBid = $proxyBid;
		$this->AdGroupCriterionBidsType = $AdGroupCriterionBidsType;
	}
}}

if (!class_exists("ManualCPMAdGroupCriterionBids")) {
/**
 * AdGroupCriterion level bids used in manual CPM bidding strategy.
 */
class ManualCPMAdGroupCriterionBids extends AdGroupCriterionBids {
	/**
	 * @access public
	 * @var Bid
	 */
	public $maxCpm;
	/**
	 * @access public
	 * @var tnsBidSource
	 */
	public $bidSource;

	public function __construct($maxCpm = NULL, $bidSource = NULL, $AdGroupCriterionBidsType = NULL) {
		if(get_parent_class('ManualCPMAdGroupCriterionBids')) parent::__construct();
		$this->maxCpm = $maxCpm;
		$this->bidSource = $bidSource;
		$this->AdGroupCriterionBidsType = $AdGroupCriterionBidsType;
	}
}}

if (!class_exists("ManualCPCAdGroupCriterionBids")) {
/**
 * AdGroupCriterion level bids used in manual cpc bidding strategy.
 */
class ManualCPCAdGroupCriterionBids extends AdGroupCriterionBids {
	/**
	 * @access public
	 * @var Bid
	 */
	public $maxCpc;
	/**
	 * @access public
	 * @var tnsBidSource
	 */
	public $bidSource;
	/**
	 * @access public
	 * @var PositionPreferenceAdGroupCriterionBids
	 */
	public $positionPreferenceBids;

	public function __construct($maxCpc = NULL, $bidSource = NULL, $positionPreferenceBids = NULL, $AdGroupCriterionBidsType = NULL) {
		if(get_parent_class('ManualCPCAdGroupCriterionBids')) parent::__construct();
		$this->maxCpc = $maxCpc;
		$this->bidSource = $bidSource;
		$this->positionPreferenceBids = $positionPreferenceBids;
		$this->AdGroupCriterionBidsType = $AdGroupCriterionBidsType;
	}
}}

if (!class_exists("BiddableAdGroupCriterion")) {
/**
 * A biddable (positive) criterion in an adgroup.
 */
class BiddableAdGroupCriterion extends AdGroupCriterion {
	/**
	 * @access public
	 * @var tnsUserStatus
	 */
	public $userStatus;
	/**
	 * @access public
	 * @var tnsSystemServingStatus
	 */
	public $systemServingStatus;
	/**
	 * @access public
	 * @var tnsApprovalStatus
	 */
	public $approvalStatus;
	/**
	 * @access public
	 * @var string
	 */
	public $destinationUrl;
	/**
	 * @access public
	 * @var AdGroupCriterionBids
	 */
	public $bids;
	/**
	 * @access public
	 * @var Bid
	 */
	public $firstPageCpc;
	/**
	 * @access public
	 * @var QualityInfo
	 */
	public $qualityInfo;
	/**
	 * @access public
	 * @var Stats
	 */
	public $stats;

	public function __construct($userStatus = NULL, $systemServingStatus = NULL, $approvalStatus = NULL, $destinationUrl = NULL, $bids = NULL, $firstPageCpc = NULL, $qualityInfo = NULL, $stats = NULL, $adGroupId = NULL, $criterion = NULL, $AdGroupCriterionType = NULL) {
		if(get_parent_class('BiddableAdGroupCriterion')) parent::__construct();
		$this->userStatus = $userStatus;
		$this->systemServingStatus = $systemServingStatus;
		$this->approvalStatus = $approvalStatus;
		$this->destinationUrl = $destinationUrl;
		$this->bids = $bids;
		$this->firstPageCpc = $firstPageCpc;
		$this->qualityInfo = $qualityInfo;
		$this->stats = $stats;
		$this->adGroupId = $adGroupId;
		$this->criterion = $criterion;
		$this->AdGroupCriterionType = $AdGroupCriterionType;
	}
}}

if (!class_exists("AdGroupCriterionOperation")) {
/**
 * Operation (add, remove and set) on adgroup criteria.
 */
class AdGroupCriterionOperation extends Operation {
	/**
	 * @access public
	 * @var AdGroupCriterion
	 */
	public $operand;
	/**
	 * @access public
	 * @var ExemptionRequest[]
	 */
	public $exemptionRequests;

	public function __construct($operand = NULL, $exemptionRequests = NULL, $operator = NULL, $OperationType = NULL) {
		if(get_parent_class('AdGroupCriterionOperation')) parent::__construct();
		$this->operand = $operand;
		$this->exemptionRequests = $exemptionRequests;
		$this->operator = $operator;
		$this->OperationType = $OperationType;
	}
}}

if (!class_exists("AdGroupCriterionPage")) {
/**
 * Contains a subset of adgroup criteria resulting from a
 * {@link AdGroupCriterionService#get} call.
 */
class AdGroupCriterionPage extends Page {
	/**
	 * @access public
	 * @var AdGroupCriterion[]
	 */
	public $entries;

	public function __construct($entries = NULL, $totalNumEntries = NULL, $PageType = NULL) {
		if(get_parent_class('AdGroupCriterionPage')) parent::__construct();
		$this->entries = $entries;
		$this->totalNumEntries = $totalNumEntries;
		$this->PageType = $PageType;
	}
}}

if (!class_exists("AdGroupCriterionReturnValue")) {
/**
 * A container for return values from the AdGroupCriterionService.
 */
class AdGroupCriterionReturnValue extends ListReturnValue {
	/**
	 * @access public
	 * @var AdGroupCriterion[]
	 */
	public $value;

	public function __construct($value = NULL, $ListReturnValueType = NULL) {
		if(get_parent_class('AdGroupCriterionReturnValue')) parent::__construct();
		$this->value = $value;
		$this->ListReturnValueType = $ListReturnValueType;
	}
}}

if (!class_exists("AdGroupCriterionLimitExceeded")) {
/**
 * Signals that too many criteria were added to some ad group.
 */
class AdGroupCriterionLimitExceeded extends EntityCountLimitExceeded {
	/**
	 * @access public
	 * @var tnsAdGroupCriterionLimitExceededCriteriaLimitType
	 */
	public $limitType;

	public function __construct($limitType = NULL, $reason = NULL, $enclosingId = NULL, $limit = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AdGroupCriterionLimitExceeded')) parent::__construct();
		$this->limitType = $limitType;
		$this->reason = $reason;
		$this->enclosingId = $enclosingId;
		$this->limit = $limit;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("CriterionPolicyError")) {
/**
 * Contains the policy violations for a single BiddableAdGroupCriterion.
 */
class CriterionPolicyError extends PolicyViolationError {

	public function __construct($key = NULL, $externalPolicyName = NULL, $externalPolicyUrl = NULL, $externalPolicyDescription = NULL, $isExemptable = NULL, $violatingParts = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('CriterionPolicyError')) parent::__construct();
		$this->key = $key;
		$this->externalPolicyName = $externalPolicyName;
		$this->externalPolicyUrl = $externalPolicyUrl;
		$this->externalPolicyDescription = $externalPolicyDescription;
		$this->isExemptable = $isExemptable;
		$this->violatingParts = $violatingParts;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("DoubleValue")) {
/**
 * Number value type for constructing double valued ranges.
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

if (!class_exists("LongValue")) {
/**
 * Number value type for constructing long valued ranges.
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

if (!class_exists("AdGroupCriterionService")) {
/**
 * AdGroupCriterionService
 * @author WSDLInterpreter
 */
class AdGroupCriterionService extends AdWordsSoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	public static $classmap = array(
		"getResponse" => "AdGroupCriterionServiceGetResponse",
		"get" => "AdGroupCriterionServiceGet",
		"mutate" => "AdGroupCriterionServiceMutate",
		"mutateResponse" => "AdGroupCriterionServiceMutateResponse",
		"DateTime" => "AdWordsDateTime",
		"Target" => "AdWordsTarget",
		"SoapHeader" => "SoapRequestHeader",
		"AdGroupCriterionError" => "AdGroupCriterionError",
		"ApiError" => "ApiError",
		"AdGroupCriterionIdFilter" => "AdGroupCriterionIdFilter",
		"AdGroupCriterionLimitExceeded" => "AdGroupCriterionLimitExceeded",
		"EntityCountLimitExceeded" => "EntityCountLimitExceeded",
		"AuthenticationError" => "AuthenticationError",
		"AuthorizationError" => "AuthorizationError",
		"BiddingError" => "BiddingError",
		"ClientTermsError" => "ClientTermsError",
		"ConversionOptimizerAdGroupCriterionBids" => "ConversionOptimizerAdGroupCriterionBids",
		"AdGroupCriterionBids" => "AdGroupCriterionBids",
		"CriterionPolicyError" => "CriterionPolicyError",
		"PolicyViolationError" => "PolicyViolationError",
		"DatabaseError" => "DatabaseError",
		"DateError" => "DateError",
		"DateRange" => "DateRange",
		"DistinctError" => "DistinctError",
		"DoubleValue" => "DoubleValue",
		"NumberValue" => "NumberValue",
		"EntityAccessDenied" => "EntityAccessDenied",
		"EntityNotFound" => "EntityNotFound",
		"InternalApiError" => "InternalApiError",
		"Keyword" => "Keyword",
		"Criterion" => "Criterion",
		"LongValue" => "LongValue",
		"Money" => "Money",
		"ComparableValue" => "ComparableValue",
		"NegativeAdGroupCriterion" => "NegativeAdGroupCriterion",
		"AdGroupCriterion" => "AdGroupCriterion",
		"NewEntityCreationError" => "NewEntityCreationError",
		"NotEmptyError" => "NotEmptyError",
		"NotWhitelistedError" => "NotWhitelistedError",
		"NullError" => "NullError",
		"OperationAccessDenied" => "OperationAccessDenied",
		"Paging" => "Paging",
		"PagingError" => "PagingError",
		"Placement" => "Placement",
		"PolicyViolationError.Part" => "PolicyViolationErrorPart",
		"PolicyViolationKey" => "PolicyViolationKey",
		"QualityInfo" => "QualityInfo",
		"QuotaCheckError" => "QuotaCheckError",
		"QuotaExceededError" => "QuotaExceededError",
		"ReadOnlyError" => "ReadOnlyError",
		"RequiredError" => "RequiredError",
		"SizeLimitError" => "SizeLimitError",
		"SoapResponseHeader" => "SoapResponseHeader",
		"StatsQueryError" => "StatsQueryError",
		"StatsSelector" => "StatsSelector",
		"ExemptionRequest" => "ExemptionRequest",
		"Stats" => "Stats",
		"ApiException" => "ApiException",
		"ApplicationException" => "ApplicationException",
		"Bid" => "Bid",
		"BudgetOptimizerAdGroupCriterionBids" => "BudgetOptimizerAdGroupCriterionBids",
		"ManualCPMAdGroupCriterionBids" => "ManualCPMAdGroupCriterionBids",
		"PositionPreferenceAdGroupCriterionBids" => "PositionPreferenceAdGroupCriterionBids",
		"ManualCPCAdGroupCriterionBids" => "ManualCPCAdGroupCriterionBids",
		"BiddableAdGroupCriterion" => "BiddableAdGroupCriterion",
		"AdGroupCriterionOperation" => "AdGroupCriterionOperation",
		"Operation" => "Operation",
		"AdGroupCriterionPage" => "AdGroupCriterionPage",
		"Page" => "Page",
		"AdGroupCriterionReturnValue" => "AdGroupCriterionReturnValue",
		"ListReturnValue" => "ListReturnValue",
		"AdGroupCriterionSelector" => "AdGroupCriterionSelector",
		"AdGroupCriterionError.Reason" => "AdGroupCriterionErrorReason",
		"AdGroupCriterionLimitExceeded.CriteriaLimitType" => "AdGroupCriterionLimitExceededCriteriaLimitType",
		"ApprovalStatus" => "ApprovalStatus",
		"AuthenticationError.Reason" => "AuthenticationErrorReason",
		"AuthorizationError.Reason" => "AuthorizationErrorReason",
		"BidSource" => "BidSource",
		"BiddingError.Reason" => "BiddingErrorReason",
		"ClientTermsError.Reason" => "ClientTermsErrorReason",
		"CriterionUse" => "CriterionUse",
		"DatabaseError.Reason" => "DatabaseErrorReason",
		"DateError.Reason" => "DateErrorReason",
		"DistinctError.Reason" => "DistinctErrorReason",
		"EntityAccessDenied.Reason" => "EntityAccessDeniedReason",
		"EntityCountLimitExceeded.Reason" => "EntityCountLimitExceededReason",
		"EntityNotFound.Reason" => "EntityNotFoundReason",
		"InternalApiError.Reason" => "InternalApiErrorReason",
		"KeywordMatchType" => "KeywordMatchType",
		"NewEntityCreationError.Reason" => "NewEntityCreationErrorReason",
		"NotEmptyError.Reason" => "NotEmptyErrorReason",
		"NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
		"NullError.Reason" => "NullErrorReason",
		"OperationAccessDenied.Reason" => "OperationAccessDeniedReason",
		"Operator" => "Operator",
		"PagingError.Reason" => "PagingErrorReason",
		"QuotaCheckError.Reason" => "QuotaCheckErrorReason",
		"QuotaExceededError.Reason" => "QuotaExceededErrorReason",
		"ReadOnlyError.Reason" => "ReadOnlyErrorReason",
		"RequiredError.Reason" => "RequiredErrorReason",
		"SizeLimitError.Reason" => "SizeLimitErrorReason",
		"Stats.Network" => "StatsNetwork",
		"StatsQueryError.Reason" => "StatsQueryErrorReason",
		"SystemServingStatus" => "SystemServingStatus",
		"UserStatus" => "UserStatus",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl=null, $options, $user) {
		$options["classmap"] = AdGroupCriterionService::$classmap;
		parent::__construct($wsdl, $options, $user, 'AdGroupCriterionService');
	}

	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Gets adgroup criteria.
	 * 
	 * @param selector filters the adgroup criteria to be returned.
	 * @return a page (subset) view of the criteria selected
	 * @throws ApiException when there is at least one error with the request
	 */
	public function get($selector) {
		$arg = new AdGroupCriterionServiceGet($selector);
		$result = $this->__soapCall("get", array($arg));
		return $result->rval;
	}


	/**
	 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
	 * <span class="constraint DistinctIds">Elements in this field must have distinct IDs for following {@link Operator}s : SET, REMOVE.</span>
	 * <span class="constraint NotEmpty">This field must contain at least one element.</span>
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Adds, removes or updates adgroup criteria.
	 * 
	 * @param operations operations to do
	 * during checks on keywords to be added.
	 * @return added and updated adgroup criteria (without optional parts)
	 * @throws ApiException when there is at least one error with the request
	 */
	public function mutate($operations) {
		$arg = new AdGroupCriterionServiceMutate($operations);
		$result = $this->__soapCall("mutate", array($arg));
		return $result->rval;
	}


}}

?>