<?php
// db_connection.php

$servername = "localhost";  // Change to your server if needed
$username = "root";         // Default username for XAMPP
$password = "";             // Default password for XAMPP
$dbname = "project";        // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
