<?php
/**
 * Exception class for an error that occurs while downloading a report.
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

/**
 * Exception class for an error that occurs while downloading a report.
 */
class ReportDownloadException extends Exception {
  /**
   * Constructor for ReportDownloadException.
   * @param string $error an optional error message
   * @param string $httpCode an optional HTTP status code of the response
   */
  public function __construct($error = NULL, $httpCode = NULL) {
    parent::__construct($error, $httpCode);
  }
}
