<?php
/* FileName: UserController.php
   Author: Raghad
   CreationDate: 23/06/24
   Purpose: Handles user registration, login, and logout actions. 
   It processes form submissions for user registration and login, manages user sessions, 
   and redirects users to appropriate pages based on their actions.
*/

require_once 'config/database.php'; // Include database configuration file
require_once 'models/User.php'; // Include User model class

class UserController {
    private $db; // Database connection object
    private $user; // User model object

    public function __construct() {
        // Initialize database connection
        $database = new Database();
        $this->db = $database->getConnection();

        // Initialize User model with database connection
        $this->user = new User($this->db);
    }

    // Method to handle user registration
    public function register() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assign username and password from POST data
        $this->user->username = $_POST['username'];
        $this->user->password = $_POST['password'];

        // Attempt to register user
        if ($this->user->register()) {
            header("Location: login.php"); // Redirect to login page after successful registration
            exit();
        } else {
            echo "Registration failed.";
        }
    }
}


    // Method to handle user login
    public function login() {
        session_start(); // Start session at the beginning
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assign username and password from POST data
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            // Attempt to login user
            if ($this->user->login()) {
                session_start();
                $_SESSION['user_id'] = $this->user->id;
                header("Location: index.php?action=dashboard"); // Redirect to dashboard on successful login
                exit();
            } else {
                echo "Login failed.";
            }
        }
    }

    // Method to handle user logout
    public function logout() {
        session_start();
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        header("Location: index.php?action=register"); // Redirect to login page after logout
        exit();
    }
}

// Handle requests
if (isset($_GET['action'])) {
    $userController = new UserController();
    if ($_GET['action'] == 'register') {
        $userController->register(); // Call register method for registration action
    } elseif ($_GET['action'] == 'login') {
        $userController->login(); // Call login method for login action
    }
}
?>
