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

    <style>
        .status {
            border: 1px solid rgba(175, 143, 111, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background-color: rgba(175, 143, 111, 0.1)
        }
    </style>

<body>
    <!-- loading page -->
    <?php require "src/components/loading.php" ?>

    <div class="container py-5">
        <div class="rounded shadow-sm p-4 mb-4 status">
            <form method="POST">
                <div class="text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                    <h4 class="mt-3">Payment Successful!</h4>
                    <p class="text-muted">Your transaction has been completed successfully.</p>
                    <p class="mb-0">Transaction ID: #123456789</p>
                    <button type="submit" class="btn btn-primary mt-3">Back to Home</button>
                </div>
            </form>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>