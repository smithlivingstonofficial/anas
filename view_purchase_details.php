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

// Fetch purchase data
$sql = "SELECT purchases.id, products.name AS product_name, purchases.quantity, purchases.price, 
        purchases.purchase_date, (purchases.quantity * purchases.price) AS total_cost
        FROM purchases
        JOIN products ON purchases.product_id = products.id
        ORDER BY purchases.purchase_date DESC";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Purchase Details</title>
    <link rel="stylesheet" href="sales_details.css"> <!-- Link to your custom stylesheet -->
</head>
<body>
    <div class="container">
        <header>
            <h1>View Purchase Details</h1>
        </header>
        
        <!-- Purchase Table -->
        <table>
            <thead>
                <tr>
                    <th>Purchase ID</th>
                    <th>Product Name</th>
                    <th>Quantity Purchased</th>
                    <th>Price per Unit</th>
                    <th>Total Cost</th>
                    <th>Purchase Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['product_name'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['price'] . "</td>
                                <td>" . $row['total_cost'] . "</td>
                                <td>" . $row['purchase_date'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No purchase records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
