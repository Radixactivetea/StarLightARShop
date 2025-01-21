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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


</head>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>

        <?= displayAlert() ?>

        <div class="main-content p-4">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="h2 mb-3">Help Us Improve</h1>
                <p class="text-muted">Your feedback helps us make our pottery shopping experience better for everyone.
                </p>
            </div>

            <!-- Feedback Form -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <form method="POST">
                                <!-- Overall Rating -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">How would you rate your overall
                                        experience?</label>
                                    <div class="d-flex gap-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating5"
                                                value="5">
                                            <label class="form-check-label" for="rating5">
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating4"
                                                value="4">
                                            <label class="form-check-label" for="rating4">
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating3"
                                                value="3">
                                            <label class="form-check-label" for="rating3">
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating2"
                                                value="2">
                                            <label class="form-check-label" for="rating2">
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating1"
                                                value="1">>
                                            <label class="form-check-label" for="rating1">
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Feedback Details -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Tell us about your experience</label>
                                    <textarea class="form-control" rows="5"
                                        placeholder="What worked well? What could be improved?"
                                        name="experience_details"></textarea>
                                </div>

                                <!-- Suggestions -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Do you have any suggestions for new
                                        features?</label>
                                    <textarea class="form-control" rows="3"
                                        placeholder="Share your ideas for making our system better"
                                        name="suggestions"></textarea>
                                </div>

                                <!-- Contact Info (Initially Hidden) -->
                                <div class="mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Your name">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Your email">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        Submit Feedback
                                        <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Thank You Message (Initially Hidden) -->
                    <div class="card mt-4 shadow-sm d-none">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                            <h3>Thank You for Your Feedback!</h3>
                            <p class="mb-0">We appreciate you taking the time to help us improve our service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>