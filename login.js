document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get the email and password values from the form
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');
    
    // Clear previous error message
    errorMessage.textContent = '';

    // Validate form data
    if (!email || !password) {
        errorMessage.textContent = 'Please enter both email and password';
        return;
    }

    // Send POST request to the PHP server to verify login credentials
    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => {
        // Check if response is okay
        if (!response.ok) {
            throw new Error('Server error');
        }
        return response.json();  // Parse the JSON response from the server
    })
    .then(data => {
        if (data.success) {
            // Clear any previous session data
            sessionStorage.clear();

            // Store login status and user role in sessionStorage
            sessionStorage.setItem('loggedIn', 'true');
            sessionStorage.setItem('userRole', data.role);

            // Redirect based on user role
            if (data.role === 'admin') {
                window.location.href = 'admin.html'; // Redirect to the admin dashboard (or manage.php)
            } else {
                window.location.href = 'user_product.php'; // Regular user page (or product.html)
            }
        } else {
            // Display the error message if login fails
            errorMessage.textContent = data.message || 'Invalid email or password';
        }
    })
    .catch(error => {
        errorMessage.textContent = error.message || 'An error occurred. Please try again later.';
    });
});
