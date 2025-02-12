<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to login page
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];
$comment_text = $_POST['comment'];

// Insert the comment into the database
$sql = "INSERT INTO comments (product_id, user_id, comment_text) VALUES ($product_id, $user_id, '$comment_text')";
if ($conn->query($sql) === TRUE) {
    echo "Comment added successfully!";
    header("Location: product_detail.php?id=$product_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
