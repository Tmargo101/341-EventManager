<?php
/* Filename: Table.class.php
 * Purpose: Creates all tables & table-adjacent HTML.
 *
 * Author: Tom Margosian
 * Date: 2/26/20
 */

/** @noinspection PhpUndefinedMethodInspection */

class Table {

    // Called from HTMLElements::CreateDiv, which is called from the view (admin.php, events.php, registration.php)
    /**
     * @param $controller
     * @param $getSomething
     * @param $type
     * @return string
     */
    public static function createTable($controller, $getSomething) {
        $table = "";

        // Uses the passed userLevel controller to get the requested data.
        $data = $controller::$getSomething();
        // If data is returned, create the table using the returned data array (objects or arrays).
        if ($data != null) {
            $table .= Table::createHeader($data[0]);
            for ($i = 0; $i < count($data); $i++) {
                $table .= Table::createRow($data[$i], $controller);
            }
            $table .= Table::end();
        }

        // Returns the full table HTML string for display at the view
        return $table;

    }

    /**
     * @param $data
     * @return string
     */
    public static function createHeader($data) {
        // TODO: 'table-responsive' option makes the table too small and shifted to the left on desktop.  Fix this.
        $tableHeader = "<div class='pb-2 container-fluid col-sm-12 table-responsive'><table class='table table-striped'>\n<thead class='thead-dark'><tr>";

        // Creates the appropriate Table header based on the first returned object's getType method (String which is in all classes in the model).
        switch ($data->getType()) {
            case "Attendee_event":
                if ($_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                    $tableHeader .= "
                        <th>Attendee Name</th>
                        <th>Event Attending</th>
                        <th>Attendee ID</th>
                        <th>Event ID</th>
                        <th style='width: 20%'></th>";
                } else {
                    $tableHeader .= "
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th style='width: 20%'></th>";
                }
                break;
            case "Attendee_session":
                if ($_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                    $tableHeader .= "
                    <th>Attendee Name</th>
                    <th>Session Attending</th>
                    <th>Attendee ID</th>
                    <th>Session ID</th>
                    <th style='width: 20%'></th>";
                } else {
                    $tableHeader .= "
                        <th>Session ID</th>
                        <th>Event Name</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th style='width: 20%'></th>";

                }
                break;

            case "Attendee":
                $tableHeader .= "
                    <th>Attendee ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th style='width: 20%'></th>";
                break;

            case "Venue":
                $tableHeader .= "
                    <th>ID</th>
                    <th>Venue Name</th>
                    <th>Max Capacity</th>
                    <th  style='width: 15%'></th>";
                break;

            case "Event":
                $tableHeader .= "
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Venue</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Max Capacity</th>
                    <th style='width: 15%'></th>";
                break;

            case "Session":
                $tableHeader .= "
                    <th>ID</th>
                    <th>Session Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Max Capacity</th>
                    <th>Venue</th>
                    <th style='width: 15%'></th>";
                break;

            default:
                $tableHeader .= "";
        }

        // If the user is authenticated as an admin or a manager, draw the Add button.
        if ($_SESSION['auth']['role'] == "admin" && $_SERVER['REQUEST_URI'] == BASE_URL.'admin.php' || $_SESSION['auth']['role'] == "manager" && $_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
            $tableHeader .= Table::addButton($data->getType());
        }
        $tableHeader .= "</tr></thead>\n";

        // Returns the header as a string.
        return $tableHeader;
    }

