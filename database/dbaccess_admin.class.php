<?php
include_once 'dbaccess_common.class.php';

/** @noinspection PhpUnused */

class DBAccess_Admin extends DBAccess {

    //////////////////////////////////////// START ADD FUNCTIONS ////////////////////////////////////////

    function addAttendee($newUserName, $newUserPassword, $newUserRole) {
        // Check if user exists (under development)
//        $previousUserArray = $this->getUser($newUserName);
//        if (!isset($previousUserArray[0])) {
        try {
            $statement = $this->dbholder->prepare("INSERT into attendee (name,password,role) VALUES (:username,:password,:role)");
            $statement->execute(array("username" => $newUserName, "password" => password_hash($newUserPassword, PASSWORD_DEFAULT),"role"=>$newUserRole));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function addVenue($newVenueName, $newVenueCapacity) {
        try {
            $statement = $this->dbholder->prepare("INSERT into venue (name,capacity) VALUES (:name,:capacity)");
            $statement->execute(array("name" => $newVenueName, "capacity" => $newVenueCapacity));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function addEvent($inName, $inDateStart, $inDateEnd, $inNumberAllowed, $inVenue) {
        try {
            $statement = $this->dbholder->prepare("INSERT into event (name,datestart,dateend,numberallowed,venue) VALUES (:name,:datestart,:dateend,:numberallowed,:venue)");
            $statement->execute(array("name" => $inName, "datestart" => $inDateStart,"dateend"=>$inDateEnd,"numberallowed"=>$inNumberAllowed,"venue"=>$inVenue));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function addSession($inName, $inStartDate, $inEndDate, $inNumberAllowed, $inEvent) {
        try {
            $statement = $this->dbholder->prepare("INSERT into session (name,startdate,enddate,numberallowed,event) VALUES (:name,:startdate,:enddate,:numberallowed,:event)");
            $statement->execute(array("name" => $inName, "startdate" => $inStartDate,"enddate"=>$inEndDate,"numberallowed"=>$inNumberAllowed,"event"=>$inEvent));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    //////////////////////////////////////// END ADD FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START EDIT FUNCTIONS ////////////////////////////////////////

    function editAttendee($newUserName, $newUserRole, $userId) {
        // Check if user exists (under development)
//        $previousUserArray = $this->getUser($newUserName);
//        if (!isset($previousUserArray[0])) {
        try {
            $statement = $this->dbholder->prepare("UPDATE attendee SET name = :username, role = :role WHERE idattendee = :id");
            $statement->execute(array("username" => $newUserName,"role"=>$newUserRole, "id"=>$userId));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function editVenue($newVenueName, $newVenueCapacity, $venueId) {
        try {
            $statement = $this->dbholder->prepare("UPDATE venue SET name = :name, capacity = :capacity WHERE idvenue = :id");
            $statement->execute(array("name" => $newVenueName, "capacity" => $newVenueCapacity, "id"=>$venueId));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function editEvent($inName, $inDateStart, $inDateEnd, $inNumberAllowed, $inVenue, $eventId) {
        try {
            $statement = $this->dbholder->prepare("UPDATE event SET name = :name, datestart = :datestart, dateend = :dateend, numberallowed = :numberallowed, venue = :venue WHERE idevent = :id");
            $statement->execute(array("name" => $inName, "datestart" => $inDateStart,"dateend"=>$inDateEnd,"numberallowed"=>$inNumberAllowed,"venue"=>$inVenue, "id"=>$eventId));
            var_dump($statement->errorInfo());
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function editSession($inName, $inStartDate, $inEndDate, $inNumberAllowed, $inEvent, $sessionId) {
        try {
            $statement = $this->dbholder->prepare("UPDATE session SET name = :name, startdate = :startdate, enddate = :enddate, numberallowed = :numberallowed, event = :event WHERE idsession = :id");
            $statement->execute(array("name" => $inName, "startdate" => $inStartDate,"enddate"=>$inEndDate,"numberallowed"=>$inNumberAllowed,"event"=>$inEvent,"id"=>$sessionId));
//            var_dump($statement->errorInfo());
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    //////////////////////////////////////// END EDIT FUNCTIONS ////////////////////////////////////////


    //////////////////////////////////////// START DELETE FUNCTIONS ////////////////////////////////////////

    function deleteAttendee($attendeeId) {
        try {
            $statement = $this->dbholder->prepare("DELETE FROM attendee WHERE idattendee = :id");
            $statement->execute(array("id" => $attendeeId));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function deleteVenue($venueId) {
        try {
            $statement = $this->dbholder->prepare("DELETE FROM venue WHERE idvenue = :id");
            $statement->execute(array("id" => $venueId));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function deleteEvent($eventId) {
        try {
            $statement = $this->dbholder->prepare("DELETE FROM event WHERE idevent = :id");
            $statement->execute(array("id" => $eventId));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    function deleteSession($sessionId) {
        try {
            $statement = $this->dbholder->prepare("DELETE FROM session WHERE idsession = :id");
            $statement->execute(array("id" => $sessionId));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    //////////////////////////////////////// END DELETE FUNCTIONS ////////////////////////////////////////

}