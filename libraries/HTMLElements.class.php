<?php
/*
These are static functions which can be called from any page.
IMPORTANT: Only functions which any user level should have access to should be here

Author: Thomas Margosian, Brian French (original html_header and html_footer)
Date created: 2/20/20

*/

class HTMLElements {
    // 	HTML Headers & Footers

    static function html_header($title = "Untitled") {
        $string = <<<END
	<!DOCTYPE html>
	
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>$title</title>
		
		<!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
	</head>
	<body class="text-center">\n
END;
        echo $string;
    } // End html_header()


    static function html_footer($text = "") {
        return "\n$text\n</body>\n</html>";
    }// End html_footer()

    static function notLoggedIn() {
        echo "<!--suppress HtmlUnknownTarget -->
            <div class='container col-md-4 mt-5 mb-5'>
                <h1>Not logged in</h1>
            </div>
            <div class='container col-md-4 mt-5 mb-5'>
                <h3>Must have made a wrong turn...</h3>
                <h4>Please login to access this page.</h4>
            </div>
            <div class='container my-5'>
                <h5>Redirecting you to Login automatically in 5 seconds...</h5>
            </div>
            <div class='container col-md-4 mt-5 mb-5'>
                <a href='index.php' class='btn btn-primary'>Login now</a>
            </div>";
    }

    static function notAdmin() {
        echo "<!--suppress HtmlUnknownTarget -->

                <div class='container col-md-4 mt-5 mb-5'>
                    <h1>Unauthorized</h1>
                </div>
                <div class='container col-md-4 mt-5 mb-5'>
                    <h3>Must have made a wrong turn...</h3>
                    <h4>Please login as admin to access this page.</h4>
                </div>
                <div class='container my-5'>
                    <h5>Redirecting you to your events portal automatically in 5 seconds...</h5>
                </div>
                <div class='container my-5'>
                    <a href='index.php' class='btn btn-primary'>Go now</a>
                </div>";
    }

    static function nav() {
        $nav = <<<END
				<div class='mb-5'>
					<nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
						<a class="navbar-brand" href="#">Event Manager</a>
						<ul class="navbar-nav ml-auto mr-auto">
END;
        if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
            $nav .= <<<END
<!--suppress HtmlUnknownTarget -->
<li class='nav-item mx-5'><a class='nav-link' href='events.php'>Events</a></li>
<li class='nav-item mx-5'><a class='nav-link' href='registration.php'>Registration</a></li>

END;
        }
        if (isset($_SESSION['auth']['authCorrect']) && isset($_SESSION['auth']['role']) && $_SESSION['auth']['role'] == "admin") {
            $nav .= "<!--suppress HtmlUnknownTarget -->
<li class='nav-item mx-5'><a class='nav-link' href='admin.php'>Admin Portal</a></li>";
        }

        if (isset($_SESSION['auth']['authCorrect']) && isset($_SESSION['auth']['role']) && $_SESSION['auth']['role'] == "manager") {
            $nav .= "<!--suppress HtmlUnknownTarget -->
<li class='nav-item mx-5'><a class='nav-link' href='manager.php'>Manage Your Events</a></li>";
        }


        if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
            $nav .= <<<END
<!--suppress HtmlUnknownTarget -->
						</ul>
						<ul class='navbar-nav'>
							<li class='navbar-brand mt-2'><i>Logged in as:</i> {$_SESSION['auth']['username']}</li>
							<li class='nav-item'><form class='nav-link' action='index.php' method='post'><button type='submit' class='btn btn-secondary' name='authButton' value='logout'>Logout</button></form></li>
END;
        }

        $nav .= <<<END
						</ul>
					</nav>
				</div>
