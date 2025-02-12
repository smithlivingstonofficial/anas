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

// Fetch sales data
$sql = "SELECT sales.id, products.name AS product_name, sales.quantity, sales.total, sales.sale_date
        FROM sales
        JOIN products ON sales.product_id = products.id
        ORDER BY sales.sale_date DESC";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales Details</title>
    <link rel="stylesheet" href="sales_details.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>View Sales Details</h1>
        </header>
        
        <!-- Sales Table -->
        <table>
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Product Name</th>
                    <th>Quantity Sold</th>
                    <th>Total Sale Amount</th>
                    <th>Sale Date</th>
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
                                <td>" . $row['total'] . "</td>
                                <td>" . $row['sale_date'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No sales records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>
