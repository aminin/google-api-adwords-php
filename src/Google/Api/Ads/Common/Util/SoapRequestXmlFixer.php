<?php
/**
 * The SOAP XML request fixer used to fix some inconsistencies among the
 * different versions of the PHP SoapClient.
 *
 * PHP version 5
 *
 * Copyright 2009, Google Inc. All Rights Reserved.
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
 * @copyright  2009, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author     Adam Rogal <api.arogal@gmail.com>
 */

require_once 'XmlUtils.php';

/**
 * The SOAP XML request fixer used to fix some inconsistencies among the
 * different versions of the PHP SoapClient.
 */
class SoapRequestXmlFixer {
  private $addXsiTypes;
  private $removeEmptyElements;

  /**
   * Constructor to determine how the XML should be fixed.
   * @param boolean $addXsiTypes <var>TRUE</var> if xsi:types should be added
   *     to all complex type elements
   * @param boolean $removeEmptyElements <var>TRUE</var> if all empty elements
   *     should be removed from the XML request
   */
  public function __construct($addXsiTypes, $removeEmptyElements) {
    $this->addXsiTypes = $addXsiTypes;
    $this->removeEmptyElements = $removeEmptyElements;
  }

  /**
   * Fixes the XML based on the parameters specified in the constructor.
   * @param string $request the raw request produced by the SOAP client
   * @param array $arguments the arguments passed to the SOAP method
   * @return string the prepared request ready to be sent to the server
   */
  public function FixXml($request, array $arguments) {
    if (!$this->addXsiTypes && !$this->removeEmptyElements) {
      return $request;
    } else {
      $requestDom = XmlUtils::GetDomFromXml($request);
      $xpath = new DOMXPath($requestDom);

      $bodyDom = $xpath->query(
          "//*[local-name()='Envelope']/*[local-name()='Body']")->item(0);
      $argumentsDomNode = $bodyDom->firstChild;

      // The first argument is taken - the wrapper object of the request.
      $this->FixXmlNode($argumentsDomNode, $arguments[0], $xpath);

      if ($this->removeEmptyElements) {
        $this->RemoveEmptyHeaderElements($requestDom, $xpath);
      }

      return $requestDom->saveXML();
    }
  }

  /**
   * Fix a list of nodes corresponding to an array of objects.
   * @param DOMNodeList $nodeList the node list matching <var>$objects</var>
   * @param array $objects the objects array matching <var>$nodeList</var>
   * @param DOMXPath $xpath the xpath object representing the DOM
   */
  private function FixXmlNodes(DOMNodeList $nodeList, array $objects,
      DOMXPath $xpath) {
    if ($nodeList->length == sizeof($objects)) {
      $i = 0;
      foreach ($objects as $object) {
        $this->FixXmlNode($nodeList->item($i), $object, $xpath);
        $i++;
      }
    }
  }

  /**
   * Fix a node corresponding to an objects.
   * @param DOMNode $node the node matching <var>$object</var>
   * @param mixed $object the object matching <var>$node</var>
   * @param DOMXPath $xpath the xpath object representing the DOM
   */
  private function FixXmlNode(DOMNode $node, $object, DOMXPath $xpath) {
    if (is_object($object)) {
      if ($this->addXsiTypes) {
        $this->AddXsiType($node, $object);
      }

      foreach (get_object_vars($object) as $varName => $varValue) {
        $nodeList =
            $xpath->query("*[local-name() = '" . $varName . "']", $node);

        if (is_array($varValue)) {
          $this->FixXmlNodes($nodeList, $varValue, $xpath);
        } else if ($nodeList->length == 1) {
          $this->FixXmlNode($nodeList->item(0), $varValue, $xpath);
        }
      }
    } else if (!isset($object) && $this->removeEmptyElements) {
      $node->parentNode->removeChild($node);
    }
  }

  /**
   * Adds the xsi:type to the DOMNode generated from the corresponding object.
   * @param DOMNode $domNode the DOM node corresponding to the object
   * @param $object the object used to determine the xsi:type
   * @access private
   */
  private function AddXsiType(DOMNode $domNode, $object) {
    $prefix = $domNode->lookupPrefix($object->getNamespace());
    $domNode->setAttribute("xsi:type", (isset($prefix) ? $prefix . ':'  : '')
        . $object->getXsiTypeName());
  }

  /**
   * Removes empty header elements from the supplied request.
   * @param DOMDocument $requestDom the DOM docudment containing the header
   * @access private
   */
  private function RemoveEmptyHeaderElements(DOMDocument $requestDom,
      DOMXPath $xpath) {
    $requestHeaderDom = $xpath->query(
        "//*[local-name()='Envelope']/*[local-name()='Header']"
            . "/*[local-name()='RequestHeader']")->item(0);

    $childNodes = $requestHeaderDom->childNodes;

    foreach ($childNodes as $childNode) {
      if ($childNode->nodeValue == NULL) {
        $requestHeaderDom->removeChild($childNode);
      }
    }
  }
}
