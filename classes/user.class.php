<?php
    include_once("./config/db.php");

    class User {
        public $db;

        public function __construct() {
            $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

            if (mysqli_connect_error()) {
                echo "Error: Could not connect to database.";
                exit;
            }
        }

        // For registration process
        public function register_user($name, $username, $password, $email) {
            $password = md5($password);
            $qry = "SELECT * FROM users WHERE Username='$username' OR Email='$email'";

            // Checking if the username or email is availble in db
            $check = $this->db->query($qry);
            $count_row = $check->num_rows;

            // If the username is not in db then insert to the table
            if ($count_row == 0) {
                $qry = "INSERT INTO users SET Fullname='$name', Username='$username', Password='$password', Email='$email'";
                $result = mysqli_query($this->db, $qry) or die(mysqli_connect_error() . "Data cannot inserted");
                return $result;
            } else {
                return false;
            }
        }

        // For login process
        public function login_user($username, $password) {
            $password = md5($password);
            $qry = "SELECT ID FROM users WHERE Username='$username' AND Password='$password'";

            // Checking if the username is available in the table
            $result = mysqli_query($this->db, $qry);
            $user_data = mysqli_fetch_array($result);
            $count_row = $result->num_rows;

            if ($count_row == 1) {
                // This login var will use for the session
                $_SESSION['login'] = true;
                $_SESSION['id'] = $user_data['ID'];
                return true;
            } else {
                return false;
            }
        }

        // For showing the username or fullname
        public function get_fullname($id) {
            $qry = "SELECT Fullname FROM users WHERE id='$id'";
            $result = mysqli_query($this->db, $qry);
            $user_data = mysqli_fetch_array($result);
            echo $user_data['Fullname'];
        }

        // Starting the session
        public function get_session() {
            return $_SESSION['login'];
        }
        public function user_logout() {
            $_SESSION['login'] = false;
            session_destroy();
        }

        // Get User data
        public function get_user($id) {
            $query = "SELECT * FROM Users WHERE id='$id'";
            $result = mysqli_query($this->db, $query);
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
?>