<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>

    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <style>
        .btn {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-success:hover {
            background-color: #4CAF50;
        }

        .btn-danger:hover {
            background-color: #E53935;
        }

        .btn-success,
        .btn-danger {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>

<body>

    <!-- loading page -->
    <?php require("src/components/loading.php") ?>

    <!-- navigation -->
    <?php require("src/components/seller-nav.php") ?>

    <div class="container my-4">
        <div class="w-100 d-flex justify-content-end">
            <a href="/seller/manage-products/form" class="btn btn-primary my-2">
                Add New
            </a>
        </div>

        <?php $deleteStatus = $_GET['delete'] ?? null; ?>

        <?php if ($deleteStatus === 'success'): ?>

            <div class="alert alert-primary d-flex justify-content-between alert-dismissible fade show align-items-center">
                Product deleted successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php elseif ($deleteStatus === 'error'): ?>

            <div class="alert alert-primary d-flex justify-content-between alert-dismissible fade show align-items-center">
                Failed to delete the product. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php endif; ?>

        <?php foreach ($getProducts as $product): ?>
            <div class="card mb-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <img src="/public/upload/product/<?= $product['image_url'] ?>" class="me-3" width="100px" height="100px"
                        alt="Basic Tee Sienna">
                    <div class="col d-flex flex-column">
                        <h4 class="card-title"><?= $product['name'] ?> </h4>
                        <div class="mt-auto">
                            <p class="fw-light m-0">Price : RM <?= $product['price'] ?></p>
                            <p class="fw-light m-0">Stock Level : <?= $product['stock_level'] ?></p>
                        </div>
                    </div>
                    <!-- Button Container with Center Alignment -->
                    <div class="ms-3">
                        <!-- Update Button (No changes here) -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#update-product">Update</button>

                        <!-- Delete Button triggers modal with product ID -->
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
                    <form action="/seller/delete" method="POST" id="delete-form">
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