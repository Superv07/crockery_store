<?php
 include_once '../includes/db.php';
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $id = $_POST['product_id'];
     $name = $_POST['product_name'];
     $price = $_POST['product_price'];
     $description = $_POST['product_description'];
 
     // Handle image upload if a new image is selected
     $image_filename = ($_FILES['product_image']['name'] != "") ? uploadImage($_FILES['product_image']) : null;
 
     // Prepare and bind the update query
     if ($image_filename) {
         $query = "UPDATE products SET name=?, price=?, description=?, image_filename=? WHERE id=?";
         $stmt = $conn->prepare($query);
         $stmt->bind_param("ssssi", $name, $price, $description, $image_filename, $id);
     } else {
         $query = "UPDATE products SET name=?, price=?, description=? WHERE id=?";
         $stmt = $conn->prepare($query);
         $stmt->bind_param("sssi", $name, $price, $description, $id);
     }
 
     $result = $stmt->execute();
 
     if (!$result) {
         echo "Error: " . $stmt->error;
     } else {
         echo "Product updated successfully!";
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
 