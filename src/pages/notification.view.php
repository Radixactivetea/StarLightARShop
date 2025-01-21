<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>

    <div class="container py-4" style="min-height: 500px;">
        <!-- Header Section -->
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <h1 class="h3 mb-3 mb-md-0">Notifications</h1>

            <!-- Action Buttons -->
            <div class="d-flex flex-column flex-sm-row gap-2">
                <div class="btn-group" role="group" aria-label="Notification filters">
                    <button class="btn btn-outline-primary active" data-filter="all">All</button>
                    <button class="btn btn-outline-primary" data-filter="Order">
                        <i class="fas fa-box-open me-1"></i>Orders
                    </button>
                    <button class="btn btn-outline-primary" data-filter="Promotion">
                        <i class="fas fa-tag me-1"></i>Promotions
                    </button>
                    <button class="btn btn-outline-primary" data-filter="System">
                        <i class="fas fa-cog me-1"></i>System
                    </button>
                </div>
            </div>
        </div>

        <!-- Notification Counter -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="text-muted">
                Showing <span id="visibleCount">0</span> of <span id="totalCount">0</span> notifications
            </div>
        </div>

        <!-- Notifications List -->
        <div class="card">
            <div class="list-group list-group-flush" id="notifications">
                
                <?php foreach ($notifications as $notification): ?>
                    <div data-category="<?= $notification['category'] ?>"
                        data-timestamp="<?= strtotime($notification['created_at']) ?>"
                        class="list-group-item list-group-item-action notification-item py-3">
                        <div class="d-flex gap-3">
                            <!-- Icon -->
                            <div class="flex-shrink-0">
                                <span
                                    class="<?= $notification['categoryClass'] ?> text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 48px; height: 48px;">
                                    <i class="<?= $notification['icon'] ?? 'fas fa-bell' ?>"></i>
                                </span>
                            </div>
                            <!-- Content -->
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="mb-1"><?= $notification['title'] ?></h6>
                                    <small class="text-muted ms-2" title="<?= $notification['created_at'] ?>">
                                        <?= $notification['created_at'] ?>
                                    </small>
                                </div>
                                <p class="mb-1 text-body-secondary"><?= $notification['message'] ?></p>
                                <?php if (!empty($notification['actions'])): ?>
                                    <div class="mt-2">
                                        <?php foreach ($notification['actions'] as $action): ?>
                                            <a href="<?= $action['url'] ?>"
                                                class="btn btn-sm <?= $action['class'] ?? 'btn-outline-primary' ?>">
                                                <?= $action['label'] ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Unread indicator -->
                            <?php if (!$notification['is_read']): ?>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3">
                                    <span class="badge bg-primary rounded-pill"></span>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-4" id="loadMoreContainer">
            <button class="btn btn-outline-primary" id="loadMore">
                Load More
                <i class="fas fa-chevron-down ms-2"></i>
            </button>
        </div>
    </div>

    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/public/js/notification.js"></script>

</body>

</html>