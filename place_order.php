<?php
// Get the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

// Extract user details and cart data
$name = $data['name'];
$email = $data['email'];
$address = $data['address'];
$mobile = $data['mobile'];
$cart = $data['cart'];

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start a transaction to ensure atomicity
$conn->begin_transaction();

try {
    // Insert order into the 'orders' table
    $sql = "INSERT INTO orders (name, email, address, mobile) VALUES ('$name', '$email', '$address', '$mobile')";
    if ($conn->query($sql) === TRUE) {
        $orderId = $conn->insert_id; // Get the last inserted order ID

        // Insert each product in the cart into the 'order_items' table
        foreach ($cart as $item) {
            $productId = $item['productId'];
            $quantity = 1; // Assuming quantity is 1 for each product (You can modify this if needed)
            $price = $item['price'];
            $totalPrice = $price * $quantity;

            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price, total_price) 
                    VALUES ('$orderId', '$productId', '$quantity', '$price', '$totalPrice')";
            $conn->query($sql);
        }

        // Commit the transaction
        $conn->commit();

        // Respond with success
        echo json_encode(['status' => 'success', 'message' => 'Order placed successfully!']);
    } else {
        throw new Exception('Error inserting order into orders table');
    }
} catch (Exception $e) {
    // Rollback the transaction in case of any errors
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Error placing order: ' . $e->getMessage()]);
}

// Close the database connection
$conn->close();
?>
