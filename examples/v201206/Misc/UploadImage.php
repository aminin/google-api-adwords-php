<?php
/**
 * This example uploads an image. To get images, run GetAllImagesAndVideos.php.
 *
 * Tags: MediaService.upload
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
require_once 'Google/Api/Ads/Common/Util/MediaUtils.php';
require_once 'Google/Api/Ads/Common/Util/MapUtils.php';

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 */
function UploadImageExample(AdWordsUser $user) {
  // Get the service, which loads the required classes.
  $mediaService = $user->GetService('MediaService', 'v201206');

  // Create image.
  $image = new Image();
  $image->data = MediaUtils::GetBase64Data('http://goo.gl/HJM3L');
  $image->type = 'IMAGE';

  // Make the upload request.
  $result = $mediaService->upload(array($image));

  // Display result.
  $image = $result[0];
  $dimensions = MapUtils::GetMap($image->dimensions);
  printf("Image with dimensions '%dx%d', MIME type '%s', and id '%s' was "
      . "uploaded.\n", $dimensions['FULL']->width,
      $dimensions['FULL']->height, $image->mimeType, $image->mediaId);
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

  // Run the example.
  UploadImageExample($user);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
