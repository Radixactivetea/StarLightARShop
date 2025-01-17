<?php


use Src\Controllers\CartController;
use Src\Controllers\CheckoutController;
use src\Controllers\HomeController;
use Src\Controllers\PaymentController;
use Src\Controllers\ProductController;
use Src\Controllers\ShopController;
use Src\Controllers\ARController;
use Src\Controllers\UserAuthController;

require_once 'router.php';

get('/', function () { $controller = new HomeController(); $controller->index();});
get('/shop', function () { $controller = new ShopController(); $controller->index();});
get('/shop/$id', function ($id) { $controller = new ProductController(); $controller->show($id);});
post('/shop/$id', function ($id) { $controller = new CartController(); $controller->addToCart($id);});

get('/cart', function () { $controller = new CartController(); $controller->viewCart();});
post('/cart-update', function () { $controller = new CartController(); $controller->updateCart();});
destroy('/cart', function () { $controller = new CartController(); $controller->removeFromCart();});
post('/cart', function () { $controller = new CartController(); $controller->moveToCheckOut();});

get('/checkout', function () { $controller = new CheckoutController(); $controller->index();});
post('/checkout', function () { $controller = new CheckoutController(); $controller->store();});

get('/payment', function () { $controller = new PaymentController(); $controller->index();});
post('/payment', function () { $controller = new PaymentController(); $controller->process();});

get('/AR/$id', function ($id) { $controller = new ARController(); $controller->index($id);});

get('/login', function () { $controller = new UserAuthController(); $controller->showLogin();});
post('/login', function () { $controller = new UserAuthController(); $controller->processLogin();});
get('/register', function () { $controller = new UserAuthController(); $controller->showRegister();});
post('/register', function () { $controller = new UserAuthController(); $controller->processRegistration();});
get('/verify', function () { $controller = new UserAuthController(); $controller->showVerify();});
post('/verify', function () { $controller = new UserAuthController(); $controller->processVerification();});
get('/logout', function () { $controller = new UserAuthController(); $controller->logout();});

get('/products', '../src/controllers/seller/products-show.php');
destroy('/products', '../src/controllers/seller/products-show.php');
get('/product/create', '../src/controllers/seller/product-create.php');
post('/product/create', '../src/controllers/seller/product-create.php');

get('/orders', '../src/controllers/seller/orders.php');
post('/orders', '../src/controllers/seller/order-update.php');

get('/review&rating', '../src/controllers/seller/review&rating.php');
post('/review&rating', '../src/controllers/seller/review&rating-update.php');

any('/404', '../src/pages/404.view.php');