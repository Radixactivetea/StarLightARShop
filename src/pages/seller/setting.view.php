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

        <div class="main-content p-4">
            <div class="container mt-5">
                <h1 class="mb-4">Edit Profile</h1>
                <form method="POST" enctype="multipart/form-data">
                    <!-- Profile Picture -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img id="profileImage"
                                src="/public/upload/profile/<?= $user['profile_pic_url'] ?? "default.png" ?>"
                                width="150px" height="150px" class="rounded-circle" alt="Profile Picture">
                            <button type="button" id="changePictureBtn"
                                class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                                <i class="fas fa-camera"></i>
                            </button>
                            <input type="file" id="profileInput" name="profile_picture" class="d-none" accept="image/*">
                            <input type="hidden" name="uploaded_file" value="<?= $user['profile_pic_url'] ?>">
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="mb-4">
                        <h6 class="mb-3 ms-1">Personal Information</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted ms-1">First Name</label>
                                <input type="text" class="form-control" name="firstname"
                                    value="<?= $user['firstname'] ?>">
                                <?= showError('firstname') ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted ms-1">Last Name</label>
                                <input type="text" class="form-control" name="lastname"
                                    value="<?= $user['lastname'] ?>">
                                <?= showError('lastname') ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted ms-1">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
                                <?= showError('email') ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted ms-1">Phone Number</label>
                                <input type="tel" class="form-control" name="phonenum"
                                    value="<?= $user['phone_num'] ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Password Change -->
                    <div class="mb-4">
                        <h6 class="mb-3 ms-1">Change Password</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-muted ms-1">Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="currentpassword">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePassword(this)">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted ms-1">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="newpassword">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePassword(this)">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <?= showError('newpassword') ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted ms-1">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="confirmpassword">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePassword(this)">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <?= showError('confirmpassword') ?>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- bootstap and popper -->
        <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
        <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

        <script>
            // JavaScript to handle real-time image preview
            document.getElementById('changePictureBtn').addEventListener('click', function () {
                document.getElementById('profileInput').click();
            });

            document.getElementById('profileInput').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('profileImage').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
        <script>
            function togglePassword(button) {
                const input = button.previousElementSibling;
                const icon = button.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-fill');
                    icon.classList.add('bi-eye-slash-fill');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye-fill');
                }
            }
        </script>

</body>

</html>