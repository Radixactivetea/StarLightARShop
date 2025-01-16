<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
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
            border: 1px solid rgba(175, 143, 111, 0.2);
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
            border: 1px solid var(--bs-focus-ring-color);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option:hover {
            border-color: var(--bs-secondary);
            background-color: rgba(175, 143, 111, 0.2);
        }

        .payment-option.selected {
            border-color: var(--bs-secondary);
            background-color: rgba(175, 143, 111, 0.2);
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
    <?php displayAlert(); ?>
    <form class="container checkout-container py-5 needs-validation" method="POST" novalidate>
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

                                    <?php foreach ($getCartItem as $index => $item): ?>
                                        <tr
                                            class="<?= $index === array_key_last($getCartItem) ? '' : 'border-bottom border-primary' ?>">
                                            <td>
                                                <h6 class="mb-1"><?= $item['name'] ?></h6>
                                            </td>
                                            <td class="text-star" style="font-size: 0.8rem;">
                                                X <?= $item['quantity'] ?>
                                            </td>
                                            <td class="text-end">RM <?= $item['total_price'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>

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
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-2" type="radio" name="payment" id="credit-card"
                                    value="Card" checked>
                                <label class="form-check-label" for="credit-card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Credit Card</span>
                                        <div class="payment-method-img mx-3">
                                            <img src="/public/img/Visa_Brandmark_Blue_RGB_2021.png"
                                                style="witdh: 40px; height: 20px;" alt="Visa" class="me-2">
                                            <img src="/public/img/Mastercard-logo.svg.png"
                                                style="witdh: 50px; height: 30px;" alt="Mastercard" class="me-2">
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
                                <input class="form-check-input" type="radio" name="payment" id="paypal" value="Paypal">
                                <label class="form-check-label" for="paypal">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="me-2">PayPal</span>
                                        <img src="/public/img/paypal.png" style="witdh: 40px; height: 20px;"
                                            alt="PayPal">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="payment-option">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="applepay"
                                    value="Applepay">
                                <label class="form-check-label" for="paypal">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="me-2">Apple Pay</span>
                                        <img src="/public/img/Apple_pay_logo.svg.png" style="witdh: 40px; height: 20px;"
                                            alt="PayPal">
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
                                <input type="text" class="form-control" placeholder="Your Name" name="name"
                                    value="<?= htmlspecialchars($customerAddress['full_name'] ?? '') ?>" required>
                                <div class="invalid-feedback ms-2" style="font-size: 10px;">
                                    Your name reply is required.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone_number"
                                    value="<?= htmlspecialchars($customerAddress['phone_number'] ?? '') ?>" required>
                                <div class="invalid-feedback ms-2" style="font-size: 10px;">
                                    Your phone number is required.
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Street Address"
                                    name="street_address"
                                    value="<?= htmlspecialchars($customerAddress['street_address'] ?? '') ?>" required>
                                <div class="invalid-feedback ms-2" style="font-size: 10px;">
                                    Your address is required.
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" placeholder="State" name="state"
                                    value="<?= htmlspecialchars($customerAddress['state'] ?? '') ?>" required>
                                <div class="invalid-feedback ms-2" style="font-size: 10px;">
                                    State is required.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="City" name="city"
                                    value="<?= htmlspecialchars($customerAddress['city'] ?? '') ?>" required>
                                <div class="invalid-feedback ms-2" style="font-size: 10px;">
                                    City is required.
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Post Code" name="post_code"
                                    value="<?= htmlspecialchars($customerAddress['post_code'] ?? '') ?>" required>
                                <div class="invalid-feedback ms-2" style="font-size: 10px;">
                                    required.
                                </div>
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
                            <span>RM <?= $_SESSION['cart_data']['subtotal'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>RM <?= $_SESSION['cart_data']['shipping'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax</span>
                            <span>RM <?= $_SESSION['cart_data']['tax'] ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>RM <?= $_SESSION['cart_data']['total'] ?></strong>
                            <input type="hidden" name="total" value="<?= $_SESSION['cart_data']['total'] ?>">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Promo Code" name="promo_code">
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Place Order</button>

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
    </form>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

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
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>