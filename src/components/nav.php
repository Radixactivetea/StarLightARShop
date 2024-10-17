<link rel="stylesheet" href="./public/css/nav.css">
<link rel="stylesheet" href="./public/css/Navbar-Centered-Brand-icons.css">

<nav>
    <div class="container justify-content-lg-end align-items-lg-center">
        <div class="row d-flex justify-content-end align-items-center" style="height: 35px;">
            <div class="col-auto d-md-flex align-items-md-center" style="padding: 0px;"><a class="nav-link-top" href="#"
                    style="border-right: 2px solid var(--bs-emphasis-color);">Help</a></div>
            <div class="col-auto d-md-flex align-items-md-center" style="padding-left: 0px;"><a class="nav-link-top"
                    href="#" style="padding-right: 0px;font-size: 13px;">Hi, John<svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor"
                        style="margin-left: 10px;transform: translateY(-3px);width: 20px;height: 20px;">
                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z">
                        </path>
                    </svg></a></div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-body" style="padding: 0px;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/"><img src="./public/img/logo.png"></a>
        <div id="navcol-4" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">StarLight Pottery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?= urlis($_SERVER['REQUEST_URI']) ? 'active' : '' ?>" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link <?= urlis($_SERVER['REQUEST_URI']) ? 'active' : '' ?>" href="/shop">Shop</a></li>
                <li class="nav-item"><a class="nav-link <?= urlis($_SERVER['REQUEST_URI']) ? 'active' : '' ?>" href="#">AR Experience</a></li>
                <li class="nav-item"><a class="nav-link <?= urlis($_SERVER['REQUEST_URI']) ? 'active' : '' ?>" href="#">About Us</a></li>
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
            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icon-tabler-mail">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                    <path d="M3 7l9 6l9 -6"></path>
                </svg></a>
            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icon-tabler-shopping-cart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 17h-11v-14h-2"></path>
                    <path d="M6 5l14 1l-1 7h-13"></path>
                </svg></a>
            <a class="responsive-icon" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
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