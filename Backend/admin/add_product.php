<?php
include_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];

    // Handle image upload
    $image_filename = uploadImage($_FILES['product_image']);

    // Prepare and bind the insert query
    $query = "INSERT INTO products (name, price, description, image_filename) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("ssss", $name, $price, $description, $image_filename);

    // Execute the query
    $result = $stmt->execute();

    if (!$result) {
        echo "Error: " . $stmt->error;
    } else {
        echo "Product added successfully!";
    }

    $stmt->close();
}

$conn->close();

function uploadImage($file) {
    $targetDir = "../../uploads/";  // Adjust this path to your actual upload folder

    // Generate a unique filename to avoid overwriting existing files
    $imageFilename = uniqid() . '_' . basename($file["name"]);

    $targetFile = $targetDir . $imageFilename;

    // Move the uploaded file to the target directory
    move_uploaded_file($file["tmp_name"], $targetFile);

    return $imageFilename;
}
?>
