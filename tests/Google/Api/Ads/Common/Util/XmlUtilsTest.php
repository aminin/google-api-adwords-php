<?php
/**
 * Unit tests for XmlUtils.
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

require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/Common/Util/XmlUtils.php';

/**
 * Unit tests for XmlUtils.
 *
 * @author api.ekoleda@gmail.com
 */
class XmlUtilsTest extends PHPUnit_Framework_TestCase {
  /**
   * Test getting a DOM document from a valid XML string.
   * @param string $xml the XML string to parse
   * @covers XmlUtils::GetDomFromXml
   * @dataProvider ValidXmlProvider
   */
  public function testGetDomFromXml_valid($xml) {
    $document = XmlUtils::GetDomFromXml($xml);
    $this->assertTrue(isset($document));
  }

  /**
   * Test getting a DOM document from an invalid XML string.
   * @param string $xml the XML string to parse
   * @covers XmlUtils::GetDomFromXml
   * @dataProvider InvalidXmlProvider
   * @expectedException DOMException
   */
  public function testGetDomFromXml_invalid($xml) {
    $document = XmlUtils::GetDomFromXml($xml);
  }

  /**
   * Test pretty printing an XML string.
   * @param string $xml the XML string to pretty print
   * @param string $expected the expected result of pretty printing the XML
   * @covers XmlUtils::PrettyPrint
   * @dataProvider PrettyXmlProvider
   */
  public function testPrettyPrint($xml, $expected) {
    $result = XmlUtils::PrettyPrint($xml);
    $this->assertEquals($expected, $result);
  }

  /**
   * Test converting a DOM document to an object.
   * @param string $xml the XML to convert
   * @param Object $expected the expected result of the conversion
   * @covers XmlUtils::ConvertDocumentToObject
   * @dataProvider XmlToObjectProvider
   */
  public function testConvertDocumentToObject($xml, $expected) {
    $document = XmlUtils::GetDomFromXml($xml);
    $result = XmlUtils::ConvertDocumentToObject($document);
    $this->assertEquals($expected, $result);
  }

  /**
   * Test converting a DOM element to an object.
   * @param string $xml the XML to convert
   * @param Object $expected the expected result of the conversion
   * @covers XmlUtils::ConvertElementToObject
   * @dataProvider XmlToObjectProvider
   */
  public function testConvertElementToObject($xml, $expected) {
    $document = XmlUtils::GetDomFromXml($xml);
    $element = $document->documentElement;
    $result = XmlUtils::ConvertElementToObject($element);
    $this->assertEquals($expected, $result);
  }

  /**
   * Provides valid XML strings.
   * @return array an array of arrays of XML strings
   */
  public function ValidXmlProvider() {
    $data = array();

    // No value.
    $data[] = array('<root/>');
    // With value.
    $data[] = array('<root>value</root>');
    // With attribute.
    $data[] = array('<root type="none"/>');
    // With child elements.
    $data[] = array('<root><a>apple</a><b>banana</b></root>');
    // With namespaces.
    $data[] = array('<root xmlns="http://foo" xmlns:bar="http://bar">'
        . '<a bar:type="none"/></root>');

    return $data;
  }

  /**
   * Provides invalid XML strings.
   * @return array an array of arrays of XML strings
   */
  public function InvalidXmlProvider() {
    $data = array();

    // Null.
    $data[] = array(NULL);
    // Empty string.
    $data[] = array('');
    // Incomplete tag.
    $data[] = array('<root');
    // Unclosed tag.
    $data[] = array('<root>');
    // Incomplete attribute.
    $data[] = array('<root type="none />');
    // Illegal character.
    $data[] = array('<root>this & that</root>');
    // Illegal attribute name
    $data[] = array('<root 1="none"/>');

    return $data;
  }

  /**
   * Provides non-pretty XML strings and their pretty counterparts.
   * @return array an array of arrays of non-pretty and pretty XML strings
   */
  public function PrettyXmlProvider() {
    $data = array();

    // Insert XML declaration.
    $data[] = array('<root/>', "<?xml version=\"1.0\"?>\n<root/>\n");
    // Collapse empty tags.
    $data[] = array('<root></root>', "<?xml version=\"1.0\"?>\n<root/>\n");
    // Tab in child elements.
    $data[] = array('<root><a>apple</a></root>',
        "<?xml version=\"1.0\"?>\n<root>\n  <a>apple</a>\n</root>\n");
    // Invalid XML should have line breaks removed.
    $data[] = array("<root>\n\n<a>apple\n", "<root><a>apple");

    return $data;
  }

  /**
   * Provides XML strings and the expect value after being converted to an
   * object.
   * @return array an array of arrays of XML strings and resulting objects
   */
  public function XmlToObjectProvider() {
    $data = array();

    // Empty.
    $data[] = array('<root/>', '');
    // String value.
    $data[] = array('<root>value</root>', 'value');
    // Nested elements.
    $data[] =
        array('<root><a>apple</a></root>', (Object) array('a' => 'apple'));
    // Nested elements with the same name.
    $data[] = array('<root><a>apple</a><a>artichoke</a></root>',
        (Object) array('a' => array('apple', 'artichoke')));

    return $data;
  }
}
