<?php
/*
This is the login page for the EventManger
If the user has already authenticated, they will be passed to the events page.
If the user has not authenticated, they will be prompted to authenticate or register

Author: Thomas Margosian
Date created: 2/20/20
*/

require_once('phpHead.php');

// Move $_POST values into a session array $_SESSION['authPOST'] to deal with whatever redirect bug exists
if (!isset($_SESSION['authPOST'])) {
    $_SESSION['POST'] = array();
}
foreach ($_POST as $key => $value) {
    $_SESSION['authPOST'][$key] = Sanitize::sanitizeString($value);
}

// Depending on the authButton status, process the auth action appropriately.
if (isset($_POST['authButton'])) {
    switch ($_POST['authButton']) {
        case "register":
            Auth::register($_SESSION['authPOST']['usernameInput'], $_SESSION['authPOST']['passwordInput']);
            break;
        case "login":
            Auth::login($_SESSION['authPOST']['usernameInput'], $_SESSION['authPOST']['passwordInput']);
            break;
        case "logout":
            Auth::logout();
            break;
    }
}

if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
    header('Location: events.php');
}
HTMLElements::html_header("Login");
HTMLElements::nav();
?>
<div class=''>
    <div class="container col-md-4 my-5 text-black">
        <?php $APPLICATION_NAME = APPLICATION_NAME; echo "<h1>{$APPLICATION_NAME}</h1>";?>
    </div>
    <div class="container col-xl-4 col-lg-6 col-md-8 col-sm-auto my-5 py-3 px-2 bg-light">
        <h2>Login</h2>
        <form action="index.php" method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="usernameInput"><b>Username</b></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="usernameInput" name="usernameInput"
                           placeholder="Enter Username" <?php if (isset($_SESSION['authPOST']['usernameInput']) && $_SESSION['auth']['authCorrect'] == "badPass" || isset($_SESSION['authPOST']['usernameInput']) && $_SESSION['auth']['authCorrect'] == "noUserFound" || isset($_SESSION['authPOST']['usernameInput']) && $_SESSION['auth']['authCorrect'] == "emptyPassword") {
                        echo 'value="' . $_SESSION['authPOST']['usernameInput'] . '"';
                    } ?> >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="passwordInput"><b>Password</b></label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="passwordInput" name="passwordInput"
                           placeholder="Enter Password" <?php if (isset($_SESSION['authPOST']['usernameInput']) && $_SESSION['auth']['authCorrect'] == "badPass" || isset($_SESSION['authPOST']['usernameInput']) && $_SESSION['auth']['authCorrect'] == "noUserFound") {
                        echo 'autofocus';
                    } ?>>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg" name='authButton' value='login'>Login</button>
                <!-- 			<button type="submit" name="register" class="btn btn-primary">Register</button> -->
            </div>
            <div class="form-group">
                <?php
                // TODO: Figure out how to stop these from displaying if I close the tab and re-open it.
                if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "emptyForm") {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h5>Error:</h5>Username and Password were left blank.<br>Please enter a Username and Password and try again.</div>";
                }
                if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "emptyUsername") {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h5>Error:</h5>Username was left blank.<br>Please enter a Username and Password and try again.</div>";
                }
                if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "emptyPassword") {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h5>Error:</h5>Password was left blank.<br>Please enter a Password and try again.</div>";
                }
                if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "noUserFound") {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h5>Error:</h5>User '{$_SESSION['authPOST']['usernameInput']}' does not exist.<br><br>If you would like to create a new attendee account with these credentials, enter the new account's password in the password field and click the button below.<div class='mt-3'><button type='submit' name='authButton' value='register' class='btn btn-primary'>Create a new attendee account</button></div></div>";
                }
                if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "badPass") {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h5>Error:</h5>Password for user '{$_SESSION['authPOST']['usernameInput']}' was incorrect. Please try again.</div>";
                }
                if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "unauthorized") {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h5>Error:</h5>You need to login or register to access this page<div class='mt-3'><button type='submit' name='authButton' value='register' class='btn btn-primary'>Create a new attendee account</button></div></div>";
                }
                if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "newUserRegistered") {
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h5>Created:</h5>Account '{$_SESSION['authPOST']['usernameInput']}' has been created.  Please login again with the same credentials.</div>";
                }
                ?></div>
        </form>
    </div>
</div>

<?php
echo HTMLElements::html_footer();
?>
