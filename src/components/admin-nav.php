<style>
    .navbar-nav .nav-link {
        padding: 0.8rem 1rem;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .main-content {
        margin-top: 70px;
    }

    .stats-card {
        transition: transform 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .dropdown-item:hover {
        background-color: var(--bs-primary);
        color: white;
    }
</style>

<!-- Sidebar Navigation -->

<nav class="navbar navbar-expand-lg navbar-light light-color position-sticky border-bottom">
    <div class="container">
        <a class="navbar-brand" href="/">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-users"></i> User Management
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/user-management/user"><i class="fas fa-ban"></i> Ban Users</a></li>
                        <li><a class="dropdown-item" href="/user-management/seller"><i class="fas fa-store"></i> Seller Privileges</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/AR"><i class="fas fa-cube"></i> AR Management</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <!-- <li class="nav-item position-relative">
                    <a class="nav-link" href="#">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger rounded-pill position-absolute start-0"
                            style="font-size: 9px">3</span>
                    </a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>