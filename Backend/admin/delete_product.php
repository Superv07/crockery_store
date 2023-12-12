<?php
include_once '../includes/db.php';

// Check if product ID is set in the POST data
if (isset($_POST['product_id'])) {
    // Get product ID from the POST data
    $product_id = $_POST['product_id'];

    // Prepare and bind the delete query
    $query = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($query);

    // Bind parameter
    $stmt->bind_param("i", $product_id);

    // Execute the query
    $result = $stmt->execute();

    // Check for errors
    if (!$result) {
        echo "Error: " . $stmt->error;
    } else {
        echo "Product deleted successfully!";
    }

    // Close statement
    $stmt->close();
} else {
    // If product ID is not set in the POST data, redirect to the product list page
    header("Location: ../../frontend/admin/product.php");
    exit();
}

// Close connection
$conn->close();
?>
