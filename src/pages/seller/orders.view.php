<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <style>
        .status-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
        }

        .status-paid {
            background-color: #e8f5f3;
            color: #0c6b58;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-overdue {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>

        <div class="main-content p-4">

            <div class="rounded-3 p-3" style="background-color: rgba(175, 143, 111, 0.3);">
                <div class="d-flex justify-content-between align-items-center mb-4 text-primary">
                    <h5 class="mb-0">Recent Invoices</h5>
                    <!-- <div class="d-flex gap-2">
                        <button class="btn btn-primary">Filter</button>
                    </div> -->
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Subtotal</th>
                                <th>Tracking Number</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($getAllOrders as $order): ?>
                                <tr>
                                    <td>
                                        <a href="/order/<?= $order['order_id'] ?>"
                                            class="btn btn-primary"><?= $order['order_id'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <?= $order['username'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $order['formatted_date'] ?>     <?= $order['formatted_time'] ?>
                                    </td>
                                    <td>
                                        <span class="status-pill status-paid"><?= $order['order_status'] ?></span>
                                    </td>
                                    <td>
                                        RM <?= $order['total_price'] ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target="#trackingModal">Add Tracking</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to enter tracking number -->
    <div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title ps-1" id="trackingModalLabel">Enter Tracking Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="trackingNumberInput" class="form-control"
                        placeholder="Enter Tracking Number">
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveTrackingBtn">Save Tracking</button>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>