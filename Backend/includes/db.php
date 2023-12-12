<?php
// Database configuration
$servername = "localhost"; // e.g., "localhost"
$username = "root";
$password = "";
$dbname = "crockery_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
$conn->set_charset("utf8");

// Optionally, you can add more configuration settings or functions as needed

?>