    /**
     * @param $data
     * @param $controller
     * @return string
     */
    public static function createRow($data, $controller) {
        // Creates the appropriate Table row based on the passed object's ($data) getType method (String which is in all classes in the model).
        switch ($data->getType()) {
            case "Attendee_event":
                if ($_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                    $row = "<tr>
                        <td>" . $data->getAttendeeName() . "</td>
                        <td>" . $data->getEventName() . "</td>
                        <td>" . $data->getAttendeeID() . "</td>
                        <td>" . $data->getEventID() . "</td>
                        ";
                    if ($_SESSION['auth']['role'] == 'manager' && $_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                        $row .= Table::managerAttendeeControlButton("","");
                    } else if ($_SERVER['REQUEST_URI'] == BASE_URL.'events.php') {
                        $row .= Table::eventsPageRemoveButton($data->getType(), $data->getEventID());
                    } else {
                        $row .= "<td></td>";
                    }
                    $row .= "</tr>";
                } else {
                    $row = "<tr>
                        <td>" . $data->getEventID() . "</td>
                        <td>" . $data->getEventName() . "</td>
                        <td>" . $data->getVenue() . "</td>
                        <td>" . substr($data->getDatestart(), 0, 10) . "</td>
                        <td>" . substr($data->getDateend(), 0, 10) . "</td>

                        ";
                    if ($_SERVER['REQUEST_URI'] == BASE_URL.'events.php') {
                        $row .= Table::eventsPageRemoveButton($data->getType(), $data->getEventID());
                    } else {
                        $row .= "<td></td>";
                    }
                    $row .= "</tr>";

                }
                break;

            case "Attendee_session":
                if ($_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                    $row = "<tr>
                    <td>" . $data->getAttendeeName() . "</td>
                    <td>" . $data->getSessionName() . "</td>
                    <td>" . $data->getAttendeeID() . "</td>
                    <td>" . $data->getSessionID() . "</td>
                    ";
                    if ($_SESSION['auth']['role'] == 'manager' && $_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                        $row .= Table::managerAttendeeControlButton("", "");
                    } else if ($_SERVER['REQUEST_URI'] == BASE_URL.'events.php') {
                        $row .= Table::eventsPageRemoveButton($data->getType(), $data->getSessionID());
                    } else {
                        $row .= "<td></td>";
                    }
                    $row .= "</tr>";
                } else {
                    $row = "<tr>
                        <td>" . $data->getSessionID() . "</td>
                        <td>" . $data->getSessionName() . "</td>
                        <td>" . $data->getVenue() . "</td>
                        <td>" . substr($data->getStartdate(), 0, 10) . "</td>
                        <td>" . substr($data->getEnddate(), 0, 10) . "</td>
                    ";
                    if ($_SERVER['REQUEST_URI'] == BASE_URL.'events.php') {
                        $row .= Table::eventsPageRemoveButton($data->getType(), $data->getSessionID());
                    } else {
                        $row .= "<td></td>";
                    }
                    $row .= "</tr>";
                }
                break;


            case "Attendee":
                $row = "<tr>
                    <td>" . $data->getIdattendee() . "</td>
                    <td>" . $data->getName() . "</td>
                    <td>" . $data->getRole() . "</td>
                    ";

                // Draw the appropriate controls, based on the user level.
                // If the user is an admin and the attendee name is NOT admin, draw the edit and delete buttons (cannot edit or delete admin).
                if ($_SESSION['auth']['role'] == 'admin' && $data->getName() != "admin") {
                    $row .= Table::editDeleteButtons($data->getType(), $data->getIdattendee());
                } else if ($data->getName() == 'admin') {
                    $row .= "<td>Superadmin is not editable.</td>";
                } else {
                    $row .= "<td></td>";
                }
                $row .= "</tr>";
                break;

            case "Venue":
                $row = "<tr>
                    <td>" . $data->getIdvenue() . "</td>
                    <td>" . $data->getName() . "</td>
                    <td>" . $data->getCapacity() . "</td>
                    ";

                // Draw the appropriate controls, based on the user level.
                // If the user is an admin and is currently viewing the attendee page, draw the edit and delete buttons (cannot edit or delete on non-admin pages).
                if ($_SESSION['auth']['role'] == 'admin' && $_SERVER['REQUEST_URI'] == BASE_URL.'admin.php') {
                    $row .= Table::editDeleteButtons($data->getType(), $data->getIdvenue());
                } else if ($data->getName() != "admin") {
                    $row .= "<td></td>";
                } else {
                    $row .= "<td></td>";
                }
                break;

            case "Event":
                $row = "<tr>
                    <td>" . $data->getIdevent() . "</td>
                    <td>" . $data->getName() . "</td>
                    <td>" . $data->getVenue() . "</td>
                    <td>" . substr($data->getDatestart(), 0, 10) . "</td>
                    <td>" . substr($data->getDateend(), 0, 10) . "</td>
                    <td>" . $data->getNumberallowed() . "</td>
                    ";

                // Draw the appropriate controls, based on the user level.
                // If the user is an admin and is currently viewing the attendee page, draw the edit and delete buttons (cannot edit or delete on non-admin pages).
                if ($_SESSION['auth']['role'] == 'admin' && $_SERVER['REQUEST_URI'] == BASE_URL.'admin.php' || $_SESSION['auth']['role'] == "manager" && $_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                    $row .= Table::editDeleteButtons($data->getType(), $data->getIdevent());
                    // TODO: change this elseif from (if getName is not admin) to (if you can register)
                } else if ($data->getName() != "admin") {
                    $row .= Table::registerButton($data->getType(), $data->getIdevent(), $controller);
                } else {
                    $row .= "<td></td>";
                }
                break;

            case "Session":
                $row = "<tr>
                    <td>" . $data->getIdsession() . "</td>
                    <td>" . $data->getName() . "</td>
                    <td>" . substr($data->getStartdate(), 0, 10) . "</td>
                    <td>" . substr($data->getEnddate(), 0, 10) . "</td>
                    <td>" . $data->getNumberallowed() . "</td>
                    <td>" . $data->getEvent() . "</td>
                    ";

                // Draw the appropriate controls, based on the user level.
                if ($_SESSION['auth']['role'] == 'admin' && $_SERVER['REQUEST_URI'] == BASE_URL.'admin.php' || $_SESSION['auth']['role'] == "manager" && $_SERVER['REQUEST_URI'] == BASE_URL.'manager.php') {
                    $row .= Table::editDeleteButtons($data->getType(), $data->getIdsession());
                } else if ($data->getName() != "admin") {
                    $row .= Table::registerButton($data->getType(), $data->getIdsession(), $controller);
                } else {
                    $row .= "<td></td>";
                }
                break;
            default:
                $row = "";
        }
        return $row;
    }

