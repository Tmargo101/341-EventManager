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
    HTMLElements::tableDiv("All Users", $currentUserLevelController, "getAllAttendees");

    HTMLElements::tableDiv("All Venues", $currentUserLevelController, "getAllVenues");

    HTMLElements::tableDiv("All Events", $currentUserLevelController, "getAllEvents");

    HTMLElements::tableDiv("All Sessions", $currentUserLevelController, "getAllSessions");

}
?>

<?php
HTMLElements::html_footer();
?>
