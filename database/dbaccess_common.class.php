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

//		function getItem($inColumns, $inTable, $inType, $inQuery) {
//            try {
//                include_once "objects/Attendee.class.php";
//                $data = array();
//                $statement = $this->dbholder->prepare("SELECT :columns FROM :tab WHERE :id = :query");
//                $statement->execute(array("columns"=>$inColumns,"tab"=>$inTable,"id"=>$inType,"query"=>$inQuery));
//                $statement->setFetchMode(PDO::FETCH_CLASS,"Attendee");
//                $data = $statement->fetchAll();
//
//                return $data;
//            } catch (PDOException $exception) {
//                echo $exception->getMessage();
//                return array();
//            }
//        }




	}
