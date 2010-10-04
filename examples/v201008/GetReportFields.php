<?php
/**
 * This example gets report fields.
 *
 * Tags: ReportDefinitionService.getReportFields
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
 * @subpackage v201008
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// AdWordsUser.php directly via require_once.
// $path = '/path/to/aw_api_php_lib/src';
$path = dirname(__FILE__) . '/../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the GetReportDefinitionService.
  $reportDefinitionService = $user->GetReportDefinitionService('v201008');

  // The type of the report to get fields for. Ex: KEYWORDS_PERFORMANCE_REPORT
  $reportType = 'INSERT_REPORT_TYPE_HERE';

  // Get report fields.
  $reportDefinitionFields =
      $reportDefinitionService->getReportFields($reportType);

  // Display report fields.
  printf("The report type '%s' contains the following fields:\n", $reportType);

  foreach ($reportDefinitionFields as $reportDefinitionField) {
    printf('- %s (%s)', $reportDefinitionField->fieldName,
        $reportDefinitionField->fieldType);
    if (isset($reportDefinitionField->enumValues)) {
      printf(' := [%s]', implode(', ', $reportDefinitionField->enumValues));
    }
    print "\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
