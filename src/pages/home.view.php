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
    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>

    <div id="promotion" class="carousel slide promotion-carousel" data-bs-ride="carousel">
        <div class="carousel-inner" style="text-align: center;">
            <div class="carousel-item active">
                <div class="d-bloock w-100">Announcement One</div>
            </div>
            <div class="carousel-item">
                <div class="d-bloock w-100">Announcement Two</div>
            </div>
            <div class="carousel-item">
                <div class="d-bloock w-100">Announcement Three</div>
            </div>
        </div>
    </div>

    <div class="collection container">
        <img class="collection-img" src="./public/img/collection.png" />
        <div class="collection-desc">
            <p class="">New Collection</p>
            <h2 class="product-title">P-White-Collection</h2>
            <p class="product-description">Remastered for style, elevate your house look with the P-White-Collection.
            </p>
            <button class="btn btn-primary">Shop Now</button>
        </div>
    </div>

    <div class="new-product container">
        <div class="row">
            <h3 class="col d-flex align-item-center" style="margin: 0;">Newest Pottery</h3>
            <div class="col-auto glide-btn glide__arrows" data-glide-el="controls">
                <button aria-label="Previous" class="glider-prev" data-glide-dir="<"><svg
                        xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em"
                        fill="currentColor">
                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z">
                        </path>
                    </svg></button>
                <button aria-label="Next" class="glider-next" data-glide-dir=">"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor">
                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                        </path>
                    </svg></button>
            </div>
        </div>
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <li class="glide__slide">
                    <a href="#">
                        <div class="card h-100">
                            <img src="./public/img/product.png" class="card-img-top" alt="Product">
                            <div class="card-body">
                                <p class="card-text">Stoneware Olive Oil Dispenser | Canard 34 oz</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="glide__slide">
                    <a href="#">
                        <div class="card h-100">
                            <img src="./public/img/product2.png" class="card-img-top" alt="Product">
                            <div class="card-body">
                                <p class="card-text">Stoneware Jug Dadasi 50 oz</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="glide__slide">
                    <a href="#">
                        <div class="card h-100">
                            <img src="./public/img/product3.png" class="card-img-top" alt="Product">
                            <div class="card-body">
                                <p class="card-text">Rustic Shallow Bowls in Toasted Marshmallow Glaze</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="glide__slide">
                    <a href="#">
                        <div class="card h-100">
                            <img src="./public/img/product4.png" class="card-img-top" alt="Product">
                            <div class="card-body">
                                <p class="card-text">Pottery Mug with Dark Brown Raw Stone Clay, 11 Ounce Coffee Cup with Carved</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="glide__slide">
                    <a href="#">
                        <div class="card h-100">
                            <img src="./public/img/product5.png" class="card-img-top" alt="Product">
                            <div class="card-body">
                                <p class="card-text">Close out Lot of Imperfect Dishes, Creamy White and Ocher Glazes</p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col d-flex justify-content-center">
            <button class="btn btn-primary">Show more</button>
        </div>
    </div>

    <div class="shop-category container">
        <div class="row">
            <h3 class="col d-flex align-item-center" style="margin: 0;">Shop By Category</h3>
            <div class="col-auto glide-btn glide__arrows" data-glide-el="controls">
                <button aria-label="Previous" class="glider-prev" data-glide-dir="<"><svg
                        xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em"
                        fill="currentColor">
                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z">
                        </path>
                    </svg></button>
                <button aria-label="Next" class="glider-next" data-glide-dir=">"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor">
                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                        </path>
                    </svg></button>
            </div>
        </div>
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <li class="glide__slide">
                    <div class="catergory-card card">
                        <img src="./public/img/product.png" class="card-img-top" alt="...">
                        <button>Oil Dispenser</button>
                    </div>
                </li>
                <li class="glide__slide">
                    <div class="catergory-card card">
                        <img src="./public/img/bowl.png" class="card-img-top" alt="...">
                        <button>Bowl</button>
                    </div>
                </li>
                <li class="glide__slide">
                    <div class="catergory-card card">
                        <img src="./public/img/mug.png" class="card-img-top" alt="...">
                        <button>Mug</button>
                    </div>
                </li>
                <li class="glide__slide">
                    <div class="catergory-card card">
                        <img src="./public/img/plate.png" class="card-img-top" alt="...">
                        <button>Plate</button>
                    </div>
                </li>
                <li class="glide__slide">
                    <div class="catergory-card card">
                        <img src="./public/img/vase.png" class="card-img-top" alt="...">
                        <button>Vase</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>



    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- glide.js -->
    <script src="/node_modules/@glidejs/glide/dist/glide.min.js"></script>
    <!-- home.js -->
    <script src="/public/js/home.js"></script>
</body>

</html>