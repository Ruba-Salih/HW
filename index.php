<?php
/* FileName: index.php
   Author: Raghad, Ruba
   CreationDate: 17/07/24
   Purpose: This file serves as the main controller for the application, handling different actions based on URL parameters.
            It includes necessary files for database connection, user management, and task operations.
            Depending on the 'action' parameter, it directs the flow to user registration, login, task management, 
            or displays the appropriate views (e.g., dashboard, add task, view tasks).
*/
session_start(); // Start the session

// Include necessary files
require 'config/database.php';
require 'models/User.php';
require 'controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home'; // Determine action from URL parameter

switch ($action) {
    case 'register':
        $userController = new UserController();
        $userController->register(); // Call register method from UserController
        include 'views/register.php'; // Include the register view
        break;
    case 'login':
        $userController = new UserController();
        $userController->login(); // Call login method from UserController
        include 'views/login.php'; // Include the login view
        break;
    case 'dashboard':
        include 'views/dashboard.php'; // Include the dashboard view
        break;
    case 'add_task':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Code to add a task
            $database = new Database();
            $db = $database->getConnection();
            $query = "INSERT INTO tasks (user_id, title, description, due_date, category, status) VALUES (:user_id, :title, :description, :due_date, :category, 'pending')";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':user_id', $_SESSION['user_id']);
            $stmt->bindParam(':title', $_POST['title']);
            $stmt->bindParam(':description', $_POST['description']);
            $stmt->bindParam(':due_date', $_POST['due_date']);
            $stmt->bindParam(':category', $_POST['category']);
            $stmt->execute(); // Execute the prepared statement
            header("Location: index.php?action=view_tasks"); // Redirect to view tasks page after adding task
            exit(); // Exit script execution
        } else {
            include 'views/add_task.php'; // Include add task view if HTTP method is GET
        }
        break;
    case 'view_tasks':
        include 'views/view_tasks.php'; // Include view tasks view
        break;
    case 'logout':
        $userController = new UserController();
        $userController->logout(); // Call logout method from UserController
        break;
    default:
        include 'views/dashboard.php'; // Default action: include dashboard view
        break;
}
?>
