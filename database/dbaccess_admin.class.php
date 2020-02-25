<?php	
	include_once 'dbaccess_common.class.php';
	
	class DBAccess_Admin extends DBAccess {


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