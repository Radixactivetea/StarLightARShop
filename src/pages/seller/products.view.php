<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>

    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">

    <link rel="stylesheet" href="/public/css/shop.css">
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

        <div class="main-grid mt-3">
            <div class="filter-bar px-3 mb-2">
                <h5>Filter By</h5>
                <form method="GET">
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Category
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="btn-group category-checkbox" role="group"
                                        aria-label="Basic checkbox toggle button group">

                                        <?php foreach ($category as $cat): ?>
                                            <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>"
                                                class="btn-check" id="category-<?= $cat['category_id'] ?>"
                                                autocomplete="off" <?php if (in_array($cat['category_id'], $selectedCategories)): ?> checked <?php endif; ?>>

                                            <label class="btn btn-outline-primary category-btn"
                                                for="category-<?= $cat['category_id'] ?>">
                                                <?= $cat['name'] ?>
                                            </label>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Price
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="btn-group category-checkbox" role="group"
                                        aria-label="Basic radio toggle button group">

                                        <input type="radio" class="btn-check" name="price_sort" value="low_high"
                                            id="btnradio1" autocomplete="off" <?php if ($priceSort == 'low_high')
                                                echo 'checked'; ?>>
                                        <label class="btn btn-outline-primary category-btn" for="btnradio1">Low -
                                            High</label>

                                        <input type="radio" class="btn-check" name="price_sort" value="high_low"
                                            id="btnradio2" autocomplete="off" <?php if ($priceSort == 'high_low')
                                                echo 'checked'; ?>>
                                        <label class="btn btn-outline-primary category-btn" for="btnradio2">High -
                                            Low</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ms-3">Filter</button>
                    </div>
                </form>
            </div>
            <div class="shop-content mb-5">
                <div class="col">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php foreach ($getProducts as $product): ?>
                            <div>
                                <div class="card h-100 shadow-sm overflow-hidden rounded-lg position-relative">
                                    <img src="/public/upload/product/<?= $product['image_url'] ?>" class="me-3 card-img-top"
                                        alt="<?= $product['name'] ?>">
                                    <div class="card-body">
                                        <div class="col d-flex flex-column">
                                            <h4 class="card-title"><?= $product['name'] ?> </h4>
                                            <div class="mt-auto">
                                                <p class="fw-light m-0">Price : RM <?= $product['price'] ?></p>
                                                <p class="fw-light m-0">Stock Level : <?= $product['stock_level'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 me-2 position-absolute top-0 end-0">
                                        <a href="/product/update/<?= $product['product_id'] ?>"
                                            class="btn btn-success ">Update</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-product-modal"
                                            data-id="<?= $product['product_id'] ?>">Delete</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
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