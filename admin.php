<?php
	include_once 'phpHead.php';
	Elements::html_header("Admin Portal","/assets/css/style.css");
	Auth::isLoggedIn();
	Elements::nav();
	Auth::isAdmin();

		echo "<h1>Admin portal</h1>";
?>
<div class=''>
	<div class='container col-sm-4 bg-light'>
		<h1>Users</h1>
	</div>
</div>


<?php
	Elements::html_footer();
?>
