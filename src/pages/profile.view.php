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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">

    <style>
        .list-group-item-action:focus,
        .list-group-item-action:hover {
            background-color: var(--bs-card-cap-bg);
        }

        .list-group-item {
            border: var(--bs-list-group-border-width) solid var(--bs-focus-ring-color);
        }

        .hover-shadow {
            cursor: pointer;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .hover-shadow:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>

    <div class="container py-5">

        <?= displayAlert() ?>

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
                            <a href="/cart" class="card-body text-center text-decoration-none hover-shadow">
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
                            <a href="/mail" class="card-body text-center text-decoration-none hover-shadow">
                                <div class="position-relative d-inline-block">
                                    <i class="fas fa-bell fa-2x text-primary mb-2"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?= $notiNum['total_notification'] ?>
                                    </span>
                                </div>
                                <h6 class="card-title mt-2">Notifications</h6>
                                <p class="small text-muted mb-0"><?= $notiNum['total_notification'] ?> messages
                                </p>
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
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <h6 class="mb-0">Recent Orders</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">

                            <?php foreach ($order as $orderDetail): ?>
                                <a href="/order/detail/<?= $orderDetail['order_id'] ?>"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Order #<?= substr($orderDetail['order_id'], 0, 6) ?></h6>
                                            <small class="text-muted"><?= $orderDetail['total_items'] ?> items •
                                                <?= $date = date('d-m-Y', strtotime($orderDetail['date'])); ?></small>
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
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Profile Picture -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img id="profileImage"
                                    src="/public/upload/profile/<?= $user['profile_pic_url'] ?? "default.png" ?>"
                                    width="150px" height="150px" class="rounded-circle" alt="Profile Picture">
                                <button type="button" id="changePictureBtn"
                                    class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                                    <i class="fas fa-camera"></i>
                                </button>
                                <input type="file" id="profileInput" name="profile_picture" class="d-none"
                                    accept="image/*">
                                <input type="hidden" name="uploaded_file" value="<?= $user['profile_pic_url'] ?>">
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="mb-4">
                            <h6 class="mb-3 ms-1">Personal Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted ms-1">First Name</label>
                                    <input type="text" class="form-control" name="firstname"
                                        value="<?= $user['firstname'] ?>">
                                    <?= showError('firstname') ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted ms-1">Last Name</label>
                                    <input type="text" class="form-control" name="lastname"
                                        value="<?= $user['lastname'] ?>">
                                    <?= showError('lastname') ?>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted ms-1">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
                                    <?= showError('email') ?>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted ms-1">Phone Number</label>
                                    <input type="tel" class="form-control" name="phonenum"
                                        value="<?= $user['phone_num'] ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="mb-4">
                            <h6 class="mb-3 ms-1">Address Information</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label text-muted ms-1">Street Address</label>
                                    <input type="text" class="form-control" name="street_address"
                                        value="<?= $address['street_address'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted ms-1">City</label>
                                    <input type="text" class="form-control" name="city"
                                        value="<?= $address['city'] ?? '' ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted ms-1">State</label>
                                    <input type="text" class="form-control" name="state"
                                        value="<?= $address['state'] ?? '' ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted ms-1">ZIP Code</label>
                                    <input type="text" class="form-control" name="post_code"
                                        value="<?= $address['post_code'] ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Password Change -->
                        <div class="mb-4">
                            <h6 class="mb-3 ms-1">Change Password</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label text-muted ms-1">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="currentpassword">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword(this)">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted ms-1">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="newpassword">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword(this)">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </div>
                                    <?= showError('newpassword') ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted ms-1">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="confirmpassword">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword(this)">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </div>
                                    <?= showError('confirmpassword') ?>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Preferences -->
                        <!-- <div class="mb-4">
                            <h6 class="mb-3 ms-1">Notification Preferences</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" checked id="emailNotif">
                                <label class="form-check-label text-muted ms-1" for="emailNotif">
                                    Email Notifications
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" checked id="smsNotif">
                                <label class="form-check-label text-muted ms-1" for="smsNotif">
                                    SMS Notifications
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="marketingNotif">
                                <label class="form-check-label text-muted ms-1" for="marketingNotif">
                                    Marketing Communications
                                </label>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to handle real-time image preview
        document.getElementById('changePictureBtn').addEventListener('click', function () {
            document.getElementById('profileInput').click();
        });

        document.getElementById('profileInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        function togglePassword(button) {
            const input = button.previousElementSibling;
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }
    </script>
</body>

</html>