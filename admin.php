<?php
include_once 'phpHead.php';
include_once "controllers/adminController.class.php";

HTMLElements::html_header("Admin Portal");
Auth::isLoggedIn();
HTMLElements::nav();
Auth::isAdmin();

?>

<div class='container col-sm-4 my-5'>
    <h1>Admin Portal</h1>
</div>

<?php HTMLElements::tableDiv("Users", "AdminController", "getAllAttendees"); ?>

<?php HTMLElements::tableDiv("Venues", "AdminController", "getAllVenues"); ?>

<?php HTMLElements::tableDiv("Events", "AdminController", "getAllEvents"); ?>

<?php HTMLElements::tableDiv("Sessions", "AdminController", "getAllSessions"); ?>

<?php
HTMLElements::html_footer();
?>
