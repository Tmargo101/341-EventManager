<?php
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpUnused */


class CRUD {
    public static function whatToDo($inPOSTValues, $controller) {
        var_dump($inPOSTValues);

        if (isset($inPOSTValues['action']) && $inPOSTValues['action'] == "submit") {
            switch($inPOSTValues['button']) {
                case "addAttendee":
                    echo $controller::createNewAttendee($inPOSTValues);
                    break;
                case "addVenue":
                    echo $controller::createNewVenue($inPOSTValues);
                    break;
                case "addEvent":
                    echo $controller::createNewEvent($inPOSTValues);
                    break;
                case "addSession":
                    echo $controller::createNewSession($inPOSTValues);
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
    } // End whatToDo

}