<?php
/* FileName: TaskController.php
   Author: Raghad
   CreationDate: 27/06/24
   Purpose: handle the logic for managing tasks in a to-do application.
   provides methods to create, read, update, and delete tasks.
*/

require_once 'config/database.php'; // Include database configuration file
require_once 'models/Task.php'; // Include Task model class

class TaskController {
    private $db; // Database connection object
    private $task; // Task model object

    public function __construct() {
        // Initialize database connection
        $database = new Database();
        $this->db = $database->getConnection();

        // Initialize Task model with database connection
        $this->task = new Task($this->db);
    }

    // Method to create a new task
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start(); // Start session

            // Check if user is logged in
            if (isset($_SESSION['user_id'])) {
                // Assign task properties from POST data
                $this->task->user_id = $_SESSION['user_id'];
                $this->task->title = $_POST['title'];
                $this->task->description = $_POST['description'];
                $this->task->due_date = $_POST['due_date'];
                $this->task->category = $_POST['category'];
                $this->task->status = $_POST['status'];

                // Attempt to create task
                if ($this->task->create()) {
                    echo "Task created successfully.";
                } else {
                    echo "Unable to create task.";
                }
            } else {
                echo "User not logged in.";
            }
        }
    }

    // Method to read tasks for a logged-in user
    public function read() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            session_start(); // Start session
            
            // Check if user is logged in
            if (isset($_SESSION['user_id'])) {
                $this->task->user_id = $_SESSION['user_id'];
                $result = $this->task->read(); // Get tasks from database
                $num = $result->rowCount(); // Get row count
    
                if ($num > 0) {
                    $tasks_arr = array();
                    $tasks_arr['data'] = array();
    
                    // Fetch and format tasks into an array
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
    
                        $task_item = array(
                            'id' => $id,
                            'title' => $title,
                            'description' => $description,
                            'due_date' => $due_date,
                            'category' => $category,
                            'status' => $status
                        );
    
                        array_push($tasks_arr['data'], $task_item);
                    }
    
                    // Instead of echoing directly, return the JSON data
                    return json_encode($tasks_arr);
                } else {
                    // Return JSON indicating no tasks found
                    return json_encode(array('message' => 'No tasks found.'));
                }
            } else {
                // Return JSON indicating user not logged in
                return json_encode(array('message' => 'User not logged in.'));
            }
        }
    }

    // Method to update an existing task
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assign task properties from POST data
            $this->task->id = $_POST['id'];
            $this->task->title = $_POST['title'];
            $this->task->description = $_POST['description'];
            $this->task->due_date = $_POST['due_date'];
            $this->task->category = $_POST['category'];
            $this->task->status = $_POST['status'];
    
            // Attempt to update task
            if ($this->task->update()) {
                echo "Task updated successfully.";
            } else {
                echo "Unable to update task.";
            }
        }
    }
    
    // Method to delete an existing task
    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assign task ID from POST data
            $this->task->id = $_POST['id'];

            // Attempt to delete task
            if ($this->task->delete()) {
                echo "Task deleted successfully.";
            } else {
                echo "Unable to delete task.";
            }
        }
    }
}
?>
