<?php
	include_once 'phpHead.php';
	
	Utilities::html_header("Events","/assets/css/style.css");
	Utilities::isLoggedIn();
	
		echo "<h1>Welcome to the {$_SESSION['auth']['role']} portal</h1>";
		echo "<form action='libraries/auth.php' method='post'><button type='submit' class='btn btn-primary' name='authButton' value='logout'>Logout</button></form>";
		var_dump($_SESSION);
	
	// Move the if session auth is true and else logic to MyUtils as a a static function MyUtils::ISLOGGEDIN
?>

