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

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSD Sports Shop</title>
    <link rel="stylesheet" href="user.css"> <!-- External CSS file -->
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <div class="logo">
        <h2>MSD Sports Shop</h2>
    </div>
    <!-- Search Form -->
    <form method="GET" action="">
        <input type="text" id="search-bar" name="search" placeholder="Search..." value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit">Search</button>
    </form>
    <div class="menu-bar">
        <button id="side-menu-btn">☰</button>
    </div>
</div>

<!-- Side Menu (Initially hidden) -->
<div id="side-menu" class="side-menu">
    <h3>Filter by Price</h3>
    <label for="min-price">Min Price: </label>
    <input type="number" id="min-price" value="<?= $minPrice ?>" name="min_price">
    <label for="max-price">Max Price: </label>
    <input type="number" id="max-price" value="<?= $maxPrice ?>" name="max_price">
    <button id="apply-filter" onclick="applyFilter()">Apply Filter</button>
</div>

<!-- Product List -->
<div id="product-list">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" width="100%">
            <h4><?= $product['name']; ?></h4>
            <p>Price: $<?= $product['price']; ?></p>
            <button class="cart-btn" onclick="addToCart(<?= $product['id']; ?>, '<?= $product['name']; ?>', <?= $product['price']; ?>)">Add to Cart</button>
        </div>
    <?php endforeach; ?>
</div>

<!-- Order Form (Hidden initially) -->
<div id="order-form-container"></div>

<!-- Order Button (Initially hidden) -->
<button id="order-btn" style="display:none;">Order Now</button>

<script src="user.js"></script> <!-- External JS file -->

<script>
    // Function to update the URL with the selected price range and reload the page
    function applyFilter() {
        const minPrice = document.getElementById('min-price').value;
        const maxPrice = document.getElementById('max-price').value;
        const searchTerm = document.getElementById('search-bar').value;
        
        // Redirect to the page with updated parameters
        window.location.href = "?min_price=" + minPrice + "&max_price=" + maxPrice + "&search=" + encodeURIComponent(searchTerm);
    }
</script>

</body>
</html>
