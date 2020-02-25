<?php
    session_name('EventManagerSession');
    session_start();

    require_once "libraries/auth.class.php";

	// If we are processing a login POST, set the auth - username variable to the POST usernameInput
 	if (isset($_POST['usernameInput'])) {$_SESSION['auth']['username'] = $_POST['usernameInput'];}
 	
 	// Depending on the authButton status, process the auth action appropriately.
	if (isset($_POST['authButton'])) {
		switch ($_POST['authButton']){
			case "register":
				Auth::register($_POST['usernameInput'], $_POST['passwordInput']);
				break;
			case "login":
				Auth::login($_POST['usernameInput'], $_POST['passwordInput']);
				var_dump($_POST);
				break;
			case "logout":
				Auth::logout();
				break;
		}
	}
	
?>