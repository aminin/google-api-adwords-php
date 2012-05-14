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
 * @author     Eric Koleda <eric.koleda@google.com>
 */

/** Required classes. **/
require_once dirname(__FILE__) . '/../Lib/AdWordsUser.php';
require_once dirname(__FILE__) . '/../../Common/Util/CurlUtils.php';
require_once dirname(__FILE__) . '/../../Common/Util/Logger.php';
require_once dirname(__FILE__) . '/../../Common/Util/XmlUtils.php';

/**
 * A collection of utility methods for working with reports.
 * @package GoogleApiAdsAdWords
 * @subpackage Util
 */
class ReportUtils {
  /**
   * The log name to use when logging requests.
   */
  public static $LOG_NAME = 'report_download';

  /**
   * Regular expression used to detect errors messages in a response.
   * @access private
   */
  private static $ERROR_MESSAGE_REGEX =
      '/^!!![^|]*\|\|\|([^|]*)\|\|\|([^?]*)\?\?\?/';

  /**
   * The format of the report download URL, for use with sprintf.
   * @access private
   */
  private static $DOWNLOAD_URL_FORMAT = '%s/api/adwords/reportdownload/%s';

  /**
   * The length of the snippet to read from the request to determine if there
   * was an error.
   * @access private
   */
  private static $SNIPPET_LENGTH = 1024;

  /**
   * The ReportUtils class is not meant to have any instances.
   * @access private
   */
  private function __construct() {}

  /**
   * Downloads a new instance of an existing report definition. If the path
   * parameter is specified it will be downloaded to the file at that path,
   * otherwise it will be downloaded to memory and be returned as a string.
   * @param mixed $reportDefinition the ReportDefinition to download or the id
   *     of a stored report definition
   * @param string $path an optional path of the file to download the report to
   * @param AdWordsUser $user the user that created the ReportDefinition
   * @param array $options the option to use when downloading the report:
   *     {boolean} returnMoneyInMicros: if the money values in the report
   *         should be returned in micros
   *     {string} server: the server to make the request to. If <var>NULL</var>,
   *         then the default server will be used
   *     {string} version: the version to make the request against. If
   *         <var>NULL</var>, then the default version will be used
   * @return mixed if path isn't specified the contents of the report,
   *     otherwise the size in bytes of the downloaded report
   */
  public static function DownloadReport($reportDefinition, $path = NULL,
      AdWordsUser $user, array $options = NULL) {
    $url = self::GetUrl($user, $options);
    $headers = self::GetHeaders($user, $url, $options);
    $params = self::GetParams($reportDefinition);
    return self::DownloadReportFromUrl($url, $headers, $params, $path);
  }

  /**
   * Downloads a report using the URL provided.
   * @param string $url the URL to make the request to
   * @param array $headers the headers to use in the request
   * @param array $params the parameters to pass in the request
   * @param string $path the optional path to download the report to
   * @return mixed if path isn't specified the contents of the report,
   *     otherwise the size in bytes of the downloaded report
   */
  private static function DownloadReportFromUrl($url, $headers, $params,
      $path = NULL) {

    $ch = CurlUtils::CreateSession($url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);

    $flatHeaders = array();
    foreach($headers as $name => $value) {
      $flatHeaders[] = sprintf('%s: %s', $name, $value);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $flatHeaders);

    if (isset($params)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }

    if (isset($path)) {
      $file = fopen($path, 'w');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, FALSE);
      curl_setopt($ch, CURLOPT_FILE, $file);
    }

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $downloadSize = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
    $request = curl_getinfo($ch, CURLINFO_HEADER_OUT);

    curl_close($ch);
    if (isset($file)) {
      fclose($file);
    }

    $exception = null;
    if ($code != 200) {
      // Get the beginning of the response.
      if (isset($path)) {
        $file = fopen($path, 'r');
        $snippet = fread($file, self::$SNIPPET_LENGTH);
        fclose($file);
      } else {
        $snippet = substr($response, 0, self::$SNIPPET_LENGTH);
      }

      // Create exception.
      if (preg_match(self::$ERROR_MESSAGE_REGEX, $snippet, $matches)) {
        $exception = new ReportDownloadException($matches[2], $code);
      } else if (!empty($error)) {
        $exception = new ReportDownloadException($error);
      } else if (isset($code)) {
        $exception =
            new ReportDownloadException('Report download failed.', $code);
      }
    }

    self::LogRequest($request, $code, $params, $exception);

