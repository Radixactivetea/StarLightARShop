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

    <div class="container py-5">
        <h1 class="mb-4">Pottery Product</h1>
        <p class="text-muted m-0 ">Please provide the following details about your pottery product:</p>
        <p class="text-muted m-0 mb-2">We'll need information about the name, description, pricing, dimensions, and an image of
            the product.</p>
        <form class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text">RM</span>
                    <input type="number" class="form-control" id="price" min="0" step="0.01" required>
                </div>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" required></textarea>
            </div>
            <p class="text-muted m-0 mt-5">The dimensions we need are diameter (in cm), height (in cm), weight (in kg), and
                capacity (in liters).
            </p>
            <div class="col-md-3">
                <label for="diameter" class="form-label">Diameter (cm)</label>
                <input type="number" class="form-control" id="diameter" min="0" step="0.1" required>
            </div>
            <div class="col-md-3">
                <label for="height" class="form-label">Height (cm)</label>
                <input type="number" class="form-control" id="height" min="0" step="0.1" required>
            </div>
            <div class="col-md-3">
                <label for="weight" class="form-label">Weight (kg)</label>
                <input type="number" class="form-control" id="weight" min="0" step="0.01" required>
            </div>
            <div class="col-md-3">
                <label for="capacity" class="form-label">Capacity (l)</label>
                <input type="number" class="form-control" id="capacity" min="0" step="0.01" required>
            </div>
            <div class="col-md-6">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control form-control-file" id="image" accept="image/*">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" onclick="history.back()">Back</button>
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>
        </form>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>