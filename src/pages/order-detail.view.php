<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <title>Checkout Order</title>
    <style>
        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background-color: rgba(175, 143, 111, 0.1)
        }

        .form-control,
        .form-select {
            padding: 0.75rem;
            border-radius: 8px;
        }

        .btn-primary {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .payment-option {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option:hover {
            border-color: #0d6efd;
            background-color: #f8f9ff;
        }

        .payment-option.selected {
            border-color: #0d6efd;
            background-color: #f8f9ff;
        }

        .step-number {
            width: 24px;
            height: 24px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container checkout-container py-5">
        <div class="row g-4">
            <!-- Checkout Steps -->
            <div class="col-lg-8">
                <!-- Cart Summary -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <span class="step-number bg-secondary text-light">1</span>
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="border-bottom border-primary">
                                        <td>
                                            <h6 class="mb-1">Wireless Headphones Pro</h6>
                                        </td>
                                        <td class="text-star" style="font-size: 0.8rem;">
                                            X 5
                                        </td>
                                        <td class="text-end">RM 129.99</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-1">Wireless Headphones Pro</h6>
                                        </td>
                                        <td class="text-star" style="font-size: 0.8rem;">
                                            X 5
                                        </td>
                                        <td class="text-end">RM 129.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <span class="step-number bg-secondary text-light">2</span>
                            <h5 class="mb-0">Payment Method</h5>
                        </div>
                        <div class="payment-option selected">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="credit-card" checked>
                                <label class="form-check-label" for="credit-card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Credit Card</span>
                                        <div>
                                            <img src="/api/placeholder/40/25" alt="Visa" class="me-2">
                                            <img src="/api/placeholder/40/25" alt="Mastercard" class="me-2">
                                            <img src="/api/placeholder/40/25" alt="Amex">
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="mt-3">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="Card Number">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="CVV">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-option">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="paypal">
                                <label class="form-check-label" for="paypal">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>PayPal</span>
                                        <img src="/api/placeholder/80/25" alt="PayPal">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <span class="step-number">3</span>
                            <h5 class="mb-0">Shipping Address</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Street Address">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Apartment, suite, etc. (optional)">
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option selected>Select State</option>
                                    <option>New York</option>
                                    <option>California</option>
                                    <option>Texas</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="ZIP">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>$429.98</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>$9.99</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax</span>
                            <span>$38.70</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>$478.67</strong>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Promo Code">
                        </div>

                        <button class="btn btn-primary w-100">Place Order</button>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                By placing your order, you agree to our
                                <a href="#" class="text-decoration-none">Terms & Conditions</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function () {
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
            });
        });
    </script>
</body>

</html>