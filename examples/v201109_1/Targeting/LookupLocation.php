<?php
/**
 * This example looks up location criteria by name.
 *
 * Tags: LocationCriterionSerivce.get
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
 * @package    GoogleApiAdsAdWords
 * @subpackage v201109_1
 * @category   WebServices
 * @copyright  2011, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda <eric.koleda@google.com>
 */

error_reporting(E_STRICT | E_ALL);

// Add the library to the include path. This is not neccessary if you've already
// done so in your php.ini file.
$path = dirname(__FILE__) . '/../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';

/**
 * Gets a string representation for a location.
 * @param Location $location the location
 * @return string the string representation
 */
function GetLocationString($location) {
  return sprintf('%s (%s)', $location->locationName, $location->displayType);
}

/**
 * Runs the example.
 * @param AdWordsUser $user the user to run the example with
 */
function LookupLocationExample(AdWordsUser $user) {
  // Get the service, which loads the required classes.
  $locationCriterionService =
      $user->GetService('LocationCriterionService', 'v201109_1');

  // Location names to look up.
  $locationNames = array('Paris', 'Quebec', 'Spain', 'Deutschland');
  // Locale to retrieve location names in.
  $locale = 'en';

  $selector = new Selector();
  $selector->fields = array('Id', 'LocationName', 'CanonicalName',
      'DisplayType',  'ParentLocations', 'Reach');
  // Location names must match exactly, only EQUALS and IN are supported.
  $selector->predicates[] = new Predicate('LocationName', 'IN', $locationNames);
  // Only one locale can be used in a request.
  $selector->predicates[] = new Predicate('Locale', 'EQUALS', $locale);

  // Make the get request.
  $locationCriteria = $locationCriterionService->get($selector);

  // Display results.
  if (isset($locationCriteria)) {
    foreach ($locationCriteria as $locationCriterion) {
      if (isset($locationCriterion->location->parentLocations)) {
        $parentLocations = implode(', ',
            array_map('GetLocationString',
                $locationCriterion->location->parentLocations));
      } else {
        $parentLocations = 'N/A';
      }
      printf("The search term '%s' returned the location '%s' of type '%s' "
          . "with ID '%s', parent locations '%s', and reach '%d'.\n",
          $locationCriterion->searchTerm,
          $locationCriterion->location->locationName,
          $locationCriterion->location->displayType,
          $locationCriterion->location->id,
          $parentLocations,
          $locationCriterion->reach);
    }
  } else {
    print "No location criteria were found.\n";
  }
}

// Don't run the example if the file is being included.
if (__FILE__ != realpath($_SERVER['PHP_SELF'])) {
  return;
}

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  LookupLocationExample($user);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
