<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">

    <style>
        .card-body {
            padding-left: 0;
            padding-right: 0;
        }
    </style>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>

    <div class="container py-5">
        <!-- Order Status Banner -->
        <div class="alert text-center mb-4" role="alert">
            <h4 class="alert-heading mb-0">#ODR<?= $order['order_id'] ?></h4>
        </div>

        <div class="row g-4">
            <!-- Order Summary -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4 px-3">
                            <div class="col-md-4">
                                <p class="text-muted mb-2">Order Date</p>
                                <p class="fw-bold"><?= $date = date('d F Y', strtotime($order['date'])); ?></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <p class="text-muted mb-2">Expected Delivery</p>
                                <p class="fw-bold">
                                    <?= $expectedDelivery = date('d F Y', strtotime($order['date'] . ' +10 days')); ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <p class="text-muted mb-2">Order Status</p>
                                <span class="badge bg-success"><?= $order['order_status'] ?></span>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="light-color p-5" style="height: 3rem;">
                                    <tr>
                                        <th style="padding-left: 1rem;">Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($order_item as $item): ?>
                                        <tr>
                                            <td style="padding-left: 1rem;">
                                                <div class="d-flex align-items-center">
                                                    <img src="/public/upload/product/<?= $item['image_url'] ?>" width="70px" height="70px" class="me-3" alt="Product">
                                                    <div>
                                                        <h6 class="mb-0"><?= $item['name'] ?></h6>
                                                        <small class="text-muted">SKU: PRD<?= $item['product_id'] ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td>RM <?= $item['price'] ?></td>
                                            <td>RM <?= $item['total_price'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>