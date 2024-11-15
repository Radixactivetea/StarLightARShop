<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">

    <link rel="stylesheet" href="/public/css/cart.css">

</head>

<body>

    <!-- loading page -->
    <?php require("src/components/loading.php") ?>

    <!-- navigation -->
    <?php require("src/components/seller-nav.php") ?>

    <div class="container p-5">
        <h1 class="mb-4">Pottery Product</h1>
        <p class="text-muted m-0 ">Please provide the following details about your pottery product:</p>
        <p class="text-muted m-0 mb-2">We'll need information about the name, description, pricing, dimensions, and an
            image of
            the product.</p>
        <form class="row g-3" action="/seller/manage-products" method="POST">
            <div class="col-md-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text">RM</span>
                    <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="stock_level" class="form-label">Stock</label>
                <div class="input-group">
                    <span class="input-group-text">Total</span>
                    <input type="number" class="form-control" id="stock_level" name="stock_level" min="0" step="1"
                        required>
                </div>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <p class="text-muted m-0 mt-5">The dimensions we need are diameter (in cm), height (in cm), weight (in kg),
                and
                capacity (in liters).
            </p>
            <div class="col-md-3">
                <label for="diameter" class="form-label">Diameter (cm)</label>
                <input type="number" class="form-control" id="diameter" name="diameter" min="0" step="0.1">
            </div>
            <div class="col-md-3">
                <label for="height" class="form-label">Height (cm)</label>
                <input type="number" class="form-control" id="height" name="height" min="0" step="0.1">
            </div>
            <div class="col-md-3">
                <label for="weight" class="form-label">Weight (kg)</label>
                <input type="number" class="form-control" id="weight" name="weight" min="0" step="0.01">
            </div>
            <div class="col-md-3">
                <label for="capacity" class="form-label">Capacity (l)</label>
                <input type="number" class="form-control" id="capacity" name="capacity" min="0" step="0.01">
            </div>
            <div class="col-md-6">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control form-control-file" id="image_url" name="image_url"
                    accept="image/*" required>
            </div>
            <div class="col-12">
                <a href="/seller/manage-products" class="btn btn-primary">Back</a>
                <input type="hidden" name="save-form" id="save-form">
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>
        </form>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>