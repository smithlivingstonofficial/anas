<?php
// Start session to verify login
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Include database connection
include('db_connection.php');

// Get the section from the URL (default to 'products' if not set)
$section = isset($_GET['section']) ? $_GET['section'] : 'products';

// Fetch data based on the section
if ($section == 'products') {
    $result = mysqli_query($conn, "SELECT * FROM products");
} elseif ($section == 'users') {
    $result = mysqli_query($conn, "SELECT * FROM users");
} elseif ($section == 'purchases') {
    $result = mysqli_query($conn, "SELECT * FROM purchases");
} else {
    // Default to products if the section is invalid
    $result = mysqli_query($conn, "SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="addproduct.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>

        <!-- Sidebar Navigation -->
        <nav>
            <ul>
                <li><a href="admin.php?section=products" class="btn">Product Management</a></li>
                <li><a href="admin.php?section=users" class="btn">User Management</a></li>
                <li><a href="admin.php?section=purchases" class="btn">Purchase Management</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <?php if ($section == 'products'): ?>
                <!-- Product Management Section -->
                <h2>Product Management</h2>
                <table>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                            <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            <?php elseif ($section == 'users'): ?>
                <!-- User Management Section -->
                <h2>User Management</h2>
                <table>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            <?php elseif ($section == 'purchases'): ?>
                <!-- Purchase Management Section -->
                <h2>Purchase Management</h2>
                <table>
                    <tr>
                        <th>Purchase ID</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Purchase Date</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['purchase_date']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
