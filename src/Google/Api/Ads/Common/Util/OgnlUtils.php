<?php
/**
 * A collection of utility methods for working with OGNL paths.
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
 * A collection of utility methods for working with OGNL paths.
 */
class OgnlUtils {
  /**
   * Matches either a field or an index, and ensures the required punctionation
   * between tokens.
   */
  private static $OGNL_TOKEN_REGEX =
      '/^(?:(\w+)|\[(\d+)\])(?:$|\.|(?=\[))/';

  /**
   * The OgnlUtils class is not meant to have any instances.
   * @access private
   */
  private function __construct() {}

  /**
   * Gets the value of an OGNL expression in the given context.
   * @param $expression the OGNL expression to evaluate
   * @param $context the context in which to evaluate the expression
   * @return the value of the expression or NULL if the expression is invalid
   */
  public static function GetValue($expression, $context) {
    if (!isset($expression) || !isset($context)) {
      return NULL;
    }
    while(strlen($expression) > 0) {
      $matches = array();
      if (preg_match(OgnlUtils::$OGNL_TOKEN_REGEX, $expression, $matches)) {
        $token = array_shift($matches);
        $expression = substr($expression, strlen($token));
        // Remove empty matches.
        $matches = array_filter($matches, 'strlen');
        foreach ($matches as $field) {
          if (is_object($context) && property_exists($context, $field)) {
            $context = $context->$field;
          } else if (is_array($context) && array_key_exists($field, $context)) {
            $context = $context[$field];
          } else {
            // Field doesn't evaluate in the context.
            return NULL;
          }
        }
      } else {
        // Invalid expression.
        return NULL;
      }
    }
    return $context;
  }
}
