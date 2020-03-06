<?php

session_name('EventManagerSession');
session_start();

include_once 'CONSTANTS.php';

foreach (glob("libraries/*.class.php") as $filename) {
    /** @noinspection PhpIncludeInspection */
    require_once($filename);
}

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = array();
}

// Set which controller to use & the controller string to pass to the tableCreation method
$currentUserLevelController = "";
if (isset($_SESSION['auth']['role'])) {
    switch ($_SESSION['auth']['role']) {
        case "admin":
            require_once 'controllers/adminController.class.php';
            $currentUserLevelController = "AdminController";
            break;
        case "manager":
            require_once 'controllers/managerController.class.php';
            $currentUserLevelController = "ManagerController";
            break;
        case "attendee":
            require_once 'controllers/attendeeController.class.php';
            $currentUserLevelController = "AttendeeController";
            break;
    }
}


