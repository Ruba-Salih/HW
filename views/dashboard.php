<?php
/* 
   FileName: dashboard.php
   Author: Raghad
   CreationDate: 17/07/24
   Purpose: This script displays the dashboard for logged-in users, including a sidebar menu.
*/

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: index.php?action=login");
    exit(); // Stop further execution
}

// Include the header file
include 'header.php';
?>

<!-- HTML content for the dashboard -->
<div class="container">
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php?action=dashboard">Dashboard</a></li> <!-- Link to the dashboard -->
            <li><a href="index.php?action=view_tasks">View Tasks</a></li> <!-- Link to view tasks -->
            <li><a href="index.php?action=add_task">Add New Task</a></li> <!-- Link to add a new task -->
            <li><a href="index.php?action=logout">Logout</a></li> <!-- Link to logout -->
            <!-- Add more sidebar links as needed -->
        </ul>
    </div>
</div>

<!-- Include the footer file -->
<?php include 'footer.php'; ?>
