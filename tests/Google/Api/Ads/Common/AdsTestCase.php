<?php
/**
 * Test case base class.
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
 * @subpackage Tests
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

error_reporting(E_STRICT | E_ALL);

require_once 'PHPUnit/Framework.php';

/**
 * Test case base class.
 *
 * @author api.ekoleda@gmail.com
 */
class AdsTestCase extends PHPUnit_Framework_TestCase {
  /**
   * Asserts that two objects are equal, excluding certain fields.
   * @param object $expected the expected object
   * @param object $actual the actual object
   * @param array $excludeFields the fields to exclude
   * @return boolean true if the objects are equal, false otherwise
   */
  public function assertEqualsWithExclusions($expected, $actual,
      array $excludeFields = NULL) {
    $expected = clone $expected;
    $actual = clone $actual;
    foreach ($excludeFields as $excludeField) {
      $fieldParts = explode('->', $excludeField);
      $this->unsetField($expected, $actual, $fieldParts);
    }
    return $this->assertEquals($expected, $actual);
  }

  /**
   * Unsets a field in both the expected and actual object.
   * @param mixed $expected the expected object
   * @param mixed $actual the actual object
   * @param array $fieldParts the parts of the field path
   */
  private function unsetField(&$expected, &$actual, $fieldParts) {
    $field = array_shift($fieldParts);
    if (sizeof($fieldParts) > 0) {
      $tempExpected = $expected->$field;
      $tempActual = $actual->$field;
      if (is_array($tempExpected) && is_array($tempActual)
          && sizeof($tempExpected) == sizeof($tempActual)) {
        for ($i = 0; $i < sizeof($tempExpected); $i++) {
          $this->unsetField($tempExpected[$i], $tempActual[$i], $fieldParts);
        }
      } else {
        $this->unsetField($tempExpected, $tempActual, $fieldParts);
      }
    } else {
      unset($expected->$field);
      unset($actual->$field);
    }
  }
}
