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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter&amp;display=swap">

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="grid-layout">
        <!-- navigator -->
        <?php include "src/components/seller-nav.php"; ?>

        <div class="container p-5 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Notifications</h1>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-check-double me-2"></i>Mark all as read
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">All Notifications</a></li>
                            <li><a class="dropdown-item" href="#">Unread</a></li>
                            <li><a class="dropdown-item" href="#">Orders</a></li>
                            <li><a class="dropdown-item" href="#">Promotions</a></li>
                            <li><a class="dropdown-item" href="#">Updates</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Notification List -->
            <div class="card">
                <div class="list-group list-group-flush">
                    <!-- Order Notification -->
                    <div class="list-group-item list-group-item-action d-flex gap-3 py-3 unread position-relative">
                        <div class="d-flex gap-3 w-100">
                            <div class="flex-shrink-0">
                                <span
                                    class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px;">
                                    <i class="fas fa-box-open"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Your order has been shipped!</h6>
                                <p class="mb-0 text-body-secondary">Order #12345 is on its way. Track your package here.
                                </p>
                                <small class="text-body-secondary">2 hours ago</small>
                            </div>
                        </div>
                        <span class="position-absolute top-50 translate-middle-y end-0 me-3">
                            <span class="badge bg-primary rounded-pill"></span>
                        </span>
                    </div>

                    <!-- Promotion Notification -->
                    <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                        <div class="d-flex gap-3 w-100">
                            <div class="flex-shrink-0">
                                <span
                                    class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px;">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Special Winter Collection Sale!</h6>
                                <p class="mb-0 text-body-secondary">Get 20% off on all winter collection items. Use
                                    code:
                                    WINTER20</p>
                                <small class="text-body-secondary">1 day ago</small>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Alert -->
                    <div class="list-group-item list-group-item-action d-flex gap-3 py-3 unread position-relative">
                        <div class="d-flex gap-3 w-100">
                            <div class="flex-shrink-0">
                                <span
                                    class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px;">
                                    <i class="fas fa-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Item Back in Stock!</h6>
                                <p class="mb-0 text-body-secondary">The Ceramic Vase you were interested in is now
                                    available.</p>
                                <small class="text-body-secondary">2 days ago</small>
                            </div>
                        </div>
                        <span class="position-absolute top-50 translate-middle-y end-0 me-3">
                            <span class="badge bg-primary rounded-pill"></span>
                        </span>
                    </div>

                    <!-- Workshop Notification -->
                    <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                        <div class="d-flex gap-3 w-100">
                            <div class="flex-shrink-0">
                                <span
                                    class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px;">
                                    <i class="fas fa-calendar"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">New Workshop Available</h6>
                                <p class="mb-0 text-body-secondary">Join our "Beginners Pottery Workshop" this weekend.
                                </p>
                                <small class="text-body-secondary">3 days ago</small>
                            </div>
                        </div>
                    </div>

                    <!-- Review Notification -->
                    <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                        <div class="d-flex gap-3 w-100">
                            <div class="flex-shrink-0">
                                <span
                                    class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px;">
                                    <i class="fas fa-star"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">How was your purchase?</h6>
                                <p class="mb-0 text-body-secondary">Please rate your recent purchase of "Handcrafted
                                    Coffee
                                    Mug"</p>
                                <small class="text-body-secondary">4 days ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-4">
                <button class="btn btn-outline-primary">
                    Load More
                    <i class="fas fa-chevron-down ms-2"></i>
                </button>
            </div>
        </div>
    </div>




    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>