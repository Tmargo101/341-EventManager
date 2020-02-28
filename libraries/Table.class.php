<?php /** @noinspection PhpUndefinedMethodInspection */

//session_name('EventManagerSession');
//session_start();

class Table {

    public static function createTable($controller, $getSomething) {
        $table = "";
        $data = $controller::$getSomething();
        if ($data != null) {
            $table .= Table::createHeader($data[0]);
            for ($i = 0; $i < count($data); $i++) {
//                    $tableDiv .= "<h3>" . $data[$i]->getName() . "</h3>";
                $table .= Table::createRow($data[$i]);
            }
            $table .= Table::end($data[0]);
        }
        return $table;

    }

    public static function createHeader($data) {
        $tableHeader = "<div class='pb-2'><table class='table table-striped'>\n<thead class='thead-dark'><tr>";
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
        $tableHeader .= "</tr></thead>\n";
        return $tableHeader;
    }

    public static function createRow($data) {
        switch ($data->getType()) {
            case "Attendee":
                $row = "<tr>
                    <td>".$data->getIdattendee()."</td>
                    <td>".$data->getName()."</td>
                    <td>".$data->getRole()."</td>
                    ";
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdattendee()}'>Edit</button><button class='btn btn-danger' name='delete{$data->getType()}' value='{$data->getIdattendee()}'>Delete</button></form></td>";
                }
                $row .= "</tr>";
                break;
            case "Venue":
                $row = "<tr>
                    <td>".$data->getIdvenue()."</td>
                    <td>".$data->getName()."</td>
                    <td>".$data->getCapacity()."</td>
                    ";
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdvenue()}'>Edit</button><button class='btn btn-danger' name='delete{$data->getType()}' value='{$data->getIdvenue()}'>Delete</button></form></td>";
                }
                $row .= "</tr>";
                break;
            case "Event":
                $row = "<tr>
                    <td>".$data->getIdevent()."</td>
                    <td>".$data->getName()."</td>
                    <td>".$data->getVenue()."</td>
                    <td>".substr($data->getDatestart(), 0, 10)."</td>
                    <td>".substr($data->getDateend(), 0, 10)."</td>
                    <td>".$data->getNumberallowed()."</td>
                    ";
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdevent()}'>Edit</button><button class='btn btn-danger' name='delete{$data->getType()}' value='{$data->getIdevent()}'>Delete</button></form></td>";
                }
                $row .= "</tr>";
                break;
            case "Session":
                $row = "<tr>
                    <td>".$data->getIdsession()."</td>
                    <td>".$data->getName()."</td>
                    <td>".substr($data->getStartdate(), 0, 10)."</td>
                    <td>".substr($data->getEnddate(), 0, 10)."</td>
                    <td>".$data->getNumberallowed()."</td>
                    <td>".$data->getEvent()."</td>
                    ";
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td><form action='crud.php' method='get'><button class='btn btn-primary mx-2' name='edit{$data->getType()}' value='{$data->getIdsession()}'>Edit</button><button class='btn btn-danger'  name='delete{$data->getType()}' value='{$data->getIdsession()}'>Delete</button></form></td>";
                }
                $row .= "</tr>";
                break;
            default:
                $row = "";
        }
        return $row;
    }

    public static function end($data) {
        return "<div class='pull-right'><form action='crud.php' method='get'><button class='btn btn-outline-success' name='add' value='{$data->getType()}'>Add</button></form></div></table></div>\n";
    }

}