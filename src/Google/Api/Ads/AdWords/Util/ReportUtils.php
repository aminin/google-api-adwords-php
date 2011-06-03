<?php
/**
 * A collection of utility methods for working with reports.
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
 * @subpackage Util
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

/** Required classes. **/
require_once dirname(__FILE__) . '/../Lib/AdWordsUser.php';
require_once dirname(__FILE__) . '/../../Common/Util/CurlUtils.php';
require_once dirname(__FILE__) . '/../../Common/Util/XmlUtils.php';

/**
 * A collection of utility methods for working with reports.
 * @package GoogleApiAdsAdWords
 * @subpackage Util
 */
class ReportUtils {
  /**
   * Regular expression used to detect errors messages in a response.
   * @access private
   */
  private static $ERROR_MESSAGE_REGEX = '/^!!![^|]*\|\|\|([^|]*)\|\|\|([^?]*)\?\?\?/';

  /**
   * The format of the report download URL, for use with sprintf.
   * @access private
   */
  private static $DOWNLOAD_URL_FORMAT = '%s/api/adwords/reportdownload?%s';

  /**
   * The length of the snippet to read from the request to determine if there
   * was an error.
   * @access private
   */
  private static $SNIPPET_LENGTH = 1024;

  /**
   * The HTTP headers from the last report download response.
   * @access private
   */
  private static $LAST_RESPONSE_HEADERS = NULL;

  /**
   * The ReportUtils class is not meant to have any instances.
   * @access private
   */
  private function __construct() {}

  /**
   * Downloads a new instance of an existing report definition. If the path
   * parameter is specified it will be downloaded to the file at that path,
   * otherwise it will be downloaded to memory and be returned as a string.
   * @param float $reportDefintionId the id of the ReportDefinition to download
   * @param string $path an optional path of the file to download the report to
   * @param AdWordsUser $user the user that created the ReportDefinition
   * @param string $server the server to make the request to. If
   *     <var>NULL</var>, then the default server will be used
   * @param boolean $returnMoneyInMicros if the money values in the report
   *     should be returned in micros
   * @return mixed if path isn't specified the contents of the report,
   *     otherwise the size in bytes of the downloaded report
   */
  public static function DownloadReport($reportDefintionId, $path = NULL,
      AdWordsUser $user, $server = NULL, $returnMoneyInMicros = NULL) {
    $options = array('returnMoneyInMicros' => $returnMoneyInMicros,
        'server' => $server);
    $extraHeaders = ReportUtils::GetExtraHeaders($options);
    $params = array('__rd' => $reportDefintionId);
    $url = ReportUtils::GetUrl($user, $params, $options);
    $result =
        ReportUtils::DownloadReportFromUrl($url, $user, $path, $extraHeaders);
    if (isset($result->details->queryToken)) {
      throw new ReportDownloadException(
          'Asyncronous report found, use RunAsyncReport() instead.',
          $result->code);
    }
    return isset($result->data) ? $result->data : $result->downloadSize;
  }

  /**
   * Runs a report using the report definition ID given. The query
   * token should be 'new' for the first request, and then use the value
   * returned in the result for the following requests.
   * @param float $reportDefintionId the id of the ReportDefinition to download
   * @param string $queryToken the query token, either 'new' or the value
   *     returned in the previous response
   * @param AdWordsUser $user the user that created the ReportDefinition
   * @param array $options the option to use when downloading the report:
   *     {boolean} returnMoneyInMicros: if the money values in the report
   *         should be returned in micros
   *     {string} server: the server to make the request to. If <var>NULL</var>,
   *         then the default server will be used
   * @return ReportDownloadResult the result of the download attempt
   */
  public static function RunAsyncReport($reportDefintionId, $queryToken,
      AdWordsUser $user, $options = NULL) {
    $extraHeaders = ReportUtils::GetExtraHeaders($options);
    $params = array('__rd' => $reportDefintionId, 'qt' => $queryToken);
    $url = ReportUtils::GetUrl($user, $params, $options);
    $result =
        ReportUtils::DownloadReportFromUrl($url, $user, NULL, $extraHeaders);
    if (!$result->details->queryToken) {
        throw new ReportDownloadException(
            'Syncronous report found, use DownloadReport() instead.',
            $result->code);
    }
    return $result;
  }

  /**
   * Downloads a report using the URL provided.  For ansyncronous reports use
   * the location returned along with a SUCCESS response.
   * @param string $url the URL to make the request to
   * @param AdWordsUser $user the AdWords user to use
   * @param string $path the optional path to download the report to
   * @param array $extraHeaders a hash of HTTP header names to values
   * @return ReportDownloadResult the result of the request
   */
  public static function DownloadReportFromUrl($url, $user, $path = NULL,
      $extraHeaders = NULL) {
    ReportUtils::$LAST_RESPONSE_HEADERS = NULL;

    $ch = CurlUtils::CreateSession($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_HEADERFUNCTION,
        'ReportUtils::StoreResponseHeader');

    $headers = ReportUtils::GetHeaders($user, $extraHeaders);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if (isset($path)) {
      $file = fopen($path, 'w');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
      curl_setopt($ch, CURLOPT_FILE, $file);
    }

    $response = curl_exec($ch);

    $result = new ReportDownloadResult();
    $result->code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $result->downloadSize = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);

    curl_close($ch);
    if (isset($file)) {
      fclose($file);
    }

