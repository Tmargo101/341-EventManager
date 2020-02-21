<?php
	include_once 'phpHead.php';
	Elements::html_header("Admin Portal","/assets/css/style.css");
	Auth::isLoggedIn();
	Elements::nav();
	Auth::isAdmin();

?>
<div class='container col-sm-4 my-5'>
	<h1>Admin Portal</h1>
</div>
<div class='container col-sm-4 my-5 bg-light'>
	<div class=''>
		<h1>Users</h1>
		<?php echo AdminDB::getALlUsersTable();?>
	</div>
</div>
<div class='container col-sm-8 my-5 bg-light'>
	<div class=''>
		<h1>Events</h1>
		<?php echo AdminDB::getAllEventsTable();?>
	</div>
</div>



<?php
	Elements::html_footer();
?>
