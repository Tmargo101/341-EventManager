<?php	
	
	class DBAccess {
		private $dbholder;
		
		function __construct() {
			try {
				$this->dbholder = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
			} catch(PDOException $pdoException) {
				echo $pdoException->getMessage();
				die("<br>Bad Database");
			} 
		}
		
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
		
		// TODO: Check if username exists...
		function createAttendee($newUserName, $newUserPassword) {
			try {
				$data = array();
				$statement = $this->dbholder->prepare("INSERT into attendee (name,password,role) VALUES (:username,:password,3)");
				$statement->execute(array("username"=>$newUserName,"password"=>$newUserPassword));
				return $this->dbholder->lastInsertId();
				
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				return -1;
			}
		}
		
	}	
?>