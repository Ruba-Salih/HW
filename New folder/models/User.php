<?php
/* FileName: User.php
   Author: Raghad
   CreationDate: 28/06/24
   Purpose: This class handles user management in a system, including user registration and login functionalities.
            It interacts with a database table named "users" to register new users and authenticate existing ones.
*/

class User {
    private $conn; // Database connection
    private $table_name = "users"; // Table name

    public $id; // User ID
    public $username; // User's username
    public $password; // User's password

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new user
    public function register() {
        // SQL query to insert a new user
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        
        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the username and hashed password to the query
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));

        // Execute the query and return true if successful, otherwise false
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // User login
    public function login() {
        // SQL query to select user ID and password hash based on the username
        $query = "SELECT id, password FROM " . $this->table_name . " WHERE username = :username";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the username to the query
        $stmt->bindParam(':username', $this->username);

        // Execute the query
        $stmt->execute();

        // Fetch the result as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password and set the user ID if login is successful
        if ($row && password_verify($this->password, $row['password'])) {
            $this->id = $row['id'];
            return true;
        }

        // Return false if login failed
        return false;
    }
}
?>
