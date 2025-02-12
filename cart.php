<?php
session_start();

// Assuming you are using session to store the cart for logged-in users
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the user is logged in (based on user email in session or localStorage)
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null; // Check if email is in session

// Check if user is logged in, and sync the cart accordingly
if ($userEmail) {
    // Fetch cart from the server (assuming you have a database or session storage)
    // For now, we'll assume the cart is fetched from session or database
    // If you were to fetch the cart from a database, do it here.
} else {
    // If the user is not logged in, use session-based cart (for non-logged-in users)
    // The cart will be stored in the session.
}

// Clear the cart if the 'clear_cart' button is clicked
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = []; // Clear the cart in session
    header('Location: cart.php'); // Redirect to refresh the cart page
    exit;
}

// Handle placing the order
if (isset($_POST['place_order'])) {
    // Process the order (this is just an example)
    // You would normally save the order details to the database and clear the cart after
    $_SESSION['cart'] = []; // Empty the cart
    echo 'Order placed successfully!';
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <div class="logo">
        <h2>MSD Sports Shop</h2>
    </div>
    <div class="menu-bar">
        <button id="side-menu-btn">☰</button>
    </div>
</div>

<!-- Cart Page -->
<div id="cart-list">
    <h3>Your Cart</h3>

    <?php if (count($_SESSION['cart']) > 0): ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>$<?php echo htmlspecialchars($item['price']); ?></td>
                    <td>1</td> <!-- You can modify this to show quantity if needed -->
                </tr>
            <?php endforeach; ?>
        </table>

        <form action="cart.php" method="POST">
            <button type="submit" name="clear_cart">Clear Cart</button>
            <button type="submit" name="place_order">Place Order</button>
        </form>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script src="cart.js"></script>

</body>
</html>
