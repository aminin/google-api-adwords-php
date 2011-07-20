<?php
/**
 * Unit tests for MapUtils.
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
 * @package    GoogleApiAdsCommon
 * @subpackage Util
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

$path = dirname(__FILE__) . '/../../../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'PHPUnit/Framework.php';
require_once 'Google/Api/Ads/Common/Util/MapUtils.php';

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
   * Test determining if an array is a map.
   * @param array $value the array to evaluate
   * @param bool $expected the expected result of IsMap()
   * @covers MapUtils::IsMap
   * @dataProvider IsMapProvider
   */
  public function testIsMap(array $value, $expected) {
    $result = MapUtils::IsMap($value);
    $this->assertEquals($expected, $result);
  }

  /**
   * Test converting a map to a set of method parameters.
   * @param array $map the map of parameter names to values
   * @param array $expected the expected array of parameter values
   * @covers MapUtils::MapToMethodParameters
   * @dataProvider MapToMethodParametersProvider
   */
  public function testMapToMethodParameters(array $map, array $expected) {
    $reflectionClass = new ReflectionClass($this);
    $reflectionMethod = $reflectionClass->getMethod('SampleMethod');
    $result = MapUtils::MapToMethodParameters($map, $reflectionMethod);
    $this->assertEquals($expected, $result);
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

  /**
   * Provides arrays and the expected value of MapUtils::IsMap().
   * @return array an array or arrays of array and booleans.
   */
  public function IsMapProvider() {
    $data = array();

    // Maps.
    $data[] = array(array('foo' => 'bar'), TRUE);
    $data[] = array(array('foo' => 'bar', 1 => 'baz'), TRUE);

    // Not maps.
    $data[] = array(array(), FALSE);
    $data[] = array(array('bar', 'baz'), FALSE);
    $data[] = array(array('0' => 'bar'), FALSE);

    return $data;
  }

  /**
   * Provides maps and the expected flat array that should be returned when
   * MapUtils::MapToMethodParameters is called with the SampleMethod method.
   * @return array an array of arrays of maps and arrays
   */
  public function MapToMethodParametersProvider() {
    $data = array();

    // Normal order.
    $data[] = array(array('a' => 'ant', 'b' => 'bat', 'c' => 'cat'),
        array('ant', 'bat', 'cat'));
    // Reverse order.
    $data[] = array(array('c' => 'cat', 'b' => 'bat', 'a' => 'ant'),
        array('ant', 'bat', 'cat'));
    // Missing parameter.
    $data[] = array(array('a' => 'ant', 'b' => 'bat'),
        array('ant', 'bat', NULL));
    // Extra parameters.
    $data[] = array(array('a' => 'ant', 'b' => 'bat', 'c' => 'cat',
        'd' => 'dog'), array('ant', 'bat', 'cat'));
    // No parameters.
    $data[] = array(array(), array(NULL, NULL, NULL));

    return $data;
  }

  /**
   * A sample method for testing MapUtils::MapToMethodParameters().
   * @param string $a the first parameter
   * @param string $b the second parameter
   * @param string $c the third paremter (optional)
   */
  public function SampleMethod($a, $b, $c = NULL) {}
}
