<!-- frontend/admin/delete_product.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
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

        input[type="submit"] {
            background-color: #d9534f;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <h1>Delete Product</h1>
    <a href="product.php">Back to Products</a>
</header>

<nav>
    <!-- Add navigation links if needed -->
</nav>

<section>
    <?php
    // Assuming you have the product_id in the URL
    $product_id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($product_id) {
        ?>
        <form action="../../backend/admin/delete_product.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <p>Are you sure you want to delete this product?</p>
            <input type="submit" value="Delete Product">
        </form>
        <?php
    } else {
        echo "Invalid product ID.";
    }
    ?>
</section>

</body>
</html>
