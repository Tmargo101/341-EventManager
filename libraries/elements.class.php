<?php
	/*
	These are static functions which can be called from any page.
	IMPORTANT: Only functions which any user level should have access to should be here
		
	Author: Thomas Margosian, Brian French (original html_header and html_footer)
	Date created: 2/20/20	
	
	https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh
	*/
	
	class Elements {
	// 	HTML Headers & Footers
	
		static function html_header($title="Untitled"){
			$string = <<<END
			<?php
				session_name('EventManagerSession');
				session_start();
			?>
	<!DOCTYPE html>
	
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>$title</title>
		
		<!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css" crossorigin="anonymous">
		
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
	
		
		static function html_footer($text=""){
			$string ="\n$text\n</body>\n</html>";
			return $string;
		}// End html_footer()

		static function nav() {
			$nav = <<<END
				<div class='mb-5'>
					<nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
						<a class="navbar-brand" href="#">Event Manager</a>
						<ul class="navbar-nav ml-auto mr-auto">
END;
			if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
				$nav .= <<<END
							<li class='nav-item mx-5'><a class='nav-link' href='events.php'>Events</a></li>
							<li class='nav-item mx-5'><a class='nav-link' href='registration.php'>Registration</a></li>

END;
			}
			if (isset($_SESSION['auth']['authCorrect']) && isset($_SESSION['auth']['role']) && $_SESSION['auth']['role'] == "admin") {
				$nav .= "<li class='nav-item mx-5'><a class='nav-link' href='admin.php'>Admin Portal</a></li>";
			}

			if (isset($_SESSION['auth']['authCorrect']) && $_SESSION['auth']['authCorrect'] == "true") {
				$nav .= <<<END
						</ul>
						<ul class='navbar-nav'>
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
	} //End Elements Class

?>