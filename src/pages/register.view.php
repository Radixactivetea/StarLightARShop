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
        .form-container {
            max-width: 450px;
            margin: 3rem auto;
            padding: 0 1rem;
        }

        .logo-container {
            display: flex;
            justify-content: start;
            gap: 10px;
            margin-bottom: 2rem;
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

        .password-requirements {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .birthday-row {
            display: flex;
            gap: 10px;
        }

        .birthday-row select {
            flex: 1;
        }

        .checkbox-wrapper {
            display: flex;
            gap: 10px;
            margin: 1rem 0;
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

        <h4 class="mb-3">Now let's make you a StarLight Pottery Member.</h4>
        <p class="text-muted mb-4">We've sent a code to <?= $_GET['email'] ?> <a href="/login"
                class="text-dark">Edit</a>
        </p>

        <!-- Form with Bootstrap Validation -->
        <form class="needs-validation" method="POST" novalidate>
            <!-- Verification Code -->
            <!-- <div class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="code" placeholder="Code*" required>
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="text-end mt-1">
                    <small class="text-muted">Resend code in 18s</small>
                </div>
            </div> -->
            
            <!-- Username Fields -->
            <div class="mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= old('username') ?>" required>
                <div class="invalid-feedback">
                    Please enter your username.
                </div>
                <?php showError('username') ?>;
            </div>

            <!-- Name Fields -->
            <div class="mb-3">
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" value="<?= old('fullname') ?>" required>
                <div class="invalid-feedback">
                    Please enter your full name.
                </div>
                <?php showError('fullname') ?>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <div class="password-input-container">
                    <input type="password" class="form-control" id="password" name="password" value="<?= old('password') ?>" placeholder="Password"
                        required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$">
                    <i class="fas fa-eye password-toggle"></i>
                    <?php showError('password') ?>
                </div>
                <div class="password-requirements mt-2 mb-4">
                    <div><i class="fas fa-times-circle"></i> Minimum of 8 characters</div>
                    <div><i class="fas fa-times-circle"></i> Uppercase, lowercase letters, and one number</div>
                </div>
            </div>

            <!-- Date of Birth -->
            <label class="form-label">Date of Birth</label>
            <div class="birthday-row mb-3">
                <select class="form-select" name="dob_day" required>
                    <option value="" disabled selected>Day</option>
                    <!-- Add days 1-31 dynamically with JavaScript -->
                </select>
                <select class="form-select" name="dob_month" required>
                    <option value="" disabled selected>Month</option>
                    <!-- Add months dynamically with JavaScript -->
                </select>
                <select class="form-select" name="dob_year" required>
                    <option value="" disabled selected>Year</option>
                    <!-- Add years dynamically with JavaScript -->
                </select>
            </div>
            <small class="text-muted">Get a Member Reward on your birthday.</small>

            <small class="text-muted d-block mt-3 mb-2">
                By continuing, I agree to the <a href="#" class="text-dark">Privacy Policy</a>
                and <a href="#" class="text-dark">Terms of Use</a>.
            </small>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary w-5 rounded-pill" type="submit">Create Account</button>
            </div>
        </form>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        // Bootstrap validation
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
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

            // Populate date dropdowns
            const daySelect = document.querySelectorAll('.form-select')[0];
            const monthSelect = document.querySelectorAll('.form-select')[1];
            const yearSelect = document.querySelectorAll('.form-select')[2];

            // Add days
            for (let i = 1; i <= 31; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                daySelect.appendChild(option);
            }

            // Add months
            const months = ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'];
            months.forEach((month, index) => {
                const option = document.createElement('option');
                option.value = index + 1;
                option.textContent = month;
                monthSelect.appendChild(option);
            });

            // Add years (e.g., last 100 years)
            const currentYear = new Date().getFullYear();
            for (let i = currentYear; i >= currentYear - 100; i--) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }
        })()
    </script>
</body>

</html>