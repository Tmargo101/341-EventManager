<?php
/* Filename: sanatize.class.php
 * Purpose: All input sanatization & validation functions ($_POST inputs mainly)
 *
 * Author: Tom Margosian
 * Date: 2/26/20
 */

/*To do in this file: Create a sanitize class with STATIC METHODS to sanitize any input and return the sanitized input*/

class Sanitize {
    static function sanatizeString($inString) {
        return strip_tags(htmlspecialchars($inString));
    }

    public static function validatePostArray($inPOSTArray) {
        $goodPOSTArray = array();

        $inputTypes = explode( ",", $inPOSTArray['validationString']);
        $i = 0;
        foreach($inPOSTArray as $key=>$value) {
            if ($key != 'action' && $key != "button" && $key != "type" && $key != "validationString") {
                echo "{$i}: Validating ($key => $value) as a {$inputTypes[$i]}<br>";
                $i++;
            }
//            echo "Key: ".$key." Value: ".$value."<br>";
        }
        $goodPOSTArray['validationError'] = "None";
        return $goodPOSTArray;
    }
}
