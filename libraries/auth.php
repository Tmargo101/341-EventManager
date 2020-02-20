<?php
	session_name('EventManagerSession');
	session_start();
	
	require_once '../database/pdo.class.php';
	$db = new DBAccess();

	// If the register button was pressed instead of submit, create a new attendee with the username / password specified
	if (isset($_POST['register'])) {	
		$db->createAttendee($_POST['usernameInput'], password_hash($_POST['passwordInput'], PASSWORD_DEFAULT));
		
		
	// If the register button was not pressed, begin the login action
	} else {
		
		// Get user from the attendee table
		$attendeeDataArray = $db->getUser($_POST['usernameInput']);
		
		// Check if the attendeeDataArray has values.  If it is empty, the user does not exist.
		if (isset($attendeeDataArray[0])) {			
			
			// Verify password hash.  If correct, determine user role and pass to events page.
			if (password_verify($_POST['passwordInput'], $attendeeDataArray[0]['password'])){
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
				header("Location: ../events.php");
			} else {
				// If the password is incorrect, set authCorrect to badPass and send back to login
				$_SESSION['auth']['authCorrect'] = "badPass";
				header("Location: ../index.php");
			}
		} else {
			// If the user was not found in DB, set authCorrect to badUser and send back to login
			$_SESSION['auth']['authCorrect'] = "noUserFound";
			header("Location: ../index.php");
		}

	}
?>