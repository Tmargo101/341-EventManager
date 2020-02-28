<?php
	include_once 'phpHead.php';
    include_once "controllers/attendeeController.class.php";
    HTMLElements::html_header("Events");
	Auth::isLoggedIn();
	HTMLElements::nav();
	
		echo "<h1>Events Portal</h1>";
// 		echo "<form action='index.php' method='post'><button type='submit' class='btn btn-primary' name='authButton' value='logout'>Logout</button></form>";
	
		
?>

<?php HTMLElements::tableDiv("All Sessions","AttendeeController","getAllEvents");?>

<?php
	HTMLElements::html_footer();
?>
