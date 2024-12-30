<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .terms-text {
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
            margin: 1rem 0;
        }

        .password-input-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        .btn:hover {
            transform: none;
        }
    </style>
</head>

<body>

    <!-- loading page -->
    <?php require("src/components/loading.php") ?>

    <div class="mx-auto p-3" style="max-width: 450px;">
        <!-- Logo Container -->
        <div class="d-flex">
            <a class="navbar-brand" href="/"><img src="/public/img/logo.png"></a>
        </div>

        <!-- Main Heading -->
        <h5 class="text-start">What's your password ?</h5>
        <p class="text-muted mb-4"><?= $_GET['email'] ?? '' ?> <a href="/login" class="text-dark">Edit</a>
        </p>

        <!-- Form -->
        <form class="needs-validation" method="POST" novalidate>
            <div class="mb-4 password-input-container">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password"
                    required>
                <i class="fas fa-eye password-toggle"></i>
                <div class="invalid-feedback">
                    Require.
                </div>
            </div>

            <!-- Terms Text -->
            <div class="terms-text">
                By continuing, I agree to the <a href="#" class="text-dark">Privacy Policy</a>
                and <a href="#" class="text-dark">Terms of Use</a>.
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-50 rounded-pill">
                    Continue
                </button>
            </div>
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

            // Password visibility toggle
            const togglePassword = document.querySelector('.password-toggle');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', () => {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');
            });
        })()
    </script>

</body>

</html>