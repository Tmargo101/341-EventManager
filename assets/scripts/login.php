<?php
	require_once 'pdo.class.php';
	var_dump($_SERVER);
	$db = new DBAccess();
	
	$attendeeDataArray = $pdologin->getUser($_POST['username']);
	
	var_dump($attendeeDataArray);
/*
	foreach ($attendeeDataArray as $key=>$value) {
		echo "Key: " . $key . "  =>. Value: " . $value;
	}
*/
?>