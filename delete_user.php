<?php
// Include database connection
include('db_connection.php');

// Get the user ID from the URL
$user_id = $_GET['id'];

// Delete the user from the database
$delete_sql = "DELETE FROM register WHERE id = $user_id";
if (mysqli_query($conn, $delete_sql)) {
    header('Location: manage_user.php'); // Redirect to user management page
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
