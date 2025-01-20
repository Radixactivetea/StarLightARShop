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

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <!-- navigator -->
    <?php include "src/components/nav.php"; ?>

    <!-- Hero Section -->
    <section class="light-color text-black text-black py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Experience Pottery in AR Instantly</h1>
                    <p class="lead mb-4">No app download needed! Simply scan our markers using your web browser to see
                        our pottery come to life.</p>
                    <button class="btn btn-primary btn-lg">Start AR Experience <i
                            class="fas fa-camera ms-2"></i></button>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <img src="/public/img/ar-demo.gif" alt="AR Demo" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">How Web AR Works</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-click fa-3x text-primary mb-3"></i>
                            <h3 class="h5">1. Click "Start AR"</h3>
                            <p>Click the AR button next to any product with an AR marker</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-camera fa-3x text-primary mb-3"></i>
                            <h3 class="h5">2. Allow Camera</h3>
                            <p>Give permission for your browser to access the camera</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-qrcode fa-3x text-primary mb-3"></i>
                            <h3 class="h5">3. Scan & View</h3>
                            <p>Point your camera at the marker to see the 3D model instantly</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sample Products with Markers -->
    <section class="py-5" style="background-color: rgba(175, 143, 111, 0.1);">
        <div class="container">
            <h2 class="text-center mb-5">Try These Products in AR</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Ceramic Vase">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title">Ceramic Vase</h5>
                                <img src="/api/placeholder/50/50" alt="AR Marker" class="border">
                            </div>
                            <p class="card-text">Modern ceramic vase with a unique glaze finish</p>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-camera me-2"></i>View in full screen
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Table Lamp">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title">Table Lamp</h5>
                                <img src="/api/placeholder/50/50" alt="AR Marker" class="border">
                            </div>
                            <p class="card-text">Handcrafted ceramic lamp with textured surface</p>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-camera me-2"></i>View in full screen
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Decorative Bowl">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title">Decorative Bowl</h5>
                                <img src="/api/placeholder/50/50" alt="AR Marker" class="border">
                            </div>
                            <p class="card-text">Large decorative bowl with custom patterns</p>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-camera me-2"></i>View in full screen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Use Our Web AR?</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-bolt text-primary fa-2x me-3"></i>
                        <div>
                            <h3 class="h5">Instant Access</h3>
                            <p>No app downloads required - works directly in your web browser</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-mobile-alt text-primary fa-2x me-3"></i>
                        <div>
                            <h3 class="h5">Works on Any Device</h3>
                            <p>Compatible with most modern smartphones and tablets</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-share-alt text-primary fa-2x me-3"></i>
                        <div>
                            <h3 class="h5">Easy to Share</h3>
                            <p>Share AR experiences via simple web links</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-sync text-primary fa-2x me-3"></i>
                        <div>
                            <h3 class="h5">Always Updated</h3>
                            <p>Access the latest 3D models without updating any apps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Browser Compatibility -->
    <section class="py-5 border-primary-subtle border-bottom" style="background-color: rgba(175, 143, 111, 0.1);">
        <div class="container text-center">
            <h2 class="mb-4">Compatible Browsers</h2>
            <p class="lead mb-4">Our Web AR works best with these browsers:</p>
            <div class="row justify-content-center g-4">
                <div class="col-2">
                    <i class="fab fa-chrome fa-3x mb-2"></i>
                    <p>Chrome</p>
                </div>
                <div class="col-2">
                    <i class="fab fa-safari fa-3x mb-2"></i>
                    <p>Safari</p>
                </div>
                <div class="col-2">
                    <i class="fab fa-firefox fa-3x mb-2"></i>
                    <p>Firefox</p>
                </div>
                <div class="col-2">
                    <i class="fab fa-edge fa-3x mb-2"></i>
                    <p>Edge</p>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "src/components/footer.html"; ?>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>