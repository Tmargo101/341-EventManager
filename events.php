<?php
	include_once 'phpHead.php';
	HTMLElements::html_header("Events");
	Auth::isLoggedIn();
	HTMLElements::nav();
	
		echo "<h1>Events Portal</h1>";
// 		echo "<form action='index.php' method='post'><button type='submit' class='btn btn-primary' name='authButton' value='logout'>Logout</button></form>";
	
		
?>

<div class='mt-5'>
	<div class='container col-sm-4 bg-light'>
		<h1>All Events</h1>
	</div>
</div>


<?php
	HTMLElements::html_footer();
?>
