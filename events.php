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
if ($_POST != null) {
    CRUD::whatToDo($_POST, $currentUserLevelController);
}

HTMLElements::tableDiv("All Events", $currentUserLevelController, "getAllEvents");

?>

<?php
HTMLElements::html_footer();
?>
