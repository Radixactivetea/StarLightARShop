<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarLightARShop</title>
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/bs-theme-overrides.css">
    <!-- shop style -->
    <link rel="stylesheet" href="./public/css/shop.css">
</head>

<body>
    <!-- navigator -->
    <?php require "./src/components/nav.html"; ?>

    <div class="main-grid container">
        <div class="sort-bar">Sort By</div>
        <div class="filter-bar">2</div>
        <div class="shop-content">3</div>
    </div>










    <!-- footer -->
    <?php require "./src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>