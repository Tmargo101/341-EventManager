<?php
	session_name("EventManagerSession");
	session_start();
	include_once 'assets/scripts/MyUtils.class.php';
	
	echo "<h1>Welcome to the {$_SESSION['auth']['role']} portal</h1>";
	var_dump($_SESSION);
?>