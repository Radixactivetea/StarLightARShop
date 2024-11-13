<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <!-- cart style -->
    <style>
        .cart-title {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .cart-item {
            padding: 1rem 0;
            border-bottom: 1px solid #ddd;
        }

        .order-summary {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
        }

        .order-total {
            font-weight: 700;
        }

        .checkout-btn {
            background-color: #4f46e5;
            color: white;
        }

        .btn-position {
            position: absolute;
            top: 22px;
            right: 0;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="d-flex w-100 justify-content-between border-bottom mb-1">
            <h1 class="cart-title">Shopping Cart</h1>
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>

        <div class="row">
            <!-- Cart Items Section -->
            <div class="col-md-8">

                <div class="cart-item d-flex align-items-center position-relative">
                    <img src="https://via.placeholder.com/100" class="me-3" alt="Basic Tee Sienna">
                    <div class="flex-grow-1">
                        <h5 class="mb-0">Basic Tee</h5>
                        <p class="text-muted">Sienna | Large</p>
                        <p class="text-success mb-0">In stock</p>
                    </div>
                    <div class="me-3">
                        <input type="number" class="form-control w-50" value="1" min="1">
                    </div>
                    <p class="fw-bold mb-0">$32.00</p>
                    <button type="button" class="btn-close btn-position" aria-label="Close"></button>
                </div>

                <div class="cart-item d-flex align-items-center">
                    <img src="https://via.placeholder.com/100" class="me-3" alt="Basic Tee Black">
                    <div class="flex-grow-1">
                        <h5 class="mb-0">Basic Tee</h5>
                        <p class="text-muted">Black | Large</p>
                        <p class="text-muted mb-0">Ships in 3–4 weeks</p>
                    </div>
                    <div class="me-3">
                        <input type="number" class="form-control w-50" value="1" min="1">
                    </div>
                    <p class="fw-bold mb-0">$32.00</p>
                </div>

                <div class="cart-item d-flex align-items-center">
                    <img src="https://via.placeholder.com/100" class="me-3" alt="Nomad Tumbler White">
                    <div class="flex-grow-1">
                        <h5 class="mb-0">Nomad Tumbler</h5>
                        <p class="text-muted">White</p>
                        <p class="text-success mb-0">In stock</p>
                    </div>
                    <div class="me-3">
                        <input type="number" class="form-control w-50" value="1" min="1">
                    </div>
                    <p class="fw-bold mb-0">$35.00</p>
                </div>

            </div>

            <!-- Order Summary Section -->
            <div class="col-md-4 pt-3">
                <div class="order-summary">
                    <h5>Order Summary</h5>
                    <div class="d-flex justify-content-between my-2">
                        <span>Subtotal</span>
                        <span>$99.00</span>
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <span>Shipping estimate</span>
                        <span>$5.00</span>
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <span>Tax estimate</span>
                        <span>$8.32</span>
                    </div>
                    <div class="d-flex justify-content-between my-2 order-total">
                        <span>Order total</span>
                        <span>$112.32</span>
                    </div>
                    <button class="btn checkout-btn w-100 mt-3">Checkout</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>