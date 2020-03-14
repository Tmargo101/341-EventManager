<?php

require_once 'database/dbaccess_admin.class.php';

/** @noinspection PhpUnused EntryPoints */

class AdminController {

    /** @noinspection PhpUnused */
    public static function getAllAttendees() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("a.idattendee, a.name, r.name AS role", "attendee", "AS a LEFT JOIN role AS r ON a.role = r.idrole ORDER BY a.idattendee", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    /** @noinspection PhpUnused */
    public static function getAllEvents() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("e.idevent, e.name, e.datestart, e.dateend, e.numberallowed, v.name AS venue", "event", "AS e LEFT JOIN venue AS v ON v.idvenue = e.venue ORDER BY e.idevent", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    /** @noinspection PhpUnused */
    public static function getAllSessions() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("s.idsession, s.name, s.numberallowed, s.event, e.name AS eventName, s.startdate, s.enddate", "session", "AS s LEFT JOIN event AS e ON s.event = e.idevent ORDER BY idsession", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    /** @noinspection PhpUnused */
    public static function getAllVenues() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("*", "venue", "ORDER BY idvenue", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getCountOfRowsFromTableStatic($inTable, $inColumn, $inId) {
        $db = new DBAccess_Admin();
        return $db->getCountOfRowsFromTable($inTable,$inColumn,$inId);
    }

    //////////////////////////////////////// START ADD FUNCTIONS ////////////////////////////////////////

    public static function createNewAttendee($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addAttendee($inPOSTValues['newUserName'], $inPOSTValues['newPassword'], $inPOSTValues['newRole']);
        if ($success == 1) {
            HTMLElements::dialogBox("success","Added: ","Added Attendee '{$inPOSTValues['newUserName']}'");
        } else if ($success == 0) {
            HTMLElements::dialogBox("error","Error: ","Added Attendee '{$inPOSTValues['newUserName']}'");
        } else {
            HTMLElements::dialogBox("error","Error: ","Added Attendee '{$inPOSTValues['newUserName']}'");
        }
    }

    public static function createNewVenue($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addVenue($inPOSTValues['newVenueName'], $inPOSTValues['newVenueCapacity']);
        if ($success == 1) {
            HTMLElements::dialogBox("success","Added: ","Added Venue '{$inPOSTValues['newVenueName']}'");
        } else if ($success == 0) {
            HTMLElements::dialogBox("error","Error: ","Added Venue '{$inPOSTValues['newVenueName']}'");
        } else {
            HTMLElements::dialogBox("error","Error: ","Added Venue '{$inPOSTValues['newVenueName']}'");
        }
    }

    public static function createNewEvent($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addEvent($inPOSTValues['newEventName'], $inPOSTValues['newEventStartDate'], $inPOSTValues['newEventEndDate'], $inPOSTValues['newEventNumberAllowed'], $inPOSTValues['newEventVenue']);
        if ($success == 1) {
            HTMLElements::dialogBox("success","Added: ","Added Event '{$inPOSTValues['newEventName']}'");
        } else if ($success == 0) {
            HTMLElements::dialogBox("error","Error: ","Added Event '{$inPOSTValues['newEventName']}'");
        } else {
            HTMLElements::dialogBox("error","Error: ","Added Event '{$inPOSTValues['newEventName']}'");
        }
    }

    public static function createNewSession($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addSession($inPOSTValues['newSessionName'], $inPOSTValues['newSessionStartDate'], $inPOSTValues['newSessionEndDate'], $inPOSTValues['newSessionNumberAllowed'], $inPOSTValues['newSessionEvent']);
        if ($success == 1) {
            HTMLElements::dialogBox("success","Added: ","Added Session '{$inPOSTValues['newSessionName']}'");
        } else if ($success == 0) {
            HTMLElements::dialogBox("error","Error: ","Added Session '{$inPOSTValues['newSessionName']}'");
        } else {
            HTMLElements::dialogBox("error","Error: ","Added Session '{$inPOSTValues['newSessionName']}'");
        }
    }

    //////////////////////////////////////// END ADD FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START EDIT FUNCTIONS ////////////////////////////////////////

    public static function editAttendee($inPOSTValues) {
        $type = "Attendee";
        $db = new DBAccess_Admin();
        $canDelete = 0;
        if ($canDelete == 0) {
            $success = $db->editAttendee($inPOSTValues['newUserName'],$inPOSTValues['newRole'],$inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Edited:","$type with ID '{$inPOSTValues['id']}' edited successfully.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to edit $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error:","$type cannot be edited. Linked to $canDelete other objects.");
        }
    }

    public static function editVenue($inPOSTValues) {
        $type = "Venue";
        $db = new DBAccess_Admin();
        $canDelete = 0;
        if ($canDelete == 0) {
            $success = $db->editVenue($inPOSTValues['newVenueName'],$inPOSTValues['newVenueCapacity'],$inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Edited:","$type with ID '{$inPOSTValues['id']}' edited successfully.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to edit $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error:","$type cannot be edited. Linked to $canDelete other objects.");
        }
    }

    public static function editEvent($inPOSTValues) {
//        var_dump($inPOSTValues);
        $type = "Event";
        $db = new DBAccess_Admin();
        $canDelete = 0;
        if ($canDelete == 0) {
            $success = $db->editEvent($inPOSTValues['newEventName'], $inPOSTValues['newEventStartDate'], $inPOSTValues['newEventEndDate'], $inPOSTValues['newEventNumberAllowed'], $inPOSTValues['newEventVenue'],$inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Edited:","$type with ID '{$inPOSTValues['id']}' edited successfully.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to edit $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error:","$type cannot be edited. Linked to $canDelete other objects.");
        }
    }

    public static function editSession($inPOSTValues) {
//        var_dump($inPOSTValues);
        $type = "Session";
        $db = new DBAccess_Admin();
        $canDelete = 0;
        if ($canDelete == 0) {
            $success = $db->editSession($inPOSTValues['newSessionName'], $inPOSTValues['newSessionStartDate'], $inPOSTValues['newSessionEndDate'], $inPOSTValues['newSessionNumberAllowed'], $inPOSTValues['newSessionEvent'],$inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Edited:","$type with ID '{$inPOSTValues['id']}' edited successfully.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to edit $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error:","$type cannot be edited. Linked to $canDelete other objects.");
        }
    }



    //////////////////////////////////////// END EDIT FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START DELETE FUNCTIONS ////////////////////////////////////////

    public static function deleteAttendee($inPOSTValues) {
        $type = "Attendee";
        $db = new DBAccess_Admin();
        $canDelete = $db->canDeleteAttendee($inPOSTValues['id']);
        if ($canDelete == 0) {
        $success = $db->deleteAttendee($inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Deleted:","$type with ID '{$inPOSTValues['id']}' deleted.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.  Maybe it has already been deleted?");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to delete $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error:","$type cannot be deleted. Linked to $canDelete other objects.");
        }
    }

    public static function deleteVenue($inPOSTValues) {
        $type = "Venue";
        $db = new DBAccess_Admin();
        $canDelete = $db->canDeleteVenue($inPOSTValues['id']);
        if ($canDelete == 0) {
            $success = $db->deleteVenue($inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Deleted:","$type with ID '{$inPOSTValues['id']}' deleted.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.  Maybe it has already been deleted?");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to delete $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error:","$type cannot be deleted. There are $canDelete events registered to this Venue");
        }
    }

    public static function deleteEvent($inPOSTValues) {
        $type = "Event";
        $db = new DBAccess_Admin();
        $canDelete = $db->canDeleteEvent($inPOSTValues['id']);
//        var_dump("CanDelete $type: ".$canDelete);
        if ($canDelete == 0) {
            $success = $db->deleteEvent($inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Deleted:","$type with ID '{$inPOSTValues['id']}' deleted.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.  Maybe it has already been deleted?");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to delete $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error:","$type cannot be deleted. Linked to $canDelete other objects.");
        }
    }

    public static function deleteSession($inPOSTValues) {
        $type = "Session";
        $db = new DBAccess_Admin();
        $canDelete = $db->canDeleteSession($inPOSTValues['id']);
//        var_dump("CanDelete $type: ".$canDelete);
        if ($canDelete == 0) {
            $success = $db->deleteSession($inPOSTValues['id']);
            if ($success == 1) {
                HTMLElements::dialogBox("success","Deleted:","$type with ID '{$inPOSTValues['id']}' deleted.");
            } else if ($success == 0) {
                HTMLElements::dialogBox("warning","Not Found:","$type with ID '{$inPOSTValues['id']}' was not found.  Maybe it has already been deleted?");
            } else {
                HTMLElements::dialogBox("error","Error:","Failed to delete $type with ID '{$inPOSTValues['id']}'.");
            }
        } else {
            HTMLElements::dialogBox("error","Error","$type cannot be deleted. There are $canDelete Attendees registered.");
        }
    }

    //////////////////////////////////////// END DELETE FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START REGISTRATION FUNCTIONS ////////////////////////////////////////

    public static function registerEvent($eventId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->registerEvent($eventId,$attendeeId);
    }

    public static function unregisterEvent($eventId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->unregisterEvent($eventId,$attendeeId);

    }

    public static function registerSession($sessionId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->registerSession($sessionId,$attendeeId);

    }

    public static function unregisterSession($sessionId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->unregisterSession($sessionId,$attendeeId);

    }

    public static function checkIfRegisteredEvent($eventId, $attendeeId) {
        $db = new DBAccess_Admin();
        $isRegistered = $db->checkIfRegisteredEvent($eventId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkIfRegisteredSession($sessionId, $attendeeId) {
        $db = new DBAccess_Admin();
        $isRegistered = $db->checkIfRegisteredSession($sessionId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }

    //////////////////////////////////////// END REGISTRATION FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START EVENT PAGE FUNCTIONS ////////////////////////////////////////

    public static function getEventsAttending() {
        $db = new DBAccess_Admin();
        $data = $db->getSomeRowsFromTable("Attendee_event","e.idevent","SELECT a_e.event AS eventID, e.name AS eventName, v.name AS venue, e.datestart AS datestart, e.dateend AS dateend FROM attendee_event AS a_e LEFT JOIN event AS e ON a_e.event = e.idevent LEFT JOIN venue AS v ON e.venue = v.idvenue LEFT JOIN attendee AS a ON a_e.attendee = a.idattendee LEFT JOIN manager_event AS m_e ON e.idevent = m_e.event", "a_e.attendee", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getSessionsAttending() {
        $db = new DBAccess_Admin();
        $data = $db->getSomeRowsFromTable("Attendee_session","s.idsession","SELECT a_s.session AS sessionID, s.name AS sessionName, v.name AS venue, s.startdate AS startdate, s.enddate AS enddate FROM attendee_session AS a_s LEFT JOIN session AS s ON a_s.session = s.idsession LEFT JOIN event AS e ON s.event = e.idevent LEFT JOIN venue AS v ON e.venue = v.idvenue  LEFT JOIN attendee AS a ON a_s.attendee = a.idattendee LEFT JOIN manager_event AS m_e ON s.idsession = m_e.event", "a_s.attendee", $_SESSION['auth']['id'], "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    //////////////////////////////////////// END EVENT PAGE FUNCTIONS ////////////////////////////////////////

} // End adminDB
