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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>

        <div class="main-content p-4">

            <?= displayAlert() ?>

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

                            <?php foreach ($orders as $index => $order): ?>
                                <tr>
                                    <td>
                                        <a href="/order/detail/<?= $order['order_id'] ?>"
                                            class="btn btn-primary">#<?= substr($order['order_id'], 0, 6) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <?= $order['firstname'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $order['formatted_date'] ?>     <?= $order['formatted_time'] ?>
                                    </td>
                                    <td>
                                        <span class="status-pill <?= $order['status_class'] ?>">
                                            <?= $order['order_status'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        RM <?= $order['total_price'] ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($order['has_tracking'])): ?>
                                            <!-- Display tracking number as muted text -->
                                            <span class="text-muted"><?= htmlspecialchars($order['tracking_number']) ?></span>
                                        <?php elseif (strtolower($order['order_status']) === 'paid'): ?>
                                            <!-- Show "Add Tracking Number" button for orders with status "Paid" -->
                                            <button class="btn btn-primary ms-5" type="button" data-bs-toggle="modal"
                                                data-bs-target="#trackingModal" data-id="<?= $order['order_id'] ?>"
                                                title="Add Tracking Number">
                                                <i class="bi bi-truck"></i>
                                            </button>
                                        <?php else: ?>
                                            <!-- Leave cell empty for other statuses -->
                                            <span class="text-muted ms-5">N/A</span>
                                        <?php endif; ?>
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
                <form method="POST" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <input type="text" id="trackingNumberInput" name="trackingNumberInput" class="form-control"
                            value="<?= old('trackingNumberInput') ?>" required>
                        <?php showError('trackingNumberInput') ?>
                        <div class="invalid-feedback ms-2" style="font-size: 10px;">Tracking number is required.</div>
                        <input type="hidden" id="trackingIdInput" name="order_id">
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="sumbit" class="btn btn-primary" id="saveTrackingBtn">Save Tracking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Listen for the modal being shown
            const replyModal = document.getElementById('trackingModal');
            replyModal.addEventListener('show.bs.modal', (event) => {
                // Get the button that triggered the modal
                const button = event.relatedTarget;

                // Extract the review ID from the data attribute
                const reviewId = button.getAttribute('data-id');

                // Set the hidden input field in the modal with the order ID
                const reviewIdInput = document.getElementById('trackingIdInput');
                reviewIdInput.value = reviewId;
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