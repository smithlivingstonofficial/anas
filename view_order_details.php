<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch order data (order id, name, email, address, mobile, product name, order date, price)
$sql = "SELECT o.id AS order_id, o.name, o.email, o.address, o.mobile, oi.product_id, p.name AS product_name, o.order_date, oi.total_price
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);

// Store results in an array
$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order Details</title>
    <link rel="stylesheet" href="sales_details.css"> <!-- External CSS file -->
</head>
<body>
    <div class="container">
        <header>
            <h1>View Order Details</h1>
        </header>
        
        <!-- Order Table -->
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Product Name</th>
                    <th>Order Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($orders) > 0) {
                    // Output data for each order
                    foreach ($orders as $order) {
                        echo "<tr>
                                <td>" . $order['order_id'] . "</td>
                                <td>" . $order['name'] . "</td>
                                <td>" . $order['email'] . "</td>
                                <td>" . $order['address'] . "</td>
                                <td>" . $order['mobile'] . "</td>
                                <td>" . $order['product_name'] . "</td>
                                <td>" . $order['order_date'] . "</td>
                                <td>$" . number_format($order['total_price'], 2) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
