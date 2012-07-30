<?php
/**
 * This example downloads an existing defined report. To get a defined report,
 * run GetDefinedReports.php. It's not possible to define new reports as of
 * @subpackage v201206
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
 * @subpackage v201206
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <eric.koleda@google.com>
 */

error_reporting(E_STRICT | E_ALL);

// Add the library to the include path. This is not neccessary if you've already
// done so in your php.ini file.
$path = dirname(__FILE__) . '/../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/AdWords/Util/ReportUtils.php';

// Enter parameters required by the code example.
$reportDefinitionId = 'INSERT_REPORT_DEFINITION_ID_HERE';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 * @param string $reportDefinitionId the ID of the report definition to download
 * @param string $filePath the path of the file to download the report to
 */
function DownloadDefinedReportExample(AdWordsUser $user, $reportDefinitionId,
    $filePath) {
  // Set options.
  $options = array('version' => 'v201206', 'returnMoneyInMicros' => TRUE);

  // Download report.
  ReportUtils::DownloadReport($reportDefinitionId, $filePath, $user, $options);

  printf("Report with definition id '%s' was downloaded to '%s'.\n",
      $reportDefinitionId, $filePath);
}

// Don't run the example if the file is being included.
if (__FILE__ != realpath($_SERVER['PHP_SELF'])) {
  return;
}

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Download the report to a file in the same directory as the example.
  $filePath = dirname(__FILE__) . '/report.csv';

  // Run the example.
  DownloadDefinedReportExample($user, $reportDefinitionId, $filePath);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
