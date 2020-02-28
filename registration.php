<?php
include_once 'phpHead.php';
HTMLElements::html_header("Events");
Auth::isLoggedIn();
HTMLElements::nav();

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
HTMLElements::html_footer();
?>
