<?php
	include_once 'phpHead.php';
	Elements::html_header("Events","/assets/css/style.css");
	Auth::isLoggedIn();
	Elements::nav();
	
		echo "<h1>Events Portal</h1>";
// 		echo "<form action='index.php' method='post'><button type='submit' class='btn btn-primary' name='authButton' value='logout'>Logout</button></form>";
	
		
?>

<div class='mt-5'>
	<div class='container col-sm-4 bg-light'>
		<h1>All Events</h1>
	</div>
</div>


<?php
	Elements::html_footer();
?>
