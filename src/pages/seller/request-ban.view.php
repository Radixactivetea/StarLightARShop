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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


</head>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>

        <?= displayAlert() ?>

        <div class="main-content p-4">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">User Ban Request Form</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Customer Name to Ban</label>
                                        <label class="text-muted" style="font-size: 9px">Required</label>
                                        <input type="text" class="form-control" name="username"
                                            value="<?= old('username') ?>">
                                        <?= showError('username') ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Reason to Ban</label>
                                        <label class="text-muted" style="font-size: 9px">Required</label>
                                        <input type="text" class="form-control" name="reason"
                                            value="<?= old('reason') ?>">
                                        <?= showError('reason') ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Evidence/Details</label>
                                        <label class="text-muted" style="font-size: 9px">Required</label>
                                        <textarea class="form-control" rows="4"
                                            name="evidence"><?= old('evidence') ?></textarea>
                                        <?= showError('evidence') ?>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Submit Ban Request</button>
                                        <button type="reset" class="btn btn-secondary">Clear Form</button>
                                    </div>
                                </form>
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