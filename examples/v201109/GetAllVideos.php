<?php
/**
 * This example gets all videos. To upload a video, see
 * http://adwords.google.com/support/aw/bin/answer.py?hl=en&answer=39454.
 *
 * Tags: MediaService.get
 * Restriction: adwords-only
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
require_once 'Google/Api/Ads/Common/Util/MediaUtils.php';
require_once 'Google/Api/Ads/Common/Util/MapUtils.php';

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the MediaService.
  $mediaService = $user->GetService('MediaService', 'v201109');

  // Create selector.
  $selector = new Selector();
  $selector->fields = array('MediaId', 'Name');
  $selector->ordering = array(new OrderBy('Name', 'ASCENDING'));

  // Create predicates.
  $typePredicate = new Predicate('Type', 'IN', array('VIDEO'));
  $selector->predicates = array($typePredicate);

  // Get all videos.
  $page = $mediaService->get($selector);

  // Display videos.
  if (isset($page->entries)) {
    foreach ($page->entries as $video) {
      printf("Video with id '%s' and name '%s' was found.\n", $video->mediaId,
          $video->name);
    }
  } else {
    print "No videos were found.\n";
  }
} catch (Exception $e) {
  print $e->getMessage();
}
