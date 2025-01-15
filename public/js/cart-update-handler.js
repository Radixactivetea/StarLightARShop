// Get all quantity controls
document.querySelectorAll('.quantity').forEach(quantityControl => {
    const minusBtn = quantityControl.querySelector('.minus');
    const plusBtn = quantityControl.querySelector('.plus');
    const input = quantityControl.querySelector('.input-box');
    const cartItem = quantityControl.closest('.py-3');
    const productId = cartItem.dataset.productId; // We'll need to add this to the HTML

    // Handle minus button click
    minusBtn.addEventListener('click', () => {
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            updateCartQuantity(productId, input.value);
        }
    });

    // Handle plus button click
    plusBtn.addEventListener('click', () => {
        if (input.value < parseInt(input.max)) {
            input.value = parseInt(input.value) + 1;
            updateCartQuantity(productId, input.value);
        }
    });

    // Handle direct input changes
    input.addEventListener('change', () => {
        let value = parseInt(input.value);
        const max = parseInt(input.max);

        // Ensure value is within bounds
        if (value < 1) value = 1;
        if (value > max) value = max;

        input.value = value;
        updateCartQuantity(productId, value);
    });
});

// Function to update cart quantity
function updateCartQuantity(productId, quantity) {
    fetch('/cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${productId}&quantity=${quantity}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Ensure subtotal, tax, and total are numbers and then update the page
                document.querySelector('#subtotal-value').textContent = `RM ${parseFloat(data.subtotal).toFixed(2)}`;

                document.querySelector('#tax-value').textContent = `RM ${parseFloat(data.tax).toFixed(2)}`;

                document.querySelector('#total-value').textContent = `RM ${parseFloat(data.total).toFixed(2)}`;
            } else {
                alert('Failed to update cart');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the cart');
        });
}