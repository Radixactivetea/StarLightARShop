<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter&amp;display=swap">
    <!-- glide.js style -->
    <link rel="stylesheet" href="/node_modules/@glidejs/glide/dist/css/glide.core.min.css">
    <!-- home style -->
    <link rel="stylesheet" href="/public/css/home.css">


<body>

    <!-- loading page -->
    <?php require("src/components/loading.php") ?>
    
    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>



    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    
</body>

</html>