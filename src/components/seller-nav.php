<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    .sidebar {
        width: 260px;
        background-color: #AF8F6F;
        min-height: 100vh;
        padding: 14px;
        position: sticky;
        align-self: start;
        top: 0;
    }

    .sidebar .nav-link {
        color: #ffffff;
        padding: 12px 20px;
        margin: 2px 0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar .nav-link:hover {
        background-color: #46392C;
        color: #ffffff;
    }

    .sidebar .nav-link.active {
        background-color: #46392C;
        color: #ffffff;
    }

    .logo {
        display: flex;
        color: #ffffff;
        font-size: 1.2rem;
        font-weight: bold;
        padding: 20px;
        gap: 10px;
        align-items: center;
    }

    .section-title {
        color: #6c757d;
        font-size: 0.8rem;
        padding: 20px 20px 10px;
        text-transform: uppercase;
    }

    .badge-notification {
        background-color: #ff4081;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item:hover {
        background-color: var(--bs-secondary);
        color: white;
    }

    .dropdown-item.active {
        background-color: var(--bs-secondary);
        color: white;
    }
</style>

<!-- Seller Navigation Bar -->
<div class="sidebar">
    <div class="logo">
        <a class="" href="/dashboard"><img width="50px" src="/public/img/logo.png"></a>
        <div>
            STARLIGHT POTTERY
        </div>
    </div>

    <div class="section-title text-muted">MAIN MENU</div>

    <nav class="nav flex-column">
        <a class="nav-link <?= urlis('/dashboard') ? 'active' : '' ?>" href="/dashboard">
            <i class="bi bi-grid"></i>
            Dashboard
        </a>
        <a class="nav-link <?= urlis('/shop') ? 'active' : '' ?>" href="/shop">
            <i class="bi bi-box"></i>
            Products
        </a>
        <a class="nav-link <?= urlis('/orders') ? 'active' : '' ?>" href="/orders">
            <i class="bi bi-list"></i>
            Orders
        </a>
        <a class="nav-link <?= urlis('/review&rating') ? 'active' : '' ?>" href="/review&rating">
            <i class="bi bi-star"></i>
            Review & Rating
        </a>
        <a class="nav-link <?= urlis('/messages') ? 'active' : '' ?>" href="/messages">
            <i class="bi bi-chat"></i>
            Messages
        </a>
    </nav>

    <div class="section-title mt-4 text-muted">HELP & SUPPORT</div>

    <nav class="nav flex-column">
        <div class="nav-item dropdown">
            <div class="nav-link dropdown-toggle <?= urlis('/help&center/feedback') || urlis('/help&center/request-ban') || urlis('/help&center/request-seller') ? 'active' : '' ?>"
                id="helpCenterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-question-circle"></i>
                Help & Center
            </div>
            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="helpCenterDropdown">
                <li>
                    <a class="dropdown-item <?= urlis('/help&center/feedback') ? 'active' : '' ?>"
                        href="/help&center/feedback">
                        Feedback
                    </a>
                </li>
                <li>
                    <a class="dropdown-item <?= urlis('/help&center/request-ban') ? 'active' : '' ?>"
                        href="/help&center/request-ban">
                        Request Ban User
                    </a>
                </li>
                <li>
                    <a class="dropdown-item <?= urlis('/help&center/request-seller') ? 'active' : '' ?>"
                        href="/help&center/request-seller">
                        Request Seller
                    </a>
                </li>
            </ul>
        </div>

        <a class="nav-link <?= urlis('/settings') ? 'active' : '' ?>" href="/settings">
            <i class="bi bi-gear"></i>
            Settings
        </a>
    </nav>

    <nav class="nav flex-column mt-4">
        <a class="nav-link" href="/logout">
            <i class="bi bi-box-arrow-left"></i>
            Log Out
        </a>
    </nav>
</div>