END;
        echo $nav;
    }

    static function tableDiv($title, $controller, $getSomething) {
        $tableDiv = <<<END
<div class='container col-sm-8 my-5 py-3 bg-light'>
	<div class=''>
		<h1>$title</h1>
END;
        $tableDiv .= Table::createTable($controller, $getSomething);
        /*		    $tableDiv .= "<?php".$controller::$tableMethod()."?>";*/
        $tableDiv .= <<<END
	</div>
</div>
END;
        echo $tableDiv;
    } //END tableDiv();

    static function addDialog($inPOSTValues) {
        switch ($inPOSTValues['type']) {
            case "Attendee":
                $crudDialog = "<div class='container col-sm-8 my-5 py-5 bg-light'><h1>Add Attendee</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'>
    <input type='hidden' name='action' value='submit'>
    <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
    <div class='form-group row'>
        <input class='form-control' type='text' name='newUserName' placeholder='Enter New Username Here'>
    </div>
    <div class='form-group row'>
        <input class='form-control' type='text' name='newPassword' placeholder='Enter New Password Here'>
    </div>
    <div class='form-group'>
        <label for='newRole'>Select role for new user:</label>
        <select class='form-control' name='newRole' id='newRole'>
            <option value='3' selected>Attendee</option>
            <option value='2'>Manager</option>
            <option value='1'>Admin</option>
        </select>
    </div>
    <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New User</button>
</form>";
                $crudDialog .= "</div>";
                break;
            case "Venue":
                $crudDialog = "<!--suppress HtmlUnknownTarget -->
<div class='container col-sm-8 my-5 py-5 bg-light'>
    <h1>Add Venue</h1>
    <form action='admin.php' method='post'>
        <input type='hidden' name='action' value='submit'>
        <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
        <div class='form-group row'>
            <input class='form-control' type='text' name='newVenueName' placeholder='Enter New Venue Name Here'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='number' name='newVenueCapacity' placeholder='Enter Venue Capacity'>
        </div>
        <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New Venue</button>
    </form>
</div>";
                break;
            case "Event":
                $crudDialog = "<!--suppress HtmlUnknownTarget -->
<div class='container col-sm-8 my-5 py-5 bg-light'>
    <h1>Add Event</h1>
    <form action='admin.php' method='post'>
        <input type='hidden' name='action' value='submit'>
        <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
        <div class='form-group row'>
            <input class='form-control' type='text' name='newEventName' placeholder='Enter Event Name'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='date' name='newEventStartDate' placeholder='Enter Event Start Date'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='date' name='newEventEndDate' placeholder='Enter Event End Date'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='number' name='newEventNumberAllowed' placeholder='Enter Number Allowed'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='number' name='newEventVenue' placeholder='Enter Venue ID where this event will take place (Found below)'>
        </div>
        <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New Event</button>
    </form>
</div>";
                break;
            case "Session":
                $crudDialog = "<!--suppress HtmlUnknownTarget -->
<div class='container col-sm-8 my-5 py-5 bg-light'>
    <h1>Add Session</h1>
    <form action='admin.php' method='post'>
        <input type='hidden' name='action' value='submit'>
        <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
        <div class='form-group row'>
            <input class='form-control' type='text' name='newSessionName' placeholder='Enter Session Name'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='date' name='newSessionStartDate' placeholder='Enter Event Start Date'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='date' name='newSessionEndDate' placeholder='Enter Event End Date'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='number' name='newSessionNumberAllowed' placeholder='Enter Number Allowed'>
        </div>
        <div class='form-group row'>
            <input class='form-control' type='number' name='newSessionEvent' placeholder='Enter Event ID where this session will take place (Found below)'>
        </div>
        <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New Event</button>
    </form>
</div>";                break;

            default:
                $crudDialog = "<h1>Nothing to Add.</h1>";
        }
        return $crudDialog;

    }

    static function editDialog($inPOSTValues) {
//        var_dump($inGETValues);
        switch ($inPOSTValues['type']) {
            case "Attendee":
                $crudDialog = "<div class='container col-sm-8 my-5 py-5 bg-light'><h1>Edit Attendee '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;
            case "Venue":
                $crudDialog = "<div class=''><h1>Edit Venue '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;
            case "Event":
                $crudDialog = "<div class=''><h1>Edit Event '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;
            case "Session":
                $crudDialog = "<div class=''><h1>Edit Session '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;

            default:
                $crudDialog = "<h1>Nothing to Edit.</h1>";
        }
        return $crudDialog;

    }

    static function deleteDialog($inPOSTValues) {
//        var_dump($inGETValues);
        switch ($inPOSTValues['type']) {
            case "Attendee":
                $crudDialog = "<div class='container col-sm-8 my-5 py-5 bg-light'><h1>Delete Attendee '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;
            case "Venue":
                $crudDialog = "<div class=''><h1>Delete Venue '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;
            case "Event":
                $crudDialog = "<div class=''><h1>Delete Event '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;
            case "Session":
                $crudDialog = "<div class=''><h1>Delete Session '{$inPOSTValues['id']}'</h1>";
                $crudDialog .= "<!--suppress HtmlUnknownTarget -->
<form action='admin.php' method='post'><button type='submit' class='btn btn-lg btn-primary'>Go back to Admin Page</button></form>";
                $crudDialog .= "</div>";
                break;

            default:
                $crudDialog = "<h1>Nothing to Delete.</h1>";
        }
        return $crudDialog;

    }





} //End HTMLElements Class

