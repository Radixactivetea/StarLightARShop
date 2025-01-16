<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <!-- cart style -->
    <link rel="stylesheet" href="/public/css/cart.css">
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="container my-5">
        <div class="d-flex w-100 justify-content-between border-bottom border-primary-subtle mb-1">
            <h2 class="fw-bold">Shopping Cart</h2>
            <button type="button" class="btn-close align-self-center" aria-label="Close"
                onclick="history.back()"></button>
        </div>

        <div class="row">
            <!-- Cart Items Section -->
            <div class="col-md-8">

                <?php foreach ($getAllCartList as $item): ?>
                    <div class="py-3 border-bottom border-primary-subtle d-flex align-items-center position-relative"
                        data-product-id="<?= $item['product_id'] ?>">

                        <img src="/public/upload/product/<?= $item['image_url'] ?>" class="me-3" width="100px"
                            height="100px" alt="<?= $item['name'] ?>">
                        <div class="flex-grow-1">
                            <h5 class="mb-0"><?= $item['name'] ?></h5>
                            <p class="text-muted" style="font-size: 0.8rem;"><?= $item['category'] ?></p>
                            <p class="mb-0">

                                <?php if ($item['stock_level'] > 0) { ?>
                                    <span class="text-success">In stock</span>
                                <?php } else { ?>
                                    <span class="text-danger">Out of stock</span>
                                <?php } ?>

                            </p>
                        </div>
                        <div class="quantity me-5">
                            <button class="minus" aria-label="Decrease">&minus;</button>
                            <input type="number" class="input-box" value="<?= $item['quantity'] ?>" min="1"
                                max="<?= $item['stock_level'] ?>">
                            <button class="plus" aria-label="Increase">&plus;</button>
                        </div>
                        <p class="fw-bold mb-0 ms-5">RM <?= $item['price'] ?></p>
                        <button type="button" class="btn-close btn-position" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Order Summary Section -->
            <div class="col-md-4 pt-3">
                <form class="order-summary p-4 rounded custom-bg" method="POST" action="/cart"
                    onsubmit="updateFormData()">
                    <h5>Order Summary</h5>

                    <!-- Subtotal -->
                    <div class="d-flex justify-content-between my-2">
                        <span id="subtotal-label">Subtotal</span>
                        <span id="subtotal-value">RM <?= number_format($total_cart, 2) ?></span>
                        <input type="hidden" name="subtotal" id="subtotal" value="<?= $total_cart ?>">
                    </div>

                    <!-- Shipping -->
                    <div class="d-flex justify-content-between my-2">
                        <span id="shipping-label">Shipping estimate</span>
                        <span id="shipping-value">RM <?= number_format($shippingCost, 2) ?></span>
                        <input type="hidden" name="shipping" id="shipping" value="<?= $shippingCost ?>">
                    </div>

                    <!-- Tax -->
                    <div class="d-flex justify-content-between my-2">
                        <span id="tax-label">Tax estimate (2%)</span>
                        <span id="tax-value">RM <?= number_format($tax, 2) ?></span>
                        <input type="hidden" name="tax" id="tax" value="<?= $tax ?>">
                    </div>

                    <!-- Total -->
                    <div class="d-flex justify-content-between my-2 fw-bold">
                        <span id="total-label">Order total</span>
                        <span id="total-value">RM <?= number_format($total_price, 2) ?></span>
                        <input type="hidden" name="total" id="total" value="<?= $total_price ?>">
                    </div>

                    <!-- Checkout Button -->
                    <button type="submit" class="btn btn-primary w-100 mt-3">Checkout</button>
                </form>
            </div>
        </div>

        <!-- bootstap and popper -->
        <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
        <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="/public/js/cart-update-handler.js"></script>
        <script>
            // This function updates the hidden input fields with the latest values from the spans before form submission.
            function updateFormData() {
                // Update the hidden input fields with the latest text from the span elements
                document.getElementById('subtotal').value = document.getElementById('subtotal-value').textContent.replace('RM ', '');
                document.getElementById('shipping').value = document.getElementById('shipping-value').textContent.replace('RM ', '');
                document.getElementById('tax').value = document.getElementById('tax-value').textContent.replace('RM ', '');
                document.getElementById('total').value = document.getElementById('total-value').textContent.replace('RM ', '');
            }
        </script>
    </div>
</body>

</html>