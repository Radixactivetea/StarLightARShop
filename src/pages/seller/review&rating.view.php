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
    </style>
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>

        <div class="main-content p-4">
            <div class="rounded-3 p-3 mb-3" style="background-color: rgba(175, 143, 111, 0.3);">
                <h5 class="text-primary">Review & Rating</h5>
            </div>

            <?php foreach ($getAllReview as $review): ?>
                <div class="card mb-2 rounded-2">
                    <div class="card-header">
                        <small class="text-muted">
                            <?= htmlspecialchars($review['username']) ?> | Order ID: <a href="#"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">1202622346520228</a>
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <!-- Product Info -->
                            <div class="d-flex align-items-center border-end border-primary-subtle w-25">
                                <img src="/public/upload/product/<?= $review['image_url'] ?>" alt="Product"
                                    class="border rounded object-fit-cover" style="width: 70px; height: 70px;" />
                                <div class="ms-3">
                                    <h6 class="mb-0"><?= $review['product_name'] ?></h6>
                                </div>
                            </div>

                            <!-- Rating and Review -->
                            <div class="border-end border-primary-subtle px-4" style="width: 55%;">
                                <div class="text-warning mb-2">
                                    <?php for ($stars = 0; $stars < $review['rating']; $stars++) { ?>
                                        ★
                                    <?php } ?>
                                </div>
                                <p class="mb-0"><?= $review['review'] ?></p>
                                <small class="text-muted"><?= $review['formatted_date'] ?></small>

                                <?php if (!empty($review['response'])): ?>
                                    <div class="p-3 rounded my-2" style="background-color: rgba(175, 143, 111, 0.2);">
                                        <div class="text-muted mb-1">Seller Response:</div>
                                        <p class="mb-0"><?= htmlspecialchars($review['response']); ?></p>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <!-- Seller Reply -->
                            <div class="d-flex align-items-center justify-content-center" style="width: 20%;">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#replyModal"
                                    class="btn btn-outline-secondary btn-sm" <?= !empty($review['response']) ? 'disabled' : ''; ?>>Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Modal to enter tracking number -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title ps-1" id="trackingModalLabel">Reply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="trackingNumberInput" class="form-control">
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveTrackingBtn">Send</button>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>