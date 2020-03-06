<?php
/* Filename: HTMLElements.class.php
 * Purpose: Draw any common elements to the page, using static functions which return strings.
 * NOTE: Only functions which any user level should have access to should be here
 *
 * Author: Thomas Margosian, Brian French (original html_header and html_footer)
 * Date: 2/20/20
 */

class HTMLElements {
    // 	HTML Headers & Footers

    static function html_header($title = "Untitled") {
        $bgImage = BG_IMAGE;
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
END;
        if ($bgImage != "none") {
            $string .= <<<END
	    <style>
            body {
                /*noinspection CssUnknownTarget*/
                background: url('{$bgImage}') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
            }
        </style>
END;
        }
        $string .= <<<END
	</head>
	<body class="text-center">\n
    <div class="">
END;
        echo $string;
    } // End html_header()


    static function html_footer($text = "") {
        return "\n$text\n</div></body>\n</html>";
    }// End html_footer()

    static function notLoggedIn() {
        echo "<!--suppress HtmlUnknownTarget -->
            <div class='container-fluid col-md-4 mt-5 mb-5'>
                <h1>Not logged in</h1>
            </div>
            <div class='container-fluid col-md-4 mt-5 mb-5'>
                <h3>Must have made a wrong turn...</h3>
                <h4>Please login to access this page.</h4>
            </div>
            <div class='container-fluid my-5'>
                <h5>Redirecting you to Login automatically in 5 seconds...</h5>
            </div>
            <div class='container-fluid col-md-4 mt-5 mb-5'>
                <a href='index.php' class='btn btn-primary'>Login now</a>
            </div>";
    }

    static function notAdmin() {
        echo "<!--suppress HtmlUnknownTarget -->

                <div class='container-fluid col-md-4 mt-5 mb-5'>
                    <h1>Unauthorized</h1>
                </div>
                <div class='container-fluid col-md-4 mt-5 mb-5'>
                    <h3>Must have made a wrong turn...</h3>
                    <h4>Please login as admin to access this page.</h4>
                </div>
                <div class='container-fluid my-5'>
                    <h5>Redirecting you to your events portal automatically in 5 seconds...</h5>
                </div>
                <div class='container-fluid my-5'>
                    <a href='index.php' class='btn btn-primary'>Go now</a>
                </div>";
    }

    static function nav() {
        $APPLICATION_NAME = APPLICATION_NAME;
        $nav = <<<END
				<div class='mb-5'>
					<nav class='navbar navbar-expand-xl bg-dark navbar-dark'>
						<a class="navbar-brand" href="#">{$APPLICATION_NAME}</a>
						    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navBarToggler">
						        <ul class="navbar-nav ml-auto mr-auto mt-2 mt-lg-0 mt-sm-4">
END;
        if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
            $nav .= <<<END
<!--suppress HtmlUnknownTarget -->
<li class='nav-item mx-5 my-sm-2'><a class='nav-link' href='events.php'>Events</a></li>
<li class='nav-item mx-5 my-sm-2'><a class='nav-link' href='registration.php'>Registration</a></li>

END;
        }
        if (isset($_SESSION['auth']['authCorrect']) && isset($_SESSION['auth']['role']) && $_SESSION['auth']['role'] == "admin") {
            $nav .= "<!--suppress HtmlUnknownTarget -->
<li class='nav-item mx-5 my-sm-2'><a class='nav-link' href='admin.php'>Admin Portal</a></li>";
        }

        if (isset($_SESSION['auth']['authCorrect']) && isset($_SESSION['auth']['role']) && $_SESSION['auth']['role'] == "manager") {
            $nav .= "<!--suppress HtmlUnknownTarget -->
<li class='nav-item mx-5 my-sm-2'><a class='nav-link' href='manager.php'>Manage Your Events</a></li>";
        }


        if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
            $nav .= <<<END
<!--suppress HtmlUnknownTarget -->
						    </ul>
						    <ul class='navbar-nav'>
							    <li class='navbar-brand mt-2 my-sm-3 mr-sm-0'><i>Logged in as:</i> <b>{$_SESSION['auth']['username']}</b> (<i>ID:</i> <b>{$_SESSION['auth']['id']}</b>)</li>
							    <li class='nav-item my-sm-2 ml-xl-3 mr-xl-2'><form class='nav-link' action='index.php' method='post'><button type='submit' class='btn btn-secondary' name='authButton' value='logout'>Logout</button></form></li>
                            </ul>
END;
        }

        $nav .= <<<END
						    
						</div>
					</nav>
				</div>
