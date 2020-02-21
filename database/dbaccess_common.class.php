<?php	
/*
	This is the superclass for DBAccess.  Functions in this class can be called from anywhere in the site, including the login page.
	
	Author: Thomas Margosian
	Date created: 2/20/20
*/
	
	class DBAccess {
		protected $dbholder;
		
		function __construct() {
			try {
				$this->dbholder = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
			} catch(PDOException $pdoException) {
				echo $pdoException->getMessage();
				die("<br>Bad Database");
			} 
		}
		
		function getAttendee($inUserName) {
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
				// Check if user exists (under development)
				$previousUserArray = $this->getAttendee($newUserName);
				if (!isset($previousUserArray[0])) {
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
		
	}	
?>