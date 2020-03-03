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
            return "error";
        }
    }

    static function validateGeneralInt($inInt) {
        // intval returns '0' on failure, so if the inInt is 0, we don't want to run it through intval
        if ($inInt == 0 || intval($inInt) != 0) {
            return $inInt;
        }
        return null;
    }

    static function validateDate($inDate) {
        $newDate = "error";
        if ($inDate == "") {
            $newDate = "";
        }
        return $newDate;
    }

    public static function validatePostArray($inPOSTArray) {
        $goodPOSTArray = array();

        $inputTypes = explode( ",", $inPOSTArray['validationString']);
        $i = 0;
        $goodPOSTArray['validationError'] = "";
        foreach($inPOSTArray as $key=>$value) {
            if ($key != 'action' && $key != "button" && $key != "type" && $key != "validationString") {
                echo "{$i}: Validating ($key => $value) as a {$inputTypes[$i]}<br>";
                switch ($inputTypes[$i]) {
                    case "string":
                        $string = self::validateGeneralString($value);
                        if ($string == "error") {
                            $goodPOSTArray['validationError'] .= "<h5>Error in {$key}</h5><br>";
                        }
                        break;
                    case "int":
                        $int = self::validateGeneralInt($value);
                        if ($int == null) {
                            $goodPOSTArray['validationError'] .= "<h5>Error in {$key}</h5><br>";
                        }
                        break;
                    case "date":
                        $date = self::validateDate($value);
                        if ($date == "error") {
                            $goodPOSTArray['validationError'] .= "<h5>Error in {$key}</h5><br>";
                        }
                        break;
                    // If the value is not defined, the input cannot be sanitized.  Thus, an error is thrown.
                    default:
                        $goodPOSTArray['validationError'] .= "<h5>Unknown Validation Type: $inputTypes[$i]</h5>";
                        break;
                } // End switch ($inputTypes[$i])

                // Increment the count up by 1
                $i++;
            }// End if
//            echo "Key: ".$key." Value: ".$value."<br>";
        }
        return $goodPOSTArray;
    }
}
