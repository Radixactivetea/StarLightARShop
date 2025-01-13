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
                    <div class="py-3 border-bottom border-primary-subtle d-flex align-items-center position-relative">
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
                            <input type="number" class="input-box" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock_level'] ?>">
                            <button class="plus" aria-label="Increase">&plus;</button>
                        </div>
                        <p class="fw-bold mb-0 ms-5">RM <?= $item['price'] ?></p>
                        <button type="button" class="btn-close btn-position" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Order Summary Section -->
            <div class="col-md-4 pt-3">
                <div class="order-summary p-4 rounded custom-bg">
                    <h5>Order Summary</h5>
                    <div class="d-flex justify-content-between my-2">
                        <span>Subtotal</span>
                        <span>RM <?= number_format($total_cart, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <span>Shipping estimate</span>
                        <span>RM <?= number_format($shippingCost, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <span>Tax estimate (2%)</span>
                        <span>RM <?= number_format($tax, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between my-2 fw-bold">
                        <span>Order total</span>
                        <span>RM <?= number_format($total_price, 2) ?></span>
                    </div>
                    <button class="btn btn-primary w-100 mt-3">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="/public/js/product.js"></script>

</body>

</html>