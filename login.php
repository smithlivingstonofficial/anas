<?php
// Include database connection
include('db_connection.php');

// Initialize response array
$response = ['success' => false, 'message' => 'Invalid email or password'];

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists in the 'register' table
    $query = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        // User found, fetch user data
        $user = mysqli_fetch_assoc($result);

        // Verify the password (assuming password is hashed in the database)
        if (password_verify($password, $user['password'])) {
            // Successful login, set session and return success response
            $response['success'] = true;
            $response['role'] = $user['role']; // Return user role (admin/user)
        } else {
            // Incorrect password
            $response['message'] = 'Incorrect password';
        }
    } else {
        // User not found
        $response['message'] = 'Email not found';
    }
}

// Return JSON response
echo json_encode($response);
?>
