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
if ($_POST != null) {
    CRUD::whatToDo($_POST, $currentUserLevelController);
}

echo HTMLElements::tableDiv("Your Events", $currentUserLevelController, "getYourEvents");

echo HTMLElements::tableDiv("Your Event's Sessions", $currentUserLevelController, "getYourSessions");

echo HTMLElements::tableDiv("Your Event's Attendees", $currentUserLevelController, "getYourEventAttendees");

echo HTMLElements::tableDiv("Your Session's Attendees", $currentUserLevelController, "getYourSessionAttendees");

?>

<?php
HTMLElements::html_footer();
?>
