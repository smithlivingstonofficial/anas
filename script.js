document.addEventListener('DOMContentLoaded', function () {
    // Display a welcome alert when the page loads
    alert('Welcome to the Sports Shop Management System!');

    // Handle button clicks
    const loginButton = document.querySelector('.btn[href="login.html"]');  // More precise selection
    const registerButton = document.querySelector('.btn[href="register.html"]'); // More precise selection

    // Login button click event
    loginButton.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default action
        alert('Redirecting to the login page...');
        window.location.href = 'login.html'; // Redirect to login page
    });

    // Register button click event
    registerButton.addEventListener('click', function (e) {
        e.preventDefault();
        alert('Redirecting to the registration page...');
        window.location.href = 'register.html'; // Redirect to register page
    });
});
