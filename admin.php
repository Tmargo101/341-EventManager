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
if ($_GET != null) {
    CRUD::whatToDo($_GET);
} else {
    HTMLElements::tableDiv("Users", $currentUserLevelController, "getAllAttendees");

    HTMLElements::tableDiv("Venues", $currentUserLevelController, "getAllVenues");

    HTMLElements::tableDiv("Events", $currentUserLevelController, "getAllEvents");

    HTMLElements::tableDiv("Sessions", $currentUserLevelController, "getAllSessions");

}
?>

<?php
HTMLElements::html_footer();
?>
