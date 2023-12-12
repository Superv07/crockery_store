<!-- frontend/admin/edit_product.php -->
<?php
// Include your database connection file or define your database connection here
// Example: include 'path/to/db/connection.php';

include "../../backend/includes/db.php";

function fetchProductDetails($conn, $product_id) {
    $sql = "SELECT id, name, price, description, image_filename FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null; // Product not found
    }
}

// Assuming you have the product_id in the URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($product_id) {
    // Fetch product details from the database
    $product = fetchProductDetails($conn, $product_id);

    if ($product) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Product</title>
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

                form {
                    max-width: 600px;
                    margin: 0 auto;
                }

                input, textarea {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                }

                input[type="submit"] {
                    background-color: #5bc0de;
                    color: white;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>

        <header>
            <h1>Edit Product</h1>
            <a href="product.php">Back to Products</a>
        </header>

        <nav>
            <!-- Add navigation links if needed -->
        </nav>

        <section>
            <form action="../../backend/admin/edit_product.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" value="<?php echo $product['name']; ?>" required>

                <label for="product_price">Product Price:</label>
                <input type="text" name="product_price" value="<?php echo $product['price']; ?>" required>

                <label for="product_description">Product Description:</label>
                <textarea name="product_description" required><?php echo $product['description']; ?></textarea>

                <label for="product_image">Product Image:</label>
                <input type="file" name="product_image" accept="image/*">

                <input type="submit" value="Update Product">
            </form>
        </section>

        </body>
        </html>
        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

// Close the database connection
$conn->close();
?>
