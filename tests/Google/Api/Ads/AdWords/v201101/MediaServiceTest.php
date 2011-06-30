<?php
/**
 * Functional tests for MediaService.
 *
 * PHP version 5
 *
 * Copyright 2011, Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the 'License');
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an 'AS IS' BASIS,
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

$path = dirname(__FILE__) . '/../../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once dirname(__FILE__) . '/../AdWordsTestSuite.php';
require_once dirname(__FILE__) . '/../../Common/AdsTestCase.php';
require_once 'Google/Api/Ads/AdWords/v201101/MediaService.php';
require_once 'Google/Api/Ads/Common/Util/MediaUtils.php';

/**
 * Functional tests for MediaService.
 *
 * @author api.ekoleda@gmail.com
 */
class MediaServiceTest extends AdsTestCase {
  private $service;

  private $mediaId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201101');
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetMediaService();

    $testUtils = $this->sharedFixture['testUtils'];
    $this->mediaId = $testUtils->UploadImage();
  }

  /**
   * Test uploading image media.
   * @covers MediaService::mutate
   */
  public function testUploadImageMedia() {
    $image = new Image();
    $image->data = MediaUtils::GetBase64Data('http://goo.gl/HJM3L');
    $image->type = 'IMAGE';
    $image->name = 'Sample Image';

    $result = $this->service->upload(array($image));

    $this->assertNotNull($result);
    $this->assertEquals(1, sizeof($result));
    $this->assertNotNull($result[0]->mediaId);
    $this->assertEquals($image->mediaTypeDb, $result[0]->mediaTypeDb);
    $this->assertNotNull($result[0]->referenceId);
    $this->assertNotNull($result[0]->dimensions);
    $this->assertNotNull($result[0]->urls);
    $this->assertNotNull($result[0]->mimeType);
    $this->assertNotNull($result[0]->fileSize);
  }

  /**
   * Tests getting media.
   * @covers MediaService::get
   */
  public function testGet() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] =
        new Predicate('MediaId', 'IN', array($this->mediaId));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Test getting different media types in the account.
   * @param MediaType $mediaType the mediaType to select
   * @dataProvider mediaTypeProvider
   * @covers MediaService::get
   */
  public function testGetByMediaType($mediaType) {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->predicates[] = new Predicate('Type', 'IN', array($mediaType));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
  }

  /**
   * Test getting all media in the account.
   * @covers MediaService::get
   */
  public function testGetAll() {
    $selector = new Selector();
    $selector->fields = $this->getAllFields();
    $selector->paging = new Paging(0, 100);
    $selector->ordering = array(new OrderBy('MediaId', 'ASCENDING'));

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertLessThanOrEqual(100, sizeof($page->entries));

    if (isset($page->entries)) {
      // Assert that the order is correct.
      $lastId = 0;
      foreach($page->entries as $media) {
        $this->assertGreaterThanOrEqual($lastId, $media->mediaId);
        $lastId = $media->mediaId;
      }
    }
  }

  /**
   * Provides media types.
   * @return array an array of media types (as an array)
   */
  public function mediaTypeProvider() {
    $data = array(
        array('AUDIO'),
        array('ICON'),
        array('IMAGE'),
        array('STANDARD_ICON'),
        array('VIDEO'));
    return $data;
  }

  /**
   * Returns all the selectable fields for the service.
   * @return array the selectable fields available
   */
  function getAllFields() {
    return array(
        'AdvertisingId',
        'CreationTime',
        'Dimensions',
        'DurationMillis',
        'FileSize',
        'IndustryStandardCommercialIdentifier',
        'MediaId',
        'MimeType',
        'Name',
        'ReadyToPlayOnTheWeb',
        'ReferenceId',
        'SourceUrl',
        'StreamingUrl',
        'Type',
        'Urls',
        'YouTubeVideoIdString'
    );
  }
}
