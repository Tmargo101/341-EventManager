<?php
/* Filename: CRUD.class.php
 * Purpose: View pages call the static function whatToDo to process all $_POST inputs.
 *
 * Author: Tom Margosian
 * Date: 3/2/20
 */

/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpUnused */


class CRUD {

//    public static function checkIfPostValid($inPOSTArray) {
//        $inputTypes = explode( ",", $inPOSTArray['validationString']);
//        $cleanPOSTArray = Sanitize::validatePostArray($inputTypes, $inPOSTArray);
//        if ($cleanPOSTArray == false) {
//            return "Post not submitted";
//        }

//        foreach ($inPOSTArray['validationArray'] as $key=>$value) {
//            echo "Key: ".$key." Value: ".$value;
//        }

    public static function whatToDo($inPOSTValues, $controller) {

        $cleanPOSTArray = Sanitize::validatePostArray($inPOSTValues);

        if ($cleanPOSTArray['validationError'] != "") {
            echo "
<div class='container col-4 alert alert-warning'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <h4>Warning:</h4>
    Action not complete.<br>
    The following fields returned errors:<br><br>
    {$cleanPOSTArray['validationError']}
</div>";
        } else {
//        var_dump($inPOSTValues);
            if (isset($inPOSTValues['action']) && $inPOSTValues['action'] == "submit") {
                switch($inPOSTValues['button']) {
                    case "add":
                        switch($inPOSTValues['type']) {
                            case "Attendee":
                                echo $controller::createNewAttendee($inPOSTValues);
                                break;
                            case "Venue":
                                echo $controller::createNewVenue($inPOSTValues);
                                break;
                            case "Event":
                                echo $controller::createNewEvent($inPOSTValues);
                                break;
                            case "Session":
                                echo $controller::createNewSession($inPOSTValues);
                                break;
                        }
                        break;
                    case "register":
                        if ($inPOSTValues['type'] == "Event") {
                            $controller::registerEvent($inPOSTValues['id'], $_SESSION['auth']['id']);

                        } else if ($inPOSTValues['type'] == "Session") {
                            $controller::registerSession($inPOSTValues['id'], $_SESSION['auth']['id']);
                        }
                        break;

                    case "unregister":
                        if ($inPOSTValues['type'] == "Event") {
                            $controller::unregisterEvent($inPOSTValues['id'], $_SESSION['auth']['id']);
                        }
                        if ($inPOSTValues['type'] == "Session") {
                            $controller::unregisterSession($inPOSTValues['id'], $_SESSION['auth']['id']);
                        }
                        if ($inPOSTValues['type'] == "Attendee_event") {
                            $controller::unregisterEvent($inPOSTValues['id'], $_SESSION['auth']['id']);
                        }
                        if ($inPOSTValues['type'] == "Attendee_session") {
                            $controller::unregisterSession($inPOSTValues['id'], $_SESSION['auth']['id']);
                        }

                        break;

                }

            } else if (isset($inPOSTValues['action']) && $inPOSTValues['action'] == "dialog"){
                switch ($inPOSTValues['button']) {
                    case "add":
                        echo HTMLElements::addDialog($inPOSTValues);
                        break;
                    case "edit":
                        echo HTMLElements::editDialog($inPOSTValues);
                        break;
                    case "delete":
                        echo HTMLElements::deleteDialog($inPOSTValues);
                        break;
                }
            }

        }

    } // End whatToDo

}