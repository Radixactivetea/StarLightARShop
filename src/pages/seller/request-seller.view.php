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
                                <h4 class="mb-0">Seller Request Form</h4>
                            </div>
                            <div class="card-body">
                                <!-- Form for submitting a ban request -->
                                <form method="POST" action="/help&center/request-seller/confirm" class="<?= isset($_SESSION['user']) && $_SESSION['user'] ? 'd-none' : 'd-block' ?>">

                                    <div class="my-4">
                                        <label class="form-label">Email that is assigned with account</label>
                                        <label class="text-muted" style="font-size: 9px">Required</label>
                                        <input type="text" class="form-control" name="email"
                                            value="<?= old('email') ?>">
                                        <?= showError('email') ?>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="reset" class="btn btn-secondary">Clear Form</button>
                                        <button type="submit" class="btn btn-primary">Submit Ban Request</button>
                                    </div>
                                </form>

                                <div
                                    class="my-4 <?= isset($_SESSION['user']) && $_SESSION['user'] ? 'd-flex' : 'd-none' ?> justify-content-center">
                                    <div class="col-lg-8 mb-4">
                                        <div class="card shadow-sm">
                                            <form method="POST" class="card-body text-center">
                                                <img src="/public/upload/profile/<?= $_SESSION['user']['profile_pic_url'] ?? 'default.png' ?>"
                                                    width="150px" height="150px" class="rounded-circle mb-3"
                                                    alt="Profile Picture">
                                                <h5 class="card-title mb-0">
                                                    <?= htmlspecialchars($_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']) ?>
                                                </h5>
                                                <p class="text-muted">
                                                    <?= htmlspecialchars($_SESSION['user']['email']) ?>
                                                </p>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <form method="POST" action="/help&center/request-seller/">
                                                        <button type="submit" class="btn btn-primary" name="unset_session">Cancel</button>
                                                    </form>
                                                    <button type="submit" class="btn btn-primary">Confirm user</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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