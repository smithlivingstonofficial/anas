<?php
// Include database connection
include('db_connection.php');

// Get the user ID from the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user's details from the database
    $sql = "SELECT * FROM register WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id); // 'i' for integer
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "User not found.";
        exit;
    }

    // Handle form submission to update user details
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        // Validate form fields
        if (empty($name) || empty($email) || empty($role)) {
            echo "All fields are required!";
        } else {
            // Update user in the database
            $update_sql = "UPDATE register SET name = ?, email = ?, role = ? WHERE id = ?";
            $update_stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, 'sssi', $name, $email, $role, $user_id); // 'sssi' for string, string, string, integer

            if (mysqli_stmt_execute($update_stmt)) {
                header('Location: manage_user.php'); // Redirect back to the user management page
                exit();
            } else {
                echo "Error updating user: " . mysqli_error($conn);
            }
        }
    }
} else {
    echo "User ID not provided.";
    exit;
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
    <style>
        /* Simple CSS Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-btn {
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .back-btn:hover {
            color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>

    <!-- Display Error Message if Any -->
    <?php if (isset($error)) : ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Edit User Form -->
    <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="role">Role</label>
        <select name="role" required>
            <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>

        <button type="submit">Update User</button>
    </form>

    <!-- Link to Go Back to User Management -->
    <a href="manage_user.php" class="back-btn">Back to User Management</a>
</div>

</body>
</html>
