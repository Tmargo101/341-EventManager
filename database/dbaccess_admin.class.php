<?php
include_once 'dbaccess_common.class.php';

/** @noinspection PhpUnused */

class DBAccess_Admin extends DBAccess {


    function getRowsFromTable($inColumns, $inQuery) {
        try {
            // TODO: If inQuery is
            // Convert the first char of $inTable to uppercase, since it's the same name but with a Capital letter (best class practice)
            $inType = ucfirst($inQuery);

            /** @noinspection PhpIncludeInspection */
            include_once "model/{$inType}.class.php";

            // Build query outside of the PDO Prepare instead of binding the params in the PDO since Table and Column names CANNOT be replaced by parameters in PDO.
            $query = "SELECT $inColumns FROM $inQuery";
            $statement = $this->dbholder->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, $inType);
            return $statement->fetchAll();

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }

    function addAttendee($newUserName, $newUserPassword, $newUserRole) {
        // Check if user exists (under development)
//        $previousUserArray = $this->getUser($newUserName);
//        if (!isset($previousUserArray[0])) {
            try {
//                    $data = array();
                $statement = $this->dbholder->prepare("INSERT into attendee (name,password,role) VALUES (:username,:password,:role)");
                $statement->execute(array("username" => $newUserName, "password" => password_hash($newUserPassword, PASSWORD_DEFAULT),"role"=>$newUserRole));
                return $this->dbholder->lastInsertId();
            } catch (PDOException $exception) {
                echo $exception->getMessage();
                return -1;
            }
//        }
//        return null;
    }

		function addEvent($inName, $inDateStart, $inDateEnd, $inNumberAllowed, $inVenue) {
            try {
                $statement = $this->dbholder->prepare("INSERT into event (name,datestart,dateend,numberallowed,venue) VALUES (:name,:datestart,:dateend,:numberallowed,:venue)");
                $statement->execute(array("name" => $inName, "datestart" => $inDateStart,"dateend"=>$inDateEnd,"numberallowed"=>$inNumberAllowed,"venue"=>$inVenue));
                return $this->dbholder->lastInsertId();
            } catch (PDOException $exception) {
                echo $exception->getMessage();
                return -1;
            }
        }

        function addSession($inName, $inStartDate, $inEndDate, $inNumberAllowed, $inEvent) {
            try {
                $statement = $this->dbholder->prepare("INSERT into session (name,startdate,enddate,numberallowed,event) VALUES (:name,:startdate,:enddate,:numberallowed,:event)");
                $statement->execute(array("name" => $inName, "startdate" => $inStartDate,"enddate"=>$inEndDate,"numberallowed"=>$inNumberAllowed,"event"=>$inEvent));
                return $this->dbholder->lastInsertId();
            } catch (PDOException $exception) {
                echo $exception->getMessage();
                return -1;
            }
        }

    function addVenue($newVenueName, $newVenueCapacity) {
        try {
            $statement = $this->dbholder->prepare("INSERT into venue (name,capacity) VALUES (:name,:capacity)");
            $statement->execute(array("name" => $newVenueName, "capacity" => $newVenueCapacity));
            return $this->dbholder->lastInsertId();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }
}