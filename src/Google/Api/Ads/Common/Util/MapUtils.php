<?php
/**
 * A collection of utility methods for working with maps (associative arrays).
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
 * @package    GoogleApiAdsCommon
 * @subpackage Util
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

/**
 * A collection of utility methods for working with maps (associative arrays).
 */
class MapUtils {
  /**
   * The MapUtils class is not meant to have any instances.
   * @access private
   */
  private function __construct() {}

  /**
   * Gets a map (associative array) from an array of map entries. A map entry
   * is any object that has a key and value field.
   * @param array $mapEntries an array of map entries
   * @return array a map built from the keys and values of the map entries
   */
  public static function GetMap(array $mapEntries) {
    $result = array();
    foreach ($mapEntries as $mapEntry) {
      $result[$mapEntry->key] = $mapEntry->value;
    }
    return $result;
  }

  /**
   * Gets an array of map entries from a map (associative array). A map entry
   * is any object that has a key and value field. An optional map entry class
   * name can be specified for constructing the entries, otherise the stdClass
   * is used.
   * @param array $map a map from key to value
   * @param string $mapEntryClassName an optional class name to use when
   *     constructing the map entries
   * @return array an array of map entries built from the key-value pairs in
   *     the map
   */
  public static function GetMapEntries(array $map, $mapEntryClassName = NULL) {
    $result = array();
    foreach($map as $key => $value) {
      if (isset($mapEntryClassName)) {
        $entry = new $mapEntryClassName();
      } else {
        $entry = (object) array();
      }
      $entry->key = $key;
      $entry->value = $value;
      $result[] = $entry;
    }
    return $result;
  }
}