    /**
     * @param $type
     * @param $id
     * @return string
     */
    private static function editDeleteButtons($type, $id) {
        return "
<td>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'>
        <input name='validationString' type='hidden' value='int'>
        <input name='action' type='hidden' value='dialog'>
        <button class='btn btn-primary mx-2' name='button' value='edit'>Edit</button>
        <button class='btn btn-danger' name='button' value='delete'>Delete</button>
        <input name='type' type='hidden' value='{$type}'>
        <input name='id' type='hidden' value='{$id}'>
    </form>
</td>";
    }

    /**
     * @param $type
     * @return string
     */
    public static function addButton($type) {
        return "
<div class='pull-right my-2 pb-3'>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'>
        <input name='validationString' type='hidden' value='none'>
        <input name='action' type='hidden' value='dialog'>
        <button class='btn btn-outline-success' name='button' value='add'>Add {$type}</button>
        <input name='type' type='hidden' value='{$type}'>
    </form>
</div>";
    }

    /**
     * @param $type
     * @param $id
     * @param $controller
     * @return string
     */
    private static function registerButton($type, $id, $controller) {
        if ($type == "Event" && $controller::checkIfRegisteredEvent($id, $_SESSION['auth']['id']) == true || $type == "Session" && $controller::checkIfRegisteredSession($id, $_SESSION['auth']['id']) == true){
            return "
<td>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'>
        <input name='validationString' type='hidden' value='int'>
        <input name='action' type='hidden' value='submit'>
        <button class='btn btn-danger mx-2' name='button' value='unregister'>Unregister</button>
        <input name='type' type='hidden' value='{$type}'>
        <input name='id' type='hidden' value='{$id}'>
    </form>
</td>";

        } else {
            return "
<td>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'>
        <input name='validationString' type='hidden' value='int'>
        <input name='action' type='hidden' value='submit'>
        <button class='btn btn-success mx-2' name='button' value='register'>Register</button>
        <input name='type' type='hidden' value='{$type}'>
        <input name='id' type='hidden' value='{$id}'>
    </form>
</td>";

        }
    } // End registerButton


    private static function managerAttendeeControlButton($type, $id) {
        return "
<td>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'>
        <input name='validationString' type='hidden' value='int'>
        <input name='action' type='hidden' value='submit'>
        <button class='btn btn-danger mx-2' name='button' value='unregister'>Remove Attendee</button>
        <input name='type' type='hidden' value='{$type}'>
        <input name='id' type='hidden' value='{$id}'>
    </form>
</td>";

    }

    private static function eventsPageRemoveButton($type, $id) {
        return "
<td>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'>
        <input name='validationString' type='hidden' value='int'>
        <input name='action' type='hidden' value='submit'>
        <button class='btn btn-danger mx-2' name='button' value='unregister'>Unregister</button>
        <input name='type' type='hidden' value='{$type}'>
        <input name='id' type='hidden' value='{$id}'>
    </form>
</td>";
    }

    /**
     * @return string
     */
    public static function end() {
        return "</table></div>\n";
    }


}