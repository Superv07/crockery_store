<!-- frontend/admin/add_product.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
    <h1>Add Product</h1>
    <a href="product.php">Back to Products</a>
</header>

<nav>
    <!-- Add navigation links if needed -->
</nav>

<section>
    <form action="../../backend/admin/add_product.php" method="post" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>

        <label for="product_price">Product Price:</label>
        <input type="text" name="product_price" required>

        <label for="product_description">Product Description:</label>
        <textarea name="product_description" required></textarea>

        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" accept="image/*" required>

        <input type="submit" value="Add Product">
    </form>
</section>

</body>
</html>
