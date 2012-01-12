<?php
/**
 * A collection of utility methods for working with cURL.
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
 * @subpackage Util
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <eric.koleda@google.com>
 */

/**
 * A collection of utility methods for working with cURL.
 * @package GoogleApiAdsCommon
 * @subpackage Util
 */
class CurlUtils {
  /**
   * The CurlUtils class is not meant to have any instances.
   * @access private
   */
  private function __construct() {}

  /**
   * Creates a new cURL session with the default options applied.
   * @param string $url the URL of the resource to connect to
   * @return the cURL handle for the new session
   */
  public static function CreateSession($url) {
    $ch = curl_init($url);

    // Default options.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_USERAGENT, 'curl, gzip');

    // Proxy options.
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

    // SSL options.
    if (defined('SSL_VERIFY_PEER') && SSL_VERIFY_PEER != '') {
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, SSL_VERIFY_PEER);
    } else {
      // Default to disabled, for backwards compatibility.
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    }
    if (defined('SSL_VERIFY_HOST') && SSL_VERIFY_HOST != '') {
      if (SSL_VERIFY_HOST) {
        // Verify that the host exists in the certificate and matches the
        // host in the request.
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
      } else {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
      }
    } else {
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    if (defined('SSL_CA_PATH') && SSL_CA_PATH != '') {
      curl_setopt($ch, CURLOPT_CAPATH, SSL_CA_PATH);
    }
    if (defined('SSL_CA_FILE') && SSL_CA_FILE != '') {
      curl_setopt($ch, CURLOPT_CAINFO, SSL_CA_FILE);
    }

    return $ch;
  }
}
