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
        // TODO: this returns 0 when it should return more than 0.  Fix.
        var_dump("CanDelete $type: ".$canDelete);
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
        // TODO: this returns 0 when it should return more than 0.  Fix.
        var_dump("CanDelete $type: ".$canDelete);
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

    public static function getCountOfRowsFromTableStatic($inTable, $inColumn, $inId) {
        $db = new DBAccess_Admin();
        return $db->getCountOfRowsFromTable($inTable,$inColumn,$inId);
    }



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



//        public static function getAllUsersTable() {
//			$db = new DBAccess_Admin();
//			$data = $db->getAllAttendees();
//			$numRecords = count($data);
//
//			$userTableOutput = "<h5>There are {$numRecords} total users registered.</h5>";
//			if (count($data) > 0) {
//				// Create the table and the table header
//				$userTableOutput .= "<div class='pb-2'><table class='table table-striped'>\n
//								<thead class='thead-dark'>
//								<tr>
//									<th>Attendee ID</th>
//									<th>Name</th>
//									<th>Role</th>
//									<th>Controls</th>
//								</tr>\n
//								</thead>\n";
//
//				// Create the table rows from the data input
//				foreach ($data as $row) {
//					$userTableOutput .= "<tr>";
//					// Created method in person.class.php to return a string which is a row (THIS IS HOW TO GET DATA OUT OF A PDO
//					$userTableOutput .= $row->returnColumns();
//					$userTableOutput .= $row->returnActionColumn();
//					$userTableOutput .= "</tr>";
//				}
//
//				// Close the table
//				$userTableOutput .= "</table></div>\n";
//			} else {
//				$userTableOutput = "<h2>No people exist.</h2>";
//			}
//
//			return $userTableOutput;
//		}
//
//		public static function getAllEventsTable() {
//			$db = new DBAccess_Admin();
//			$data = $db->getAllEvents();
//			$numRecords = count($data);
//
//			$eventTableOutputString = "<h5>There are {$numRecords} total events registered.</h5>";
//			if (count($data) > 0) {
//				// Create the table and the table header
//				$eventTableOutputString .= "<div class='pb-2'><table class='table table-striped'>\n
//								<thead class='thead-dark'>
//								<tr>
//									<th>Event ID</th>
//									<th>Event Name</th>
//									<th>Start Date</th>
//									<th>End Date</th>
//									<th>Max Attendees</th>
//									<th>Venue ID</th>
//									<th>Controls</th>
//								</tr>\n
//								</thead>\n";
//
//				// Create the table rows from the data input
//				foreach ($data as $row) {
//					$eventTableOutputString .= "<tr>";
//					$eventTableOutputString .= $row->returnColumns();
//					$eventTableOutputString .= $row->returnActionColumn();
//					$eventTableOutputString .= "</tr>";
//				}
//
//				// Close the table
//				$eventTableOutputString .= "</table></div>\n";
//			} else {
//				$eventTableOutputString = "<h2>No Events exist.</h2>";
//			}
//
//			return $eventTableOutputString;
//		}
} // End adminDB
