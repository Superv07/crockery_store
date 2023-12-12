<!-- frontend/admin/product.php -->
<?php
// Include your database connection file or define your database connection here
// Example: include 'path/to/db/connection.php';

include "../../backend/includes/db.php";

// Fetch all products from the database
$sql = "SELECT id, name, price, description, image_filename FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <!-- Add any additional styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #444;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        section {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .action-buttons {
            text-align: center;
        }

        .action-buttons a {
            margin: 5px;
            padding: 5px 10px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>All Products</h1>
    <a href="product.php">View All Products</a>
</header>

<nav>
    <a href="add_product.php">Add Product</a>
    <!-- Add navigation links if needed -->
</nav>

<section>
    <?php
    if ($result && $result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Actions</th></tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>$' . $row['price'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td><img src="../../uploads/' . $row['image_filename'] . '" alt="Product Image"></td>';
            
            // Action buttons
            echo '<td class="action-buttons">';
            echo '<a href="edit_product.php?id=' . $row['id'] . '">Edit</a>';
            echo '<a href="delete_product.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</a>';
            echo '</td>';
            
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "No products found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</section>

</body>
</html>
