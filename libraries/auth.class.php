<?php
/*
	All authentication functions are handled in this file
	
	Author: Thomas Margosian
	Date created: 2/20/20
*/
	require_once 'database/dbaccess_common.class.php';
	
	class Auth {
		
		static function login($inUsername, $inPassword) {
			$db = new DBAccess();
			// Get user from the attendee table
			$attendeeDataArray = $db->getAttendee($inUsername);
			
			// Check if the attendeeDataArray has values.  If it is empty, the user does not exist.
			if (isset($attendeeDataArray[0])) {			
				
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
			$db = new DBAccess();
			if ($db->createAttendee($inUsername, password_hash($inPassword, PASSWORD_DEFAULT)) != false) {
//				$this->login($inUsername, $inPassword);
			} else {
				return "Cannot register user.";
			}
		}
		
		// Return true or false.  Input: username, what role you want to check
		static function isUserAn($userInput, $roleInput) {
			$db = new DBAccess();
			$attendeeDataArray = $db->getUser($userInput);
		}
		
		static function isLoggedIn() {
			if (!isset($_SESSION['auth']['authCorrect']) || $_SESSION['auth']['authCorrect'] != "true") {
				if (!isset($_SESSION['auth'])) {
					$_SESSION['auth'] = array();
				}
				$_SESSION['auth']['authCorrect'] = "";
	// 			header("Location: index.php");
				echo "<div class='container col-md-4 mt-5 mb-5'><h1>Not logged in</h1></div><div class='container col-md-4 mt-5 mb-5'><h3>Must have made a wrong turn...</h3>  <h4>Please login to access this page.</h4><div class='container col-md-4 my-5'><h5>Redirecting you to Login automatically in 5 seconds...</h5></div><div class='container col-md-4 mt-5 mb-5'><a href='index.php' class='btn btn-primary'>Login now</a></div>";
				header("Refresh:5; url=index.php");
				die();
			}// End if(authCorrect!=true)
		} // End isLoggedIn()
		
		static function isAdmin() {
			if ($_SESSION['auth']['role'] != "admin") {
				echo "<div class='container col-md-4 mt-5 mb-5'><h1>Unauthorized</h1></div><div class='container col-md-4 mt-5 mb-5'><h3>Must have made a wrong turn...</h3><h4>Please login as admin to access this page.</h4><div class='container my-5'><h5>Redirecting you to your events portal automatically in 5 seconds...</h5></div><div class='container my-5'><a href='index.php' class='btn btn-primary'>Go now</a></div>";
				header("Refresh:5; url=events.php");
				die();

			}
		}
	} // End Auth class
		
?>