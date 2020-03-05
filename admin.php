<?php
include_once 'phpHead.php';

HTMLElements::html_header("Admin Portal");
Auth::isLoggedIn();
HTMLElements::nav();
Auth::isAdmin();

?>

<div class='container col-sm-4 my-5'>
    <h1>Admin Portal</h1>
</div>

<?php
if ($_POST != null) {
    CRUD::whatToDo($_POST, $currentUserLevelController);
}

echo HTMLElements::tableDiv("All Users", $currentUserLevelController, "getAllAttendees", "Attendee");

echo HTMLElements::tableDiv("All Venues", $currentUserLevelController, "getAllVenues", "Venue");

echo HTMLElements::tableDiv("All Events", $currentUserLevelController, "getAllEvents", "Event");

echo HTMLElements::tableDiv("All Sessions", $currentUserLevelController, "getAllSessions", "Session");


?>

<?php
HTMLElements::html_footer();
?>
