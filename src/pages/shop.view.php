<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <!-- shop style -->
    <link rel="stylesheet" href="/public/css/shop.css">
</head>

<body>
    <!-- navigator -->
    <?php require "src/components/nav.php"; ?>

    <div class="main-grid container mt-5">
        <div class="filter-bar px-3 mb-2">
            <h5>Filter By</h5>
            <form action="/shop" method="POST">
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
                                <form action="/shop" method="POST">
                                    <div class="btn-group category-checkbox" role="group"
                                        aria-label="Basic checkbox toggle button group">

                                        <?php foreach ($category as $cat): ?>
                                            <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>"
                                                class="btn-check" id="category-<?= $cat['category_id'] ?>"
                                                autocomplete="off" <?php if (in_array($cat['category_id'], $selectedCategories)): ?> checked <?php endif; ?>>

                                            <label class="btn btn-outline-primary category-btn"
                                                for="category-<?= $cat['category_id'] ?>">
                                                <?= htmlspecialchars($cat['name']) ?>
                                            </label>
                                        <?php endforeach; ?>

                                    </div>
                                </form>
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

                    <?php foreach ($products as $products): ?>
                        <a href="/shop/<?= $products['product_id'] ?>" class="col text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden rounded-lg">
                                <img src="/public/upload/product/<?= $products['image_url'] ?>"
                                    alt="<?= $products['image_url'] ?>" class="card-img-top" />
                                <div class="card-body">
                                    <h5 class="card-title text-sm text-gray-700"><?= $products['name'] ?></h5>
                                    <p class="card-text text-lg fw-light text-gray-900">RM <?= $products['price'] ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>


    <!-- footer -->
    <?php require "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>