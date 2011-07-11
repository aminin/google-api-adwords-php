<?php
/**
 * This example demonstrates how to handle policy violation errors.
 *
 * Tags: AdGroupAdService.mutate
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
require_once 'Google/Api/Ads/Common/Util/ErrorUtils.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the AdGroupAdService.
  $adGroupAdService = $user->GetService('AdGroupAdService', 'v201101');

  // Get validateOnly version of the AdGroupAdService.
  $adGroupAdValidationService =
      $user->GetService('AdGroupAdService', 'v201101', NULL, NULL, TRUE);

  $adGroupId = (float) 'INSERT_AD_GROUP_ID_HERE';

  // Create text ad that violates an exemptable policy. This ad will only
  // trigger an error in the production environment.
  $textAd = new TextAd();
  $textAd->headline = 'Mars Cruise ' . time() . '!!!';
  $textAd->description1 = 'Visit the Red Planet in style.';
  $textAd->description2 = 'Low-gravity fun for everyone!';
  $textAd->displayUrl = 'www.example.com';
  $textAd->url = 'http://www.example.com/';

  // Create ad group ad.
  $adGroupAd = new AdGroupAd();
  $adGroupAd->adGroupId = $adGroupId;
  $adGroupAd->ad = $textAd;

  // Create operations.
  $operation = new AdGroupAdOperation();
  $operation->operand = $adGroupAd;
  $operation->operator = 'ADD';

  $operations = array($operation);

  try {
    // Validate the ads.
    $result = $adGroupAdValidationService->mutate($operations);
  } catch (SoapFault $fault) {
    $errors = ErrorUtils::GetApiErrors($fault);
    $operationIndicesToRemove = array();
    foreach ($errors as $error) {
      if ($error instanceof PolicyViolationError) {
        $operationIndex = ErrorUtils::GetSourceOperationIndex($error);
        $operation = $operations[$operationIndex];
        printf("Ad with headline '%s' violated %s policy '%s'.\n",
            $operation->operand->ad->headline,
            $error->isExemptable ? 'exemptable' : 'non-exemptable',
            $error->externalPolicyName);
        if ($error->isExemptable) {
          // Add exemption request to the operation.
          printf("Adding exemption request for policy name '%s' on text "
              ."'%s'.\n", $error->key->policyName, $error->key->violatingText);
          if (!isset($operation->exemptionRequests)) {
            $operation->exemptionRequests = array();
          }
          $operation->exemptionRequests[] = new ExemptionRequest($error->key);
        } else {
          // Remove non-exemptable operation.
          print "Removing the operation from the request.\n";
          $operationIndicesToRemove[] = $operationIndex;
        }
      } else {
        // Non-policy error returned, throw fault.
        throw $fault;
      }
    }
    $operationIndicesToRemove =
        array_unique($operationIndicesToRemove);
    rsort($operationIndicesToRemove, SORT_NUMERIC);
    if (sizeof($operationIndicesToRemove) > 0) {
      foreach ($operationIndicesToRemove as $operationIndex) {
        unset($operations[$operationIndex]);
      }
    }
  }

  if (sizeof($operations) > 0) {
    // Add ads with exemptions.
    $result = $adGroupAdService->mutate($operations);
  }

  // Display ads.
  if (isset($result->value)) {
    foreach ($result->value as $adGroupAd) {
      printf("Ad with id '%s' and headline '%s' was added.\n",
          $adGroupAd->ad->id, $adGroupAd->ad->headline);
    }
  } else {
    print "No ads were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
