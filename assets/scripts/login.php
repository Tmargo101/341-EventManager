<?php
	session_start();
	require_once 'pdo.class.php';
	$db = new DBAccess();

	// If the register button was pressed instead of submit, create a new attendee with the username / password specified
	if (isset($_POST['register'])) {	
		$db->createAttendee($_POST['usernameInput'], password_hash($_POST['passwordInput'], PASSWORD_DEFAULT));
	} else {
		$attendeeDataArray = $db->getUser($_POST['usernameInput']);
		
		// Check if the attendeeDataArray has values.  If it is empty, the user does not exist.
		if (isset($attendeeDataArray[0])) {
// 			echo "<h2>User Exists in database</h2>";
// 			var_dump($attendeeDataArray);
			
			// Verify password hash.  If correct, determine user role and pass to appropriate page.
			if (password_verify($_POST['passwordInput'], $attendeeDataArray[0]['password'])){
// 				echo "<h2>password was correct for user {$attendeeDataArray[0]['name']}.</h2>";
				switch ($attendeeDataArray[0]['role']){
					case 1:
// 						echo "<h1>User is of type admin</h1>";
						header("Location: ../../admin.php");
						break;
					case 2:
// 						echo "<h1>User is of type manager</h1>";
						header("Location: ../../manager.php");
						break;
					case 3:
// 						echo "<h1>User is of type Attendee</h1>";
						header("Location: ../../attendee.php");
						break;
				}
			} else {
				echo "<h1>Password incorrect.</h1>";
			}
		} else {
			header("Location: ../../index.php?user=notfound");
		}

	}
?>