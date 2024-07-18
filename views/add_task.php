<?php
/* 
 * FileName: add_task.php
 * Author: Raghad
 * CreationDate: 17/07/24
 * Purpose: This script handles the addition of a new task. It includes session validation to ensure that only authenticated users can add tasks.
 */

// Start the session or resume the existing session
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?action=login");
    exit();
}

// Include the header file
include 'header.php';
?>

<!-- HTML form for adding a new task -->
<h2>Add a New Task</h2>
<form id="addTaskForm" method="POST" action="index.php?action=add_task">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>
    <br>
    <label for="due_date">Due Date:</label>
    <input type="date" id="due_date" name="due_date" required>
    <br>
    <label for="category">Category:</label>
    <input type="text" id="category" name="category" required>
    <br>
    <button type="submit">Add Task</button>
    <button class="back-button" onclick="history.back()">Go Back</button>
</form>

<!-- Include the footer file -->
<?php include 'footer.php'; ?>

<!-- Include the JavaScript file -->
<script src="assets/formValidation.js"></script>