<?php


class Table {

    public static function createEventTable($data) {
        if (count($data) > 0) {
            // Create the table and the table header
            $userTableOutput = "<div class='pb-2'><table class='table table-striped'>\n
								<thead class='thead-dark'>
								<tr>
									<th>Attendee ID</th>
									<th>Name</th>
									<th>Role</th>
									<th>Controls</th>
								</tr>\n
								</thead>\n";
            var_dump($data);
            echo "<hr>";
            // Create the table rows from the data input
            foreach ($data as $row) {
                var_dump($row);
                echo "<hr>";
                $userTableOutput .= "<tr>";
                $userTableOutput .= "<td>$row->getIdattendee()</td>";
                $userTableOutput .= "<td>$row->getName()</td>";
                $userTableOutput .= "<td>$row->getRole()</td>";
                $userTableOutput .= "<td>Controls will go here eventually</td>";
                $userTableOutput .= "</tr>";
            }

            // Close the table
            $userTableOutput .= "</table></div>\n";
        } else {
            $userTableOutput = "<h2>No people exist.</h2>";
        }
        echo $userTableOutput;
    }

    public static function createHeader($data) {
        $tableHeader = "<div class='pb-2'><table class='table table-striped'>\n<thead class='thead-dark'>
								<tr>";
        $tableHeader .= $data->getTableHeader();
        $tableHeader .= "</tr></thead>\n";
        echo $tableHeader;
    }
    public static function createRows($inData) {
        foreach ($inData as $row) {
//            $allAttendees = "{$row->getIdattendee()}<br>{$row->getName()}<br>{$row->getPassword()}<br>{$row->getRole()}";
            echo "";
        }

    }

    public static function end() {
        echo "</table></div>\n";
    }
}