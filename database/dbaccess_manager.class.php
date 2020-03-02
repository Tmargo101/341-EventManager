<?php

include_once 'dbaccess_common.class.php';

class DBAccess_Manager extends DBAccess {

    /** @noinspection PhpInconsistentReturnPointsInspection */
    function getSomeRowsFromTable($inColumns, $inTable, $inQuery, $id, $fetchType) {
        try {
            // Decide if I am going to use a fetch class or an associative array
            switch ($fetchType) {
                case "class":
                    // Convert the first char of $inTable to uppercase, since it's the same name but with a Capital letter (best class practice)
                    $inType = ucfirst($inTable);

                    /** @noinspection PhpIncludeInspection */
                    include_once "model/{$inType}.class.php";

                    // Build query outside of the PDO Prepare instead of binding the params in the PDO since Table and Column names CANNOT be replaced by parameters in PDO.
                    $query = "SELECT $inColumns FROM $inTable $inQuery where me.manager = :id";
                    $statement = $this->dbholder->prepare($query);
//                    var_dump($statement);
//                    var_dump($id);
//                    var_dump($_SESSION['auth']);
                    $statement->execute(array("id"=>$id));
                    $statement->setFetchMode(PDO::FETCH_CLASS, $inType);
                    return $statement->fetchAll();
                    break;
                case "array":
                    break;

            }

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }

////////////////////////////////////////// START REGISTRATION FUNCTIONS ////////////////////////////////////////
//    function registerEvent($eventId, $attendeeId) {
//        try {
//            $statement = $this->dbholder->prepare("INSERT into attendee_event (event,attendee) VALUES (:eventID,:attendeeID)");
//            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
//            return $this->dbholder->lastInsertId();
//        } catch (PDOException $exception) {
//            echo $exception->getMessage();
//            return array();
//        }
//    }
//
//    function unregisterEvent($eventId, $attendeeId) {
//        try {
//            $statement = $this->dbholder->prepare("DELETE from attendee_event WHERE event = :eventID AND attendee = :attendeeID");
//            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
//            return $this->dbholder->lastInsertId();
//        } catch (PDOException $exception) {
//            echo $exception->getMessage();
//            return array();
//        }
//    }
//
//    function registerSession($eventId, $attendeeId) {
//        try {
//            $statement = $this->dbholder->prepare("INSERT into attendee_session (event,attendee) VALUES (:eventID,:attendeeID)");
//            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
//            return $this->dbholder->lastInsertId();
//        } catch (PDOException $exception) {
//            echo $exception->getMessage();
//            return array();
//        }
//    }
//
//    function unregisterSession($eventId, $attendeeId) {
//        try {
//            $statement = $this->dbholder->prepare("DELETE from attendee_session WHERE event = :eventID AND attendee = :attendeeID");
//            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
//            return $this->dbholder->lastInsertId();
//        } catch (PDOException $exception) {
//            echo $exception->getMessage();
//            return array();
//        }
//    }
//
//
//    function checkIfRegistered($eventId, $attendeeId) {
//        try {
//            $statement = $this->dbholder->prepare("SELECT * from attendee_event WHERE event = :eventID AND attendee = :attendeeID");
//            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
//            $data = $statement->fetchAll();
//            if (isset($data[0])) {
//                return true;
//            } else {
//                return false;
//            }
//        } catch (PDOException $exception) {
//            echo $exception->getMessage();
//            return array();
//        }
//    }
//    //////////////////////////////////////// END REGISTRATION FUNCTIONS ////////////////////////////////////////


}