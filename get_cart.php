<?php
session_start();
header('Content-Type: application/json');

// Get the email parameter
$email = $_GET['email'];

// Fetch the cart data from the database
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Query to get the cart for the given email
$stmt = $conn->prepare("SELECT cart FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($cart);
$stmt->fetch();

// If cart exists, return it, else return empty cart
echo json_encode(['cart' => $cart ? json_decode($cart) : []]);

$conn->close();
?>
