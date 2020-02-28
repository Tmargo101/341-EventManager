<?php
	session_name('EventManagerSession');
	session_start();
	
	foreach (glob("libraries/*.class.php") as $filename) {
        /** @noinspection PhpIncludeInspection */
        require_once ($filename);
	}
	
	if (!isset($_SESSION['auth'])) {
		$_SESSION['auth'] = array();
	}

