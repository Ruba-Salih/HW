<?php 
/* 
   FileName: login.php
   Author: Raghad
   CreationDate: 17/07/24
   Purpose: Handle user login and provide a link to registration page.
*/

// Include header file
include 'header.php';

// Link to register.php for new users
?>

<?php

// Start or resume session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to dashboard or another authenticated page
    header("Location: dashboard.php");
    exit(); // Ensure script stops execution after redirection
}

?>

<h2>Login</h2>
<form method="POST" action="index.php?action=login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Login</button>
    <a href="register.php" class="back-button">Go to Register</a>

</form>

<!-- Include the JavaScript file -->
<script src="assets/formValidation.js"></script>
<?php include 'footer.php'; ?>
