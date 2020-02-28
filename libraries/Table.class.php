<?php /** @noinspection PhpUndefinedMethodInspection */

class Table {

    // Called from HTMLElements::CreateDiv, which is called from the view (admin.php, events.php, registration.php)
    public static function createTable($controller, $getSomething) {
        $table = "";

        // Uses the passed userLevel controller to get the requested data.
        $data = $controller::$getSomething();

        // If data is returned, create the table using the returned data array (objects or arrays).
        if ($data != null) {
            $table .= Table::createHeader($data[0]);
            for ($i = 0; $i < count($data); $i++) {
                $table .= Table::createRow($data[$i]);
            }
            $table .= Table::end();
        }

        // Returns the full table HTML string for display at the view
        return $table;

    }

    public static function createHeader($data) {
        $tableHeader = "<div class='pb-2'><table class='table table-striped'>\n<thead class='thead-dark'><tr>";

        // Creates the appropriate Table header based on the first returned object's getType method (String which is in all classes in the model).
        switch ($data->getType()) {
            case "Attendee":
                $tableHeader .= "
                    <th>Attendee ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th style='width: 15%'></th>";
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

        // If the user is authenticated as an admin, draw the Add button.
        if ($_SESSION['auth']['role'] == "admin") {
            $tableHeader .= "<div class='pull-right my-2'><form action='crud.php' method='get'><button class='btn btn-outline-success' name='add' value='{$data->getType()}'>Add {$data->getType()}</button></form></div>";
        }
        $tableHeader .= "</tr></thead>\n";

        // Returns the header as a string.
        return $tableHeader;
    }

    public static function createRow($data) {
        // Creates the appropriate Table row based on the passed object's ($data) getType method (String which is in all classes in the model).
        switch ($data->getType()) {
            case "Attendee":
                $row = "<tr>
                    <td>" . $data->getIdattendee() . "</td>
                    <td>" . $data->getName() . "</td>
                    <td>" . $data->getRole() . "</td>
                    ";

                // Draw the appropriate controls, based on the user level.
                // If the user is an admin and the attendee name is NOT admin, draw the edit and delete buttons (cannot edit or delete admin).
                if ($_SESSION['auth']['role'] == 'admin' && $data->getName() != "admin") {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdattendee()}'>Edit</button><button class='btn btn-danger' name='delete{$data->getType()}' value='{$data->getIdattendee()}'>Delete</button></form></td>";
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
                if ($_SESSION['auth']['role'] == 'admin' && $_SERVER['REQUEST_URI'] == '/~txm5483/341/project1/admin.php') {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdvenue()}'>Edit</button><button class='btn btn-danger' name='delete{$data->getType()}' value='{$data->getIdvenue()}'>Delete</button></form></td>";
                } else if ($data->getName() != "admin") {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='register{$data->getType()}' value='{$data->getIdvenue()}'>Register</button></form></td>";
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
                if ($_SESSION['auth']['role'] == 'admin' && $_SERVER['REQUEST_URI'] == '/~txm5483/341/project1/admin.php') {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdevent()}'>Edit</button><button class='btn btn-danger' name='delete{$data->getType()}' value='{$data->getIdevent()}'>Delete</button></form></td>";
                    // TODO: change this elseif from (if dataname is not admin) to (if you can register)
                } else if ($data->getName() != "admin") {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='register{$data->getType()}' value='{$data->getIdevent()}'>Register</button></form></td>";
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
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdsession()}'>Edit</button><button class='btn btn-danger'  name='delete{$data->getType()}' value='{$data->getIdsession()}'>Delete</button></form></td>";
                } else if ($data->getName() != "admin") {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='register{$data->getType()}' value='{$data->getIdsession()}'>Register</button></form></td>";
                } else {
                    $row .= "<td></td>";
                }
                break;

            default:
                $row = "";
        }
        return $row;
    }

    public static function end() {
        return "</table></div>\n";
    }
}