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

    <div class="container">
        <div class="row">
            <div class="content-wrapper">
                <!-- Page Header -->
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-primary">
                    <h1 class="h2">Dashboard Overview</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div>
                            <i class="fas fa-calendar"></i>
                            This month
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stats-card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <h3 class="card-text"><?= $overview['total_users'] ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stats-card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">AR Models</h5>
                                <h3 class="card-text"><?= $overview['total_ar'] ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stats-card bg-warning text-dark">
                            <div class="card-body">
                                <h5 class="card-title">Total Feedback</h5>
                                <h3 class="card-text"><?= $overview['total_feedback'] ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stats-card bg-danger text-white">
                            <div class="card-body">
                                <h5 class="card-title">Banned Users</h5>
                                <h3 class="card-text"><?= $overview['total_banned_users'] ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent System Feedback</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Experience</th>
                                        <th>Suggestion</th>
                                        <th>Date</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($feedbacks as $feedback): ?>
                                        <tr>
                                            <td><?= $feedback['name'] ?? 'Not Provided' ?></td>
                                            <td><?= $feedback['experience_details'] ?></td>
                                            <td><?= $feedback['feature_suggestions'] ?></td>
                                            <td>
                                                <?= (new DateTime($feedback['submitted_at']))->format('d/m/Y') ?>
                                            </td>
                                            <td>
                                                <?= $feedback['user_id'] ? '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal-' . $feedback['feedback_id'] . '" ' . ($feedback['is_replied'] ? 'disabled' : '') . '>' . ($feedback['is_replied'] ? 'Replied' : 'Reply') . '</button>' : '' ?>
                                                <div class="modal fade" id="replyModal-<?= $feedback['feedback_id'] ?>"
                                                    tabindex="-1"
                                                    aria-labelledby="replyModalLabel-<?= $feedback['feedback_id'] ?>"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-primary">
                                                                <h5 class="modal-title"
                                                                    id="replyModalLabel-<?= $feedback['feedback_id'] ?>">
                                                                    Reply to
                                                                    Feedback</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/admin" method="POST">
                                                                    <input type="hidden" name="feedback_id"
                                                                        value="<?= $feedback['feedback_id'] ?>">
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?= $feedback['user_id'] ?>">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            for="replyMessage-<?= $feedback['feedback_id'] ?>"
                                                                            class="form-label">Your Reply</label>
                                                                        <textarea class="form-control"
                                                                            id="replyMessage-<?= $feedback['feedback_id'] ?>"
                                                                            name="reply_message" rows="3"
                                                                            required></textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-secondary">Send
                                                                        Reply</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

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

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>