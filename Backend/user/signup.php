<?php
// Include the database connection file
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process user signup
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = 'user'; // Default role

    // Validate passwords match
    if ($password !== $confirmPassword) {
        // Passwords do not match, handle accordingly (redirect, show error, etc.)
        header('Location: ../../frontend/user/signup.php');
        exit;
    }

    // Insert user data into the database without password hashing (not recommended)
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $username, $email, $password, $role);
    $stmt->execute();
    $stmt->close();

    // After successful signup, redirect to login page or wherever needed
    header('Location: ../../frontend/user/login.php');
    exit;
} else {
    // Redirect to signup page if accessed directly without POST request
    header('Location: ../../frontend/user/signup.php');
    exit;
}
?>
