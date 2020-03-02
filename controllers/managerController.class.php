<?php

require_once "database/dbaccess_manager.class.php";

class ManagerController {
    public static function getAllEvents() {
        $db = new DBAccess();
        $data = $db->getAllRowsFromTable("e.idevent, e.name, e.datestart, e.dateend, e.numberallowed, v.name AS venue", "event", "AS e LEFT JOIN venue AS v ON v.idvenue = e.venue", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getAllSessions() {
        $db = new DBAccess();
        $data = $db->getAllRowsFromTable("*", "session", "", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }
}