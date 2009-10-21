<?php
/**
 * Contains all client objects for the AdGroupAdService service.
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

if (!class_exists("Dimensions")) {
/**
 * Represents a simple height-width dimension.
 */
class Dimensions {
	/**
	 * @access public
	 * @var integer
	 */
	public $width;
	/**
	 * @access public
	 * @var integer
	 */
	public $height;

	public function __construct($width = NULL, $height = NULL) {
		if(get_parent_class('Dimensions')) parent::__construct();
		$this->width = $width;
		$this->height = $height;
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

if (!class_exists("Media_MediaExtendedCapabilityType_Media_MediaExtendedCapabilityStateMapEntry")) {
/**
 * This represents an entry in a map with a key of type MediaExtendedCapabilityType
 * and value of type MediaExtendedCapabilityState.
 */
class Media_MediaExtendedCapabilityType_Media_MediaExtendedCapabilityStateMapEntry {
	/**
	 * @access public
	 * @var tnsMediaMediaExtendedCapabilityType
	 */
	public $key;
	/**
	 * @access public
	 * @var tnsMediaMediaExtendedCapabilityState
	 */
	public $value;

	public function __construct($key = NULL, $value = NULL) {
		if(get_parent_class('Media_MediaExtendedCapabilityType_Media_MediaExtendedCapabilityStateMapEntry')) parent::__construct();
		$this->key = $key;
		$this->value = $value;
	}
}}

if (!class_exists("Media_Size_DimensionsMapEntry")) {
/**
 * This represents an entry in a map with a key of type Size
 * and value of type Dimensions.
 */
class Media_Size_DimensionsMapEntry {
	/**
	 * @access public
	 * @var tnsMediaSize
	 */
	public $key;
	/**
	 * @access public
	 * @var Dimensions
	 */
	public $value;

	public function __construct($key = NULL, $value = NULL) {
		if(get_parent_class('Media_Size_DimensionsMapEntry')) parent::__construct();
		$this->key = $key;
		$this->value = $value;
	}
}}

if (!class_exists("Media_Size_StringMapEntry")) {
/**
 * This represents an entry in a map with a key of type Size
 * and value of type String.
 */
class Media_Size_StringMapEntry {
	/**
	 * @access public
	 * @var tnsMediaSize
	 */
	public $key;
	/**
	 * @access public
	 * @var string
	 */
	public $value;

	public function __construct($key = NULL, $value = NULL) {
		if(get_parent_class('Media_Size_StringMapEntry')) parent::__construct();
		$this->key = $key;
		$this->value = $value;
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

if (!class_exists("AdUnionId")) {
/**
 * Represents an id indicating a grouping of Ads under some heuristic.
 */
class AdUnionId {
	/**
	 * @access public
	 * @var integer
	 */
	public $id;
	/**
	 * @access public
	 * @var string
	 */
	public $AdUnionIdType;
	private $_parameterMap = array (
		"AdUnionId.Type" => "AdUnionIdType",
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

	public function __construct($id = NULL, $AdUnionIdType = NULL) {
		if(get_parent_class('AdUnionId')) parent::__construct();
		$this->id = $id;
		$this->AdUnionIdType = $AdUnionIdType;
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

if (!class_exists("Media")) {
/**
 * Represents any media (e.g., image).
 */
class Media {
	/**
	 * @access public
	 * @var integer
	 */
	public $mediaId;
	/**
	 * @access public
	 * @var tnsMediaMediaType
	 */
	public $mediaTypeDb;
	/**
	 * @access public
	 * @var integer
	 */
	public $referenceId;
	/**
	 * @access public
	 * @var Media_Size_DimensionsMapEntry[]
	 */
	public $dimensions;
	/**
	 * @access public
	 * @var Media_Size_StringMapEntry[]
	 */
	public $urls;
	/**
	 * @access public
	 * @var tnsMediaMimeType
	 */
	public $mimeType;
	/**
	 * @access public
	 * @var string
	 */
	public $sourceUrl;
	/**
	 * @access public
	 * @var tnsMediaMediaSubType
	 */
	public $mediaSubType;
	/**
	 * @access public
	 * @var string
	 */
	public $name;
	/**
	 * @access public
	 * @var integer
	 */
	public $fileSize;
	/**
	 * @access public
	 * @var Media_MediaExtendedCapabilityType_Media_MediaExtendedCapabilityStateMapEntry[]
	 */
	public $extendedCapabilities;
	/**
	 * @access public
	 * @var string
	 */
	public $creationTime;
	/**
	 * @access public
	 * @var string
	 */
	public $MediaType;
	private $_parameterMap = array (
		"Media.Type" => "MediaType",
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

	public function __construct($mediaId = NULL, $mediaTypeDb = NULL, $referenceId = NULL, $dimensions = NULL, $urls = NULL, $mimeType = NULL, $sourceUrl = NULL, $mediaSubType = NULL, $name = NULL, $fileSize = NULL, $extendedCapabilities = NULL, $creationTime = NULL, $MediaType = NULL) {
		if(get_parent_class('Media')) parent::__construct();
		$this->mediaId = $mediaId;
		$this->mediaTypeDb = $mediaTypeDb;
		$this->referenceId = $referenceId;
		$this->dimensions = $dimensions;
		$this->urls = $urls;
		$this->mimeType = $mimeType;
		$this->sourceUrl = $sourceUrl;
		$this->mediaSubType = $mediaSubType;
		$this->name = $name;
		$this->fileSize = $fileSize;
		$this->extendedCapabilities = $extendedCapabilities;
		$this->creationTime = $creationTime;
		$this->MediaType = $MediaType;
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

if (!class_exists("TemplateElementField")) {
/**
 * Represents a field in a template element.
 */
class TemplateElementField {
	/**
	 * @access public
	 * @var string
	 */
	public $name;
	/**
	 * @access public
	 * @var tnsTemplateElementFieldType
	 */
	public $type;
	/**
	 * @access public
	 * @var string
	 */
	public $fieldText;
	/**
	 * @access public
	 * @var Media
	 */
	public $fieldMedia;

	public function __construct($name = NULL, $type = NULL, $fieldText = NULL, $fieldMedia = NULL) {
		if(get_parent_class('TemplateElementField')) parent::__construct();
		$this->name = $name;
		$this->type = $type;
		$this->fieldText = $fieldText;
		$this->fieldMedia = $fieldMedia;
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

if (!class_exists("TemplateElement")) {
/**
 * Represents an element in a template. Each template element is composed
 * of a list of fields (actual value data).
 */
class TemplateElement {
	/**
	 * @access public
	 * @var string
	 */
	public $uniqueName;
	/**
	 * @access public
	 * @var TemplateElementField[]
	 */
	public $fields;

	public function __construct($uniqueName = NULL, $fields = NULL) {
		if(get_parent_class('TemplateElement')) parent::__construct();
		$this->uniqueName = $uniqueName;
		$this->fields = $fields;
	}
}}

if (!class_exists("AdGroupAdSelector")) {
/**
 * Specifies criteria for selecting a set of AdGroupAds for the account.
 */
class AdGroupAdSelector {
	/**
	 * @access public
	 * @var integer[]
	 */
	public $campaignIds;
	/**
	 * @access public
	 * @var integer[]
	 */
	public $adGroupIds;
	/**
	 * @access public
	 * @var integer[]
	 */
	public $adIds;
	/**
	 * @access public
	 * @var AdStatsSelector
	 */
	public $statsSelector;
	/**
	 * @access public
	 * @var Paging
	 */
	public $paging;

	public function __construct($campaignIds = NULL, $adGroupIds = NULL, $adIds = NULL, $statsSelector = NULL, $paging = NULL) {
		if(get_parent_class('AdGroupAdSelector')) parent::__construct();
		$this->campaignIds = $campaignIds;
		$this->adGroupIds = $adGroupIds;
		$this->adIds = $adIds;
		$this->statsSelector = $statsSelector;
		$this->paging = $paging;
	}
}}

if (!class_exists("Ad")) {
/**
 * <span class="constraint ReadOnly">This field is read only and should not be set for following {@link Operator}s : ADD.</span>
 */
class Ad {
	/**
	 * @access public
	 * @var integer
	 */
	public $id;
	/**
	 * @access public
	 * @var string
	 */
	public $url;
	/**
	 * @access public
	 * @var string
	 */
	public $displayUrl;
	/**
	 * @access public
	 * @var tnsAdApprovalStatus
	 */
	public $approvalStatus;
	/**
	 * @access public
	 * @var string[]
	 */
	public $disapprovalReasons;
	/**
	 * @access public
	 * @var string
	 */
	public $AdType;
	private $_parameterMap = array (
		"Ad.Type" => "AdType",
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

	public function __construct($id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('Ad')) parent::__construct();
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
	}
}}

if (!class_exists("AdGroupAd")) {
/**
 * Represents an ad in an ad group.
 */
class AdGroupAd {
	/**
	 * @access public
	 * @var integer
	 */
	public $adGroupId;
	/**
	 * @access public
	 * @var Ad
	 */
	public $ad;
	/**
	 * @access public
	 * @var tnsAdGroupAdStatus
	 */
	public $status;
	/**
	 * @access public
	 * @var AdStats
	 */
	public $stats;

	public function __construct($adGroupId = NULL, $ad = NULL, $status = NULL, $stats = NULL) {
		if(get_parent_class('AdGroupAd')) parent::__construct();
		$this->adGroupId = $adGroupId;
		$this->ad = $ad;
		$this->status = $status;
		$this->stats = $stats;
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

if (!class_exists("AdApprovalStatus")) {
/**
 * Approval status for Creatives.
 */
class AdApprovalStatus {

	public function __construct() {
		if(get_parent_class('AdApprovalStatus')) parent::__construct();
	}
}}

if (!class_exists("AdErrorReason")) {
/**
 * The reasons for the target error.
 */
class AdErrorReason {

	public function __construct() {
		if(get_parent_class('AdErrorReason')) parent::__construct();
	}
}}

if (!class_exists("AdGroupAdStatus")) {
/**
 * The current status of an Ad.
 */
class AdGroupAdStatus {

	public function __construct() {
		if(get_parent_class('AdGroupAdStatus')) parent::__construct();
	}
}}

if (!class_exists("AdGroupAdErrorReason")) {
/**
 * The reasons for the target error.
 */
class AdGroupAdErrorReason {

	public function __construct() {
		if(get_parent_class('AdGroupAdErrorReason')) parent::__construct();
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

if (!class_exists("DateErrorReason")) {
/**
 * The reasons for the target error.
 */
class DateErrorReason {

	public function __construct() {
		if(get_parent_class('DateErrorReason')) parent::__construct();
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

if (!class_exists("DeprecatedAdType")) {
/**
 * 
 */
class DeprecatedAdType {

	public function __construct() {
		if(get_parent_class('DeprecatedAdType')) parent::__construct();
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

if (!class_exists("GenderTargetGender")) {
/**
 * Gender segments.
 */
class GenderTargetGender {

	public function __construct() {
		if(get_parent_class('GenderTargetGender')) parent::__construct();
	}
}}

if (!class_exists("IdErrorReason")) {
/**
 * The reasons for the target error.
 */
class IdErrorReason {

	public function __construct() {
		if(get_parent_class('IdErrorReason')) parent::__construct();
	}
}}

if (!class_exists("ImageErrorReason")) {
/**
 * 
 */
class ImageErrorReason {

	public function __construct() {
		if(get_parent_class('ImageErrorReason')) parent::__construct();
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

if (!class_exists("MarkupLanguageType")) {
/**
 * Markup languages to use for mobile ads.
 */
class MarkupLanguageType {

	public function __construct() {
		if(get_parent_class('MarkupLanguageType')) parent::__construct();
	}
}}

if (!class_exists("MediaMediaExtendedCapabilityState")) {
/**
 * 
 */
class MediaMediaExtendedCapabilityState {

	public function __construct() {
		if(get_parent_class('MediaMediaExtendedCapabilityState')) parent::__construct();
	}
}}

if (!class_exists("MediaMediaExtendedCapabilityType")) {
/**
 * 
 */
class MediaMediaExtendedCapabilityType {

	public function __construct() {
		if(get_parent_class('MediaMediaExtendedCapabilityType')) parent::__construct();
	}
}}

if (!class_exists("MediaMediaSubType")) {
/**
 * 
 */
class MediaMediaSubType {

	public function __construct() {
		if(get_parent_class('MediaMediaSubType')) parent::__construct();
	}
}}

if (!class_exists("MediaMediaType")) {
/**
 * Media types
 */
class MediaMediaType {

	public function __construct() {
		if(get_parent_class('MediaMediaType')) parent::__construct();
	}
}}

if (!class_exists("MediaMimeType")) {
/**
 * Mime types
 */
class MediaMimeType {

	public function __construct() {
		if(get_parent_class('MediaMimeType')) parent::__construct();
	}
}}

if (!class_exists("MediaSize")) {
/**
 * Sizes for retrieving the original media
 */
class MediaSize {

	public function __construct() {
		if(get_parent_class('MediaSize')) parent::__construct();
	}
}}

if (!class_exists("MediaErrorReason")) {
/**
 * The reasons for the target error.
 */
class MediaErrorReason {

	public function __construct() {
		if(get_parent_class('MediaErrorReason')) parent::__construct();
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

if (!class_exists("TemplateElementFieldType")) {
/**
 * Field types
 */
class TemplateElementFieldType {

	public function __construct() {
		if(get_parent_class('TemplateElementFieldType')) parent::__construct();
	}
}}

if (!class_exists("AdGroupAdServiceGet")) {
/**
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Returns a list of AdGroupAds based on an AdGroupAdSelector.  The
 * selector defines a specific set of AdGroupAds that are to be returned - an
 * AdGroupAd must pass all the filters specified in the argument
 * AdGroupAdSelector.
 * @param selector the selector specifying the query
 * @return the AdGroupAds specified
 */
class AdGroupAdServiceGet {
	/**
	 * @access public
	 * @var AdGroupAdSelector
	 */
	public $selector;

	public function __construct($selector = NULL) {
		if(get_parent_class('AdGroupAdServiceGet')) parent::__construct();
		$this->selector = $selector;
	}
}}

if (!class_exists("AdGroupAdServiceGetResponse")) {
/**
 * 
 */
class AdGroupAdServiceGetResponse {
	/**
	 * @access public
	 * @var AdGroupAdPage
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('AdGroupAdServiceGetResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AdGroupAdServiceMutate")) {
/**
 * <span class="constraint ContentsNotNull">This field must not contain {@code null} elements.</span>
 * <span class="constraint DistinctIds">Elements in this field must have distinct IDs for following {@link Operator}s : SET, REMOVE.</span>
 * <span class="constraint NotEmpty">This field must contain at least one element.</span>
 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
 * 
 * 
 * 
 * Applies the list of mutate operations (ie. add, set, remove):
 * 
 * Add - Creates a set of AdGroupAd entities, each effectively linking an
 * AdGroup and an Ad.  The adGroupId of each AdGroupAd must be that of an
 * existing AdGroup.  The Ad may either specify an existing Ad in the account
 * library by id or be sufficiently specified for a new Ad to be created and
 * added to the account library.
 * 
 * Set - Updates a set of AdGroupAd entities. Except for status, AdGroupAd
 * fields are not mutable. Status updates are straightforward - the status of
 * the AdGroupAd is updated as specified.
 * 
 * Remove - Removes the link between the specified AdGroup and Ad.
 * 
 * @param operations the operations to apply
 * @return a list of AdGroupAds where each entry in the list is the result of
 * applying the operation in the input list with the same index. For an
 * add/set operation, the return AdGroupAd will be what is saved to the db.
 * In the case, of the remove operation, the return AdGroupAd will simply be
 * an AdGroupAd containing an Ad with the id set to the Ad being deleted from
 * the AdGroup.
 */
class AdGroupAdServiceMutate {
	/**
	 * @access public
	 * @var AdGroupAdOperation[]
	 */
	public $operations;

	public function __construct($operations = NULL) {
		if(get_parent_class('AdGroupAdServiceMutate')) parent::__construct();
		$this->operations = $operations;
	}
}}

if (!class_exists("AdGroupAdServiceMutateResponse")) {
/**
 * 
 */
class AdGroupAdServiceMutateResponse {
	/**
	 * @access public
	 * @var AdGroupAdReturnValue
	 */
	public $rval;

	public function __construct($rval = NULL) {
		if(get_parent_class('AdGroupAdServiceMutateResponse')) parent::__construct();
		$this->rval = $rval;
	}
}}

if (!class_exists("AdError")) {
/**
 * 
 */
class AdError extends ApiError {
	/**
	 * @access public
	 * @var tnsAdErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AdError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("AdExtensionOverrideStats")) {
/**
 * Represents stats specific to AdExtensionOverrides.
 */
class AdExtensionOverrideStats extends Stats {

	public function __construct($startDate = NULL, $endDate = NULL, $network = NULL, $clicks = NULL, $impressions = NULL, $cost = NULL, $averagePosition = NULL, $averageCpc = NULL, $averageCpm = NULL, $ctr = NULL, $conversions = NULL, $conversionRate = NULL, $costPerConversion = NULL, $conversionsManyPerClick = NULL, $conversionRateManyPerClick = NULL, $costPerConversionManyPerClick = NULL, $StatsType = NULL) {
		if(get_parent_class('AdExtensionOverrideStats')) parent::__construct();
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

if (!class_exists("AdGroupAdError")) {
/**
 * 
 */
class AdGroupAdError extends ApiError {
	/**
	 * @access public
	 * @var tnsAdGroupAdErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AdGroupAdError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
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

if (!class_exists("AdStats")) {
/**
 * Represents stats specific to Ads
 */
class AdStats extends Stats {
	/**
	 * @access public
	 * @var double
	 */
	public $percentServed;

	public function __construct($percentServed = NULL, $startDate = NULL, $endDate = NULL, $network = NULL, $clicks = NULL, $impressions = NULL, $cost = NULL, $averagePosition = NULL, $averageCpc = NULL, $averageCpm = NULL, $ctr = NULL, $conversions = NULL, $conversionRate = NULL, $costPerConversion = NULL, $conversionsManyPerClick = NULL, $conversionRateManyPerClick = NULL, $costPerConversionManyPerClick = NULL, $StatsType = NULL) {
		if(get_parent_class('AdStats')) parent::__construct();
		$this->percentServed = $percentServed;
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

if (!class_exists("AdStatsSelector")) {
/**
 * Ad specific stats selector.
 */
class AdStatsSelector extends StatsSelector {

	public function __construct($dateRange = NULL, $StatsSelectorType = NULL) {
		if(get_parent_class('AdStatsSelector')) parent::__construct();
		$this->dateRange = $dateRange;
		$this->StatsSelectorType = $StatsSelectorType;
	}
}}

if (!class_exists("Audio")) {
/**
 * Encapsulates an Audio media identified by a MediaId.
 */
class Audio extends Media {
	/**
	 * @access public
	 * @var integer
	 */
	public $durationMillis;
	/**
	 * @access public
	 * @var string
	 */
	public $streamingUrl;
	/**
	 * @access public
	 * @var boolean
	 */
	public $readyToPlayOnTheWeb;

	public function __construct($durationMillis = NULL, $streamingUrl = NULL, $readyToPlayOnTheWeb = NULL, $mediaId = NULL, $mediaTypeDb = NULL, $referenceId = NULL, $dimensions = NULL, $urls = NULL, $mimeType = NULL, $sourceUrl = NULL, $mediaSubType = NULL, $name = NULL, $fileSize = NULL, $extendedCapabilities = NULL, $creationTime = NULL, $MediaType = NULL) {
		if(get_parent_class('Audio')) parent::__construct();
		$this->durationMillis = $durationMillis;
		$this->streamingUrl = $streamingUrl;
		$this->readyToPlayOnTheWeb = $readyToPlayOnTheWeb;
		$this->mediaId = $mediaId;
		$this->mediaTypeDb = $mediaTypeDb;
		$this->referenceId = $referenceId;
		$this->dimensions = $dimensions;
		$this->urls = $urls;
		$this->mimeType = $mimeType;
		$this->sourceUrl = $sourceUrl;
		$this->mediaSubType = $mediaSubType;
		$this->name = $name;
		$this->fileSize = $fileSize;
		$this->extendedCapabilities = $extendedCapabilities;
		$this->creationTime = $creationTime;
		$this->MediaType = $MediaType;
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

if (!class_exists("DeprecatedAd")) {
/**
 * Represents a deprecated ad.
 * 
 * Deprecated ads can be deleted, but cannot be created.
 */
class DeprecatedAd extends Ad {
	/**
	 * @access public
	 * @var string
	 */
	public $name;
	/**
	 * @access public
	 * @var tnsDeprecatedAdType
	 */
	public $type;

	public function __construct($name = NULL, $type = NULL, $id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('DeprecatedAd')) parent::__construct();
		$this->name = $name;
		$this->type = $type;
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
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

if (!class_exists("IdError")) {
/**
 * Errors associated with the ids.
 */
class IdError extends ApiError {
	/**
	 * @access public
	 * @var tnsIdErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('IdError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("Image")) {
/**
 * 
 */
class Image extends Media {
	/**
	 * @access public
	 * @var base64Binary
	 */
	public $data;

	public function __construct($data = NULL, $mediaId = NULL, $mediaTypeDb = NULL, $referenceId = NULL, $dimensions = NULL, $urls = NULL, $mimeType = NULL, $sourceUrl = NULL, $mediaSubType = NULL, $name = NULL, $fileSize = NULL, $extendedCapabilities = NULL, $creationTime = NULL, $MediaType = NULL) {
		if(get_parent_class('Image')) parent::__construct();
		$this->data = $data;
		$this->mediaId = $mediaId;
		$this->mediaTypeDb = $mediaTypeDb;
		$this->referenceId = $referenceId;
		$this->dimensions = $dimensions;
		$this->urls = $urls;
		$this->mimeType = $mimeType;
		$this->sourceUrl = $sourceUrl;
		$this->mediaSubType = $mediaSubType;
		$this->name = $name;
		$this->fileSize = $fileSize;
		$this->extendedCapabilities = $extendedCapabilities;
		$this->creationTime = $creationTime;
		$this->MediaType = $MediaType;
	}
}}

if (!class_exists("ImageError")) {
/**
 * Error class for errors associated with parsing image data.
 */
class ImageError extends ApiError {
	/**
	 * @access public
	 * @var tnsImageErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('ImageError')) parent::__construct();
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

if (!class_exists("MediaError")) {
/**
 * 
 */
class MediaError extends ApiError {
	/**
	 * @access public
	 * @var tnsMediaErrorReason
	 */
	public $reason;

	public function __construct($reason = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('MediaError')) parent::__construct();
		$this->reason = $reason;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
	}
}}

if (!class_exists("MobileAd")) {
/**
 * Represents a MobileAd.
 * 
 * A mobile ad can contain a click-to-call phone number, a link to a website,
 * or both. You specify which features you want by setting certain fields, as
 * shown in the following table. For example, to create a click-to-call mobile
 * ad, set the fields in the <b>Click-to-call</b> column. A hyphen means don't
 * set the corresponding field.
 * </p>
 * <table summary="">
 * <tr> <th scope="col"> Click-to-call </th>
 * <th scope="col"> Website </th>
 * <th scope="col"> Both </th></tr>
 * <tr> <td> headline <br />
 * description <br />
 * mobileCarriers <br />
 * phoneNumber <br />
 * countryCode <br />
 * businessName <br />
 * - <br />
 * - <br />
 * - <br />
 * </td>
 * <td> headline <br />
 * description <br />
 * mobileCarriers <br />
 * - <br />
 * - <br />
 * - <br />
 * displayUrl <br />
 * destinationUrl <br />
 * markupLanguages <br />
 * </td>
 * <td> headline <br />
 * description <br />
 * mobileCarriers <br />
 * phoneNumber <br />
 * countryCode <br />
 * businessName <br />
 * displayUrl <br />
 * destinationUrl <br />
 * markupLanguages <br />
 * </td></tr>
 * </table>
 * 
 * <h2 class="normalsize">More Information</h2>
 * <ul class="nolist">
 * <li>
 * <a href="https://adwords.google.com/select/mobileguidelines.html"
 * target="_blank">Mobile Ad Editorial Guidelines</a></li>
 * <li>
 * <a href="http://adwords.google.com/support/bin/topic.py?topic=8500"
 * target="_blank">Mobile Ad FAQ</a></li>
 * </ul>
 */
class MobileAd extends Ad {
	/**
	 * @access public
	 * @var string
	 */
	public $headline;
	/**
	 * @access public
	 * @var string
	 */
	public $description;
	/**
	 * @access public
	 * @var tnsMarkupLanguageType[]
	 */
	public $markupLanguages;
	/**
	 * @access public
	 * @var string[]
	 */
	public $mobileCarriers;
	/**
	 * @access public
	 * @var string
	 */
	public $businessName;
	/**
	 * @access public
	 * @var string
	 */
	public $countryCode;
	/**
	 * @access public
	 * @var string
	 */
	public $phoneNumber;

	public function __construct($headline = NULL, $description = NULL, $markupLanguages = NULL, $mobileCarriers = NULL, $businessName = NULL, $countryCode = NULL, $phoneNumber = NULL, $id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('MobileAd')) parent::__construct();
		$this->headline = $headline;
		$this->description = $description;
		$this->markupLanguages = $markupLanguages;
		$this->mobileCarriers = $mobileCarriers;
		$this->businessName = $businessName;
		$this->countryCode = $countryCode;
		$this->phoneNumber = $phoneNumber;
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
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

if (!class_exists("TempAdUnionId")) {
/**
 * Represents the temporary id for an ad union id, which the user can specify.
 * The temporary id can be used to group ads together during ad creation.
 */
class TempAdUnionId extends AdUnionId {

	public function __construct($id = NULL, $AdUnionIdType = NULL) {
		if(get_parent_class('TempAdUnionId')) parent::__construct();
		$this->id = $id;
		$this->AdUnionIdType = $AdUnionIdType;
	}
}}

if (!class_exists("TextAd")) {
/**
 * Represents a TextAd.
 */
class TextAd extends Ad {
	/**
	 * @access public
	 * @var string
	 */
	public $headline;
	/**
	 * @access public
	 * @var string
	 */
	public $description1;
	/**
	 * @access public
	 * @var string
	 */
	public $description2;

	public function __construct($headline = NULL, $description1 = NULL, $description2 = NULL, $id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('TextAd')) parent::__construct();
		$this->headline = $headline;
		$this->description1 = $description1;
		$this->description2 = $description2;
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
	}
}}

if (!class_exists("Video")) {
/**
 * Encapsulates a Video media identified by a MediaId
 */
class Video extends Media {
	/**
	 * @access public
	 * @var integer
	 */
	public $durationMillis;
	/**
	 * @access public
	 * @var string
	 */
	public $streamingUrl;
	/**
	 * @access public
	 * @var boolean
	 */
	public $readyToPlayOnTheWeb;
	/**
	 * @access public
	 * @var string
	 */
	public $industryStandardCommercialIdentifier;
	/**
	 * @access public
	 * @var string
	 */
	public $advertisingId;

	public function __construct($durationMillis = NULL, $streamingUrl = NULL, $readyToPlayOnTheWeb = NULL, $industryStandardCommercialIdentifier = NULL, $advertisingId = NULL, $mediaId = NULL, $mediaTypeDb = NULL, $referenceId = NULL, $dimensions = NULL, $urls = NULL, $mimeType = NULL, $sourceUrl = NULL, $mediaSubType = NULL, $name = NULL, $fileSize = NULL, $extendedCapabilities = NULL, $creationTime = NULL, $MediaType = NULL) {
		if(get_parent_class('Video')) parent::__construct();
		$this->durationMillis = $durationMillis;
		$this->streamingUrl = $streamingUrl;
		$this->readyToPlayOnTheWeb = $readyToPlayOnTheWeb;
		$this->industryStandardCommercialIdentifier = $industryStandardCommercialIdentifier;
		$this->advertisingId = $advertisingId;
		$this->mediaId = $mediaId;
		$this->mediaTypeDb = $mediaTypeDb;
		$this->referenceId = $referenceId;
		$this->dimensions = $dimensions;
		$this->urls = $urls;
		$this->mimeType = $mimeType;
		$this->sourceUrl = $sourceUrl;
		$this->mediaSubType = $mediaSubType;
		$this->name = $name;
		$this->fileSize = $fileSize;
		$this->extendedCapabilities = $extendedCapabilities;
		$this->creationTime = $creationTime;
		$this->MediaType = $MediaType;
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

if (!class_exists("MobileImageAd")) {
/**
 * Data associated with a mobile image ad.
 * 
 * <h2 class="normalsize">More Information</h2>
 * <ul class="nolist">
 * <li>
 * <a href="https://adwords.google.com/select/mobileguidelines.html"
 * target="_blank">Mobile Ad Editorial Guidelines</a></li>
 * <li>
 * <a href="http://adwords.google.com/support/bin/topic.py?topic=8500"
 * target="_blank">Mobile Ad FAQ</a></li>
 * </ul>
 */
class MobileImageAd extends Ad {
	/**
	 * @access public
	 * @var tnsMarkupLanguageType[]
	 */
	public $markupLanguages;
	/**
	 * @access public
	 * @var string[]
	 */
	public $mobileCarriers;
	/**
	 * @access public
	 * @var Image
	 */
	public $image;

	public function __construct($markupLanguages = NULL, $mobileCarriers = NULL, $image = NULL, $id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('MobileImageAd')) parent::__construct();
		$this->markupLanguages = $markupLanguages;
		$this->mobileCarriers = $mobileCarriers;
		$this->image = $image;
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
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

if (!class_exists("ImageAd")) {
/**
 * Represents an ImageAd.
 */
class ImageAd extends Ad {
	/**
	 * @access public
	 * @var Image
	 */
	public $image;
	/**
	 * @access public
	 * @var string
	 */
	public $name;

	public function __construct($image = NULL, $name = NULL, $id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('ImageAd')) parent::__construct();
		$this->image = $image;
		$this->name = $name;
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
	}
}}

if (!class_exists("LocalBusinessAd")) {
/**
 * Represents Legacy Local Business Ad
 * 
 * Legacy LBAs can be deleted or paused/unpaused, but are not editable.
 */
class LocalBusinessAd extends Ad {
	/**
	 * @access public
	 * @var string
	 */
	public $fullBusinessName;
	/**
	 * @access public
	 * @var string
	 */
	public $phoneNumber;
	/**
	 * @access public
	 * @var string
	 */
	public $streetAddress;
	/**
	 * @access public
	 * @var string
	 */
	public $city;
	/**
	 * @access public
	 * @var string
	 */
	public $region;
	/**
	 * @access public
	 * @var string
	 */
	public $regionCode;
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
	 * @access public
	 * @var string
	 */
	public $businessName;
	/**
	 * @access public
	 * @var string
	 */
	public $description1;
	/**
	 * @access public
	 * @var string
	 */
	public $description2;
	/**
	 * @access public
	 * @var ProximityTarget
	 */
	public $target;
	/**
	 * @access public
	 * @var Image
	 */
	public $businessImage;
	/**
	 * @access public
	 * @var Image
	 */
	public $icon;

	public function __construct($fullBusinessName = NULL, $phoneNumber = NULL, $streetAddress = NULL, $city = NULL, $region = NULL, $regionCode = NULL, $postalCode = NULL, $countryCode = NULL, $businessName = NULL, $description1 = NULL, $description2 = NULL, $target = NULL, $businessImage = NULL, $icon = NULL, $id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('LocalBusinessAd')) parent::__construct();
		$this->fullBusinessName = $fullBusinessName;
		$this->phoneNumber = $phoneNumber;
		$this->streetAddress = $streetAddress;
		$this->city = $city;
		$this->region = $region;
		$this->regionCode = $regionCode;
		$this->postalCode = $postalCode;
		$this->countryCode = $countryCode;
		$this->businessName = $businessName;
		$this->description1 = $description1;
		$this->description2 = $description2;
		$this->target = $target;
		$this->businessImage = $businessImage;
		$this->icon = $icon;
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
	}
}}

if (!class_exists("TemplateAd")) {
/**
 * Represents a TemplateAd. A template ad is composed of a template (specified
 * by it's template id) along with all the elements to populate the
 * template's fields.
 */
class TemplateAd extends Ad {
	/**
	 * @access public
	 * @var integer
	 */
	public $templateId;
	/**
	 * @access public
	 * @var AdUnionId
	 */
	public $adUnionId;
	/**
	 * @access public
	 * @var TemplateElement[]
	 */
	public $templateElements;
	/**
	 * @access public
	 * @var Dimensions
	 */
	public $dimensions;
	/**
	 * @access public
	 * @var string
	 */
	public $name;
	/**
	 * @access public
	 * @var integer
	 */
	public $duration;

	public function __construct($templateId = NULL, $adUnionId = NULL, $templateElements = NULL, $dimensions = NULL, $name = NULL, $duration = NULL, $id = NULL, $url = NULL, $displayUrl = NULL, $approvalStatus = NULL, $disapprovalReasons = NULL, $AdType = NULL) {
		if(get_parent_class('TemplateAd')) parent::__construct();
		$this->templateId = $templateId;
		$this->adUnionId = $adUnionId;
		$this->templateElements = $templateElements;
		$this->dimensions = $dimensions;
		$this->name = $name;
		$this->duration = $duration;
		$this->id = $id;
		$this->url = $url;
		$this->displayUrl = $displayUrl;
		$this->approvalStatus = $approvalStatus;
		$this->disapprovalReasons = $disapprovalReasons;
		$this->AdType = $AdType;
	}
}}

if (!class_exists("AdGroupAdOperation")) {
/**
 * AdGroupAd service operations.
 */
class AdGroupAdOperation extends Operation {
	/**
	 * @access public
	 * @var AdGroupAd
	 */
	public $operand;
	/**
	 * @access public
	 * @var ExemptionRequest[]
	 */
	public $exemptionRequests;

	public function __construct($operand = NULL, $exemptionRequests = NULL, $operator = NULL, $OperationType = NULL) {
		if(get_parent_class('AdGroupAdOperation')) parent::__construct();
		$this->operand = $operand;
		$this->exemptionRequests = $exemptionRequests;
		$this->operator = $operator;
		$this->OperationType = $OperationType;
	}
}}

if (!class_exists("AdGroupAdPage")) {
/**
 * Represents a page of {@link AdGroupAd}s resulting from the query done by
 * {@link AdGroupAdService}.
 */
class AdGroupAdPage extends Page {
	/**
	 * @access public
	 * @var AdGroupAd[]
	 */
	public $entries;

	public function __construct($entries = NULL, $totalNumEntries = NULL, $PageType = NULL) {
		if(get_parent_class('AdGroupAdPage')) parent::__construct();
		$this->entries = $entries;
		$this->totalNumEntries = $totalNumEntries;
		$this->PageType = $PageType;
	}
}}

if (!class_exists("AdGroupAdReturnValue")) {
/**
 * A container for return values from the AdGroupAdService.
 */
class AdGroupAdReturnValue extends ListReturnValue {
	/**
	 * @access public
	 * @var AdGroupAd[]
	 */
	public $value;

	public function __construct($value = NULL, $ListReturnValueType = NULL) {
		if(get_parent_class('AdGroupAdReturnValue')) parent::__construct();
		$this->value = $value;
		$this->ListReturnValueType = $ListReturnValueType;
	}
}}

if (!class_exists("AdGroupAdCountLimitExceeded")) {
/**
 * Indicates too many ads were added/enabled under the specified adgroup.
 */
class AdGroupAdCountLimitExceeded extends EntityCountLimitExceeded {

	public function __construct($reason = NULL, $enclosingId = NULL, $limit = NULL, $fieldPath = NULL, $trigger = NULL, $ApiErrorType = NULL) {
		if(get_parent_class('AdGroupAdCountLimitExceeded')) parent::__construct();
		$this->reason = $reason;
		$this->enclosingId = $enclosingId;
		$this->limit = $limit;
		$this->fieldPath = $fieldPath;
		$this->trigger = $trigger;
		$this->ApiErrorType = $ApiErrorType;
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

if (!class_exists("AdGroupAdService")) {
/**
 * AdGroupAdService
 * @author WSDLInterpreter
 */
class AdGroupAdService extends AdWordsSoapClient {
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	public static $classmap = array(
		"getResponse" => "AdGroupAdServiceGetResponse",
		"get" => "AdGroupAdServiceGet",
		"mutate" => "AdGroupAdServiceMutate",
		"mutateResponse" => "AdGroupAdServiceMutateResponse",
		"DateTime" => "AdWordsDateTime",
		"Target" => "AdWordsTarget",
		"SoapHeader" => "SoapRequestHeader",
		"AdError" => "AdError",
		"ApiError" => "ApiError",
		"AdExtensionOverrideStats" => "AdExtensionOverrideStats",
		"Stats" => "Stats",
		"AdGroupAdCountLimitExceeded" => "AdGroupAdCountLimitExceeded",
		"EntityCountLimitExceeded" => "EntityCountLimitExceeded",
		"AdGroupAdError" => "AdGroupAdError",
		"AdScheduleTarget" => "AdScheduleTarget",
		"AdStats" => "AdStats",
		"AdStatsSelector" => "AdStatsSelector",
		"StatsSelector" => "StatsSelector",
		"Address" => "Address",
		"AgeTarget" => "AgeTarget",
		"DemographicTarget" => "DemographicTarget",
		"Audio" => "Audio",
		"Media" => "Media",
		"AuthenticationError" => "AuthenticationError",
		"AuthorizationError" => "AuthorizationError",
		"CityTarget" => "CityTarget",
		"GeoTarget" => "GeoTarget",
		"ClientTermsError" => "ClientTermsError",
		"CountryTarget" => "CountryTarget",
		"DatabaseError" => "DatabaseError",
		"DateError" => "DateError",
		"DateRange" => "DateRange",
		"DeprecatedAd" => "DeprecatedAd",
		"Ad" => "Ad",
		"Dimensions" => "Dimensions",
		"DistinctError" => "DistinctError",
		"DoubleValue" => "DoubleValue",
		"NumberValue" => "NumberValue",
		"EntityNotFound" => "EntityNotFound",
		"GenderTarget" => "GenderTarget",
		"GeoPoint" => "GeoPoint",
		"IdError" => "IdError",
		"Image" => "Image",
		"ImageError" => "ImageError",
		"InternalApiError" => "InternalApiError",
		"LanguageTarget" => "LanguageTarget",
		"LongValue" => "LongValue",
		"MediaError" => "MediaError",
		"Media_MediaExtendedCapabilityType_Media_MediaExtendedCapabilityStateMapEntry" => "Media_MediaExtendedCapabilityType_Media_MediaExtendedCapabilityStateMapEntry",
		"Media_Size_DimensionsMapEntry" => "Media_Size_DimensionsMapEntry",
		"Media_Size_StringMapEntry" => "Media_Size_StringMapEntry",
		"MetroTarget" => "MetroTarget",
		"MobileAd" => "MobileAd",
		"Money" => "Money",
		"ComparableValue" => "ComparableValue",
		"NetworkTarget" => "NetworkTarget",
		"NewEntityCreationError" => "NewEntityCreationError",
		"NotEmptyError" => "NotEmptyError",
		"NotWhitelistedError" => "NotWhitelistedError",
		"NullError" => "NullError",
		"OperationAccessDenied" => "OperationAccessDenied",
		"Paging" => "Paging",
		"PagingError" => "PagingError",
		"PlatformTarget" => "PlatformTarget",
		"PolicyViolationError.Part" => "PolicyViolationErrorPart",
		"PolicyViolationKey" => "PolicyViolationKey",
		"PolygonTarget" => "PolygonTarget",
		"ProvinceTarget" => "ProvinceTarget",
		"ProximityTarget" => "ProximityTarget",
		"QuotaCheckError" => "QuotaCheckError",
		"QuotaExceededError" => "QuotaExceededError",
		"ReadOnlyError" => "ReadOnlyError",
		"RequiredError" => "RequiredError",
		"SizeLimitError" => "SizeLimitError",
		"SoapResponseHeader" => "SoapResponseHeader",
		"StatsQueryError" => "StatsQueryError",
		"TempAdUnionId" => "TempAdUnionId",
		"AdUnionId" => "AdUnionId",
		"TextAd" => "TextAd",
		"Video" => "Video",
		"ExemptionRequest" => "ExemptionRequest",
		"MobileImageAd" => "MobileImageAd",
		"PolicyViolationError" => "PolicyViolationError",
		"TemplateElementField" => "TemplateElementField",
		"ApiException" => "ApiException",
		"ApplicationException" => "ApplicationException",
		"ImageAd" => "ImageAd",
		"LocalBusinessAd" => "LocalBusinessAd",
		"TemplateElement" => "TemplateElement",
		"AdGroupAdSelector" => "AdGroupAdSelector",
		"TemplateAd" => "TemplateAd",
		"AdGroupAd" => "AdGroupAd",
		"AdGroupAdOperation" => "AdGroupAdOperation",
		"Operation" => "Operation",
		"AdGroupAdPage" => "AdGroupAdPage",
		"Page" => "Page",
		"AdGroupAdReturnValue" => "AdGroupAdReturnValue",
		"ListReturnValue" => "ListReturnValue",
		"Ad.ApprovalStatus" => "AdApprovalStatus",
		"AdError.Reason" => "AdErrorReason",
		"AdGroupAd.Status" => "AdGroupAdStatus",
		"AdGroupAdError.Reason" => "AdGroupAdErrorReason",
		"AgeTarget.Age" => "AgeTargetAge",
		"AuthenticationError.Reason" => "AuthenticationErrorReason",
		"AuthorizationError.Reason" => "AuthorizationErrorReason",
		"ClientTermsError.Reason" => "ClientTermsErrorReason",
		"DatabaseError.Reason" => "DatabaseErrorReason",
		"DateError.Reason" => "DateErrorReason",
		"DayOfWeek" => "DayOfWeek",
		"DeprecatedAd.Type" => "DeprecatedAdType",
		"DistinctError.Reason" => "DistinctErrorReason",
		"EntityCountLimitExceeded.Reason" => "EntityCountLimitExceededReason",
		"EntityNotFound.Reason" => "EntityNotFoundReason",
		"GenderTarget.Gender" => "GenderTargetGender",
		"IdError.Reason" => "IdErrorReason",
		"ImageError.Reason" => "ImageErrorReason",
		"InternalApiError.Reason" => "InternalApiErrorReason",
		"MarkupLanguageType" => "MarkupLanguageType",
		"Media.MediaExtendedCapabilityState" => "MediaMediaExtendedCapabilityState",
		"Media.MediaExtendedCapabilityType" => "MediaMediaExtendedCapabilityType",
		"Media.MediaSubType" => "MediaMediaSubType",
		"Media.MediaType" => "MediaMediaType",
		"Media.MimeType" => "MediaMimeType",
		"Media.Size" => "MediaSize",
		"MediaError.Reason" => "MediaErrorReason",
		"MinuteOfHour" => "MinuteOfHour",
		"NetworkCoverageType" => "NetworkCoverageType",
		"NewEntityCreationError.Reason" => "NewEntityCreationErrorReason",
		"NotEmptyError.Reason" => "NotEmptyErrorReason",
		"NotWhitelistedError.Reason" => "NotWhitelistedErrorReason",
		"NullError.Reason" => "NullErrorReason",
		"OperationAccessDenied.Reason" => "OperationAccessDeniedReason",
		"Operator" => "Operator",
		"PagingError.Reason" => "PagingErrorReason",
		"PlatformType" => "PlatformType",
		"ProximityTarget.DistanceUnits" => "ProximityTargetDistanceUnits",
		"QuotaCheckError.Reason" => "QuotaCheckErrorReason",
		"QuotaExceededError.Reason" => "QuotaExceededErrorReason",
		"ReadOnlyError.Reason" => "ReadOnlyErrorReason",
		"RequiredError.Reason" => "RequiredErrorReason",
		"SizeLimitError.Reason" => "SizeLimitErrorReason",
		"Stats.Network" => "StatsNetwork",
		"StatsQueryError.Reason" => "StatsQueryErrorReason",
		"TemplateElementField.Type" => "TemplateElementFieldType",
	);

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl=null, $options, $user) {
		$options["classmap"] = AdGroupAdService::$classmap;
		parent::__construct($wsdl, $options, $user, 'AdGroupAdService');
	}

	/**
	 * <span class="constraint Required">This field is required and should not be {@code null}.</span>
	 * 
	 * 
	 * 
	 * Returns a list of AdGroupAds based on an AdGroupAdSelector.  The
	 * selector defines a specific set of AdGroupAds that are to be returned - an
	 * AdGroupAd must pass all the filters specified in the argument
	 * AdGroupAdSelector.
	 * @param selector the selector specifying the query
	 * @return the AdGroupAds specified
	 */
	public function get($selector) {
		$arg = new AdGroupAdServiceGet($selector);
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
	 * Applies the list of mutate operations (ie. add, set, remove):
	 * 
	 * Add - Creates a set of AdGroupAd entities, each effectively linking an
	 * AdGroup and an Ad.  The adGroupId of each AdGroupAd must be that of an
	 * existing AdGroup.  The Ad may either specify an existing Ad in the account
	 * library by id or be sufficiently specified for a new Ad to be created and
	 * added to the account library.
	 * 
	 * Set - Updates a set of AdGroupAd entities. Except for status, AdGroupAd
	 * fields are not mutable. Status updates are straightforward - the status of
	 * the AdGroupAd is updated as specified.
	 * 
	 * Remove - Removes the link between the specified AdGroup and Ad.
	 * 
	 * @param operations the operations to apply
	 * @return a list of AdGroupAds where each entry in the list is the result of
	 * applying the operation in the input list with the same index. For an
	 * add/set operation, the return AdGroupAd will be what is saved to the db.
	 * In the case, of the remove operation, the return AdGroupAd will simply be
	 * an AdGroupAd containing an Ad with the id set to the Ad being deleted from
	 * the AdGroup.
	 */
	public function mutate($operations) {
		$arg = new AdGroupAdServiceMutate($operations);
		$result = $this->__soapCall("mutate", array($arg));
		return $result->rval;
	}


}}

?>