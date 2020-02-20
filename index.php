<?php
	session_name('EventManagerSession');
	session_start();
	require_once 'assets/scripts/MyUtils.class.php';
	echo MyUtils::html_header("Login","/assets/css/style.css");
?>

<div class="container col-md-4">
	<h1>Login</h1>
	<form action="assets/scripts/login.php" method="post">
		<div class="form-group">
			<label class="control-label" id="username">Username</label>
			<input type="text" class="form-control" name="usernameInput">
		</div>
		<div class="form-group">
			<label id="passwordInput">Password</label>
			<input type="password" class="form-control" name="passwordInput">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="submit" name="register" class="btn btn-primary">Register</button>
		<?php
			if (isset($_GET['user'])) {echo "<div class='alert alert-danger'><strong>Error:</strong> User not found in database.</div>";}
		?>
	</form>
</div>

<?php
	echo MyUtils::html_footer();	
?>