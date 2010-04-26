<?php
/**
 * Unit tests for ErrorUtils.
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
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/Common/Util/ErrorUtils.php';
require_once dirname(__FILE__) . '/../../../../../../src/Google/Api/Ads/AdWords/v200909/cm/CampaignService.php';

/**
 * Unit tests for ErrorUtils.
 *
 * @author api.ekoleda@gmail.com
 */
class ErrorUtilsTest extends PHPUnit_Framework_TestCase {
  /**
   * Test getting the API errors from a SOAP fault.
   * @param SoapFault $fault the SOAP fault to get errors from
   * @param array $expected the expected errors
   * @covers ErrorUtils::GetApiErrors
   * @dataProvider SoapFaultProvider
   */
  public function testGetApiErrors(SoapFault $fault, array $expected) {
    $errors = ErrorUtils::GetApiErrors($fault);
    $this->assertEquals($expected, $errors);
  }

  /**
   * Provides SOAP faults along with the expected errors.
   * @return array an array of arrays of SOAP faults and expected
   *     errors
   */
  public function SoapFaultProvider() {
    $data = array();
    $error = new AuthenticationError('AUTHENTICATION_FAILED');

    // No SoapVar.
    $exception = new ApiException(array($error));
    $details = (object) array('ApiExceptionFault' => $exception);
    $fault = new SoapFault('soap:Server', NULL, NULL, $details);
    $data[] = array($fault, array($error));

    // With SoapVar.
    $soapVar = new SoapVar($error, SOAP_ENC_OBJECT);
    $exception = new ApiException(array($soapVar));
    $details = (object) array('ApiExceptionFault' => $exception);
    $fault = new SoapFault('soap:Server', NULL, NULL, $details);
    $data[] = array($fault, array($error));

    // No errors.
    $fault = new SoapFault('soap:Server', NULL);
    $data[] = array($fault, array());

    return $data;
  }

  /**
   * Test getting the index of the operation referenced by an error.
   * @param ApiError $error the ApiError to get the operation for
   * @param int $expected the expected operation
   * @covers ErrorUtils::GetSourceOperationIndex
   * @dataProvider SourceOperationIndexProvider
   */
  public function testGetSourceOperationIndex($error, $expected) {
    $index = ErrorUtils::GetSourceOperationIndex($error);
    $this->assertEquals($expected, $index);
  }

  /**
   * Provides errors along with the expected operation index.
   * @return array an array of arrays of error and expected
   *     operation index
   */
  public function SourceOperationIndexProvider() {
    $data = array();

    // Valid data sets.
    // First operation.
    $error = new RequiredError();
    $error->fieldPath = 'operations[0].operand';
    $data[] = array($error, 0);
    // Two digit index.
    $error = new RequiredError();
    $error->fieldPath = 'operations[10].operand';
    $data[] = array($error, 10);

    // Invalid data sets.
    // NULL field path.
    $error = new RequiredError();
    $data[] = array($error, NULL);
    // Empty field path.
    $error = new RequiredError();
    $error->fieldPath = '';
    $data[] = array($error, NULL);
    // Field path that doesn't reference an operation.
    $error = new RequiredError();
    $error->fieldPath = 'foo';
    $data[] = array($error, NULL);
    // Negative index.
    $error = new RequiredError();
    $error->fieldPath = 'operations[-1]';
    $data[] = array($error, NULL);
    // Non-numeric index.
    $error = new RequiredError();
    $error->fieldPath = 'operations[foo]';
    $data[] = array($error, NULL);

    return $data;
  }
}
