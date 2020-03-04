<?php
/* Filename: auth.class.php
 * Purpose: All authentication functions & authentication-related database access
 * NOTE: Utilizes CONSTANTS defined in CONSTANTS.php
 *
 * Author: Tom Margosian
 * Date: 2/20/20
 */

class AuthDBAccess {
    protected $dbholder;

    function __construct() {
        try {
            // Set PDO access data from constants (Cannot call a constant within string interpolation)
            $host = DB_SERVER;
            $username = DB_USERNAME;
            $password = DB_PASSWORD;
            $database = DB_DATABASE;

            $this->dbholder = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
        } catch (PDOException $pdoException) {
            echo "<div class=''></div><h1>Internal Server Error:</h1>";
            echo "<h3>DB Error number: <i>".$pdoException->getCode()."</i></h3>";
            die("</div><br>");
        }
    }

    public function getUser($inUserName) {
        try {
//                $data = array();
            $statement = $this->dbholder->prepare("SELECT * FROM attendee WHERE name = :username");
            $statement->execute(array("username" => $inUserName));

            return $statement->fetchAll();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return array();
        } // End catch
    }

    public function createAttendee($newUserName, $newUserPassword) {
        // Check if user exists (under development)
        $previousUserArray = $this->getUser($newUserName);
        if (!isset($previousUserArray[0])) {
            try {
//                    $data = array();
                $statement = $this->dbholder->prepare("INSERT into attendee (name,password,role) VALUES (:username,:password,3)");
                $statement->execute(array("username" => $newUserName, "password" => $newUserPassword));
                $_SESSION['auth']['authCorrect'] = "newUserRegistered";
                return $this->dbholder->lastInsertId();

            } catch (PDOException $exception) {
                echo $exception->getMessage();
                return -1;
            }
        }
        return null;
    }

} //End Class AuthDBAccess

class Auth {

    static function login($inUsername, $inPassword) {
        if ($inUsername == "" && $inPassword == "") {
            $_SESSION['auth']['authCorrect'] = "emptyForm";
            header("Location: index.php");
        } else if ($inUsername == "") {
            $_SESSION['auth']['authCorrect'] = "emptyUsername";
            header("Location: index.php");
        } else if ($inPassword == "") {
            $_SESSION['auth']['authCorrect'] = "emptyPassword";
            header("Location: index.php");

        } else {
            $db = new AuthDBAccess();
            // Get user from the attendee table
            $attendeeDataArray = $db->getUser($inUsername);

            // Check if the attendeeDataArray has values.  If it is empty, the user does not exist.
            if (isset($attendeeDataArray[0])) {
                $_SESSION['auth']['username'] = $inUsername;

                // Verify password hash.  If correct, determine user role and pass to events page.
                if (password_verify($inPassword, $attendeeDataArray[0]['password'])) {
                    switch ($attendeeDataArray[0]['role']) {
                        case 1:
                            $_SESSION['auth']['authCorrect'] = "true";
                            $_SESSION['auth']['role'] = "admin";
                            $_SESSION['auth']['id'] = $attendeeDataArray[0]['idattendee'];
                            break;
                        case 2:
                            $_SESSION['auth']['authCorrect'] = "true";
                            $_SESSION['auth']['role'] = "manager";
                            $_SESSION['auth']['id'] = $attendeeDataArray[0]['idattendee'];
                            break;
                        case 3:
                            $_SESSION['auth']['authCorrect'] = "true";
                            $_SESSION['auth']['role'] = "attendee";
                            $_SESSION['auth']['id'] = $attendeeDataArray[0]['idattendee'];
                            break;
                    }
                    header("Location: events.php");
                } else {
                    // If the password is incorrect, set authCorrect to badPass and send back to login
                    $_SESSION['auth']['authCorrect'] = "badPass";
                    header("Location: index.php");
                }
            } else {
                // If the user was not found in DB, set authCorrect to badUser and send back to login
                $_SESSION['auth']['authCorrect'] = "noUserFound";
                header("Location: index.php");
            }
        }
    }

    static function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

    static function register($inUsername, $inPassword) {
        $db = new AuthDBAccess();
        if ($db->createAttendee($inUsername, password_hash($inPassword, PASSWORD_DEFAULT)) != false) {
//				$this->login($inUsername, $inPassword);
            return "User Registered";
        } else {
            return "Cannot register user.";
        }
    }

    // Return true or false.  Input: username, what role you want to check
//		static function isUserAn($userInput, $roleInput) {
//			$db = new DBAccess();
//			$attendeeDataArray = $db->getUser($userInput);
//		}

    static function isLoggedIn() {
        if (!isset($_SESSION['auth']['authCorrect']) || $_SESSION['auth']['authCorrect'] != "true") {
            if (!isset($_SESSION['auth'])) {
                $_SESSION['auth'] = array();
            }
            $_SESSION['auth']['authCorrect'] = "";
            HTMLElements::notLoggedIn();
            // TODO: Find out how to pass 401 code and still refresh the page after 5 seconds
            header("HTTP/1.0 401 Unauthorized; Refresh:5; url=index.php");
            die();
        }// End if(authCorrect!=true)
    } // End isLoggedIn()

    static function isAdmin() {
        if ($_SESSION['auth']['role'] != "admin") {
            HTMLElements::notAdmin();
//				header("Refresh:5; url=index.php");
//				die();
            // TODO: Find out how to pass 401 code and still refresh the page after 5 seconds
            header("HTTP/1.0 401 Unauthorized; Refresh=5; url=index.php");
            die();
        }
    } // End isAdmin()

    static function isManager() {
        if ($_SESSION['auth']['role'] != "manager") {
            HTMLElements::notAdmin();
//				header("Refresh:5; url=index.php");
//				die();
            // TODO: Find out how to pass 401 code and still refresh the page after 5 seconds
            header("HTTP/1.0 401 Unauthorized; Refresh=5; url=index.php");
            die();
        }
    } // End isAdmin()


} // End Auth class
		
