// Handling the tab switching for Product and User Management
document.getElementById('productTab').addEventListener('click', function() {
    // Show product section, hide user section
    document.getElementById('productSection').style.display = 'block';
    document.getElementById('userSection').style.display = 'none';

    // Toggle active class for tab buttons
    document.getElementById('productTab').classList.add('active');
    document.getElementById('userTab').classList.remove('active');
});

document.getElementById('userTab').addEventListener('click', function() {
    // Show user section, hide product section
    document.getElementById('userSection').style.display = 'block';
    document.getElementById('productSection').style.display = 'none';

    // Toggle active class for tab buttons
    document.getElementById('userTab').classList.add('active');
    document.getElementById('productTab').classList.remove('active');
});
