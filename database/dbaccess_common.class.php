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

		function getItem($inColumns, $inTable, $inType, $inQuery) {
            try {
                include_once "model/Attendee.class.php";
                $statement = $this->dbholder->prepare("SELECT :columns FROM :tab WHERE :id = :query");
                $statement->execute(array("columns"=>$inColumns,"tab"=>$inTable,"id"=>$inType,"query"=>$inQuery));
                $statement->setFetchMode(PDO::FETCH_CLASS,"Attendee");
                $data = $statement->fetchAll();

                return $data;
            } catch (PDOException $exception) {
                echo $exception->getMessage();
                return array();
            }
        }

//        function getAllItems($inColumns, $inTable, $inType) {
//		    try {
//                include_once "model/{$inType}.class.php";
//                $statement = $this->dbholder->prepare("SELECT :columnQuery FROM :tableQuery");
//                $statement->execute(array("columnQuery"=>$inColumns,"tableQuery"=>$inTable));
//                $statement->setFetchMode(PDO::FETCH_CLASS,"Attendee");
//                $data = $statement->fetchAll();
//                return $data;
//
//            } catch (PDOException $exception) {
//                echo $exception->getMessage();
//                return array();
//            }
//        }

        function getAllRowsFromTable($inColumns, $inTable) {
            try {
                // Convert the first char of $inTable to uppercase, since it's the same name but with a Capital letter (best class practice)
                $inType = ucfirst($inTable);

                include_once "model/{$inType}.class.php";

                // Build query outside of the PDO Prepare instead of binding the params in the PDO since Table and Column names CANNOT be replaced by parameters in PDO.
                $query = "SELECT {$inColumns} FROM {$inTable}";
                $statement = $this->dbholder->prepare($query);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_CLASS,$inType);
                $data = $statement->fetchAll();
                return $data;

            } catch (PDOException $exception) {
                echo $exception->getMessage();
                return array();
            }
        }





    }
