<?php
// Include database connection
include('db_connection.php');

// Check if the 'id' parameter exists in the URL (to know which user to edit)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data from the database
    $sql = "SELECT * FROM register WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    
    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found!";
        exit();
    }
} else {
    echo "User ID not specified!";
    exit();
}

// Initialize variables
$error = '';
$success_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Update user data in the database
    $update_sql = "UPDATE register SET name='$name', email='$email', role='$role' WHERE id='$id'";

    if (mysqli_query($conn, $update_sql)) {
        $success_message = "User updated successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="update.css"> <!-- Link to your CSS file -->
</head>
<body>

<div class="container">
    <header>
        <h1>Edit User</h1>
    </header>

    <!-- Display Success or Error Message -->
    <?php if (isset($success_message)) : ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php elseif (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Edit User Form -->
    <form action="update_user.php?id=<?php echo $user['id']; ?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" required>
                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
            </select>
        </div>

        <button type="submit">Update User</button>
    </form>

    <!-- Back to User Management -->
    <a href="manage_user.php" class="btn">Back to User Management</a>
</div>

</body>
</html>
