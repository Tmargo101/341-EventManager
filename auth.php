<?php
	require_once 'phpHead.php';
	
	// If we are processing a login POST, set the auth - username variable to the POST usernameInput
 	if (isset($_POST['usernameInput'])) {$_SESSION['auth']['username'] = $_POST['usernameInput'];}
 	
 	// Depending on the authButton status, process the auth action appropriately.
	if (isset($_POST['authButton'])) {
		switch ($_POST['authButton']){
			case "register":
				Auth::register();
				break;
			case "login":
				Auth::login();
				break;
			case "logout":
				Auth::logout();
				break;
		}
	}
	
?>