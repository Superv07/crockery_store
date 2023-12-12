<?php
session_start(); // Start the session

// Include the database configuration
include_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle login form submission
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    // Fetch user information from the database
    $query = "SELECT username, password FROM users WHERE username = ? AND role = 'admin'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $admin_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $admin_password === $user['password']) {
        // Admin credentials are correct, set session variable
        $_SESSION['admin_authenticated'] = true;
        header("Location: ../../frontend/admin/home.php");
        exit();
    } else {
        // Invalid credentials, redirect to login page with an error message
        header("Location: ../../frontend/admin/login.php?error=1");
        exit();
    }
} else {
    // If someone tries to access this file directly without a POST request, redirect to login page
    header("Location: ../../frontend/admin/login.php");
    exit();
}
?>
