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

                        <?php if ($product['has_AR'] == 1) { ?>
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
                                        Experience our pottery collection like never before with Augmented Reality! Our AR
                                        feature lets you visualize each piece in your own space, so you can see colors,
                                        textures, and size as if it’s right in front of you. Try it now—just click the
                                        button below and bring our pottery into your home today!
                                    </div>
                                    <a href="/AR" class="text-primary"><svg xmlns="http://www.w3.org/2000/svg" height="32"
                                            fill="currentColor" viewBox="0 0 640 512">
                                            <path
                                                d="M576 64L64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l120.4 0c24.2 0 46.4-13.7 57.2-35.4l32-64c8.8-17.5 26.7-28.6 46.3-28.6s37.5 11.1 46.3 28.6l32 64c10.8 21.7 33 35.4 57.2 35.4L576 448c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64zM96 240a64 64 0 1 1 128 0A64 64 0 1 1 96 240zm384-64a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                        </svg></a>

                                </div>
                            </div>
                        <?php } ?>

                        <div class="accordion-item border-top border-primary-subtle">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Dimensions
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body fw-light ">
                                    <div class="d-flex flex-wrap">

                                        <?php foreach ($dimensions as $dimension): ?>
                                            <div class="w-50 pb-3">

                                                <?php if (!empty($dimension['name'])): ?>
                                                    <h6 class="ms-0 mb-1"><?= htmlspecialchars($dimension['name']) ?></h6>
                                                <?php endif; ?>

                                                <?php if (!empty($dimension['diameter'])): ?>
                                                    <div>Diameter: <?= htmlspecialchars($dimension['diameter']) ?> cm</div>
                                                <?php endif; ?>

                                                <?php if (!empty($dimension['height'])): ?>
                                                    <div>Height: <?= htmlspecialchars($dimension['height']) ?> cm</div>
                                                <?php endif; ?>

                                                <?php if (!empty($dimension['weight'])): ?>
                                                    <div>Weight: <?= htmlspecialchars($dimension['weight']) ?> kg</div>
                                                <?php endif; ?>

                                                <?php if (!empty($dimension['capacity'])): ?>
                                                    <div>Capacity: <?= htmlspecialchars($dimension['capacity']) ?> &#8467;</div>
                                                <?php endif; ?>

                                            </div>
                                        <?php endforeach; ?>

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
                                        <div class="px-2">

                                            <?php foreach ($percentages as $percent): ?>
                                                <div class="rating-bar d-flex align-items-center mb-3">
                                                    <span class="me-2"><?= $percent['rating'] ?>
                                                        <span class="rating-star">★</span>
                                                    </span>
                                                    <div class="progress flex-grow-1 me-2">
                                                        <div class="progress-bar bg-primary"
                                                            style="width: <?= $percent['percentage'] ?>%;">
                                                        </div>
                                                    </div>
                                                    <span class="text-end"
                                                        style="width: 24px;"><?= $percent['rating_count'] ?>
                                                    </span>
                                                </div>
                                            <?php endforeach ?>

                                        </div>
                                        <!-- Average rating display -->
                                        <div class="px-2">
                                            <div class="p-4 rounded" style="background-color: rgba(175, 143, 111, 0.3)">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <div class="rating-number">
                                                            <?= $totalAndAverage['average_rating'] ?? 0 ?>
                                                        </div>
                                                        <div>
                                                            <span class="">★★★★★</span>
                                                            <span
                                                                class="text-muted"><?= $totalAndAverage['total_reviews'] ?>
                                                                Ratings</span>
                                                        </div>
                                                    </div>

                                                    <?php if (!is_null($totalAndAverage['average_rating'])) { ?>
                                                        <button class="btn btn-primary" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#ReviewSection"
                                                            aria-expanded="false" aria-controls="ReviewSection">
                                                            See All Reviews
                                                        </button>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
            <?php foreach ($showReview as $review): ?>
                <div class="row py-3 border-bottom border-primary-subtle">
                    <div class="col-12 col-lg-10">
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <img src="https://pagedone.io/asset/uploads/1704364459.png" alt="Profile Image"
                                class="rounded-circle object-fit-cover" style="width: 8rem; height: 8rem;">
                            <div>
                                <p class="fw-medium fs-5 mb-2 text-dark">Robert Karmazov</p>
                                <div class="d-flex d-lg-none align-items-center gap-2 mb-4">
                                    <!-- for icon review -->
                                    <span class="rating-star">
                                        <?php for ($stars = 0; $stars < $review['rating']; $stars++) { ?>
                                            ★
                                        <?php } ?>
                                    </span>
                                </div>
                                <p class="fw-normal fs-6 text-secondary mb-4"> <?= $review['review'] ?> </p>
                                <p class="fw-medium fs-6 text-secondary mb-0"> <?= $review['date'] ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2 d-none d-lg-block">
                        <div class="d-flex align-items-center gap-2 mb-4 h-100">
                            <!-- for icon review -->
                            <span class="rating-star">
                                <?php for ($stars = 0; $stars < $review['rating']; $stars++) { ?>
                                    ★
                                <?php } ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
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