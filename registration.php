<?php
	include_once 'phpHead.php';
	Elements::html_header("Events","/assets/css/style.css");
	Auth::isLoggedIn();
	Elements::nav();
	
		echo "<h1>Registration Portal</h1>";
/*
		var_dump($_SESSION);
 		echo "User is an ".Auth::getUserLevel($_SESSION['auth']['username']);
*/
?>
<div class=''>
	<div class='container col-sm-4 bg-light'>
		<h1>Users</h1>
	</div>
</div>


<?php
	Elements::html_footer();
?>
