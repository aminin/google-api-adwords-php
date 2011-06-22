<?php
/**
 * Functional tests for UserListService.
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
 * @subpackage v201008
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
require_once 'Google/Api/Ads/AdWords/v201008/CampaignService.php';

/**
 * Functional tests for UserListService.
 */
class UserListServiceTest extends AdsTestCase {
  private $service;
  private $testUtils;

  private $userListId;

  /**
   * Create the test suite.
   */
  public static function suite() {
    $suite = new AdWordsTestSuite(__CLASS__);
    $suite->SetVersion('v201008');
    return $suite;
  }

  /**
   * Set up the test fixtures.
   */
  protected function setUp() {
    $user = $this->sharedFixture['user'];
    $this->service = $user->GetUserListService();
    $this->testUtils = $this->sharedFixture['testUtils'];

    $this->userListId = $this->testUtils->CreateUserList();
  }

  /**
   * Test adding a user list.
   * @covers UserListService::mutate
   */
  public function testAdd() {
    $userList = new RemarketingUserList();
    $userList->name = 'User List ' . uniqid();
    $userList->description = 'Description';
    $userList->status = 'OPEN';
    $userList->membershipLifeSpan = 10;

    $conversionType = new UserListConversionType();
    $conversionType->name = 'User List Conversion ' . uniqid();
    $userList->conversionTypes = array($conversionType);

    $operations = array(new UserListOperation($userList, 'ADD'));
    $testUserList = $this->service->mutate($operations)->value[0];

    // Exclude generated fields.
    $excludeFields = array('id', 'isReadOnly', 'size', 'sizeRange', 'type',
        'UserListType', 'conversionTypes->id', 'conversionTypes->category');
    $this->assertEqualsWithExclusions($userList, $testUserList,
        $excludeFields);
  }

  /**
   * Test updating a user list.
   * @covers UserListService::mutate
   */
  public function testUpdate() {
    $userList = new UserList();
    $userList->id = $this->userListId;
    $userList->description = 'New Description';

    $operations = array(new UserListOperation($userList, 'SET'));
    $testUserList = $this->service->mutate($operations)->value[0];

    $this->assertEquals($userList->description, $testUserList->description);
  }

  /**
   * Test deleting a user list.
   * @covers UserListService::mutate
   */
  public function testDelete() {
    $userList = new UserList();
    $userList->id = $this->userListId;
    $userList->status = 'CLOSED';

    $operations = array(new UserListOperation($userList, 'SET'));
    $testUserList = $this->service->mutate($operations)->value[0];

    $this->assertEquals($userList->status, $testUserList->status);
  }

  /**
   * Test getting a user list.
   * @covers UserListService::get
   */
  public function testGet() {
    $selector = new UserListSelector();
    $selector->userListIds = array($this->userListId);
    $selector->userListTypes = array('EXTERNAL_REMARKETING', 'LOGICAL',
        'REMARKETING');
    $selector->userListStatuses = array('OPEN', 'CLOSED');
    $selector->paging = new Paging(0, 10);

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertEquals(1, sizeof($page->entries));
  }

  /**
   * Test getting all user lists.
   * @covers UserListService::get
   */
  public function testGetAll() {
    $selector = new UserListSelector();

    $page = $this->service->get($selector);

    $this->assertNotNull($page);
    $this->assertGreaterThanOrEqual(1, sizeof($page->entries));
  }
}
