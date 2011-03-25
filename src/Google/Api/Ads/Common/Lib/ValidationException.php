<?php
/**
 * Exception class for any client library validation error.
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
 * @package    GoogleApiAdsCommon
 * @subpackage Lib
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

/**
 * Exception class for any client library validation error.
 * @package GoogleApiAdsCommon
 * @subpackage Lib
 */
class ValidationException extends Exception {
    /**
     * Constructor for ValidationException where the exception will appear
     * as "Validation failed for [$trigger] with value [$value]: $message".
     * @param string $trigger the trigger for the validation error
     * @param string $value the value for the trigger
     * @param string $message the message representing the error in validation
     */
    public function __construct($trigger, $value, $message) {
      $exceptionMessage = "Validation failed for [" . $trigger . "]  with value"
          . " [" . $value . "]: " . $message;
      parent::__construct($exceptionMessage);
    }
}
