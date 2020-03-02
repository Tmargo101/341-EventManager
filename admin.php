<?php /** @noinspection PhpUndefinedMethodInspection */
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

//if ($_POST != null && $_POST['action'] == "addAttendee") {
//    echo $currentUserLevelController::createNewAttendee($_POST);
//}
//
//if ($_POST != null && $_POST['action'] == "addVenue") {
//    echo $currentUserLevelController::createNewVenue($_POST);
//}
//
//if ($_POST != null && $_POST['action'] == "addEvent") {
//    echo $currentUserLevelController::createNewEvent($_POST);
//}
//
//if ($_POST != null && $_POST['action'] == "addSession") {
//    echo $currentUserLevelController::createNewSession($_POST);
//}

HTMLElements::tableDiv("All Users", $currentUserLevelController, "getAllAttendees");

HTMLElements::tableDiv("All Venues", $currentUserLevelController, "getAllVenues");

HTMLElements::tableDiv("All Events", $currentUserLevelController, "getAllEvents");

HTMLElements::tableDiv("All Sessions", $currentUserLevelController, "getAllSessions");


?>

<?php
HTMLElements::html_footer();
?>
