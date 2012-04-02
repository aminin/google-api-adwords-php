<?php
/**
 * A collection of utility methods for testing the API.
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

/**
 * A collection of utility methods for testing the API.
 * @package GoogleApiAdsAdWords
 * @subpackage Util
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
   * @param string $biddingStrategy the type of bidding strategy to use
   * @return float the id of the campaign
   */
  public function CreateCampaign($biddingStrategyType = NULL) {
    $campaignService =
        $this->user->GetService('CampaignService', $this->version);

    $campaign = new Campaign();
    $campaign->name = 'Campaign #' . uniqid();
    $campaign->budget = new Budget('DAILY', new Money(50000000), 'STANDARD');
    $campaign->status = 'PAUSED';

    if (!isset($biddingStrategyType)) {
      $biddingStrategyType = 'ManualCPC';
    }
    $campaign->biddingStrategy = new $biddingStrategyType;

    $operation = new CampaignOperation(NULL, $campaign, 'ADD');
    $campaign = $campaignService->mutate(array($operation))->value[0];
    return $campaign->id;
  }

  /**
   * Deletes a campaign.
   * @param float $campaignId the id of the campaign
   */
  public function DeleteCampaign($campaignId) {
    $campaignService =
        $this->user->GetService('CampaignService', $this->version);

    $campaign = new Campaign();
    $campaign->id = $campaignId;
    $campaign->status = 'DELETED';

    $operation = new CampaignOperation(NULL, $campaign, 'SET');
    $campaignService->mutate(array($operation));
  }

  /**
   * Creates an ad group.
   * @param float $campaignId the id of the parent campaign
   * @param string $bidsType the type of bids to use
   * @return float the id of the ad group
   */
  public function CreateAdGroup($campaignId, $bidsType = NULL) {
    $adGroupService = $this->user->GetService('AdGroupService', $this->version);

    $adGroup = new AdGroup();
    $adGroup->name = 'AdGroup #' . uniqid();
    $adGroup->campaignId = $campaignId;
    $adGroup->status = 'PAUSED';

    if (!isset($bidsType)) {
      $bidsType = 'ManualCPCAdGroupBids';
    }
    $adGroup->bids = new $bidsType(new Bid(new Money(1000000)));

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
        $this->user->GetService('AdGroupAdService', $this->version);

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
        $this->user->GetService('AdGroupCriterionService', $this->version);

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
   * Creates a placement criterion.
   * @param float $adGroupId the id of the parent ad group
   * @return float the id of the criterion
   */
  public function CreatePlacement($adGroupId) {
    $adGroupCriterionService =
        $this->user->GetService('AdGroupCriterionService', $this->version);

    $placement = new Placement('mars.google.com');

    $adGroupCriterion = new BiddableAdGroupCriterion();
    $adGroupCriterion->adGroupId = $adGroupId;
    $adGroupCriterion->criterion = $placement;

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
        $this->user->GetService('CampaignCriterionService', $this->version);

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
    $adParamService = $this->user->GetService('AdParamService', $this->version);

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
        $this->user->GetService('CampaignAdExtensionService', $this->version);
    $geoLocationService =
        $this->user->GetService('GeoLocationService', $this->version);

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
        $this->user->GetService('AdExtensionOverrideService', $this->version);

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
        $this->user->GetService('AdExtensionOverrideService', $this->version);

    $adExtension = new AdExtension($adExtensionId);
    $adExtensionOverride = new AdExtensionOverride($adId, $adExtension);

    $operation = new AdExtensionOverrideOperation($adExtensionOverride,
        'REMOVE');
    $adExtensionOverrideService->mutate(array($operation));
  }

  /**
   * Uploads an image.
   * @return float the id of the image media
   */
  public function UploadImage() {
    $mediaService = $this->user->GetService('MediaService', $this->version);

    $image = new Image();
    $image->data = MediaUtils::GetBase64Data('http://goo.gl/HJM3L');
    $image->type = 'IMAGE';

    $result = $mediaService->upload(array($image));
    return $result[0]->mediaId;
  }

  /**
   * Adds a report definition.
   * @return float the id of the report definition
   */
  public function AddReportDefinition() {
    $reportDefinitionService =
        $this->user->GetService('ReportDefinitionService', $this->version);

    $selector =
        new Selector(array('KeywordText', 'KeywordMatchType', 'Clicks'));
    $reportDefinition = new ReportDefinition();
    $reportDefinition->selector = $selector;
    $reportDefinition->reportName = 'Test report #' . uniqid();
    $reportDefinition->reportType = 'KEYWORDS_PERFORMANCE_REPORT';
    $reportDefinition->dateRangeType = 'YESTERDAY';
    $reportDefinition->downloadFormat = 'XML';

    $operation = new ReportDefinitionOperation($reportDefinition, 'ADD');
    $result = $reportDefinitionService->mutate(array($operation));

    return $result[0]->id;
  }

  /**
   * Creates a user list.
   * @return float the id of the user list
   */
  public function CreateUserList() {
    $userListService =
        $this->user->GetService('UserListService', $this->version);

    $userList = new RemarketingUserList();
    $userList->name = 'User List ' . uniqid();
    $conversionType = new UserListConversionType();
    $conversionType->name = 'User List Conversion ' . uniqid();
    $userList->conversionTypes = array($conversionType);

    $operation = new UserListOperation($userList, 'ADD');
    $result = $userListService->mutate(array($operation));

    return $result->value[0]->id;
  }

  /**
   * Creates an experiment.
   * @param float $campaignId the ID of the campaign to create the experiment
   *     for
   * @return float the ID of the experiment
   */
  public function CreateExperiment($campaignId) {
    $experimentService =
        $this->user->GetService('ExperimentService', $this->version);

    $experiment = new Experiment();
    $experiment->campaignId = $campaignId;
    $experiment->name = 'Experiment ' . uniqid();
    $experiment->queryPercentage = 50;
    $experiment->startDateTime = date('Ymd hms', strtotime('+1 day'));
    $experiment->endDateTime = date('Ymd hms', strtotime('+2 day'));

    $operation = new ExperimentOperation($experiment, 'ADD');
    $result = $experimentService->mutate(array($operation));

    return $result->value[0]->id;
  }

  /**
   * Deletes an experiment.
   * @param float $experimentId the ID of the experiment to delete
   */
  public function DeleteExperiment($experimentId) {
    $experimentService =
        $this->user->GetService('ExperimentService', $this->version);

    $experiment = new Experiment();
    $experiment->id = $experimentId;
    $experiment->status = 'DELETED';

    $operation = new ExperimentOperation($experiment, 'SET');
    $experimentService->mutate(array($operation));
  }

  /**
   * Creates a conversion tracker.
   * @return float the id of the conversion tracker
   */
  public function CreateConversionTracker() {
    $conversionTrackerService =
        $this->user->GetService('ConversionTrackerService', $this->version);

    $conversionTracker = new AdWordsConversionTracker();
    $conversionTracker->name = 'Conversion ' . uniqid();

    $operation = new ConversionTrackerOperation($conversionTracker, 'ADD');
    $result = $conversionTrackerService->mutate(array($operation));

    return $result->value[0]->id;
  }
}
