<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/bs-theme-overrides.css">
    <!-- shop style -->
    <link rel="stylesheet" href="./public/css/shop.css">
</head>

<body>
    <!-- navigator -->
    <?php require "./src/components/nav.php"; ?>

    <div class="main-grid container">
        <div class="sort-bar">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><button class="dropdown-item" type="button">Newest</button></li>
                    <li><button class="dropdown-item" type="button">Price: High - Low</button></li>
                    <li><button class="dropdown-item" type="button">Price: Low - High</button></li>
                </ul>
            </div>
        </div>

        <div class="filter-bar">
            <div class="accordion accordion-flush" id="filterby-accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Filter By
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                        data-bs-parent="#filterby-accordion">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <li class="list-group-item">Oil Dispenser </li>
                                <li class="list-group-item">Bowl</li>
                                <li class="list-group-item">Mug</li>
                                <li class="list-group-item">Plate</li>
                                <li class="list-group-item">Vase</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-content">
            
        </div>
    </div>










    <!-- footer -->
    <?php require "./src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>