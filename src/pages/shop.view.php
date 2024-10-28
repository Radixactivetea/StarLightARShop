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
    <link rel="stylesheet" href="./public/css/shop.css">
</head>

<body>
    <!-- navigator -->
    <?php require "src/components/nav.php"; ?>

    <div class="main-grid container mt-5">
        <div class="filter-bar px-3">
            <h5>Filter By</h5>
            <div class="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Category
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="btn-group category-checkbox" role="group"
                                aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                                <label class="btn btn-outline-primary category-btn" for="btncheck1">Oil
                                    Dispenser</label>

                                <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                                <label class="btn btn-outline-primary category-btn" for="btncheck2">Plates</label>

                                <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                                <label class="btn btn-outline-primary category-btn" for="btncheck3">Bowls</label>

                                <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
                                <label class="btn btn-outline-primary category-btn" for="btncheck4">Mug</label>
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
                            <div class="btn-group category-checkbox" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                                    checked>
                                <label class="btn btn-outline-primary category-btn" for="btnradio1">Low - High</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary category-btn" for="btnradio2">High - Low</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-content">
            <div class="col">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <a href="#" class="col text-decoration-none">
                        <div class="card h-100 shadow-sm overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/plus/img/ecommerce-images/category-page-04-image-card-01.jpg"
                                alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
                                class="card-img-top"   />
                            <div class="card-body">
                                <h5 class="card-title text-sm text-gray-700">Earthen Bottle</h5>
                                <p class="card-text text-lg font-weight-bold text-gray-900">$48</p>
                            </div>
                        </div>
                    </a>
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