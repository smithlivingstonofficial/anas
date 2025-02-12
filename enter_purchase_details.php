<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $purchase_date = $_POST['purchase_date'];

    // Start a transaction to ensure both operations are atomic
    $conn->begin_transaction();

    try {
        // Insert the purchase record into the purchases table
        $sql_insert = "INSERT INTO purchases (product_id, quantity, price, purchase_date)
                       VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iids", $product_id, $quantity, $price, $purchase_date);
        $stmt_insert->execute();

        // Update the product quantity in the products table (increase the stock)
        $sql_update = "UPDATE products SET quantity = quantity + ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $quantity, $product_id);
        $stmt_update->execute();

        // Commit the transaction
        $conn->commit();

        // Success message
        echo "Purchase recorded and product stock updated successfully!";
    } catch (Exception $e) {
        // If there is an error, rollback the transaction
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Purchase Details</title>
    <link rel="stylesheet" href="purchase.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Enter Purchase Details</h1>
        </header>
        
        <form action="enter_purchase_details.php" method="POST">
            <div>
                <label for="product_id">Product ID:</label>
                <input type="number" name="product_id" required>
            </div>
            <div>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" required>
            </div>
            <div>
                <label for="purchase_date">Purchase Date:</label>
                <input type="date" name="purchase_date" required>
            </div>
            <div>
                <button type="submit">Submit Purchase</button>
            </div>
        </form>
    </div>
</body>
</html>
