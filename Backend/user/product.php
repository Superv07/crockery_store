<?php
// Include the database connection file
include "../includes/db.php";

// Fetch products from the database
$sql = "SELECT id, name, price, description, image_filename FROM products";
$result = $conn->query($sql);

// Process the result
if ($result && $result->num_rows > 0) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $products = [];
}

// Return the products as JSON
header('Content-Type: application/json');
echo json_encode($products);
?>
