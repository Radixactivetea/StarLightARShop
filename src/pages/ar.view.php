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

    <script type="importmap">
            {
              "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@0.170.0/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.170.0/examples/jsm/"
              }
            }
          </script>
    <script type="module" src="/public/js/ar.js"></script>

    <style>
        a.link-primary:hover {
            color: #74512D !important;
            text-decoration-color: RGBA(116, 81, 45, var(--bs-link-underline-opacity, 1)) !important;
        }

        .view-ar {
            margin: 0;
        }

        .view-ar button {
            position: fixed;
            z-index: 100;
            padding: 1vh;
            bottom: 1vh;
            left: 41%;
        }
    </style>

<body>

    <div class="d-md-none view-ar">
        <button id="ar-button" class="btn btn-primary">Start AR</button>
    </div>

    <div class="d-none d-md-block">
        <!-- loading page -->
        <?php require("src/components/loading.php") ?>

        <!-- navigator -->
        <?php include "src/components/nav.php"; ?>

        <div class="text-center my-4">
            <h3>Scan the QR code to open on your phone</h3>
            <img src="/public/upload/qr/<?= htmlspecialchars($getAr['img_url']) ?>" alt="QR Code" width="200" height="200">
            <h2>Or</h2>
            <a href="<?= htmlspecialchars($getAr['qr_link']) ?>"
                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?= htmlspecialchars($getAr['qr_link']) ?></a>
        </div>


        <!-- footer -->
        <?php include "src/components/footer.html"; ?>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>