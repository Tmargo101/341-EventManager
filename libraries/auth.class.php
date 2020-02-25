<?php
/*
	All authentication functions are handled in this file
	
	Author: Thomas Margosian
	Date created: 2/20/20
*/

	class AuthDBAccess {
        protected $dbholder;

        function __construct() {
            try {
                $this->dbholder = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
            } catch(PDOException $pdoException) {
                echo $pdoException->getMessage();
                die("<br>Bad Database");
            }
        }

        public function getUser($inUserName) {
            try {
//                $data = array();
                $statement = $this->dbholder->prepare("SELECT * FROM attendee WHERE name = :username");
                $statement->execute(array("username"=>$inUserName));

                return $statement->fetchAll();
            } catch (PDOException $exception) {
                echo $exception->getMessage();
                return array();
            } // End catch
        }

        public function createAttendee($newUserName, $newUserPassword) {
            // Check if user exists (under development)
            $previousUserArray = $this->getUser($newUserName);
            if (!isset($previousUserArray[0])) {
                try {
//                    $data = array();
                    $statement = $this->dbholder->prepare("INSERT into attendee (name,password,role) VALUES (:username,:password,3)");
                    $statement->execute(array("username"=>$newUserName,"password"=>$newUserPassword));
                    $_SESSION['auth']['authCorrect'] = "newUserRegistered";
                    return $this->dbholder->lastInsertId();

                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                    return -1;
                }
            }
            return null;
        }

    } //End Class AuthDBAccess

	class Auth {
		
		static function login($inUsername, $inPassword) {

			$db = new AuthDBAccess();
			// Get user from the attendee table
			$attendeeDataArray = $db->getUser($inUsername);
			
			// Check if the attendeeDataArray has values.  If it is empty, the user does not exist.
			if (isset($attendeeDataArray[0])) {
                $_SESSION['auth']['username'] = $inUsername;

				// Verify password hash.  If correct, determine user role and pass to events page.
				if (password_verify($inPassword, $attendeeDataArray[0]['password'])){
					switch ($attendeeDataArray[0]['role']){
						case 1:
							$_SESSION['auth']['authCorrect'] = "true";
							$_SESSION['auth']['role'] = "admin";
							break;
						case 2:
							$_SESSION['auth']['authCorrect'] = "true";
							$_SESSION['auth']['role'] = "manager";
							break;
						case 3:
							$_SESSION['auth']['authCorrect'] = "true";
							$_SESSION['auth']['role'] = "attendee";
							break;
					}
					header("Location: events.php");
				} else {
					// If the password is incorrect, set authCorrect to badPass and send back to login
					$_SESSION['auth']['authCorrect'] = "badPass";
					header("Location: index.php");
				}
			} else {
				// If the user was not found in DB, set authCorrect to badUser and send back to login
				$_SESSION['auth']['authCorrect'] = "noUserFound";
				header("Location: index.php");
			}
	
		}
		
		static function logout() {
			session_unset();
			session_destroy();
			header('Location: index.php');
		}
		
		static function register($inUsername, $inPassword) {
			$db = new AuthDBAccess();
			if ($db->createAttendee($inUsername, password_hash($inPassword, PASSWORD_DEFAULT)) != false) {
//				$this->login($inUsername, $inPassword);
                return "User Registered";
			} else {
				return "Cannot register user.";
			}
		}
		
		// Return true or false.  Input: username, what role you want to check
//		static function isUserAn($userInput, $roleInput) {
//			$db = new DBAccess();
//			$attendeeDataArray = $db->getUser($userInput);
//		}
		
		static function isLoggedIn() {
			if (!isset($_SESSION['auth']['authCorrect']) || $_SESSION['auth']['authCorrect'] != "true") {
				if (!isset($_SESSION['auth'])) {
					$_SESSION['auth'] = array();
				}
				$_SESSION['auth']['authCorrect'] = "";
				HTMLElements::notLoggedIn();
                header("Refresh:5; url=index.php");
				die();
			}// End if(authCorrect!=true)
		} // End isLoggedIn()
		
		static function isAdmin() {
			if ($_SESSION['auth']['role'] != "admin") {
			    HTMLElements::notAdmin();
				header("Refresh:5; url=index.php");
				die();

			}
		} // End isAdmin()
	} // End Auth class
		
