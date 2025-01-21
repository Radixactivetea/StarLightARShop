<link rel="stylesheet" href="/public/css/nav.css">
<link rel="stylesheet" href="/public/css/Navbar-Centered-Brand-icons.css">

<style>
    /* Show dropdown menu on hover */
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    /* Ensure the dropdown is hidden by default */
    .dropdown-menu {
        display: none;
        margin-top: 0;
        font-size: 13px;
        /* Optional adjustment for alignment */
    }

    .dropdown-item:hover {
        background-color: transparent;
        color: var(--bs-primary);
        text-decoration: underline;
        text-underline-offset: 5px;
    }

    /* Add hover effect to the dropdown link */
    .nav-link-top:hover {
        text-decoration: underline;
    }
</style>


<nav>
    <div class="container justify-content-lg-end align-items-lg-center">
        <div class="row d-flex justify-content-end align-items-center" style="height: 35px;">
            <div class="col-auto d-md-flex align-items-md-center" style="padding: 0px;">
                <a class="nav-link-top" href="/help" style="border-right: 2px solid var(--bs-emphasis-color);">
                    Help
                </a>
            </div>

            <?php if (!empty($_SESSION['firstname'])) { ?>
                <div class="col-auto d-md-flex align-items-md-center" style="padding-left: 0px;">
                    <div class="dropdown">
                        <a class="nav-link-top" href="/profile" id="userDropdown" role="button"
                            style="padding-right: 0px; font-size: 13px;">
                            Hi, <?= ucfirst(strtolower($_SESSION['firstname'])) ?>!
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em"
                                fill="currentColor"
                                style="margin-left: 10px; transform: translateY(-3px); width: 20px; height: 20px;">
                                <path
                                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z">
                                </path>
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-auto d-md-flex align-items-md-center" style="padding-left: 0px;"><a class="nav-link-top"
                        href="/login" style="padding-right: 0px;font-size: 13px;">Login
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-body" style="padding: 0px;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/"><img src="/public/img/logo-transparent.png"></a>
        <div id="navcol-4" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">StarLight Pottery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?= urlis('/') ? 'active' : '' ?>" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link <?= urlis('/shop') ? 'active' : '' ?>" href="/shop">Shop</a>
                </li>
                <li class="nav-item"><a class="nav-link <?= urlis('/ar-experience') ? 'active' : '' ?>"
                        href="/ar-experience">AR Experience</a></li>
                <li class="nav-item"><a class="nav-link <?= urlis('/about-us') ? 'active' : '' ?>"
                        href="/about-us">About Us</a></li>
            </ul>
        </div>
        <input class="focus-ring focus-ring-primary search" type="search" placeholder="Search">
        <div class="toggle-icon">
            <a class="responsive-icon" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" class="icon icon-tabler icon-tabler-search">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                    <path d="M21 21l-6 -6"></path>
                </svg></a>
            <a href="/mail"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icon-tabler-mail">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                    <path d="M3 7l9 6l9 -6"></path>
                </svg></a>
            <a href="/cart"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icon-tabler-shopping-cart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 17h-11v-14h-2"></path>
                    <path d="M6 5l14 1l-1 7h-13"></path>
                </svg></a>
            <a class="responsive-icon" href="/profile"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" class="icon icon-tabler icon-tabler-user">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                </svg></a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" aria-controls="offcanvasNavbar"
                data-bs-target="#navcol-4" aria-label="Toggle navigation"><span class="visually-hidden">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button>
        </div>
    </div>
</nav>