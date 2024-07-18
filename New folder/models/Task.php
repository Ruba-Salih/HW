<?php
/* FileName: Task.php
   Author: Raghad
   CreationDate: 23/06/24
    Purpose: This class handles CRUD operations for tasks in a task management system.
            It allows for the creation, reading, updating, and deletion of tasks.
            The class interacts with a database table named "tasks" to perform these operations.
*/
class Task {
    private $conn; // Database connection object
    private $table_name = "tasks"; // Table name in the database

    // Task properties
    public $id;
    public $user_id;
    public $title;
    public $description;
    public $due_date;
    public $category;
    public $status;

    // Constructor to initialize with database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create a new task
    public function create() {
        // SQL query to insert a new task into the database
        $query = "INSERT INTO " . $this->table_name . " (user_id, title, description, due_date, category, status) VALUES (:user_id, :title, :description, :due_date, :category, :status)";
        
        // Prepare the query
        $stmt = $this->conn->prepare($query);
    
        // Sanitize inputs
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->status = htmlspecialchars(strip_tags($this->status));
    
        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':status', $this->status);
    
        // Execute the query
        if ($stmt->execute()) {
            return true; // Task created successfully
        }
        return false; // Unable to create task
    }

    // Method to read tasks for a specific user
    public function read() {
        // SQL query to select tasks for a specific user
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();

        // Return the executed statement object
        return $stmt;
    }

    // Method to update an existing task
    public function update() {
        // SQL query to update a task by ID
        $query = "UPDATE {$this->table_name} SET
                  title = :title,
                  description = :description,
                  due_date = :due_date,
                  category = :category,
                  status = :status
                  WHERE id = :id";
    
        // Prepare the query
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':status', $this->status);
    
        // Execute the query
        if ($stmt->execute()) {
            return true; // Task updated successfully
        }
    
        return false; // Unable to update task
    }

    // Method to delete a task by ID
    public function delete() {
        // SQL query to delete a task by ID
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $this->id);

        // Execute the query
        if ($stmt->execute()) {
            return true; // Task deleted successfully
        }

        return false; // Unable to delete task
    }
}
?>
