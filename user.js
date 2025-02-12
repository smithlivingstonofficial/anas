let cart = [];

// Toggle Side Menu
document.getElementById('side-menu-btn').onclick = function() {
    const menu = document.getElementById('side-menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
};

// Apply Filter (filter products by price and search term)
document.getElementById('apply-filter').onclick = function() {
    const minPrice = document.getElementById('min-price').value;
    const maxPrice = document.getElementById('max-price').value;
    const searchTerm = document.getElementById('search-bar').value; // Get the search term from the search input
    fetchProducts(minPrice, maxPrice, searchTerm);
};

// Fetch products based on filter and search term
function fetchProducts(minPrice, maxPrice, searchTerm) {
    fetch(`fetch_products.php?min_price=${minPrice}&max_price=${maxPrice}&search=${searchTerm}`)
        .then(response => response.json())
        .then(data => {
            let productList = document.getElementById('product-list');
            productList.innerHTML = ''; // Clear existing products
            data.forEach(product => {
                let productDiv = document.createElement('div');
                productDiv.classList.add('product');
                productDiv.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" width="100%">
                    <h4>${product.name}</h4>
                    <p>Price: $${product.price}</p>
                    <button class="cart-btn" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Add to Cart</button>
                `;
                productList.appendChild(productDiv);
            });
        })
        .catch(err => console.error('Error fetching products:', err));
}

// Add product to cart
function addToCart(productId, name, price) {
    cart.push({ productId, name, price });
    alert(`${name} added to cart`);
    document.getElementById('order-btn').style.display = 'block'; // Show Order button
}

// Display the order form when clicking "Order Now"
document.getElementById('order-btn').onclick = function() {
    const formHTML = `
        <h3>Order Details</h3>
        <form id="order-form">
            <label for="name">Name:</label><input type="text" id="name" required><br>
            <label for="email">Email:</label><input type="email" id="email" required><br>
            <label for="address">Address:</label><textarea id="address" required></textarea><br>
            <label for="mobile">Mobile:</label><input type="tel" id="mobile" required><br>
            <button type="submit">Place Order</button>
        </form>
    `;
    document.getElementById('order-form-container').innerHTML = formHTML;

    // Now that the form is added, attach the onsubmit event listener
    document.getElementById('order-form').onsubmit = function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;
        const mobile = document.getElementById('mobile').value;

        // Send order data to the server (via PHP)
        fetch('place_order.php', {
            method: 'POST',
            body: JSON.stringify({ name, email, address, mobile, cart }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            alert('Order Successful!');
            cart = []; // Empty the cart
            document.getElementById('order-btn').style.display = 'none'; // Hide Order button
        })
        .catch(err => alert('Error placing order.'));
    };
};
