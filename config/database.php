<?php
/* FileName: database.php
   Author: Raghad, Ruba
   CreationDate: 10/07/24
   Purpose: manage the connection to a MySQL database for a PHP application. 
*/
class Database {
    private $host = "localhost";
    private $db_name = "todo_app";
    private $username = "root";
    private $password = "root";
    public $conn;

    // Method to get a database connection
    public function getConnection() {
        $this->conn = null;
        try {
            // Create a new PDO instance
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Set the connection character set to utf8
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // Handle connection errors
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
