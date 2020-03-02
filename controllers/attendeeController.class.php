<?php

require_once  'database/dbaccess_common.class.php';

/** @noinspection PhpUnused */

class AttendeeController {

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

    //////////////////////////////////////// START REGISTRATION FUNCTIONS ////////////////////////////////////////
    public static function registerEvent($eventId, $attendeeId) {
        $db = new DBAccess();
        return $db->registerEvent($eventId,$attendeeId);

    }
    public static function unregisterEvent($eventId, $attendeeId) {
        $db = new DBAccess();
        return $db->unregisterEvent($eventId,$attendeeId);

    }

    public static function registerSession($sessionId, $attendeeId) {
        $db = new DBAccess();
        return $db->registerSession($sessionId,$attendeeId);

    }
    public static function unregisterSession($sessionId, $attendeeId) {
        $db = new DBAccess();
        return $db->unregisterSession($sessionId,$attendeeId);

    }

    public static function checkIfRegisteredEvent($eventId, $attendeeId) {
        $db = new DBAccess();
        $isRegistered = $db->checkIfRegisteredEvent($eventId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkIfRegisteredSession($sessionId, $attendeeId) {
        $db = new DBAccess();
        $isRegistered = $db->checkIfRegisteredSession($sessionId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }
    //////////////////////////////////////// END REGISTRATION FUNCTIONS ////////////////////////////////////////

}