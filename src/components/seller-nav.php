<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    .navbar-nav .nav-link {
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .navbar-nav .nav-link:hover {
        background-color: #AF8F6F;
        color: white;
        border-radius: 5px;
        padding: 8px 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu {
        border: 1px solid #AF8F6F;
        border-radius: 8px;
        padding: 0;
        overflow: hidden;
    }

    .dropdown-item {
        color: #AF8F6F;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #AF8F6F;
        color: #fff;
    }

    /* Divider style */
    .dropdown-divider {
        margin: 0;
        border-color: #AF8F6F;
    }
</style>

<!-- Seller Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(175, 143, 111, 0.3);">
    <div class="container">
        <a class="navbar-brand">StarLight Pottery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sellerNavbar"
            aria-controls="sellerNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="sellerNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/seller/manage-products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/seller/orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/seller/review&rating">Reviews & Ratings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/seller/notifications">Notifications</a>
                </li>
                <!-- Profile Dropdown Icon -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>