<?php	
	include_once 'dbaccess_common.class.php';
	
	class DBAccess_Admin extends DBAccess {
		
		function __construct() {
			parent::__construct();
		}
		
		
/*
		function getUser($inUserName) {
			try {	
				
				$data = array();
				$statement = $this->dbholder->prepare("SELECT * FROM attendee WHERE name = :username");
				$statement->execute(array("username"=>$inUserName));
				
				$data = $statement->fetchAll();					
				
				return $data;
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				return array();
			} // End catch
		}
		
		function createAttendee($newUserName, $newUserPassword) {
			try {
				// Check if user exists (under development)
				$this->getUser($newUserName);
				
				$data = array();
				$statement = $this->dbholder->prepare("INSERT into attendee (name,password,role) VALUES (:username,:password,3)");
				$statement->execute(array("username"=>$newUserName,"password"=>$newUserPassword));
				return $this->dbholder->lastInsertId();
				
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				return -1;
			}
		}
*/
		
	}	
?>