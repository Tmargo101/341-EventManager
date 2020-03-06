<?php
include_once 'phpHead.php';

HTMLElements::html_header("Events");
Auth::isLoggedIn();
HTMLElements::nav();


?>

<div class='container col-sm-4 my-5'>
    <h1>Registration Portal</h1>
</div>

<?php
if ($_POST != null) {
    CRUD::whatToDo($_POST, $currentUserLevelController);
}

echo HTMLElements::tableDiv("All Events", $currentUserLevelController, "getAllEvents", "Event");

echo HTMLElements::tableDiv("All Sessions", $currentUserLevelController, "getAllSessions", "Session");

?>

<?php
HTMLElements::html_footer();
?>
