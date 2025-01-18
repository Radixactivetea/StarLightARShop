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
</head>

<body>

    <!-- loading page -->
    <?php require "src/components/loading.php" ?>
    <div class="grid-layout">
        <!-- navigation -->
        <?php require "src/components/seller-nav.php" ?>
        <div class="container p-5 main-content">

            <?= displayAlert() ?>

            <h1 class="mb-4">Pottery Product</h1>
            <p class="text-muted m-0 ">Please provide the following details about your pottery product:</p>
            <p class="text-muted m-0 mb-2">We'll need information about the name, description, pricing, dimensions, and
                an
                image of the product.</p>

            <form class="row g-3" method="POST" enctype="multipart/form-data" novalidate>

                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                    <?php showError('name') ?>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['name'] ?? '' ?></div>
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">RM</span>
                        <input type="number" class="form-control" id="price" name="price" min="0" step="0.01"
                            value="<?= old('price') ?>" required>
                    </div>
                    <?php showError('price') ?>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['price'] ?? ''; ?></div>
                </div>

                <div class="col-md-6">
                    <label for="stock_level" class="form-label">Stock</label>
                    <div class="input-group">
                        <span class="input-group-text">Total</span>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" step="1"
                            value="<?= old('stock') ?>" required>
                    </div>
                    <?php showError('stock') ?>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['stock'] ?? ''; ?></div>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        required><?= old('description') ?></textarea>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['description'] ?? ''; ?></div>
                    <?php showError('description') ?>
                </div>

                <p class="text-muted m-0 mt-5">The dimensions we need are diameter (in cm), height (in cm), weight (in
                    kg),
                    and
                    capacity (in liters).
                </p>
                <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['categories'] ?? ''; ?></div>
                <?php showError('categories') ?>

                <?php foreach ($category as $cat): ?>
                    <div class="col-md-3">
                        <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>" class="btn-check"
                            id="category-<?= $cat['category_id'] ?>" autocomplete="off" <?php if (in_array($cat['category_id'], $selectedCategories)): ?> checked <?php endif; ?>>
                        <label class="btn btn-outline-primary category-btn w-100" for="category-<?= $cat['category_id'] ?>">
                            <?= $cat['name'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>

                <p class="text-muted m-0 mt-5">The dimensions we need are diameter (in cm), height (in cm), weight (in
                    kg),
                    and
                    capacity (in liters).
                </p>

                <div class="col-md-3">
                    <label for="diameter" class="form-label">Diameter (cm)</label>
                    <input type="number" class="form-control" id="diameter" name="diameter" min="0" step="0.1"
                        value="<?= old('diameter') ?>" required>
                    <?php showError('diameter') ?>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['diameter'] ?? ''; ?></div>
                </div>

                <div class="col-md-3">
                    <label for="height" class="form-label">Height (cm)</label>
                    <input type="number" class="form-control" id="height" name="height" min="0" step="0.1"
                        value="<?= old('height') ?>" required>
                    <?php showError('height') ?>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['height'] ?? ''; ?></div>
                </div>
                <div class="col-md-3">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" class="form-control" id="weight" name="weight" min="0" step="0.01"
                        value="<?= old('weight') ?>" required>
                    <?php showError('weight') ?>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['weight'] ?? ''; ?></div>
                </div>
                <div class="col-md-3">
                    <label for="capacity" class="form-label">Capacity (l)</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" min="0" step="0.01"
                        value="<?= old('capacity') ?>" required>
                    <?php showError('capacity') ?>
                    <div class="mt-1 text-danger" style="font-size: 10px;"><?= $errors['capacity'] ?? ''; ?></div>
                </div>

                <div class="col-md-6">
                    <label for="image_url" class="form-label">Image</label>
                    <input type="file" class="form-control form-control-file" id="image_url" name="image_url" required>

                    <?php if (!empty($imageErrors)): ?>
                        <?php foreach ($imageErrors as $error): ?>
                            <div class="mt-1 text-danger" style="font-size: 10px;"><?= $error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                <div class="col-12">
                    <a href="/seller/manage-products" class="btn btn-primary">Back</a>
                    <input type="hidden" name="save-form" id="save-form">
                    <button type="submit" class="btn btn-secondary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>