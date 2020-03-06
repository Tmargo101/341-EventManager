<?php
/*
	This is the superclass for the Database Layer.  Functions in this class can be called from any of the userLevel controllers.
	
	Author: Thomas Margosian
	Date created: 2/20/20
*/

class DBAccess {
    protected $dbholder;

    function __construct() {
        try {
            // Set PDO access data from constants (Cannot call a constant within string interpolation)
            $host = DB_SERVER;
            $username = DB_USERNAME;
            $password = DB_PASSWORD;
            $database = DB_DATABASE;

            $this->dbholder = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
        } catch (PDOException $pdoException) {
            echo $pdoException->getMessage();
            die("<br>Bad Database");
        }
    }

//		function getItem($inColumns, $inTable, $inType, $inQuery) {
//            try {
//                include_once "model/Attendee.class.php";
//                $statement = $this->dbholder->prepare("SELECT :columns FROM :tab WHERE :id = :query");
//                $statement->execute(array("columns"=>$inColumns,"tab"=>$inTable,"id"=>$inType,"query"=>$inQuery));
//                $statement->setFetchMode(PDO::FETCH_CLASS,"Attendee");
//                return $statement->fetchAll();
//            } catch (PDOException $exception) {
//                echo $exception->getMessage();
//                return array();
//            }
//        }

    /** @noinspection PhpInconsistentReturnPointsInspection
     * @noinspection PhpIncludeInspection
     * @param $inColumns
     * @param $inTable
     * @param $inQuery
     * @param $fetchType
     * @return array
     */
    function getAllRowsFromTable($inColumns, $inTable, $inQuery, $fetchType) {
        try {
            // Decide if I am going to use a fetch class or an associative array
            switch ($fetchType) {
                case "class":
                    // Convert the first char of $inTable to uppercase, since it's the same name but with a Capital letter (best class practice)
                    $inType = ucfirst($inTable);

                    include_once "model/{$inType}.class.php";

                    // Build query outside of the PDO Prepare instead of binding the params in the PDO since Table and Column names CANNOT be replaced by parameters in PDO.
                    $query = "SELECT $inColumns FROM $inTable $inQuery";
                    $statement = $this->dbholder->prepare($query);
                    $statement->execute();
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

    /** @noinspection PhpInconsistentReturnPointsInspection */
    function getSomeRowsFromTable($inObjectReturnType, $inSortBy, $inQuery, $inColumn, $id, $fetchType) {
        try {
            // Decide if I am going to use a fetch class or an associative array
            switch ($fetchType) {
                case "class":

                    /** @noinspection PhpIncludeInspection */
                    include_once "model/{$inObjectReturnType}.class.php";

                    // Build query outside of the PDO Prepare instead of binding the params in the PDO since Table and Column names CANNOT be replaced by parameters in PDO.
                    $query = "$inQuery WHERE $inColumn = :id ORDER BY :orderby";
                    $statement = $this->dbholder->prepare($query);
                    $statement->execute(array("id"=>$id, "orderby"=>$inSortBy));
                    $statement->setFetchMode(PDO::FETCH_CLASS, $inObjectReturnType);
                    return $statement->fetchAll();
                    break;

                case "array":
                    // Build query outside of the PDO Prepare instead of binding the params in the PDO since Table and Column names CANNOT be replaced by parameters in PDO.
                    $query = "$inQuery where m_e.manager = :id";
                    $statement = $this->dbholder->prepare($query);
                    var_dump($statement);
                    $statement->execute(array("id"=>$id));
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    return $statement->fetchAll();
                    break;

                    break;

            }

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }


    //////////////////////////////////////// START REGISTRATION FUNCTIONS ////////////////////////////////////////
    function registerEvent($eventId, $attendeeId) {
        try {
            $statement = $this->dbholder->prepare("INSERT into attendee_event (event,attendee) VALUES (:eventID,:attendeeID)");
            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
            return $this->dbholder->lastInsertId();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }

    function unregisterEvent($eventId, $attendeeId) {
        try {
            $statement = $this->dbholder->prepare("DELETE from attendee_event WHERE event = :eventID AND attendee = :attendeeID");
            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
            return $this->dbholder->lastInsertId();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }

    function registerSession($sessionId, $attendeeId) {
        try {
            $statement = $this->dbholder->prepare("INSERT into attendee_session (session,attendee) VALUES (:sessionID,:attendeeID)");
            $statement->execute(array("sessionID" => $sessionId, "attendeeID" => $attendeeId));
            return $this->dbholder->lastInsertId();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }

    function unregisterSession($sessionId, $attendeeId) {
        try {
            $statement = $this->dbholder->prepare("DELETE from attendee_session WHERE session = :sessionID AND attendee = :attendeeID");
            $statement->execute(array("sessionID" => $sessionId, "attendeeID" => $attendeeId));
            return $this->dbholder->lastInsertId();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }


    function checkIfRegisteredEvent($eventId, $attendeeId) {
        try {
            $statement = $this->dbholder->prepare("SELECT * from attendee_event WHERE event = :eventID AND attendee = :attendeeID");
            $statement->execute(array("eventID" => $eventId, "attendeeID" => $attendeeId));
            $data = $statement->fetchAll();
            if (isset($data[0])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }

    function checkIfRegisteredSession($sessionId, $attendeeId) {
        try {
            $statement = $this->dbholder->prepare("SELECT * from attendee_session WHERE session = :sessionID AND attendee = :attendeeID");
            $statement->execute(array("sessionID" => $sessionId, "attendeeID" => $attendeeId));
            $data = $statement->fetchAll();
            if (isset($data[0])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        }
    }
    //////////////////////////////////////// END REGISTRATION FUNCTIONS ////////////////////////////////////////


}
