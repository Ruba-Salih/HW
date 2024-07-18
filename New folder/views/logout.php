<?php
/* FileName: logout.php
   Author: Raghad
   CreationDate: 17/07/24
   Purpose: This file handles user logout by terminating the session and clearing all session variables. 
            After logging out, it redirects the user to the registration or login page.
*/

// Initialize session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or any other page
header("Location: index.php?action=register");
exit();
?>
