<?php
/**
 * This example gets the changes in the account during the last 24 hours.
 *
 * Tags: CustomerSyncService.get
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
 * @subpackage v201109
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

function ArrayToString($array) {
  if (!isset($array)) {
    return '';
  } else {
    return implode(', ', $array);
  }
}

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the services.
  $campaignService = $user->GetService('CampaignService', 'v201109');
  $customerSyncService = $user->GetService('CustomerSyncService', 'v201109');

  // Get an array of all campaign ids.
  $campaignIds = array();
  $selector = new Selector();
  $selector->fields = array('Id');
  $page = $campaignService->get($selector);
  if (isset($page->entries)) {
    foreach ($page->entries as $campaign) {
      $campaignIds[] = $campaign->id;
    }
  }

  // Set the date time range, from 24 hours ago until now.
  $dateTimeRange = new DateTimeRange();
  $dateTimeRange->min = date('Ymd his', strtotime('-1 day'));
  $dateTimeRange->max = date('Ymd his');

  // Create selector.
  $selector = new CustomerSyncSelector();
  $selector->dateTimeRange = $dateTimeRange;
  $selector->campaignIds = $campaignIds;

  // Get changes.
  $accountChanges = $customerSyncService->get($selector);

  // Display changes.
  if (isset($accountChanges)) {
    printf("Most recent change: %s\n", $accountChanges->lastChangeTimestamp);
    if (isset($accountChanges->changedCampaigns)) {
      foreach ($accountChanges->changedCampaigns as $campaignChangeData) {
        printf("Campaign with id '%.0f' has change status '%s'.\n",
            $campaignChangeData->campaignId,
            $campaignChangeData->campaignChangeStatus);
        if ($campaignChangeData->campaignChangeStatus != 'NEW') {
          printf("\tAdded ad extensions: %s\n",
              ArrayToString($campaignChangeData->addedAdExtensions));
          printf("\tDeleted ad extensions: %s\n",
              ArrayToString($campaignChangeData->deletedAdExtensions));
          printf("\tAdded campaign criteria: %s\n",
              ArrayToString($campaignChangeData->addedCampaignCriteria));
          printf("\tDeleted campaign criteria: %s\n",
              ArrayToString($campaignChangeData->deletedCampaignCriteria));
          printf("\tCampaign targeting changed: %s\n",
              $campaignChangeData->campaignTargetingChanged ? 'true'
                  : 'false');
          if (isset($campaignChangeData->changedAdGroups)) {
            foreach($campaignChangeData->changedAdGroups as
                $adGroupChangeData) {
              printf("\tAd Group with id '%.0f' has change status '%s'.\n",
                  $adGroupChangeData->adGroupId,
                  $adGroupChangeData->adGroupChangeStatus);
              if ($adGroupChangeData->adGroupChangeStatus != 'NEW') {
                printf("\t\tChanged ads: %s\n",
                    ArrayToString($adGroupChangeData->changedAds));
                printf("\t\tChanged criteria: %s\n",
                    ArrayToString($adGroupChangeData->changedCriteria));
                printf("\t\tDeleted criteria: %s\n",
                    ArrayToString($adGroupChangeData->deletedCriteria));
              }
            }
          }
        }
      }
    }
  } else {
    print "No changes were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
