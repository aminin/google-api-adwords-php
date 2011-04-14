<?php
/**
 * This example gets and downloads a report from a report definition.
 * To get a report definition, run AddKeywordsPerformanceReportDefinition.php.
 * Currently, there is only production support for report download.
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

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/AdWords/Util/ReportUtils.php';

// For large reports we recommend a wait time of 30 seconds.
DEFINE('WAIT_TIME', 5);
DEFINE('MAX_RETRIES', 10);

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  $reportDefinitionId = (float) 'INSERT_REPORT_DEFINITION_ID_HERE';
  $fileName = 'INSERT_OUTPUT_FILE_NAME_HERE';

  $path = dirname(__FILE__) . '/' . $fileName;
  $options = array('returnMoneyInMicros' => TRUE);

  $queryToken = 'new';
  $retryCount = 0;
  do {
    $result = ReportUtils::RunAsyncReport($reportDefinitionId, $queryToken,
        $user, $options);
    // Use the returned query token in future requests.
    $queryToken = $result->details->queryToken;
    if ($result->code == 200) {
      printf("Report is running: %d complete and %d failed of %d total "
          . "accounts. Waiting for %d seconds before retry.\n",
          $result->details->success, $result->details->fail,
          $result->details->total, WAIT_TIME);
      sleep(WAIT_TIME);
    }
    $retryCount++;
  } while ($result->code == 200 && $retryCount < MAX_RETRIES);

  if ($result->code == 200) {
    printf("Download aborted after %d retries.\n", MAX_RETRIES);
  } elseif ($result->code == 500) {
    printf("Report failed with reason '%s'.\n",
        $result->details->failureReason);
  } elseif ($result->code == 301) {
    print "Report completed successfully.\n";
    if (isset($result->details->failures)) {
      $failedAccounts = array_map(
          create_function('$account', 'return $account->id;'),
          $result->details->failures->account);
      printf("However, some accuonts failed to process: %s.\n",
          implode(', ', $failedAccounts));
    }
    $result =
        ReportUtils::DownloadReportFromUrl($result->location, $user, $path);
    printf("Downloaded %d bytes to '%s'.\n", $result->downloadSize, $path);
  } else {
    printf("Report returned with unknown code %d with state '%s'.\n",
        $result->code, $result->details->state);
  }
} catch (Exception $e) {
  print $e->getMessage();
}
