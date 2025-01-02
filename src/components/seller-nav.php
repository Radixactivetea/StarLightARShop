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
</style>

<!-- Seller Navigation Bar -->
<div class="sidebar">
    <div class="logo">
        <a class="" href="/"><img width="50px" src="/public/img/logo.png"></a>
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
        <a class="nav-link <?= urlis('/products') ? 'active' : '' ?>" href="/products">
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
        <a class="nav-link" href="/help&center">
            <i class="bi bi-question-circle"></i>
            Help & Center
        </a>
        <a class="nav-link" href="/settings">
            <i class="bi bi-gear"></i>
            Settings
        </a>
    </nav>

    <nav class="nav flex-column mt-4">
        <a class="nav-link" href="/log-out">
            <i class="bi bi-box-arrow-left"></i>
            Log Out
        </a>
    </nav>
</div>