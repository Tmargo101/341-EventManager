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

<div class='container col-sm-4 my-5 bg-light'>
	<div class=''>
		<h1>Users</h1>
        <?php AdminController::getAllAttendees();?>
	</div>
</div>

<div class='container col-sm-8 my-5 bg-light'>
	<div class=''>
		<h1>Events</h1>

	</div>
</div>

<div class='container col-sm-8 my-5 bg-light'>
    <div class=''>
        <h1>Events</h1>

    </div>
</div>


<?php
	HTMLElements::html_footer();
?>
