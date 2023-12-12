<!-- frontend/user/product.php -->
<?php
// Include your database connection file or define your database connection here
// Example: include 'path/to/db/connection.php';

include "../../backend/includes/db.php";

// Assuming you have the product_id in the URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch product details from the database
if (!empty($product_id)) {
    $sql = "SELECT id, name, price, description, image_filename FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        // Debugging: Print the SQL query and any error
        echo "Product ID: $product_id<br>";
        echo "SQL Query: $sql<br>";
        echo "Query Error: " . $conn->error;
        $product = null;
    }
} else {
    // Redirect to the product listing page if no specific product ID is provided
    header("Location: products.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>

<?php
if (!empty($product)) {
    echo '<h1>' . $product['name'] . '</h1>';
    echo '<p>Price: $' . $product['price'] . '</p>';
    echo '<p>Description: ' . $product['description'] . '</p>';
    echo '<img src="../../uploads/' . $product['image_filename'] . '" alt="Product Image">';

    // Add increment and decrement buttons with JavaScript for cart interaction
    echo '<button onclick="updateCart(' . $product['id'] . ', \'increment\')">Add to Cart</button>';
    echo '<button onclick="updateCart(' . $product['id'] . ', \'decrement\')">Remove from Cart</button>';
} else {
    echo "No product found.";
}

// Close the database connection
$conn->close();
?>

<script>
    function updateCart(productId, action) {
        // Send a request to update the cart
        fetch("../../backend/user/cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                action: action,
                productId: productId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Update the UI or perform any other actions based on the response
        });
    }
</script>

</body>
</html>
