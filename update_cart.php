<?php
session_start();
header('Content-Type: application/json');

// Get JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Extract the email and cart data
$email = $data['email'];
$cart = json_encode($data['cart']); // Convert cart to JSON string

// You should save the cart data in a database associated with the email.
// Example:
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Save or update the cart in the database (assuming a 'users' table with a 'cart' column)
$stmt = $conn->prepare("UPDATE users SET cart = ? WHERE email = ?");
$stmt->bind_param('ss', $cart, $email);
$stmt->execute();

// Check if the update was successful
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'failure']);
}

$conn->close();
?>
