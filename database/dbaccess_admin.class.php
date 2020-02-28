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

//		function createEvent($inName, $inDateStart, $inDateEnd, $inNumberAllowed, $inVenue) {
//			try {
//				// Check if event exists (under development)
////				$this->getUser($newUserName);
//
//				$data = array();
//
//				$statement = $this->dbholder->prepare("INSERT into event (name,datestart,dateend,numberallowed,venue) VALUES (:name,:datestart,:dateend,:numberallowed,:venue)");
//				$statement->execute(array("name"=>$inName,"datestart"=>$inDateStart,"dateend"=>$inDateEnd,"numberallowed"=>$inNumberAllowed,"venue"=>$inVenue));
//				return $this->dbholder->lastInsertId();
//
//			} catch (PDOException $exception) {
//				echo $exception->getMessage();
//				return -1;
//			}
//		} // End createEvent()

//		function getAllEvents() {
//			try {
////				$data = array();
//
//				include_once "model/Event.class.php";
//
//				$statement = $this->dbholder->prepare("SELECT * FROM event");
//				$statement->execute();
//
//				$statement->setFetchMode(PDO::FETCH_CLASS,"Event");
//
//                return $statement->fetchAll();
//			} catch (PDOException $exception) {
//				echo $exception->getMessage();
//				return array();
//			}
//		} // End getAllEvents()
//	}
}