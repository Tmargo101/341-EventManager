<?php
/* Filename: sanitize.class.php
 * Purpose: All input sanitization & validation functions ($_POST inputs mainly)
 *
 * Author: Tom Margosian
 * Date: 2/26/20
 */

/*To do in this file: Create a sanitize class with STATIC METHODS to sanitize any input and return the sanitized input*/

class Sanitize {
    static function sanitizeString($inString) {
        return strip_tags(htmlspecialchars($inString));
    }

    static function validateGeneralString($inString) {
        $sanatizedString = self::sanitizeString($inString);
        if (is_string($sanatizedString) == true && $sanatizedString != "") {
            return $sanatizedString;
        } else {
            return null;
        }
    }

    static function validateGeneralInt($inInt) {
        // intval returns '0' on failure, so if the inInt is 0, we don't want to run it through intval
        if ($inInt == 0 || intval($inInt) != 0) {
            return $inInt;
        } else {
            return null;
        }
    }

    static function validateDate($inDate) {
        if (DateTime::createFromFormat('Y-m-d', $inDate) == true) {
            return $inDate;
        } else {
            return null;
        }
    }

    public static function validatePostArray($inPOSTArray) {
        $goodPOSTArray = array();
        if(isset($inPOSTArray['validationString'])) {
            $inputTypes = explode( ",", $inPOSTArray['validationString']);
            $i = 0;
            $goodPOSTArray['validationError'] = "";
            foreach($inPOSTArray as $key=>$value) {
                if ($key != 'action' && $key != "button" && $key != "type" && $key != "validationString" && $key != "authButton") {
//                    echo "{$i}: Validating ($key => $value) as a {$inputTypes[$i]}<br>";
                    switch ($inputTypes[$i]) {
                        case "string":
                            $string = self::validateGeneralString($value);
                            if ($string == null) {
                                $goodPOSTArray['validationError'] .= "<strong>{$key}</strong><br>";
                            } else {
                                $goodPOSTArray[$key] = $value;
                            }
                            break;
                        case "int":
                            $int = self::validateGeneralInt($value);
                            if ($int == null) {
                                $goodPOSTArray['validationError'] .= "<strong>{$key}</strong><br>";
                            } else {
                                $goodPOSTArray[$key] = $value;
                            }
                            break;
                        case "date":
                            $date = self::validateDate($value);
                            if ($date == null) {
                                $goodPOSTArray['validationError'] .= "<strong>{$key}</strong><br>";
                            } else {
                                $goodPOSTArray[$key] = $value;
                            }
                            break;
                        case "none":
                            $goodPOSTArray[$key] = $value;
                            break;
                        // If the value is not defined, the input cannot be sanitized.  Thus, an error is thrown.
                        default:
                            $goodPOSTArray['validationError'] .= "<strong>Unknown Data Type, Cannot Validate: $inputTypes[$i]</strong>";
                            break;
                    } // End switch ($inputTypes[$i])

                    // Increment the count up by 1
                    $i++;
                }// End if (key is not these kinds of inputs)
            } // End foreach (value in post array)
        } else {
            $goodPOSTArray['validationError'] = "<strong>No validation for this form is possible.</strong><br>";
        }
        return $goodPOSTArray;
    } // End validatePostArray

}
