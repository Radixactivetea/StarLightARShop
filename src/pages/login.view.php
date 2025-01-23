<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .logo-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .form-container {
            max-width: 450px;
            margin: 3rem auto;
            padding: 0 1rem;
        }

        .terms-text {
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
            margin: 1rem 0;
        }

        .btn:hover {
            transform: none;
        }
    </style>
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <?= displayAlert() ?>

    <div class="form-container">
        <!-- Logo Container -->
        <div class="logo-container">
            <a class="navbar-brand d-flex align-items-center" href="/"><img src="/public/img/logo.png"></a>
        </div>

        <!-- Main Heading -->
        <h5 class="text-center mb-4">Enter your email to join us or sign in</h5>

        <!-- Form -->
        <form class="needs-validation" method="POST" novalidate>
            <div class="mb-4">
                <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                    value="<?= old('email') ?>" required>
                <div class="invalid-feedback">
                    Require.
                </div>
                <?php showError('email') ?>
            </div>

            <!-- Terms Text -->
            <div class="terms-text">
                By continuing, I agree to the <a href="#" class="text-dark">Privacy Policy</a>
                and <a href="#" class="text-dark">Terms of Use</a>.
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 rounded-pill">
                Continue
            </button>
        </form>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        // Bootstrap form validation
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

</body>

</html>