    if (isset($exception)) {
      throw $exception;
    } else if (isset($path)) {
      return $downloadSize;
    } else {
      return $response;
    }
  }

  /**
   * Generates the URL to use for the download request.
   * @param AdWordsUser $user the AdWordsUser to make the request for
   * @param array $options the options configured for the download
   * @return string the download URL
   */
  private static function GetUrl($user, array $options = NULL) {
    $server = !empty($options['server']) ? $options['server'] :
        $user->GetDefaultServer();
    $version = !empty($options['version']) ? $options['version'] : NULL;
    if (!isset($version) && $user->GetDefaultVersion() >= 'v201109') {
      $version = $user->GetDefaultVersion();
    }
    if (isset($server) && strpos($server, 'http') !== 0) {
      throw new ReportDownloadException('Invalid server: ' . $server);
    }
    return sprintf(self::$DOWNLOAD_URL_FORMAT, $server, $version);
  }

  /**
   * Generates the parameters to use for the download request.
   * @param mixed $reportDefinition the report definition, as an ID or object
   * @return array the parameters
   */
  private static function GetParams($reportDefinition) {
    $params = array();
    if (is_numeric($reportDefinition)) {
      $params['__rd'] = $reportDefinition;
    } else if (is_object($reportDefinition) || is_array($reportDefinition)) {
      $document = XmlUtils::ConvertObjectToDocument($reportDefinition,
          'reportDefinition');
      $document->formatOutput = TRUE;
      $params['__rdxml'] = XmlUtils::GetXmlFromDom($document);
    } else {
      throw new ReportDownloadException('Invalid report definition type: '
          . $reportDefinition);
    }
    return $params;
  }

  /**
   * Gets the HTTP headers for the report download request.
   * @param AdWordsUser $user the AdWordsUser to get credentials from
   * @param string $url the URL the request will be made to
   * @param array $options the options for the download
   * @return array and array of strings, which are header names and values
   */
  private static function GetHeaders($user, $url, array $options = NULL) {
    $headers = array();
    $version = !empty($options['version']) ? $options['version'] :
        $user->GetDefaultVersion();
    // Authorization.
    if ($user->GetOAuthInfo()) {
      $oauthParams = $user->GetOAuthHandler()->GetSignedRequestParameters(
          $user->GetOAuthInfo(), $url, 'POST');
      $headers['Authorization'] = 'OAuth '
          . $user->GetOAuthHandler()->FormatParametersForHeader($oauthParams);
    } elseif ($user->GetOAuth2Info()) {
      if (!$user->IsOAuth2AccessTokenValid() &&
          $user->CanRefreshOAuth2AccessToken()) {
        $user->RefreshOAuth2AccessToken();
      }
      $oauth2Header = $user->GetOAuth2Handler()->FormatCredentialsForHeader(
          $user->GetOAuth2Info());
      $headers['Authorization'] = $oauth2Header;
    } else {
      $headers['Authorization']= 'GoogleLogin auth=' . $user->GetAuthToken();
    }
    // Developer token.
    $headers['developerToken'] = $user->GetDeveloperToken();
    // Target client.
    $email = $user->GetEmail();
    $clientId = $user->GetClientId();
    if (isset($clientId)) {
      if (strpos($clientId, '@') !== FALSE) {
        if ($version < 'v201109') {
          $headers['clientEmail'] = $clientId;
        } else {
          throw new ReportDownloadException('Client emails are not supported '
              . 'in versions v201109 and later.');
        }
      } else {
        $headers['clientCustomerId'] = $clientId;
      }
    } else {
      if ($version < 'v201109' && isset($email)) {
        $headers['clientEmail'] = $email;
      } else {
          throw new ReportDownloadException('The client customer ID must be '
          . 'specified for report downloads.');
      }
    }
    // Flags.
    if (isset($options['returnMoneyInMicros'])) {
      $headers['returnMoneyInMicros'] =
          $options['returnMoneyInMicros'] ? 'true' : 'false';
    }
    return $headers;
  }

  /**
   * Logs the report download request.
   * @param string $requestHeaders the HTTP request headers
   * @param integer $responseCode the HTTP response code
   * @param array $params the parameters that were sent, if any
   * @param Exception $exception the exception that will be thrown, if any
   */
  private static function LogRequest($requestHeaders, $responseCode,
      $params = NULL, $exception = NULL) {
    $level = isset($exception) ? Logger::$ERROR : Logger::$INFO;
    $messageParts = array();
    $messageParts[] = trim($requestHeaders);
    $messageParts[] = ''; // Blank line for readability.
    $messageParts[] = "Parameters:";
    foreach ($params as $name => $value) {
      $messageParts[] = sprintf('%s: %s', $name, $value);
    }
    $messageParts[] = ''; // Blank line for readability.
    $messageParts[] = sprintf('Response Code: %s', $responseCode);
    if (isset($exception)) {
      $messageParts[] = sprintf('Error Message: %s', $exception->GetMessage());
    }
    $messageParts[] = ''; // Blank line for readability.
    $message = implode("\n", $messageParts);
    Logger::Log(self::$LOG_NAME, $message, $level);
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