    // Get the beginning of the response.
    if (isset($path)) {
      $file = fopen($path, 'r');
      $snippet = fread($file, ReportUtils::$SNIPPET_LENGTH);
      fclose($file);
    } else {
      $snippet = substr($response, 0, $SNIPPET_LENGTH);
    }

    // Determine if an error occured.
    $matches = array();
    if (preg_match(ReportUtils::$ERROR_MESSAGE_REGEX, $snippet, $matches)) {
      throw new ReportDownloadException($matches[2], $result->code);
    }

    // Set the response data.
    if (!isset($path)) {
      $result->data = $response;
    }

    // Set the response details.
    try {
      $document = XmlUtils::GetDomFromXml($snippet);
      $result->details = XmlUtils::ConvertDocumentToObject($document);
      if (isset($result->details->failures)
          && !is_array($result->details->failures->account)) {
        $result->details->failures->account =
            array($result->details->failures->account);
      }
    } catch (DOMException $e) {
      // The body is not an XML document, so don't set the details.
    }

    // Set the location.
    if (isset(ReportUtils::$LAST_RESPONSE_HEADERS['Location'])) {
      $result->location = ReportUtils::$LAST_RESPONSE_HEADERS['Location'];
    }

    return $result;
  }

  /**
   * Generates an array of extra headers to pass with the request.
   * @param array $options the options for the download
   * @return array the extra headers to set on the request
   */
  private static function GetExtraHeaders($options) {
    $extraHeaders = array();
    if (isset($options['returnMoneyInMicros'])) {
      $extraHeaders['returnMoneyInMicros'] =
          $options['returnMoneyInMicros'] ? 'true' : 'false';
    }
    return $extraHeaders;
  }

  /**
   * Generates the URL to use for the download request.
   * @param AdWordsUser $user the AdWordsUser to make the request for
   * @param array $params the query parameters to use for the request
   * @param array $options the options configured for the download
   * @return string the download URL
   */
  private static function GetUrl($user, $params, $options) {
    $server = !empty($options['server']) ? $options['server'] :
        $user->GetDefaultServer();
    if (isset($server) && strpos($server, 'http') !== 0) {
      throw new ReportDownloadException('Invalid server: ' . $server);
    }
    return sprintf(ReportUtils::$DOWNLOAD_URL_FORMAT, $server,
        http_build_query($params, NULL, '&'));
  }

  /**
   * Gets the HTTP headers for the report download request.
   * @param AdWordsUser $user the AdWordsUser to get credentials from
   * @param array $extraHeaders a hash of HTTP header names to values
   * @return array and array of strings, which are header names and values
   */
  private static function GetHeaders($user, $extraHeaders) {
    $headers = array();
    $headers[]= 'Authorization: GoogleLogin auth=' . $user->GetAuthToken();
    $clientId = $user->GetClientId();
    if (isset($clientId)) {
      if (strpos($clientId, '@') !== FALSE) {
        $headers[] = 'clientEmail: ' . $clientId;
      } else {
        $headers[] = 'clientCustomerId: ' . $clientId;
      }
    }
    if (isset($extraHeaders)) {
      foreach ($extraHeaders as $key => $value) {
        $headers[] = sprintf('%s: %s', $key, $value);
      }
    }
    return $headers;
  }

  /**
   * A callback function for cURL's CURLOPT_HEADERFUNCTION option, which records
   * the response headers and stores them in a static variable for later access.
   * @param resource $ch the cURL handler
   * @param string $header the header to store
   * @return int the length of the header data that was processed
   */
  public static function StoreResponseHeader($ch, $header) {
    if (!isset(ReportUtils::$LAST_RESPONSE_HEADERS)) {
      ReportUtils::$LAST_RESPONSE_HEADERS = array();
    }
    if (strpos($header, ':') !== FALSE) {
      list($name, $value) = explode(': ', $header);
      ReportUtils::$LAST_RESPONSE_HEADERS[$name] = $value;
    }
    return strlen($header);
  }
}

/**
 * Exception class for an error that occurs while downloading a report.
 * @package GoogleApiAdsAdWords
 * @subpackage Util
 */
class ReportDownloadException extends Exception {
  /**
   * Constructor for ReportDownloadException.
   * @param string $error an optional error message
   * @param string $httpCode an optional HTTP status code of the response
   */
  public function __construct($error = NULL, $httpCode = NULL) {
    if (empty($error)) {
      $error = 'Report download failed with status code: ' . $httpCode;
    }
    parent::__construct($error, $httpCode);
  }
}

/**
 * A class that holds the result of a report download.
 * @package GoogleApiAdsAdWords
 * @subpackage Util
 */
class ReportDownloadResult {
  /**
   * @access public
   * @var string the HTTP code returned
   */
  public $code = NULL;

  /**
   * @access public
   * @var object an object representing the XML response returned, if any
   */
  public $details = NULL;

  /**
   * @access public
   * @var string the returned report data, if the report was downloaded to
   *     memory
   */
  public $data = NULL;

  /**
   * @access public
   * @var int the size of the returned report data
   */
  public $downloadSize = NULL;

  /**
   * @access public
   * @var string the Location http header returned along with the request,
   *     if any
   */
  public $location = NUll;

  /**
   * Constructor for ReportDownloadResult.
   */
  public function __construct() {}
}
