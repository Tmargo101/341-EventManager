<?php
	session_name("EventManagerSession");
	session_start();
	
	include_once 'libraries/utilities.class.php';
	echo Utilities::html_header("Login","/assets/css/style.css");

	if ($_SESSION['auth']['authCorrect'] == "true") {
		echo "<h1>Welcome to the {$_SESSION['auth']['role']} portal</h1>";
		echo "<form action='libraries/auth.php' method='post'><button type='submit' class='btn btn-primary' name='authButton' value='logout'>Logout</button></form>";
		var_dump($_SESSION);
	} else {
		if (!isset($_SESSION['auth'])) {$_SESSION['auth'] = array();}$_SESSION['auth']['authCorrect'] = "unauthorized";
		header("Location: index.php");
	}
	
	// Move the if session auth is true and else logic to MyUtils as a a static function MyUtils::ISLOGGEDIN
?>

