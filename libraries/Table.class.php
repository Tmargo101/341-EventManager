<?php


class Table {

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