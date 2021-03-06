<?php
/* Filename: CONSTANTS.php
 * Purpose: Define program constants
 * NOTE: This file excluded from deployment.  To make changes, edit on server.
 *
 * Author: Tom Margosian
 * Date: 3/3/20
 */

// TODO: Create new page (Setup.php) which will import a blank database & set these CONSTANTS, for setup on new servers without CLI interface.  This page should be locked out after any attendees are created.


// Change application-wide constants here
$SET_APPLICATION_NAME = "Event Manager";
$SET_BACKGROUND_IMAGE = "";

// Set application base url
$SET_BASE_URL = "";

// Set MySQL Database credentials
$SET_DB_SERVER = "";
$SET_DB_USER = "";
$SET_DB_PASSWORD = "";
$SET_DB_DATABASE = "";

// Define system-wide constants for project use
define("APPLICATION_NAME", $SET_APPLICATION_NAME);
define("BG_IMAGE", $SET_BACKGROUND_IMAGE);
define("BASE_URL", $SET_BASE_URL);
define("DB_SERVER", $SET_DB_SERVER);
define("DB_USERNAME", $SET_DB_USER);
define("DB_PASSWORD", $SET_DB_PASSWORD);
define("DB_DATABASE", $SET_DB_DATABASE);

