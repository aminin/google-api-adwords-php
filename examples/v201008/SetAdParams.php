<?php
/**
 * This example sets ad parameters for a keyword ad group criterion. To get ad
 * group criteria, run GetAllAdGroupCriteria.php.
 *
 * Tags: AdParamService.mutate
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

  // Get the AdParamService.
  $adParamService = $user->GetAdParamService('v201008');

  $adGroupId = (float) 'INSERT_AD_GROUP_ID_HERE';
  $keywordId = (float) 'INSERT_KEYWORD_ID_HERE';

  // Create ad parameters.
  $adParam1 = new AdParam($adGroupId, $keywordId, '100', 1);
  $adParam2 = new AdParam($adGroupId, $keywordId, '$40', 2);

  // Create operations.
  $adParamOperation1 = new AdParamOperation();
  $adParamOperation1->operand = $adParam1;
  $adParamOperation1->operator = 'SET';

  $adParamOperation2 = new AdParamOperation();
  $adParamOperation2->operand = $adParam2;
  $adParamOperation2->operator = 'SET';

  $operations = array($adParamOperation1, $adParamOperation2);

  // Set ad parameters.
  $adParams = $adParamService->mutate($operations);

  // Display ad parameters.
  if (isset($adParams)) {
    foreach ($adParams as $adParam) {
      print 'Ad parameter with ad group id "' . $adParam->adGroupId
          . '", criterion id "' . $adParam->criterionId
          . '", insertion text "' . $adParam->insertionText
          . '", and parameter index "' . $adParam->paramIndex
          . "\" was set.\n";
    }
  } else {
    print "No ad parameters were set.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
