<?php
	session_name('EventManagerSession');
	session_start();
	
	// Create the auth array if not created
	if (!isset($_SESSION['auth'])) {$_SESSION['auth'] = array();}
	
	require_once 'assets/scripts/MyUtils.class.php';
	echo MyUtils::html_header("Login","/assets/css/style.css");
?>

<div class="container col-md-4 mt-5">
	<h1>Login</h1>
	<form action="libraries/auth.php" method="post">
		<div class="form-group">
			<label class="control-label" id="username">Username</label>
			<input type="text" class="form-control" name="usernameInput">
		</div>
		<div class="form-group">
			<label id="passwordInput">Password</label>
			<input type="password" class="form-control" name="passwordInput">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Login</button>
<!-- 			<button type="submit" name="register" class="btn btn-primary">Register</button> -->
		</div>
		<div class="form-group">
		<?php
// 			var_dump($_SESSION);
			if ($_SESSION['auth']['authCorrect'] == "noUserFound") {echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error:</strong> User does not exist. Would you like to create a new attendee account with these credentials?.<div class='mt-3'><button type='submit' name='register' class='btn btn-primary'>Create a new attendee account</button></div></div>";}
			if ($_SESSION['auth']['authCorrect'] == "badPass") {echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error:</strong> Password for user was incorrect. Please try again.</div>";}
		?></div>
	</form>
</div>

<?php
	echo MyUtils::html_footer();	
?>