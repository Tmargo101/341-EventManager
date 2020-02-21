<?php
	/*
	This is the default page for the EventManger
	If the user has already authenticated, they will be passed to the events page.
	If the user has not authenticated, they will be prompted to authenticate or register
	
	Author: Thomas Margosian
	Date created: 2/20/20
	*/

	require_once('phpHead.php');

// 	var_dump($_POST); //DOES NOT WORK (POST ARRAY EMPTY)
//  var_dump($_SESSION); //WORKS

Elements::html_header("Login","/assets/css/style.css");
		// If we are processing a login POST, set the auth - username variable to the POST usernameInput
	if (isset($_POST['usernameInput'])) {
// 		$_POST['usernameInput'] = Sanitize::sanitizeString($_POST['usernameInput']);
		$_SESSION['auth']['username'] = $_POST['usernameInput'];
	}

	// Depending on the authButton status, process the auth action appropriately.
	if (isset($_POST['authButton'])) {
		switch ($_POST['authButton']){
			case "register":
				Auth::register($_POST['usernameInput'], $_POST['passwordInput']);
				break;
			case "login":
				Auth::login($_POST['usernameInput'], $_POST['passwordInput']);
				break;
			case "logout":
				Auth::logout();
				break;
		}
	}

	if(isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
		header('Location: events.php');
	}
	
	Elements::nav();
?>
<div class=''>
	<div class="container col-md-4 my-5">
			<h1>Event Manager</h1>
	</div>
	<div class="container col-md-4 my-5 py-3 px-2 bg-light">
		<h2>Login</h2>
		<form action="index.php" method="post">
			<div class="form-group">
 				<label class="control-label" for="usernameInput"><b>Username</b></label>
                <input type="text" class="form-control" name="usernameInput" placeholder="Enter Username" <?php if(isset($_SESSION['auth']['username']) && $_SESSION['auth']['authCorrect'] == "badPass" || isset($_SESSION['auth']['username']) && $_SESSION['auth']['authCorrect'] == "noUserFound"){echo 'value="'.$_SESSION['auth']['username'].'" autofocus';}?> >
            </div>
			<div class="form-group">
 				<label for="passwordInput"><b>Password</b></label>
                    <input type="password" class="form-control" name="passwordInput" placeholder="Enter Password">
            </div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name='authButton' value='login'>Login</button>
	<!-- 			<button type="submit" name="register" class="btn btn-primary">Register</button> -->
			</div>
			<div class="form-group">
			<?php
				if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "noUserFound") {echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error:</strong> User does not exist. Would you like to create a new attendee account with these credentials?.<div class='mt-3'><button type='submit' name='authButton' value='register' class='btn btn-primary'>Create a new attendee account</button></div></div>";}
				if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "badPass") {echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error:</strong> Password for user was incorrect. Please try again.</div>";}
				if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "unauthorized") {echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error:</strong> You need to login or register to access this page<div class='mt-3'><button type='submit' name='authButton' value='register' class='btn btn-primary'>Create a new attendee account</button></div></div>";}
	
			?></div>
		</form>
	</div>
</div>

<?php
	echo Elements::html_footer();
7?>
