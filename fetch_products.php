<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter and search input from the user (if any)
$minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : 200;
$maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : 5000;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch products from the database with filter and search
$sql = "SELECT * FROM products WHERE price BETWEEN ? AND ? AND name LIKE ?";
$stmt = $conn->prepare($sql);
$searchTermWithWildcard = "%" . $searchTerm . "%";
$stmt->bind_param('iis', $minPrice, $maxPrice, $searchTermWithWildcard);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Return the filtered products as JSON
echo json_encode($products);

// Close the database connection
$conn->close();
?>
