<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter&amp;display=swap">

    <style>
        .smaller-img {
            width: 50%;
            height: auto;
            margin: 0 auto;
        }
    </style>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>

    <!-- Hero Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Crafting Beauty, One Piece at a Time</h1>
                    <p class="lead mb-4">We're passionate artisans dedicated to creating handcrafted pottery that brings
                        both beauty and function to your everyday life.</p>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <img src="/public/img/store.jpeg" alt="Pottery Workshop" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <h2 class="mb-4">Our Story</h2>
                    <p class="mb-3">Founded in 2015, our journey began in a small studio with a single potter's wheel
                        and a dream. What started as a personal passion for creating beautiful, functional pottery has
                        grown into a thriving community of artisans and ceramics enthusiasts.</p>
                    <p class="mb-3">Each piece we create is born from a dedication to traditional craftsmanship while
                        embracing modern design sensibilities. Our artisans spend years perfecting their techniques,
                        ensuring every item that leaves our studio meets our exacting standards.</p>
                    <p>Today, we're proud to share our creations with customers worldwide, bringing a touch of
                        handcrafted beauty to homes across the globe.</p>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <img src="/public/img/making.jpeg" alt="Pottery Making Process" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="light-color" style="padding: 7rem 0">
        <div class="container">
            <h2 class="text-center mb-5">Our Values</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-hands fa-3x text-primary mb-3"></i>
                            <h3 class="h5">Handcrafted Excellence</h3>
                            <p>Every piece is carefully handmade by our skilled artisans, ensuring unique character and
                                quality.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-leaf fa-3x text-primary mb-3"></i>
                            <h3 class="h5">Sustainability</h3>
                            <p>We use eco-friendly materials and practices to minimize our environmental impact.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                            <h3 class="h5">Community</h3>
                            <p>We believe in fostering a community of artists and supporting local arts education.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet Our Team -->
    <section style="padding: 7rem 0">
        <div class="container">
            <h2 class="text-center mb-5">Meet Our Artisans</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/public/img/default.png" class="card-img-top mt-2 smaller-img" alt="Master Potter">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bowen Lau</h5>
                            <p class="text-muted">Master Potter & Founder</p>
                            <p class="card-text">With over 15 years of experience, Sarah leads our creative direction
                                and teaches pottery workshops.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/public/img/default.png" class="card-img-top mt-2 smaller-img" alt="Ceramic Artist">
                        <div class="card-body text-center">
                            <h5 class="card-title">Anglela Kao</h5>
                            <p class="text-muted">Ceramic Artist</p>
                            <p class="card-text">Anglela specializes in glazing techniques and creates our signature
                                color palettes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/public/img/default.png" class="card-img-top mt-2 smaller-img" alt="Production Lead">
                        <div class="card-body text-center">
                            <h5 class="card-title">Wan Sirajuddin</h5>
                            <p class="text-muted">Developer Lead</p>
                            <p class="card-text">Wan ensures quality control and manages our website operations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Process -->
    <section class="light-color" style="padding: 7rem 0">
        <div class="container">
            <h2 class="text-center mb-5">Our Process</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-pencil-alt fa-2x"></i>
                        </div>
                        <h5>Design</h5>
                        <p>Each piece begins with detailed sketches and planning</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-hands fa-2x"></i>
                        </div>
                        <h5>Throwing</h5>
                        <p>Skilled artisans shape the clay on the potter's wheel</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-paint-brush fa-2x"></i>
                        </div>
                        <h5>Glazing</h5>
                        <p>Custom glazes are carefully applied by hand</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-fire fa-2x"></i>
                        </div>
                        <h5>Firing</h5>
                        <p>Pieces are fired in our kiln at precise temperatures</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section style="padding: 6rem 0">
        <div class="container text-center">
            <h2 class="mb-4">Visit Our Studio</h2>
            <p class="lead mb-4">We offer workshop tours and pottery classes. Come see where the magic happens!</p>
            <a href="https://wa.me/0168321076" target="_blank" class="btn btn-primary btn-lg">Book a Visit</a>
        </div>
    </section>

    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>