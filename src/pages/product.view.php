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
    <link rel="stylesheet" href="/public/css/product.css">
</head>

<body>
    <!-- navigator -->
    <?php require "src/components/nav.php"; ?>


    <!-- Product section-->
    <section class="py-5">
        <div class="container">
            <div class="row gx-4 gx-lg-5 align-items-start">
                <div class="col-md-6 sticky"><img class="card-img-top mb-5 mb-md-0"
                        src="/public/upload/product/<?= $product['image_url'] ?>" alt="Product Item" /></div>
                <div class="col-md-6">
                    <h2 class="fw-bolder"><?= $product['name'] ?></h2>
                    <div class="mb-5">
                        <!-- <span class="text-decoration-line-through">$45.00</span> -->
                        <span>RM <?= $product['price'] ?></span>
                    </div>
                    <p class="fs-6 fw-light"><?= $product['description'] ?></p>
                    <div class="d-flex">
                        <div class="quantity me-3">
                            <button class="minus" aria-label="Decrease">&minus;</button>
                            <input type="number" class="input-box" value="1" min="1"
                                max="<?= $product['stock_level'] ?>">
                            <button class="plus" aria-label="Increase">&plus;</button>
                        </div>
                        <button class="btn btn-outline-primary flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                    <div class="accordion accordion-flush mt-5">
                        <div class="accordion-item border-top border-primary-subtle">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Augmented Reality
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body fw-light ">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur veniam fugit
                                    facere dignissimos non recusandae aliquam possimus harum repellat pariatur
                                    reiciendis, ducimus totam ad laborum repudiandae suscipit dolor atque. Dignissimos?
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-top border-primary-subtle">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Description
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body fw-light ">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur veniam fugit
                                    facere dignissimos non recusandae aliquam possimus harum repellat pariatur
                                    reiciendis, ducimus totam ad laborum repudiandae suscipit dolor atque. Dignissimos?
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-top border-primary-subtle">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Reviews
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body fw-light ">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur veniam fugit
                                    facere dignissimos non recusandae aliquam possimus harum repellat pariatur
                                    reiciendis, ducimus totam ad laborum repudiandae suscipit dolor atque. Dignissimos?
                                </div>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ReviewSection" aria-expanded="false" aria-controls="ReviewSection">
                                    Full Reviews
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Review section -->
    <section id="ReviewSection" class="collapse">
        <div class="container my-5">
            <h4 class="text-center mb-4">People Love Us</h4>
            <div class="row border-top border-bottom border-primary-subtle py-4">
                <div class="col-12 col-lg-10">
                    <h6 class="mb-0">Reviews</h6>
                </div>
                <div class="col-12 col-lg-2 d-none d-lg-block">
                    <h6 class="mb-0">Rating</h6>
                </div>
            </div>
            <div class="row py-3 border-bottom border-primary-subtle">
                <div class="col-12 col-lg-10">
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <img src="https://pagedone.io/asset/uploads/1704364459.png" alt="Profile Image"
                            class="rounded-circle object-fit-cover" style="width: 8rem; height: 8rem;">
                        <div>
                            <p class="fw-medium fs-5 mb-2 text-dark">Robert Karmazov</p>
                            <div class="d-flex d-lg-none align-items-center gap-2 mb-4">
                                <!-- for icon review -->
                            </div>
                            <p class="fw-normal fs-6 text-secondary mb-4">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Quisquam, ea rerum natus exercitationem molestias laborum fuga
                                veritatis sint, quaerat sunt fugiat corporis rem quo. Assumenda doloribus cumque atque
                                mollitia qui.</p>
                            <p class="fw-medium fs-6 text-secondary mb-0">Nov 01, 2023</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-none d-lg-block">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <!-- for icon review -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related items section-->
    <section class="py-5">
        <div class="container">
            <h4 class="mb-4">Just for You</h4>
            <div class="col">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                    <?php foreach ($products as $products): ?>
                        <a href="/shop/<?= $products['product_id'] ?>" class="col text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden rounded-lg">
                                <img src="/public/upload/product/<?= $products['image_url'] ?>"
                                    alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
                                    class="card-img-top"   />
                                <div class="card-body">
                                    <h5 class="card-title text-sm text-gray-700"><?= $products['name'] ?></h5>
                                    <p class="card-text text-lg font-weight-bold text-gray-900">RM <?= $products['price'] ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach ?>
                    <!-- more related product (limit to 4) -->
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php require "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="/public/js/product.js"></script>
</body>

</html>