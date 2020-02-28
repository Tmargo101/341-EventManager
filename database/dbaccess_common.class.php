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
				$this->dbholder = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
			} catch(PDOException $pdoException) {
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
                switch($fetchType) {
                    case "class":
                        // Convert the first char of $inTable to uppercase, since it's the same name but with a Capital letter (best class practice)
                        $inType = ucfirst($inTable);

                        include_once "model/{$inType}.class.php";

                        // Build query outside of the PDO Prepare instead of binding the params in the PDO since Table and Column names CANNOT be replaced by parameters in PDO.
                        $query = "SELECT $inColumns FROM $inTable $inQuery";
                        $statement = $this->dbholder->prepare($query);
                        $statement->execute();
                        $statement->setFetchMode(PDO::FETCH_CLASS,$inType);
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





    }
