<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        <?= displayAlert() ?>

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
                                <span
                                    class="badge status-pill bg-primary px-3 py-2"><?= $order['order_status'] ?></span>
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
                                                    <img src="/public/upload/product/<?= $item['image_url'] ?>" width="70px"
                                                        height="70px" class="me-3" alt="Product">
                                                    <div>
                                                        <h6 class="mb-0"><?= $item['name'] ?></h6>
                                                        <small class="text-muted">SKU: PRD<?= $item['product_id'] ?></small>
                                                    </div>
                                                    <?php if ($order['order_status'] == 'Delivered'): ?>
                                                        <div class="col-md-3 text-center">
                                                            <button class="btn text-white bg-primary px-3 py-2" type="button"
                                                                data-bs-toggle="modal" data-bs-target="#addReviewModal"
                                                                data-id="<?= $order['order_id'] ?>"
                                                                product-id="<?= $item['product_id'] ?>" title="Add Review">Add
                                                                Review
                                                            </button>
                                                        </div>
                                                    <?php endif; ?>
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

    <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReviewModalLabel">Add Your Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" >
                        <!-- Order ID (hidden) -->
                        <input type="hidden" name="order_id" id="order_id">
                        <input type="hidden" name="product_id" id="product_id">

                        <!-- Rating -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <?= showError('rating') ?>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="" disabled selected>Select Rating</option>
                                <option value="1">1 - Poor</option>
                                <option value="2">2 - Fair</option>
                                <option value="3">3 - Good</option>
                                <option value="4">4 - Very Good</option>
                                <option value="5">5 - Excellent</option>
                            </select>
                        </div>

                        <!-- Review Text -->
                        <div class="mb-3">
                            <label for="review" class="form-label">Your Review</label>
                            <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                            <?= showError('review') ?>
                            <?= old('review') ?>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Listen for the modal being shown
            const replyModal = document.getElementById('addReviewModal');
            replyModal.addEventListener('show.bs.modal', (event) => {
                // Get the button that triggered the modal
                const button = event.relatedTarget;

                // Extract the review ID from the data attribute
                const reviewId = button.getAttribute('data-id');
                const productId = button.getAttribute('product-id');

                // Set the hidden input field in the modal with the order ID
                const reviewIdInput = document.getElementById('order_id');
                reviewIdInput.value = reviewId;
                const productIdInput = document.getElementById('product_id');
                productIdInput.value = productId;
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