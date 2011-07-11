<?php
/**
 * A collection of utility methods for working with XML.
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
 * @author     Adam Rogal <api.arogal@gmail.com>
 * @author     Eric Koleda <api.ekoleda@gmail.com>
 */

/**
 * A collection of utility methods for working with XML.
 * @package GoogleApiAdsCommon
 * @subpackage Util
 */
class XmlUtils {
  /**
   * Gets the DOMDocument of the <var>$xml</var>.
   * @param string $xml the XML to create a DOMDocument from
   * @return DOMDocument the DOMDocument of the XML
   * @throws DOMException if the DOM could not be loaded
   */
  public static function GetDomFromXml($xml) {
    set_error_handler('HandleXmlError');
    $dom = new DOMDocument();
    $dom->loadXML($xml,
        LIBXML_DTDLOAD | LIBXML_DTDATTR | LIBXML_NOENT | LIBXML_XINCLUDE);
    restore_error_handler();
    return $dom;
  }

  /**
   * Returns a pretty printed XML. If the XML cannot be loaded a string
   * stripped of any newlines is returned.
   * @param string $xml the XML to pretty print
   * @return string a pretty printed string
   */
  public static function PrettyPrint($xml) {
    try {
      $dom = XmlUtils::GetDomFromXml($xml);
      $dom->formatOutput = true;
      return $dom->saveXML();
    } catch (DOMException $e) {
      restore_error_handler();
      return str_replace(array("\r\n", "\n", "\r"), '', $xml);
    }
  }

  /**
   * Converts a DOMDocument to a stdClass object, where each element under
   * the root node is a field. Atribute values are ignored.
   * @param DOMDocument $document the document to convert
   * @returns Object the converted object
   */
  public static function ConvertDocumentToObject($document) {
    return XmlUtils::ConvertElementToObject($document->documentElement);
  }

  /**
   * Converts a DOMElement to a stdClass object, where each child element is
   * a field. Attribute values are ignored.
   * @param DOMElement $element the element to convert
   * @returns Object the converted object
   */
  public static function ConvertElementToObject($element) {
    $result = array();
    if ($element->hasChildNodes()) {
      $numChildNodes = $element->childNodes->length;
      for ($i = 0; $i < $numChildNodes; $i++) {
        $childNode = $element->childNodes->item($i);
        if ($childNode instanceof DOMElement) {
          $name = $childNode->tagName;
          $value = XmlUtils::ConvertElementToObject($childNode);
          if (isset($result[$name])) {
            if (!is_array($result[$name])) {
              $result[$name] = array($result[$name]);
            }
            $result[$name][] = $value;
          } else {
            $result[$name] = $value;
          }
        }
      }
    }
    if (sizeof($result) > 0) {
      return (Object) $result;
    } else {
      return $element->nodeValue;
    }
  }
}

/**
 * Caputures the warnings thrown by the loadXML function to create a proper
 * DOMException.
 * @param string $errno contains the level of the error raised, as an integer
 * @param string $errstr contains the error message, as a string
 * @param string $errfile contains the filename that the error was raised in,
 *     as a string
 * @param integer $errline contains the line number the error was raised at, as
 *     an integer
 * @return boolean <var>FALSE</var> if the normal error handler should continue
 */
function HandleXmlError($errno, $errstr, $errfile, $errline) {
  if ($errno == E_WARNING
      && substr_count($errstr, 'DOMDocument::loadXML()') > 0) {
    throw new DOMException($errstr);
  } else {
    return FALSE;
  }
}
