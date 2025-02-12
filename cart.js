document.addEventListener("DOMContentLoaded", function() {
    // Example of handling "clear cart" functionality
    const clearCartButton = document.querySelector('button[name="clear_cart"]');
    if (clearCartButton) {
        clearCartButton.addEventListener('click', function() {
            alert("Cart cleared!");
        });
    }

    // Example of handling "place order" functionality
    const placeOrderButton = document.querySelector('button[name="place_order"]');
    if (placeOrderButton) {
        placeOrderButton.addEventListener('click', function(event) {
            // Logic for placing an order
            event.preventDefault(); // Prevent form submission
            alert("Order placed successfully!");
        });
    }
});
