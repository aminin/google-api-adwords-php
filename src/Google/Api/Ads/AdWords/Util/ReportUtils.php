<?php
/**
 * A collection of utility methods for working with reports.
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
 * @package    GoogleApiAdsAdWords
 * @subpackage Util
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

require_once dirname(__FILE__) . '/../Lib/AdWordsUser.php';
require_once 'ReportDownloadException.php';

/**
 * A collection of utility methods for working with reports.
 */
class ReportUtils {
  private static $REPORT_ERROR_MESSAGE_REGEX = '/^!!!([^|]*)\|\|\|(.*)/';

  /**
   * The ReportUtils class is not meant to have any instances.
   * @access private
   */
  private function __construct() {}

  /**
   * Downloads a new instance of a report to a file.
   * @param float $reportDefintionId the id of the ReportDefinition to downlaod
   * @param string $path the path of the file to download the report to
   * @param AdWordsUser $user the user that created the ReportDefinition
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   */
  public static function DownloadReport($reportDefintionId, $path,
      AdWordsUser $user, $server = NULL) {
    $url = sprintf('%s/api/adwords/reportdownload?__rd=%s',
        isset($server) ? $server : $user->GetDefaultServer(),
        $reportDefintionId);

    // The authorization token and client identifier must be set as HTTP
    // headers.
    $headers = array();
    $headers[]= 'Authorization: GoogleLogin auth=' . $user->GetAuthToken();
    $clientId = $user->GetClientId();
    if (isset($clientId)) {
      if (strpos($clientId, '@') >= 0) {
        $headers[] = 'clientEmail: ' . $clientId;
      } else {
        $headers[] = 'clientCustomerId: ' . $clientId;
      }
    }

    $file = fopen($path, 'w');
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FILE, $file);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    if (defined('HTTP_PROXY_HOST') && HTTP_PROXY_HOST != '') {
      curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY_HOST);
    }
    if (defined('HTTP_PROXY_PORT') && HTTP_PROXY_PORT != '') {
      curl_setopt($ch, CURLOPT_PROXYPORT, HTTP_PROXY_PORT);
    }
    if (defined('HTTP_PROXY_USER') && defined('HTTP_PROXY_PASSWORD')
        && HTTP_PROXY_USER != '' && HTTP_PROXY_PASSWORD != '') {
      curl_setopt($ch, CURLOPT_PROXYUSERPWD, HTTP_PROXY_USER . ':'
          . HTTP_PROXY_PASSWORD);
    }
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    fclose($file);

    if ($httpCode != 200) {
      throw new ReportDownloadException($error, $httpCode);
    }

    // Check for error in downloaded file.
    $file = fopen($path, 'r');
    $line = fgets($file);
    fclose($file);
    $matches = array();
    if (preg_match(ReportUtils::$REPORT_ERROR_MESSAGE_REGEX, $line, $matches)) {
      throw new ReportDownloadException($matches[1]);
    }
  }
}
