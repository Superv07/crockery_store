<?php
// Include your database connection file or define your database connection here
// Example: include 'path/to/db/connection.php';
include '../includes/db.php';
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header('Location: ../../frontend/user/login.php');
exit;
?>
