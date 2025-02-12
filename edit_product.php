<?php
// Include the database connection
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch product details from the database
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
} else {
    echo "Product ID is missing!";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated product data from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Update the product details
    $query = "UPDATE products SET 
              name='$name', description='$description', price='$price', quantity='$quantity' 
              WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: product_management.php");  // Redirect to the product management page
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="addproduct1.css">
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>

        <!-- Product Edit Form -->
        <form method="POST">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>

            <button type="submit" class="btn">Update Product</button>
        </form>
    </div>
</body>
</html>
