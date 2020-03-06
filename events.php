<?php
include_once 'phpHead.php';

HTMLElements::html_header("Events");
Auth::isLoggedIn();
HTMLElements::nav();


?>

<div class='container col-sm-4 my-5'>
    <h1>Events Portal</h1>
</div>

<?php
//var_dump($_POST);
if ($_POST != null) {
    CRUD::whatToDo($_POST, $currentUserLevelController);
}

echo HTMLElements::tableDiv("Events I am attending", $currentUserLevelController, "getEventsAttending", "Event");

echo HTMLElements::tableDiv("Sessions I am attending", $currentUserLevelController, "getSessionsAttending", "Session");

?>

<?php
HTMLElements::html_footer();
?>
