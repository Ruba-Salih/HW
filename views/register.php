<?php 
/* 
   FileName: register.php
   Author: Raghad
   CreationDate: 17/07/24
   Purpose: Handle user registration.
*/

// Include header file
include 'header.php';
?>

<h2>Register</h2>
<form method="POST" action="index.php?action=register">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Register</button>
    <a href="login.php" class="back-button">Go Back to Login</a>
</form>

<!-- Include the JavaScript file -->
<script src="assets/formValidation.js"></script>
<?php include 'footer.php'; ?>
