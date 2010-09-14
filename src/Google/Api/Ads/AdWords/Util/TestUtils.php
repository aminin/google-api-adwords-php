<?php
/**
 * A collection of utility methods for testing the API.
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

/**
 * A collection of utility methods for testing the API.
 */
class TestUtils {
  /**
   * Creates an AdWordsUser from the test auth and settings files.
   * @param $defaultVersion the default version of the API the user should use
   * @return AdWordsUser the new user
   */
  public static function CreateUser($defaultVersion = NULL) {
    $testDataPath = dirname(__FILE__) . '/../../../../../../test_data/';
    $authFile = $testDataPath . 'test_auth.ini';
    $settingsFile = $testDataPath . 'test_settings.ini';
    $user = new AdWordsUser($authFile, NULL, NULL, NULL, NULL, NULL, NULL,
        $settingsFile);
    $user->SetDefaultVersion($defaultVersion);
    $user->LogDefaults();
    return $user;
  }

  private $user;
  private $version;

  /**
   * Constructs a new TestUtils object.
   * @param $user the AdWordsUser to use for requests
   * @param $version the version of the API to use for requests
   */
  public function __construct($user, $version) {
    $this->user = $user;
    $this->version = $version;
  }

  /**
   * Creates a new campaign.
   * @return float the id of the campaign
   */
  public function CreateCampaign() {
    $campaignService = $this->user->GetCampaignService($this->version);

    $campaign = new Campaign();
    $campaign->name = 'Campaign #' . time();
    $campaign->biddingStrategy = new ManualCPC();
    $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');

    $operation = new CampaignOperation(NULL, $campaign, 'ADD');
    $campaign = $campaignService->mutate(array($operation))->value[0];
    return $campaign->id;
  }

  /**
   * Deletes a campaign.
   * @param float $campaignId the id of the campaign
   */
  public function DeleteCampaign($campaignId) {
    $campaignService = $this->user->GetCampaignService($this->version);

    $campaign = new Campaign();
    $campaign->id = $campaignId;
    $campaign->status = 'DELETED';

    $operation = new CampaignOperation(NULL, $campaign, 'SET');
    $campaignService->mutate(array($operation));
  }

  /**
   * Creates an ad group.
   * @param float $campaignId the id of the parent campaign
   * @return float the id of the ad group
   */
  public function CreateAdGroup($campaignId) {
    $adGroupService = $this->user->GetAdGroupService($this->version);

    $adGroup = new AdGroup();
    $adGroup->name = 'AdGroup #' . time();
    $adGroup->bids = new ManualCPCAdGroupBids(new Bid(new Money(1000000)));
    $adGroup->campaignId = $campaignId;

    $operation = new AdGroupOperation($adGroup, 'ADD');
    $adGroup = $adGroupService->mutate(array($operation))->value[0];
    return $adGroup->id;
  }

  /**
   * Creates a text ad.
   * @param float $adGroupId the id of the parent ad group
   * @return float the id of the ad
   */
  public function CreateTextAd($adGroupId) {
    $adGroupAdService =
        $this->user->GetAdGroupAdService($this->version);

    $textAd = new TextAd();
    $textAd->headline = 'Luxury Cruise to Mars';
    $textAd->description1 = 'Visit the Red Planet in style.';
    $textAd->description2 = 'Low-gravity fun for everyone!';
    $textAd->displayUrl = 'www.example.com';
    $textAd->url = 'http://www.example.com';

    $adGroupAd = new AdGroupAd($adGroupId, $textAd);

    $operation = new AdGroupAdOperation($adGroupAd, NULL, 'ADD');
    $adGroupAd = $adGroupAdService->mutate(array($operation))->value[0];
    return $adGroupAd->ad->id;
  }

