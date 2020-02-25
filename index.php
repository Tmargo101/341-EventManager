<?php
	/*
	This is the login page for the EventManger
	If the user has already authenticated, they will be passed to the events page.
	If the user has not authenticated, they will be prompted to authenticate or register
	
	Author: Thomas Margosian
	Date created: 2/20/20
	*/

	require_once('phpHead.php');

// 	var_dump($_POST); //DOES NOT WORK (POST ARRAY EMPTY)
//  var_dump($_SESSION); //WORKS

    HTMLElements::html_header("Login");

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
			    // How does this work if we cannot echo out the POST array???
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
	
	HTMLElements::nav();
?>
<div class=''>
	<div class="container col-md-4 my-5">
			<h1>Event Manager</h1>
	</div>
	<div class="container col-md-4 my-5 py-3 px-2 bg-light">
		<h2>Login</h2>
		<form action="index.php" method="post">
			<div class="form-group row">
                <label class="col-sm-3 col-form-label" for="usernameInput"><b>Username</b></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="usernameInput" name="usernameInput" placeholder="Enter Username" <?php if(isset($_SESSION['auth']['username']) && $_SESSION['auth']['authCorrect'] == "badPass" || isset($_SESSION['auth']['username']) && $_SESSION['auth']['authCorrect'] == "noUserFound"){echo 'value="'.$_SESSION['auth']['username'].'" autofocus';}?> >
                </div>
            </div>
			<div class="form-group row">
 				<label class="col-sm-3 col-form-label" for="passwordInput"><b>Password</b></label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="passwordInput" name="passwordInput" placeholder="Enter Password">
                </div>
            </div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-lg" name='authButton' value='login'>Login</button>
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
	echo HTMLElements::html_footer();
?>
