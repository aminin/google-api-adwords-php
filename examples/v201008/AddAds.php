<?php
/**
 * This example adds a text ad and an image ad to an ad group. To get ad groups,
 * run GetAllAdGroups.php. To get all videos, run GetAllVideos.php. To upload
 * videos, see
 * http://adwords.google.com/support/aw/bin/answer.py?hl=en&answer=39454.
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
 * @subpackage v201008
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
require_once 'Google/Api/Ads/Common/Util/MediaUtils.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the AdGroupAdService.
  $adGroupAdService = $user->GetAdGroupAdService('v201008');

  $adGroupId = (float) 'INSERT_AD_GROUP_ID_HERE';
  $videoMediaId = (float) 'INSERT_VIDEO_MEDIA_ID_HERE';

  // Create text ad.
  $textAd = new TextAd();
  $textAd->headline = 'Luxury Cruise to Mars';
  $textAd->description1 = 'Visit the Red Planet in style.';
  $textAd->description2 = 'Low-gravity fun for everyone!';
  $textAd->displayUrl = 'www.example.com';
  $textAd->url = 'http://www.example.com';

  // Create ad group ad.
  $textAdGroupAd = new AdGroupAd();
  $textAdGroupAd->adGroupId = $adGroupId;
  $textAdGroupAd->ad = $textAd;

  // Create image ad.
  $imageAd = new ImageAd();
  $imageAd->name = 'Cruise to mars image ad #' . time();
  $imageAd->displayUrl = 'www.example.com';
  $imageAd->url = 'http://www.example.com';

  // Create image.
  $image = new Image();
  $image->data = MediaUtils::GetBase64Data(
      'https://sandbox.google.com/sandboximages/image.jpg');
  $imageAd->image = $image;

  // Create ad group ad.
  $imageAdGroupAd = new AdGroupAd();
  $imageAdGroupAd->adGroupId = $adGroupId;
  $imageAdGroupAd->ad = $imageAd;

  // Create template ad, using the Click to Play Video template (id 9).
  $templateAd = new TemplateAd();
  $templateAd->templateId = 9;
  $templateAd->dimensions = new Dimensions(300, 250);
  $templateAd->name = 'Cruise to mars video ad #' . time();
  $templateAd->displayUrl = 'www.example.com';
  $templateAd->url = 'http://www.example.com';

  // Create template ad data.
  $startImage = new Image();
  $startImage->data = MediaUtils::GetBase64Data(
      'https://sandbox.google.com/sandboximages/image.jpg');
  $startImage->type = 'IMAGE';
  $video = new Video();
  $video->mediaId = $videoMediaId;
  $video->type = 'VIDEO';

  $templateAd->templateElements = array(
      new TemplateElement('adData', array(
          new TemplateElementField('startImage', 'IMAGE', NULL, $startImage),
          new TemplateElementField('displayUrlColor', 'ENUM', '#ffffff'),
          new TemplateElementField('video', 'VIDEO', NULL, $video)
      ))
  );

  // Create ad group ad.
  $templateAdGroupAd = new AdGroupAd();
  $templateAdGroupAd->adGroupId = $adGroupId;
  $templateAdGroupAd->ad = $templateAd;

  // Create operations.
  $textAdGroupAdOperation = new AdGroupAdOperation();
  $textAdGroupAdOperation->operand = $textAdGroupAd;
  $textAdGroupAdOperation->operator = 'ADD';

  $imageAdGroupAdOperation = new AdGroupAdOperation();
  $imageAdGroupAdOperation->operand = $imageAdGroupAd;
  $imageAdGroupAdOperation->operator = 'ADD';

  $templateAdGroupAdOperation = new AdGroupAdOperation();
  $templateAdGroupAdOperation->operand = $templateAdGroupAd;
  $templateAdGroupAdOperation->operator = 'ADD';

  $operations = array($textAdGroupAdOperation, $imageAdGroupAdOperation,
      $templateAdGroupAdOperation);

  // Add ads.
  $result = $adGroupAdService->mutate($operations);

  // Display ads.
  if (isset($result->value)) {
    foreach ($result->value as $adGroupAd) {
      print 'Ad with id "' . $adGroupAd->ad->id . '" and type "'
          . $adGroupAd->ad->AdType . "\" was added.\n";
    }
  } else {
    print "No ads were added.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
