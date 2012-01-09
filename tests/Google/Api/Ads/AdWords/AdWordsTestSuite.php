<?php
/**
 * Test suite for AdWords API tests.
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
 * @subpackage Tests
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

$path = dirname(__FILE__) . '/../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
require_once 'Google/Api/Ads/AdWords/Util/TestUtils.php';
require_once 'PHPUnit/Framework.php';

/**
 * Test suite for AdWords API tests.
 *
 * @author api.ekoleda@gmail.com
 */
class AdWordsTestSuite extends PHPUnit_Framework_TestSuite {
  /**
   * A map of entity dependencies.
   * @var array
   */
  private static $DEPENDS = array(
      'AD_GROUP' => array('CAMPAIGN'),
      'KEYWORD' => array('AD_GROUP'),
      'AD' => array('AD_GROUP'),
      'CAMPAIGN_AD_EXTENSION' => array('CAMPAIGN'),
  );

  private $version;
  private $requires;

  private $user;
  private $mccUser;

  private $campaignId;
  private $adGroupId;
  private $keywordId;
  private $adId;
  private $adExtensionId;
  private $userListId;

  /**
   * Sets up the test suite, created required entities.
   */
  protected function setUp() {
    $this->sharedFixture = array();

    // User.
    $this->user = TestUtils::CreateUser($this->version);
    $this->sharedFixture['user'] = $this->user;

    // MCC user.
    $this->mccUser = TestUtils::CreateUser($this->version);
    $clientId = $this->mccUser->GetClientId();
    $this->mccUser->SetClientId(NULL);
    $this->sharedFixture['mccUser'] = $this->mccUser;
    $this->sharedFixture['clientId'] = $clientId;

    // Test utils.
    $testUtils = new TestUtils($this->user, $this->version);
    $this->sharedFixture['testUtils'] = $testUtils;

    // Add dependencies to requires.
    for ($i = 0; $i < sizeof($this->requires); $i++) {
      $entity = $this->requires[$i];
      if (isset(AdWordsTestSuite::$DEPENDS[$entity])) {
        $this->requires = array_unique(
            array_merge($this->requires, AdWordsTestSuite::$DEPENDS[$entity]));
      }
    }

    // Create required entities.
    if ($this->IsRequired('CAMPAIGN')) {
      $this->campaignId = $testUtils->CreateCampaign();
      $this->sharedFixture['campaignId'] = $this->campaignId;
    }
    if ($this->IsRequired('AD_GROUP')) {
      $this->adGroupId = $testUtils->CreateAdGroup($this->campaignId);
      $this->sharedFixture['adGroupId'] = $this->adGroupId;
    }
    if ($this->IsRequired('KEYWORD')) {
      $this->keywordId = $testUtils->CreateKeyword($this->adGroupId);
      $this->sharedFixture['keywordId'] = $this->keywordId;
    }
    if ($this->IsRequired('AD')) {
      $this->adId = $testUtils->CreateTextAd($this->adGroupId);
      $this->sharedFixture['adId'] = $this->adId;
    }
    if ($this->IsRequired('CAMPAIGN_AD_EXTENSION')) {
      $this->adExtensionId =
          $testUtils->CreateLocationExtension($this->campaignId);
      $this->sharedFixture['adExtensionId'] = $this->adExtensionId;
    }
    if ($this->IsRequired('USER_LIST')) {
      $this->userListId = $testUtils->CreateUserList();
      $this->sharedFixture['userListId'] = $this->userListId;
    }
  }

  /**
   * Tears down the test case, deleting created entities.
   */
  protected function tearDown() {
    $testUtils = new TestUtils($this->user, $this->version);
    // It's only important to delete the campaign.
    if (isset($this->campaignId)) {
      $testUtils->DeleteCampaign($this->campaignId);
    }
  }

  /**
   * Sets the version for the test suite to target.
   * @param string $version the version to target
   */
  public function SetVersion($version) {
    $this->version = $version;
  }

  /**
   * Sets the required entities for the test suite.
   * @param array $requires the required entities
   */
  public function SetRequires($requires) {
    $this->requires = $requires;
  }

  /**
   * Determines if an entity is required for the test.
   * @param string $entity the name of the entity
   * @return boolean true if it is required, false otherwise
   */
  private function IsRequired($entity) {
    return isset($this->requires) && in_array($entity, $this->requires);
  }
}
