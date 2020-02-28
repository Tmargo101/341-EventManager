<?php

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
            $table .= Table::end();
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
                    <th>Controls</th>";
                break;
            case "Venue":
                $tableHeader .= "
                    <th>ID</th>
                    <th>Venue Name</th>
                    <th>Max Capacity</th>
                    <th>Controls</th>";
                break;
            case "Event":
                $tableHeader .= "
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Max Capacity</th>
                    <th>Venue</th>
                    <th>Controls</th>";
                break;
            case "Session":
                $tableHeader .= "
                    <th>ID</th>
                    <th>Session Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Max Capacity</th>
                    <th>Venue</th>
                    <th>Controls</th>";
                break;
            default:
                $tableHeader .= "";
        }
        $tableHeader .= "</tr></thead>\n";
        return $tableHeader;
    }

    /** @noinspection PhpUndefinedVariableInspection */
    public static function createRow($data) {
        switch ($data->getType()) {
            case "Attendee":
                $row = "<tr>
                    <td>".$data->getIdattendee()."</td>
                    <td>".$data->getName()."</td>
                    <td>".$data->getRole()."</td>
                    ";
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td>Buttons go here</td>";
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
                    $row .= "<td>Buttons go here</td>";
                }
                $row .= "</tr>";
                break;
            case "Event":
                $row = "<tr>
                    <td>".$data->getIdevent()."</td>
                    <td>".$data->getName()."</td>
                    <td>".$data->getDatestart()."</td>
                    <td>".$data->getDateend()."</td>
                    <td>".$data->getNumberallowed()."</td>
                    <td>".$data->getVenue()."</td>
                    ";
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td>Buttons go here</td>";
                }
                $row .= "</tr>";
                break;
            case "Session":
                $row = "<tr>
                    <td>".$data->getIdsession()."</td>
                    <td>".$data->getName()."</td>
                    <td>".$data->getStartdate()."</td>
                    <td>".$data->getEnddate()."</td>
                    <td>".$data->getNumberallowed()."</td>
                    <td>".$data->getEvent()."</td>
                    ";
                if ($_SESSION['auth']['role'] == 'admin') {
                    $row .= "<td>Buttons go here</td>";
                }
                $row .= "</tr>";
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