  /**
   * Creates a keyword criterion.
   * @param float $adGroupId the id of the parent ad group
   * @return float the id of the criterion
   */
  public function CreateKeyword($adGroupId) {
    $adGroupCriterionService =
        $this->user->GetAdGroupCriterionService($this->version);

    $keyword = new Keyword('mars cruise', 'BROAD');

    $adGroupCriterion = new BiddableAdGroupCriterion();
    $adGroupCriterion->adGroupId = $adGroupId;
    $adGroupCriterion->criterion = $keyword;

    $operation = new AdGroupCriterionOperation($adGroupCriterion, NULL, 'ADD');
    $adGroupCriterion =
        $adGroupCriterionService->mutate(array($operation))->value[0];
    return $adGroupCriterion->criterion->id;
  }

  /**
   * Creates a negative campaign keyword criterion.
   * @param float $campaignId the id of the parent campaign
   * @return float the id of the criterion
   */
  public function CreateNegativeCampaignKeyword($campaignId) {
    $campaignCriterionService =
        $this->user->GetCampaignCriterionService($this->version);

    $keyword = new Keyword('jupiter cruise', 'BROAD');

    $campaignCriterion = new NegativeCampaignCriterion();
    $campaignCriterion->campaignId = $campaignId;
    $campaignCriterion->criterion = $keyword;

    $operation = new CampaignCriterionOperation($campaignCriterion, 'ADD');
    $campaignCriterion =
        $campaignCriterionService->mutate(array($operation))->value[0];
    return $campaignCriterion->criterion->id;
  }

  /**
   * Sets an ad parameter on a keyword criterion.
   * @param float $adGroupId the id of the ad group
   * @param float $criterionId the id of the keyword criterion
   */
  public function SetAdParam($adGroupId, $criterionId) {
    $adParamService = $this->user->GetAdParamService($this->version);

    $adParam = new AdParam($adGroupId, $criterionId, '1', 1);

    $operation = new AdParamOperation($adParam, 'SET');
    $adParamService->mutate(array($operation));
  }

  /**
   * Creates a location extension.
   * @param float $campaignId the id of the campaign
   * @return float the id of the ad extension
   */
  public function CreateLocationExtension($campaignId) {
    $campaignAdExtensionService =
        $this->user->GetCampaignAdExtensionService($this->version);
    $geoLocationService = $this->user->GetGeoLocationService($this->version);

    $address = new Address('1600 Amphitheatre Parkway', NULL, 'Mountain View',
        'US-CA', NULL, '94043', 'US');
    $selector = new GeoLocationSelector(array($address));
    $result = $geoLocationService->get($selector);
    $geoLocation = $result[0];

    $locationExtension = new LocationExtension($geoLocation->address,
        $geoLocation->geoPoint, $geoLocation->encodedLocation, 'Google',
        '650-253-0000', 'ADWORDS_FRONTEND');
    $campaignAdExtension = new CampaignAdExtension($campaignId,
        $locationExtension);

    $operation = new CampaignAdExtensionOperation($campaignAdExtension, 'ADD');
    $campaignAdExtension =
        $campaignAdExtensionService->mutate(array($operation))->value[0];
    return $campaignAdExtension->adExtension->id;
  }

  /**
   * Creates an ad extension override.
   * @param float $adId the id of the ad
   * @param float $adExtensionId the id of the ad extension
   */
  public function CreateAdExtensionOverride($adId, $adExtensionId) {
    $adExtensionOverrideService =
        $this->user->GetAdExtensionOverrideService($this->version);

    $adExtension = new AdExtension($adExtensionId);
    $adExtensionOverride = new AdExtensionOverride($adId, $adExtension);

    $operation = new AdExtensionOverrideOperation($adExtensionOverride, 'ADD');
    $adExtensionOverrideService->mutate(array($operation));
  }

  /**
   * Removes an ad extension override.
   * @param float $adId the id of the ad
   * @param float $adExtensionId the id of the ad extension
   */
  public function RemoveAdExtensionOverride($adId, $adExtensionId) {
    $adExtensionOverrideService =
        $this->user->GetAdExtensionOverrideService($this->version);

    $adExtension = new AdExtension($adExtensionId);
    $adExtensionOverride = new AdExtensionOverride($adId, $adExtension);

    $operation = new AdExtensionOverrideOperation($adExtensionOverride,
        'REMOVE');
    $adExtensionOverrideService->mutate(array($operation));
  }
}