END;
        echo $nav;
    }

    static function tableDiv($title, $controller, $getSomething, $objectReturnType) {
        $tableDiv = <<<END
<div class='container-fluid col-sm-12 col-md-11 col-lg-10 col-xl-9 my-5 py-3 bg-light'>
	<div class=''>
		<h2 class='pb-3'>$title</h2>
END;
        $table = Table::createTable($controller, $getSomething);
        if ($table != null) {
            $tableDiv .= $table;
        } else if ($table == null && $_SERVER['REQUEST_URI'] == BASE_URL.'events.php'){
            $tableDiv .= "<div class='alert alert-info container-fluid col-md-6'><h5>No Data found:</h5><br>User '{$_SESSION['auth']['username']}' is not registered for anything here.<br>  Go to the Registration Portal and sign up for an event or session.</div></div>";
        } else if ($table == null && $_SERVER['REQUEST_URI'] == BASE_URL.'registration.php') {
            $tableDiv .= "<div class='alert alert-info container-fluid col-md-6'><h5>No Data found:</h5><br>There are currently no items scheduled here.<br></div></div>";
        } else if ($table == null && $_SERVER['REQUEST_URI'] == BASE_URL.'admin.php' && $_SESSION['auth']['role'] == "admin") {
            // TODO: Display add (itemType) button here
            $tableDiv .= Table::addButton($objectReturnType);
            $tableDiv .= "<div class='alert alert-info container-fluid col-md-6'><h5>No Data found:</h5><br>There are currently no items here.  Add one!<br></div></div>";
        } else if ($table == null && $_SERVER['REQUEST_URI'] == BASE_URL.'manager.php'  && $_SESSION['auth']['role'] == "manager") {
            $tableDiv .= Table::addButton($objectReturnType);
            $tableDiv .= "<div class='alert alert-info container-fluid col-md-6'><h5>No Data found:</h5><br>There are currently no items here.<br></div></div>";
        }

        /*		    $tableDiv .= "<?php".$controller::$tableMethod()."?>";*/
        $tableDiv .= <<<END
	</div>
</div>
END;
        return $tableDiv;
    } //END tableDiv();

    static function addDialog($inPOSTValues) {
        switch ($inPOSTValues['type']) {
            case "Attendee":
                $crudDialog = "<!--suppress HtmlUnknownTarget -->
<div class='container-fluid col-sm-auto col-md-8 col-xl-4 my-5 py-3 px-2 bg-light'>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'><button type='submit' class='close'><span aria-hidden='true'>&times;</span></button></form>
    <h2>Add Attendee</h2>
    <form action='admin.php' method='post'>
        <input type='hidden' name='validationString' value='string,string,int'>
        <input type='hidden' name='action' value='submit'>
        <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newUserName'><b>Username</b></label>
            <div class='col-sm-8'>
                <input class='form-control com-sm-8' type='text' id='newUserName' name='newUserName' placeholder='Enter New Username Here'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newPassword'><b>Password</b></label>
            <div class='col-sm-8'>
                <input class='form-control com-sm-8' type='text' id='newPassword' name='newPassword' placeholder='Enter New Password Here'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newRole'><b>Role</b></label>
            <div class='col-sm-4'>
                <select class='form-control' name='newRole' id='newRole'>
                    <option value='3' selected>Attendee</option>
                    <option value='2'>Manager</option>
                    <option value='1'>Admin</option>
                </select>
            </div>
        </div>
        <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New User</button>
    </form>
</div>";
                $crudDialog .= "</div>";
                break;
            case "Venue":
                $crudDialog = "<!--suppress HtmlUnknownTarget -->
<div class='container-fluid col-md-4 my-5 py-3 px-2 bg-light'>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'><button type='submit' class='close'><span aria-hidden='true'>&times;</span></button></form>
    <h2>Add Venue</h2>
    <form action='admin.php' method='post'>
        <!-- To be validated & sanitized: newVenueName, newVenueCapacity -->
        <input type='hidden' name='validationString' value='string,int'>
        <input type='hidden' name='action' value='submit'>
        <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newVenueName'><b>Venue Name</b></label>
            <div class='col-sm-8'>
                <input class='form-control com-sm-8' type='text' id='newVenueName' name='newVenueName' placeholder='Enter New Venue Name Here'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newVenueCapacity'><b>Venue Capacity</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='number' id='newVenueCapacity' name='newVenueCapacity' placeholder='Enter Venue Capacity'>
            </div>    
        </div>
        <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New Venue</button>
    </form>
</div>";
                break;
            case "Event":
                $crudDialog = "<!--suppress HtmlUnknownTarget -->
<div class='container-fluid col-md-4 my-5 py-3 px-2 bg-light'>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'><button type='submit' class='close'><span aria-hidden='true'>&times;</span></button></form>
    <h2>Add Event</h2>
    <form action='admin.php' method='post'>
        <!-- To be validated & sanitized: newEventName, newEventStartDate, newEventEndDate, newEventNumberAllowed, newEventVenue -->
        <input name='validationString' type='hidden' value='string,date,date,int,int'>
        <input type='hidden' name='action' value='submit'>
        <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newEventName'><b>Event Name</b></label>
            <div class='col-sm-8'>
                <input class='form-control com-sm-8' type='text' id='newEventName' name='newEventName' placeholder='Enter New Event Name Here'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newEventStartDate'><b>Start Date</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='date' id='newEventStartDate' name='newEventStartDate' placeholder='(YYYY-MM-DD)'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newEventEndDate'><b>End Date</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='date' id='newEventEndDate' name='newEventEndDate' placeholder='(YYYY-MM-DD)'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newEventNumberAllowed'><b>Max Attendees</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='number' id='newEventNumberAllowed' name='newEventNumberAllowed' placeholder='Enter Maximum number of Attendees'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newEventVenue'><b>Event Venue</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='number' id='newEventVenue' name='newEventVenue' placeholder='Enter Venue ID (Found below)'>
            </div>    
        </div>
        <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New Event</button>
    </form>
</div>";

                break;
            case "Session":
                $crudDialog = "<!--suppress HtmlUnknownTarget -->
<div class='container-fluid col-md-4 my-5 py-3 px-2 bg-light'>
    <form action='{$_SERVER['REQUEST_URI']}' method='post'><button type='submit' class='close'><span aria-hidden='true'>&times;</span></button></form>
    <h2>Add Session</h2>
    <form action='admin.php' method='post'>
        <!-- To be validated & sanitized: newSessionName, newSessionStartDate, newSessionEndDate, newSessionNumberAllowed, newSessionEvent -->
        <input name='validationString' type='hidden' value='string,date,date,int,int'>
        <input type='hidden' name='action' value='submit'>
        <input type='hidden' name='type' value='{$inPOSTValues['type']}'>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newSessionName'><b>Event Name</b></label>
            <div class='col-sm-8'>
                <input class='form-control com-sm-8' type='text' id='newSessionName' name='newSessionName' placeholder='Enter New Session Name Here'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newSessionStartDate'><b>Start Date</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='date' id='newSessionStartDate' name='newSessionStartDate' placeholder='(YYYY-MM-DD)'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newSessionEndDate'><b>End Date</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='date' id='newSessionEndDate' name='newSessionEndDate' placeholder='(YYYY-MM-DD)'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newSessionNumberAllowed'><b>Max Attendees</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='number' id='newSessionNumberAllowed' name='newSessionNumberAllowed' placeholder='Enter Maximum number of Attendees'>
            </div>    
        </div>
        <div class='form-group row'>
            <label class='col-sm-3 col-form-label' for='newSessionEvent'><b>Event</b></label>
            <div class='col-sm-8'>
                <input class='form-control' type='number' id='newSessionEvent' name='newSessionEvent' placeholder='Enter Event ID (Found below)'>
            </div>    
        </div>
        <button type='submit' name='button' value='add' class='btn btn-lg btn-primary'>Create New Session</button>
    </form>
</div>";

                break;

            default:
                $crudDialog = "<h1>Nothing to Add.</h1>";
        }
        return $crudDialog;

    }

    static function editDialog($inPOSTValues) {
//        var_dump($inGETValues);
        switch ($inPOSTValues['type']) {
            case "Attendee":
                $crudDialog = "<div class='container-fluid col-sm-8 my-5 py-5 bg-light'><h1>Edit Attendee '{$inPOSTValues['id']}'</h1>";
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
                $crudDialog = "<div class='container-fluid col-sm-8 my-5 py-5 bg-light'><h1>Delete Attendee '{$inPOSTValues['id']}'</h1>";
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

