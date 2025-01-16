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
    

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>