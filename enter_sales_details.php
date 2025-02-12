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
    $total = $_POST['total'];
    $sale_date = $_POST['sale_date'];

    // Start a transaction to ensure both operations are atomic
    $conn->begin_transaction();

    try {
        // Insert the sale record into the sales table
        $sql_insert = "INSERT INTO sales (product_id, quantity, total, sale_date)
                       VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iids", $product_id, $quantity, $total, $sale_date);
        $stmt_insert->execute();

        // Update the product quantity in the products table (decrease the stock)
        $sql_update = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $quantity, $product_id);
        $stmt_update->execute();

        // Commit the transaction
        $conn->commit();

        // Success message
        echo "Sale recorded and product stock updated successfully!";
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
    <title>Enter Sales Details</title>
    <link rel="stylesheet" href="sales.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Enter Sales Details</h1>
        </header>
        
        <form action="enter_sales_details.php" method="POST">
            <div>
                <label for="product_id">Product ID:</label>
                <input type="number" name="product_id" required>
            </div>
            <div>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" required>
            </div>
            <div>
                <label for="total">Total Sale Amount:</label>
                <input type="number" step="0.01" name="total" required>
            </div>
            <div>
                <label for="sale_date">Sale Date:</label>
                <input type="date" name="sale_date" required>
            </div>
            <div>
                <button type="submit">Submit Sale</button>
            </div>
        </form>
    </div>
</body>
</html>
