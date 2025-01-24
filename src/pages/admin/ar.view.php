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
    <style>
    </style>

<body>
    <!-- Include the admin navigation -->
    <?php require 'src/components/admin-nav.php'; ?>

    <?= displayAlert() ?>

    <div class="container">
        <div class="row">
            <div class="content-wrapper" style="margin-bottom: 10rem;">
                <!-- Page Header -->
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-primary">
                    <h1 class="h2">Argumented Reality</h1>
                </div>

                <div class="row">
                    <?php foreach ($ARs as $ar): ?>
                        <a href="/AR/<?= $ar['ar_id'] ?>" class="col-lg-3 my-4 text-decoration-none">
                            <div class="card shadow-sm h-100">
                                <div class="card-body text-center">
                                    <img src="/public/upload/product/<?= $ar['image_url'] ?? "default.png" ?> "
                                        width="150px" height="150px" class="rounded-circle mb-3" alt="Profile Picture">
                                    <h5 class="card-title mb-0"><?= $ar['name'] ?></h5>
                                    <p class="text-muted"><?= $ar['model_path'] ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-primary">
                    <h1 class="h2">Add New AR</h1>
                </div>

                <form class="row g-3" method="POST" novalidate>
                    <div class="col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control mb-3" id="product" name="product"
                            placeholder="Enter name or ID of the product"
                            value="<?= $_SESSION['product']['name'] ?? old('name') ?>" required>
                        <?php showError('name') ?>
                        <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['name'] ?? '' ?></div>
                    </div>

                    <button type="submit"
                        class="btn btn-primary col-2 ms-2 <?= isset($_SESSION['product']['name']) ? 'd-none' : 'd-flex' ?>">
                        Find Product
                    </button>
                </form>
                <form action="/AR/create" id="validationForm" method="POST" enctype="multipart/form-data" class="<?= isset($_SESSION['product']['name']) ? 'd-block' : 'd-none' ?>" novalidate>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="form-label">3D Model (GLB only)</label>
                            <input type="file" class="form-control" name="model_file" accept=".glb" required>
                            <?php showError('file') ?>
                            <div class="invalid-feedback">Model file required</div>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">QR Code Image</label>
                            <input type="file" class="form-control" name="qr_image" accept="image/*" required>
                            <?php showError('file') ?>
                            <div class="invalid-feedback">QR file required</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Link</label>
                            <input type="url" class="form-control" name="product_link" required>
                            <?php showError('product_link') ?>
                            <div class="invalid-feedback">Product link required</div>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $_SESSION['product']['product_id'] ?>">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </form>
            </div>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        (function () {
            'use strict';
            const form = document.getElementById('validationForm');

            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);

            form.addEventListener('input', function () {
                if (form.classList.contains('was-validated')) {
                    form.classList.remove('was-validated');
                }
            });
        })();
    </script>

</body>

</html>