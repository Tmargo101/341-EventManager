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
        $data = $db->getAllRowsFromTable("*", "session", "ORDER BY idsession", "class");
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

    public static function createNewAttendee($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addAttendee($inPOSTValues['newUserName'], $inPOSTValues['newPassword'], $inPOSTValues['newRole']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <h5>Created:</h5><br>
        User '{$inPOSTValues['newUserName']}' has been created.
    </div>
</div>";

        } else {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <h5>Error:</h5><br>
        User '{$inPOSTValues['newUserName']}' was not created.
    </div>
</div>";
        }
    }

    public static function createNewVenue($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addVenue($inPOSTValues['newVenueName'], $inPOSTValues['newVenueCapacity']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <h5>Created:</h5><br>
        Venue '{$inPOSTValues['newVenueName']}' has been created.
    </div>
</div>";
        } else {
            echo "
<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    <h5>Error:</h5><br>
    Venue '{$inPOSTValues['newVenueName']}' was not created.
</div>";

        }
    }

    public static function createNewEvent($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addEvent($inPOSTValues['newEventName'], $inPOSTValues['newEventStartDate'], $inPOSTValues['newEventEndDate'], $inPOSTValues['newEventNumberAllowed'], $inPOSTValues['newEventVenue']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <h5>Created:</h5><br>
        Event '{$inPOSTValues['newEventName']}' has been created.
    </div>
</div>";
        } else {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <h5>Error:</h5><br>
        Event '{$inPOSTValues['newEventName']}' was not created.
    </div>
</div>";

        }
    }

    public static function createNewSession($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addSession($inPOSTValues['newSessionName'], $inPOSTValues['newSessionStartDate'], $inPOSTValues['newSessionEndDate'], $inPOSTValues['newSessionNumberAllowed'], $inPOSTValues['newSessionEvent']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <h5>Created:</h5><br>
        Session '{$inPOSTValues['newSessionName']}' has been created.
    </div>
</div>";
        } else {
            echo "<h1>User {$inPOSTValues['newUserName']} Was not created.</h1>";
        }
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
