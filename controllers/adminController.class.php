<?php
	
	require_once 'database/dbaccess_admin.class.php';

	class AdminController {
		
		public static function getAllUsersTable() {
			$db = new DBAccess_Admin();
			$data = $db->getAllAttendees();
			$numRecords = count($data);
			
			$userTableOutput = "<h5>There are {$numRecords} total users registered.</h5>";
			if (count($data) > 0) {	
				// Create the table and the table header
				$userTableOutput .= "<div class='pb-2'><table class='table table-striped'>\n
								<thead class='thead-dark'>
								<tr>
									<th>Attendee ID</th>
									<th>Name</th>
									<th>Role</th>
									<th>Controls</th>
								</tr>\n
								</thead>\n";
				
				// Create the table rows from the data input				
				foreach ($data as $row) {
					$userTableOutput .= "<tr>";
					// Created method in person.class.php to return a string which is a row (THIS IS HOW TO GET DATA OUT OF A PDO
					$userTableOutput .= $row->returnColumns();
					$userTableOutput .= $row->returnActionColumn();
					$userTableOutput .= "</tr>";
				}
				
				// Close the table
				$userTableOutput .= "</table></div>\n";
			} else {
				$userTableOutput = "<h2>No people exist.</h2>";
			}
			
			return $userTableOutput;
		}
		
		public static function getAllEventsTable() {
			$db = new DBAccess_Admin();
			$data = $db->getAllEvents();
			$numRecords = count($data);
			
			$eventTableOutputString = "<h5>There are {$numRecords} total events registered.</h5>";
			if (count($data) > 0) {	
				// Create the table and the table header
				$eventTableOutputString .= "<div class='pb-2'><table class='table table-striped'>\n
								<thead class='thead-dark'>
								<tr>
									<th>Event ID</th>
									<th>Event Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Max Attendees</th>
									<th>Venue ID</th>
									<th>Controls</th>
								</tr>\n
								</thead>\n";
				
				// Create the table rows from the data input				
				foreach ($data as $row) {
					$eventTableOutputString .= "<tr>";
					$eventTableOutputString .= $row->returnColumns();
					$eventTableOutputString .= $row->returnActionColumn();
					$eventTableOutputString .= "</tr>";
				}
				
				// Close the table
				$eventTableOutputString .= "</table></div>\n";
			} else {
				$eventTableOutputString = "<h2>No Events exist.</h2>";
			}
			
			return $eventTableOutputString;
		}

	} // End adminDB
