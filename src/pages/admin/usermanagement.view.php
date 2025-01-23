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

<body>
    <!-- Include the admin navigation -->
    <?php require 'src/components/admin-nav.php'; ?>

    <?= displayAlert() ?>

    <div class="container p-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-primary">
            <h1 class="h2">User Overview</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div>
                    <i class="fas fa-calendar"></i>
                    This month
                </div>
            </div>
        </div>
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Pending Requests</h5>
                        <h2><?= $summary['total_pending'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Approved</h5>
                        <h2><?= $summary['total_approved'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5>Rejected</h5>
                        <h2><?= $summary['total_rejected'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Total Active Bans</h5>
                        <h2><?= $summary['total_banned_users'] ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ban Requests Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Ban Requests</h5>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="width: 150px;">
                        <option>All Statuses</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Rejected</option>
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
                            <th>Reason</th>
                            <th>Requested By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($ban as $banDetails): ?>
                            <tr>
                                <td>#<?= $banDetails['id'] ?></td>
                                <td><?= substr($banDetails['user_id'], 0, 8) ?></td>
                                <td><?= $banDetails['reason'] ?></td>
                                <td><?= $banDetails['firstname'] ?></td>
                                <td>
                                    <span class="status-pill text-white <?= $banDetails['css_class'] ?>">
                                        <?= $banDetails['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <form method="POST">
                                            <input type="hidden" name="ban_id" value="<?= $banDetails['id'] ?>">
                                            <input type="hidden" name="user_id" value="<?= $banDetails['user_id'] ?>">
                                            <input type="hidden" name="seller_id" value="<?= $banDetails['seller_id'] ?>">
                                            <button class="btn btn-sm btn-success" <?= $banDetails['status'] == 'pending' ? '' : 'disabled' ?>>
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-sm btn-danger" <?= $banDetails['status'] == 'pending' ? '' : 'disabled' ?> data-bs-toggle="modal"
                                            data-bs-target="#rejectModal-<?= $banDetails['id'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal-<?= $banDetails['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reject Ban Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form method="POST" action="/user-management/user/rejected">
                                            <div class="modal-body">
                                                <input type="hidden" name="ban_id" value="<?= $banDetails['id'] ?>">
                                                <input type="hidden" name="user_id" value="<?= $banDetails['user_id'] ?>">
                                                <input type="hidden" name="seller_id"
                                                    value="<?= $banDetails['seller_id'] ?>">
                                                <input type="hidden" name="action" value="reject">
                                                <div class="mb-3">
                                                    <label class="form-label">Rejection Reason</label>
                                                    <textarea class="form-control" name="rejection_note" rows="3"
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('.table tbody');
            const statusSelect = document.querySelector('.form-select');
            const searchInput = document.querySelector('input[placeholder="Search..."]');

            function filterTable() {
                const selectedStatus = statusSelect.value.toLowerCase();
                const searchTerm = searchInput.value.toLowerCase();

                // Reset all rows to visible first
                Array.from(table.rows).forEach(row => {
                    row.style.display = '';
                });

                // Then apply filters
                Array.from(table.rows).forEach(row => {
                    const statusCell = row.querySelector('span.status-pill');
                    const rowText = row.innerText.toLowerCase();

                    const statusMatch = selectedStatus === 'all statuses' ||
                        statusCell.innerText.toLowerCase() === selectedStatus;
                    const searchMatch = rowText.includes(searchTerm);

                    row.style.display = (statusMatch && searchMatch) ? '' : 'none';
                });
            }

            // Add event listeners for filtering
            statusSelect.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);

            // Ensure "All Statuses" is selected by default
            statusSelect.value = 'All Statuses';
        });
    </script>

</body>

</html>