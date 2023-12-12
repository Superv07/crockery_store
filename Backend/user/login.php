<?php
// Include the database connection file
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process user login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check user credentials
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $db_username, $db_password, $user_role);
    $stmt->fetch();
    $stmt->close();

    // Verify password (without password hashing, not recommended)
    if ($password === $db_password) {
        // Passwords match, user is authenticated

        // Start session and store user information
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['role'] = $user_role;

        // Redirect to the user's dashboard or home page
        header('Location: ../../frontend/user/home.php');
        exit;
    } else {
        // Incorrect password, handle accordingly (redirect, show error, etc.)
        header('Location: ../../frontend/user/login.php');
        exit;
    }
} else {
    // Redirect to login page if accessed directly without POST request
    header('Location: ../../frontend/user/login.php');
    exit;
}
?>
