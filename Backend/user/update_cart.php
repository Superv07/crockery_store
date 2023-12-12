<?php
session_start();

// Include the database connection file
include "../includes/db.php";

// Validate that the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    exit;
}

// Assuming you have user authentication in place
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Decode the JSON payload
$data = json_decode(file_get_contents("php://input"), true);

// Validate the required parameters
if (!isset($data['action'], $data['productId'])) {
    http_response_code(400); // Bad Request
    exit;
}

$action = $data['action'];
$productId = $data['productId'];

// Handle different actions
switch ($action) {
    case 'increment':
        addToCart($user_id, $productId);
        break;
    case 'decrement':
        removeFromCart($user_id, $productId);
        break;
    default:
        http_response_code(400); // Bad Request
        exit;
}

// Fetch and return updated cart items
$cartItems = fetchCartItems($user_id);
header('Content-Type: application/json');
echo json_encode(['quantity' => getCartItemQuantity($user_id, $productId), 'cartItems' => $cartItems]);

// Functions to interact with the cart in the database
function addToCart($user_id, $product_id) {
    global $conn;
    
    // Check if the product is already in the cart
    $sql = "SELECT id FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Product is already in the cart, update the quantity
        $sqlUpdate = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
        $conn->query($sqlUpdate);
    } else {
        // Product is not in the cart, insert a new record
        $sqlInsert = "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)";
        $conn->query($sqlInsert);
    }
}

function removeFromCart($user_id, $product_id) {
    global $conn;

    // Check if the product is in the cart
    $sql = "SELECT id, quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Product is in the cart
        $row = $result->fetch_assoc();

        if ($row['quantity'] > 1) {
            // If quantity is greater than 1, decrement the quantity
            $sqlUpdate = "UPDATE cart SET quantity = quantity - 1 WHERE id = " . $row['id'];
            $conn->query($sqlUpdate);
        } else {
            // If quantity is 1, remove the product from the cart
            $sqlDelete = "DELETE FROM cart WHERE id = " . $row['id'];
            $conn->query($sqlDelete);
        }
    }
}

function fetchCartItems($user_id) {
    global $conn;
    
    // Fetch cart items from the database
    $sql = "SELECT p.id, p.name, p.price, p.image_filename, c.quantity 
            FROM cart c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = $user_id";
    $result = $conn->query($sql);

    return ($result && $result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getCartItemQuantity($user_id, $product_id) {
    global $conn;
    
    // Fetch the quantity of a specific product in the cart
    $sql = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $result = $conn->query($sql);

    return ($result && $result->num_rows > 0) ? (int)$result->fetch_assoc()['quantity'] : 0;
}

// Close the database connection
$conn->close();
?>
