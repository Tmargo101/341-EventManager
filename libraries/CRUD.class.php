<?php
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpUnused */


class CRUD {
    public static function whatToDo($inGETValues, $controller) {
        if (isset($inGETValues['action'])) {
            echo "Action";
//            switch() {
//                case "addAttendee":
//                    break;
//                case "editAttendee":
//                    break;
//            }
        } else {
            switch (array_keys($inGETValues)[0]) {
                case "add":
                    echo HTMLElements::addDialog($inGETValues);
                    break;
                case "edit":
                    echo HTMLElements::editDialog($inGETValues);
                    break;
                case "delete":
                    echo HTMLElements::deleteDialog($inGETValues);
                    break;
                case "register":
                    if ($inGETValues['register'] == "Event") {
                        $controller::registerEvent($inGETValues['id'], $_SESSION['auth']['id']);

                    } else if ($inGETValues['register'] == "Session") {
                        $controller::registerSession($inGETValues['id'], $_SESSION['auth']['id']);
                    }
                    break;

                case "unregister":
                    if ($inGETValues['unregister'] == "Event") {
                        $controller::unregisterEvent($inGETValues['id'], $_SESSION['auth']['id']);

                    }
                    if ($inGETValues['unregister'] == "Session") {
                        $controller::unregisterSession($inGETValues['id'], $_SESSION['auth']['id']);
                    }
                    break;
            }
        }
    } // End whatToDo

}