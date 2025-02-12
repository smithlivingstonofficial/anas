<?php
// Include database connection
include('db_connection.php');

// Initialize variables
$error = '';
$success_message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    
    // Handle image upload
    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        // Define allowed image types
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $uploadDir = 'sports/';  // Relative path to the 'sports' folder
        $imageName = uniqid() . '.' . $imageType;  // Generate a unique name for the image
        $imagePath = $uploadDir . $imageName;  // Store relative path

        // Check if the directory exists, and create it if it doesn't
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create the directory with full permissions
        }

        // Check if the file is an image
        $check = getimagesize($imageTmp);
        if ($check === false) {
            $error = "File is not an image.";
        } else {
            // Validate file extension
            if (!in_array($imageType, $allowedExtensions)) {
                $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            } elseif ($imageSize > 5000000) { // Max size: 5MB
                $error = "File size is too large. Maximum allowed size is 5MB.";
            } else {
                // Move the uploaded image to the sports folder
                if (move_uploaded_file($imageTmp, $imagePath)) {
                    // Insert product into the database with image path
                    $sql = "INSERT INTO products (name, description, price, quantity, image) 
                            VALUES ('$name', '$description', '$price', '$quantity', '$imagePath')";

                    if (mysqli_query($conn, $sql)) {
                        $success_message = "Product added successfully!";
                    } else {
                        $error = "Error: " . mysqli_error($conn);
                    }
                } else {
                    $error = "Failed to upload image.";
                }
            }
        }
    } else {
        $error = "Please upload an image.";
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
    <title>Add Product</title>
    <link rel="stylesheet" href="addproduct1.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Add New Product</h1>
    </header>

    <!-- Display Success or Error Message -->
    <?php if (isset($success_message)) : ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php elseif (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Add New Product Form -->
    <section id="add-product">
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name</label>
            <input type="text" name="name" required>

            <label for="description">Description</label>
            <textarea name="description" required></textarea>

            <label for="price">Price</label>
            <input type="number" name="price" required>

            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" required>

            <label for="image">Product Image</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Add Product</button>
        </form>
    </section>
</div>

</body>
</html>
