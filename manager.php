<?php
include_once 'phpHead.php';

HTMLElements::html_header("Manager Portal");
Auth::isLoggedIn();
HTMLElements::nav();
Auth::isManager();

?>

<div class='container col-sm-4 my-5'>
    <h1>Manager Portal</h1>
</div>

<?php
if ($_GET != null) {
    CRUD::whatToDo($_GET, $currentUserLevelController);
} else {

    HTMLElements::tableDiv("Your Events", $currentUserLevelController, "getYourEvents");

    HTMLElements::tableDiv("Your Event's Sessions", $currentUserLevelController, "getYourSessions");

    HTMLElements::tableDiv("Your Attendees", $currentUserLevelController, "getYourAttendees");

}
?>

<?php
HTMLElements::html_footer();
?>
