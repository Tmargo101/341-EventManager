<?php /** @noinspection PhpUnused */
/** @noinspection PhpUnused */
/** @noinspection PhpUnused */
/** @noinspection PhpUnused */
/** @noinspection PhpUnused */

require_once "database/dbaccess_manager.class.php";

class ManagerController {

    //////////////////////////////////////// START MANAGER SPECIFIC FUNCTIONS ////////////////////////////////////////

    public static function getYourEvents() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("Event","e.idevent","SELECT e.idevent, e.name, e.datestart, e.dateend, e.numberallowed, v.name AS venue FROM event AS e LEFT JOIN venue AS v ON v.idvenue = e.venue LEFT JOIN manager_event AS m_e ON e.idevent = m_e.event", "m_e.manager", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getYourSessions() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("Session","s.idsession", "SELECT s.idsession, s.name, s.numberallowed, s.event, s.startdate, s.enddate FROM session AS s LEFT JOIN event AS e ON s.event = e.idevent LEFT JOIN manager_event AS m_e ON e.idevent = m_e.event", "m_e.manager", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getYourEventAttendees() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("Attendee_event","e.idevent","SELECT a_e.event AS eventID, e.name AS eventName, a_e.attendee AS attendeeID, a.name AS attendeeName FROM attendee_event AS a_e LEFT JOIN event AS e ON a_e.event = e.idevent LEFT JOIN attendee AS a ON a_e.attendee = a.idattendee LEFT JOIN manager_event AS m_e ON e.idevent = m_e.event", "m_e.manager", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getYourSessionAttendees() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("Attendee_session","s.idsession","SELECT a_s.session AS sessionID, s.name AS sessionName, a_s.attendee AS attendeeID, a.name AS attendeeName FROM attendee_session AS a_s LEFT JOIN session AS s ON a_s.session = s.idsession LEFT JOIN attendee AS a ON a_s.attendee = a.idattendee LEFT JOIN event AS e ON s.event = e.idevent LEFT JOIN manager_event AS m_e ON e.idevent = m_e.event", "m_e.manager", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    //////////////////////////////////////// END MANAGER SPECIFIC FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START EVENT PAGE FUNCTIONS ////////////////////////////////////////

    public static function getEventsAttending() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("Attendee_event","e.idevent","SELECT a_e.event AS eventID, e.name AS eventName, v.name AS venue, e.datestart AS datestart, e.dateend AS dateend FROM attendee_event AS a_e LEFT JOIN event AS e ON a_e.event = e.idevent LEFT JOIN venue AS v ON e.venue = v.idvenue LEFT JOIN attendee AS a ON a_e.attendee = a.idattendee LEFT JOIN manager_event AS m_e ON e.idevent = m_e.event", "a_e.attendee", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getSessionsAttending() {
        $db = new DBAccess_Manager();
        $data = $db->getSomeRowsFromTable("Attendee_session","s.idsession","SELECT a_s.session AS sessionID, s.name AS sessionName, v.name AS venue, s.startdate AS startdate, s.enddate AS enddate FROM attendee_session AS a_s LEFT JOIN session AS s ON a_s.session = s.idsession LEFT JOIN event AS e ON s.event = e.idevent LEFT JOIN venue AS v ON e.venue = v.idvenue  LEFT JOIN attendee AS a ON a_s.attendee = a.idattendee LEFT JOIN manager_event AS m_e ON s.idsession = m_e.event", "a_s.attendee", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    //////////////////////////////////////// END EVENT PAGE FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START REGISTRATION FUNCTIONS ////////////////////////////////////////

    public static function registerEvent($eventId, $attendeeId) {
        $db = new DBAccess_Manager();
        return $db->registerEvent($eventId,$attendeeId);

    }
    public static function unregisterEvent($eventId, $attendeeId) {
        $db = new DBAccess_Manager();
        return $db->unregisterEvent($eventId,$attendeeId);

    }

    public static function registerSession($sessionId, $attendeeId) {
        $db = new DBAccess_Manager();
        return $db->registerSession($sessionId,$attendeeId);

    }
    public static function unregisterSession($sessionId, $attendeeId) {
        $db = new DBAccess_Manager();
        return $db->unregisterSession($sessionId,$attendeeId);

    }

    public static function checkIfRegisteredEvent($eventId, $attendeeId) {
        $db = new DBAccess_Manager();
        $isRegistered = $db->checkIfRegisteredEvent($eventId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkIfRegisteredSession($sessionId, $attendeeId) {
        $db = new DBAccess_Manager();
        $isRegistered = $db->checkIfRegisteredSession($sessionId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }
    //////////////////////////////////////// END REGISTRATION FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START OVERRIDE FUNCTIONS FROM DBACCESS_COMMON ////////////////////////////////////////

    public static function getAllEvents() {
        $db = new DBAccess_Manager();
        $data = $db->getAllRowsFromTable("e.idevent, e.name, e.datestart, e.dateend, e.numberallowed, v.name AS venue", "event", "AS e LEFT JOIN venue AS v ON v.idvenue = e.venue ORDER BY e.idevent", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getAllSessions() {
        $db = new DBAccess_Manager();
        $data = $db->getAllRowsFromTable("*", "session", "ORDER BY idsession", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    //////////////////////////////////////// END OVERRIDE FUNCTIONS FROM DBACCESS_COMMON ////////////////////////////////////////



}