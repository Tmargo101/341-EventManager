<?php

include_once 'dbaccess_common.class.php';

class DBAccess_Manager extends DBAccess {

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
            if ($statement->rowCount() == 0) {
                return $statement->rowCount();
            } else {
                return self::addEventManager($statement->fetchColumn(0));
            }
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

    function addEventManager($inId) {
        try {
            $statement = $this->dbholder->prepare("INSERT into manager_event (event, manager) VALUES (:eventID,:managerID)");
            $statement->execute(array("eventID" => $inId, "managerID" => $_SESSION['auth']['id']));
            return $statement->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    //////////////////////////////////////// END ADD FUNCTIONS ////////////////////////////////////////


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