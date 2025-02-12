<?php
include('db_connection.php');

// Query to fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Return products as JSON
echo json_encode($products);

mysqli_close($conn);
?>
