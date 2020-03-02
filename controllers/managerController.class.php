<?php

require_once "database/dbaccess_manager.class.php";

class ManagerController {
    public static function getYourEvents() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("e.idevent, e.name, e.datestart, e.dateend, e.numberallowed, v.name AS venue", "event", "AS e LEFT JOIN venue AS v ON v.idvenue = e.venue LEFT JOIN manager_event AS me ON e.idevent = me.event",$_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getYourSessions() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("s.idsession, s.name, s.numberallowed, s.event, s.startdate, s.enddate", "session", "AS s LEFT JOIN event AS e ON s.event = e.idevent LEFT JOIN manager_event AS me ON e.idevent = me.event",$_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getYourAttendees() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("a.idattendee, a.name, r.name AS role", "attendee", "AS a LEFT JOIN role AS r ON a.role = r.idrole LEFT join attendee_session AS as ON a.idattendee = as.attendee",$_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

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