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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter&amp;display=swap">

<body>

    <?php require 'src/components/admin-nav.php'; ?>

    <?= displayAlert() ?>

    <div class="container p-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-primary">
            <h1 class="h2">Seller Overview</h1>
        </div>
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Pending Requests</h5>
                        <h2><?= $summary['total_pending'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Approved</h5>
                        <h2><?= $summary['total_approved'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-black">
                    <div class="card-body">
                        <h5>Total Active Seller</h5>
                        <h2><?= $summary['total_sellers'] ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ban Requests Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Requests Transfer Account</h5>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="width: 150px;">
                        <option>All Statuses</option>
                        <option>Pending</option>
                        <option>Approved</option>
                    </select>
                    <input type="text" class="form-control form-control-sm" placeholder="Search..."
                        style="width: 200px;">
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>User ID</th>
                            <th>Status</th>
                            <th>Requested By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($request as $user): ?>
                            <tr>
                                <td>#<?= $user['id'] ?></td>
                                <td><?= $user['user_firstname'] ?></td>
                                <td>
                                    <span class="status-pill text-white <?= $user['css_class'] ?>">
                                        <?= $user['status'] ?>
                                    </span>
                                </td>
                                <td><?= $user['requested_by_name'] ?></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <form method="POST">
                                            <input type="hidden" name="request_id" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                            <input type="hidden" name="seller_id" value="<?= $user['seller_id'] ?>">
                                            <button class="btn btn-sm btn-success" <?= $user['status'] == 'pending' ? '' : 'disabled' ?>>
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-5  border-bottom border-primary">
            <h1 class="h2">List of All Existed Seller Account</h1>
        </div>
        <div class="row">
            <?php foreach ($allSeller as $seller): ?>
                <div class="col-lg-3 my-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <img src="/public/upload/profile/<?= $seller['profile_pic_url'] ?? "default.png" ?> "
                                width="150px" height="150px" class="rounded-circle mb-3" alt="Profile Picture">
                            <h5 class="card-title mb-0"><?= $seller['firstname'] . ' ' . $seller['lastname'] ?></h5>
                            <p class="text-muted"><?= $seller['email'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>