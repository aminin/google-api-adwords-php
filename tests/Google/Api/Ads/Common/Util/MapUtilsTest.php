<?php
/**
 * Unit tests for MapUtils.
 *
 * PHP version 5
 *
 * Copyright 2010, Google Inc. All Rights Reserved.
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
 * @package    GoogleApiAdsCommon
 * @subpackage Util
 * @category   WebServices
 * @copyright  2010, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/Common/Util/MapUtils.php';

/**
 * Unit tests for MapUtils.
 *
 * @author api.ekoleda@gmail.com
 */
class MapUtilsTest extends PHPUnit_Framework_TestCase {
  /**
   * Test getting a map from an array of map entries.
   * @param array $mapEntries an array of map entries
   * @param array $map the expected map
   * @covers MapUtils::GetMap
   * @dataProvider MapEntriesProvider
   */
  public function testGetMap(array $mapEntries, array $map) {
    $result = MapUtils::GetMap($mapEntries);
    $this->assertEquals($map, $result);
  }

  /**
   * Test getting map entries from a map.
   * @param array $mapEntries the expected map entries
   * @param array $map a map
   * @covers MapUtils::GetMapEntries
   * @dataProvider MapEntriesProvider
   */
  public function testGetMapEntries(array $mapEntries, array $map) {
    $result = MapUtils::GetMapEntries($map);
    $this->assertEquals($mapEntries, $result);
  }

  /**
   * Provides map entries along with the expected map.
   * @return array an array of arrays of map entries and expected map
   */
  public function MapEntriesProvider() {
    $data = array();

    // One entry.
    $mapEntry = (object) array('key' => 'foo', 'value' => 'bar');
    $map = array('foo' => 'bar');
    $data[] = array(array($mapEntry), $map);

    // More than one entry.
    $mapEntry1 = (object) array('key' => 'foo', 'value' => 'bar');
    $mapEntry2 = (object) array('key' => 'tick', 'value' => 'tock');
    $map = array('foo' => 'bar', 'tick' => 'tock');
    $data[] = array(array($mapEntry1, $mapEntry2), $map);

    // No entries.
    $data[] = array(array(), array());

    return $data;
  }
}
