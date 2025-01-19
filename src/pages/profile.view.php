<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">

    <style>
        .list-group-item-action:focus,
        .list-group-item-action:hover {
            background-color: var(--bs-card-cap-bg);
        }

        .list-group-item {
            border: var(--bs-list-group-border-width) solid var(--bs-focus-ring-color);
        }
    </style>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>

    <div class="container py-5">
        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="/public/upload/profile/<?= $user['profile_pic_url'] ?? "default.png" ?> "
                            width="150px" height="150px" class="rounded-circle mb-3" alt="Profile Picture">
                        <h5 class="card-title mb-0"><?= $user['firstname'] . ' ' . $user['lastname'] ?></h5>
                        <p class="text-muted"><?= $user['email'] ?></p>
                        <div class="d-grid">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Quick Actions -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <a href="/cart" class="card-body text-center text-decoration-none">
                                <div class="position-relative d-inline-block">
                                    <i class="fas fa-shopping-cart fa-2x text-primary mb-2"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?= $cartNum['total_items'] ?>
                                    </span>
                                </div>
                                <h6 class="card-title mt-2">Cart</h6>
                                <p class="small text-muted mb-0"><?= $cartNum['total_items'] ?> items pending</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <a href="/cart" class="card-body text-center text-decoration-none">
                                <div class="position-relative d-inline-block">
                                    <i class="fas fa-bell fa-2x text-primary mb-2"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        5
                                    </span>
                                </div>
                                <h6 class="card-title mt-2">Notifications</h6>
                                <p class="small text-muted mb-0">5 unread messages</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-box fa-2x text-primary mb-2"></i>
                                <h6 class="card-title mt-2">Orders</h6>
                                <p class="small text-muted mb-0"><?= $order[0]['total_orders'] ?> total orders</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Recent Orders</h6>
                            <button class="btn btn-sm btn-link text-reset" data-bs-toggle="modal" data-bs-target="#allOrdersModal">
                                View All
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">

                            <?php foreach ($order as $orderDetail): ?>
                                <a href="profile/order/213" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Order #<?= substr($orderDetail['order_id'], 0, 6) ?></h6>
                                            <small class="text-muted"><?= $orderDetail['total_items'] ?> items • Delivered
                                                on Jan 15, 2025</small>
                                        </div>
                                        <span class="badge status-pill <?= $orderDetail['status_class'] ?>">
                                            <?= $orderDetail['status_order'] ?>
                                        </span>
                                    </div>
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Profile Picture -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="/public/upload/profile/default.png" width="150px" height="150px"
                                    class="rounded-circle" alt="Profile Picture">
                                <button type="button"
                                    class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="mb-4">
                            <h6 class="mb-3">Personal Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="John">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="Doe">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="john.doe@example.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" value="+1 (555) 123-4567">
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="mb-4">
                            <h6 class="mb-3">Address Information</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Street Address</label>
                                    <input type="text" class="form-control" value="123 Main Street">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" value="New York">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">State</label>
                                    <select class="form-select">
                                        <option value="NY" selected>NY</option>
                                        <option value="CA">CA</option>
                                        <option value="TX">TX</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">ZIP Code</label>
                                    <input type="text" class="form-control" value="10001">
                                </div>
                            </div>
                        </div>

                        <!-- Password Change -->
                        <div class="mb-4">
                            <h6 class="mb-3">Change Password</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Notification Preferences -->
                        <div class="mb-4">
                            <h6 class="mb-3">Notification Preferences</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" checked id="emailNotif">
                                <label class="form-check-label" for="emailNotif">
                                    Email Notifications
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" checked id="smsNotif">
                                <label class="form-check-label" for="smsNotif">
                                    SMS Notifications
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="marketingNotif">
                                <label class="form-check-label" for="marketingNotif">
                                    Marketing Communications
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="allOrdersModal" tabindex="-1" aria-labelledby="allOrdersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allOrdersModalLabel">Order History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Order Filters -->
                    <div class="mb-4">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option selected>All Status</option>
                                    <option>Delivered</option>
                                    <option>Processing</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option selected>Last 6 Months</option>
                                    <option>Last Year</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search orders...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders List -->
                    <div class="list-group">
                        <a href="/order/12345" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Order #12345</h6>
                                    <p class="mb-1 text-muted small">2 items • Total: $156.00</p>
                                    <small class="text-muted">Delivered on Jan 15, 2025</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success mb-2 d-block">Delivered</span>
                                    <small class="text-primary">View Details →</small>
                                </div>
                            </div>
                        </a>
                        <a href="/order/12344" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Order #12344</h6>
                                    <p class="mb-1 text-muted small">1 item • Total: $49.99</p>
                                    <small class="text-muted">Processing</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-warning text-dark mb-2 d-block">Processing</span>
                                    <small class="text-primary">View Details →</small>
                                </div>
                            </div>
                        </a>
                        <!-- More Order Items -->
                        <a href="/order/12343" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Order #12343</h6>
                                    <p class="mb-1 text-muted small">3 items • Total: $238.50</p>
                                    <small class="text-muted">Delivered on Jan 10, 2025</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success mb-2 d-block">Delivered</span>
                                    <small class="text-primary">View Details →</small>
                                </div>
                            </div>
                        </a>
                        <!-- Repeat similar items for more orders -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="text-muted small">Showing 10 of 25 orders</div>
                    <nav aria-label="Order pagination">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
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