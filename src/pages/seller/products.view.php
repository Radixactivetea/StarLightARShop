<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>

    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <!-- navigation -->
    <?php require "src/components/seller-nav.php" ?>

    <div class="container my-4">
        <div class="w-100 d-flex justify-content-end">
            <a href="/product/create" class="btn btn-primary my-2">
                Add New
            </a>
        </div>

        <?= displayAlert() ?>

        <?php foreach ($getProducts as $product): ?>
            <div class="card mb-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <img src="/public/upload/product/<?= $product['image_url'] ?>" class="me-3" width="100px" height="100px"
                        alt="<?= $product['name'] ?>">
                    <div class="col d-flex flex-column">
                        <h4 class="card-title"><?= $product['name'] ?> </h4>
                        <div class="mt-auto">
                            <p class="fw-light m-0">Price : RM <?= $product['price'] ?></p>
                            <p class="fw-light m-0">Stock Level : <?= $product['stock_level'] ?></p>
                        </div>
                    </div>
                    <div class="ms-3">
                        <a href="/product/update/<?= $product['product_id'] ?>" class="btn btn-success">Update</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-product-modal" data-id="<?= $product['product_id'] ?>">Delete</button>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <div class="modal fade" id="delete-product-modal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" id="delete-form">
                        <input type="hidden" name="delete-product-id" id="delete-product-id">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('delete-product-modal');
            const deleteProductIdInput = document.getElementById('delete-product-id');

            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const productId = button.getAttribute('data-id');
                deleteProductIdInput.value = productId;
            });
        });
    </script>
</body>

</html>