<?php


use Src\Controllers\CartController;
use Src\Controllers\CheckoutController;
use Src\Controllers\FeedBackController;
use src\Controllers\HomeController;
use Src\Controllers\PaymentController;
use Src\Controllers\ProductController;
use Src\Controllers\ShopController;
use Src\Controllers\ARController;
use Src\Controllers\UserAuthController;
use Src\Controllers\OrderController;
use Src\Controllers\UserController;
use src\Controllers\NotificationController;

require_once 'router.php';

get('/', function () { $controller = new HomeController(); $controller->index();});
get('/about-us', function () { $controller = new HomeController(); $controller->aboutUs();});
get('/dashboard', function () { $controller = new HomeController(); $controller->homeSeller();});


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
get('/ar-experience', function () { $controller = new ARController(); $controller->arGallery();});

get('/mail', function () { $controller = new NotificationController(); $controller->index();});

get('/feedback', function () { $controller = new FeedBackController(); $controller->index();});

get('/profile', function () { $controller = new UserController(); $controller->index();});
post('/profile', function () { $controller = new UserController(); $controller->update();});

get('/login', function () { $controller = new UserAuthController(); $controller->showLogin();});
post('/login', function () { $controller = new UserAuthController(); $controller->processLogin();});
get('/register', function () { $controller = new UserAuthController(); $controller->showRegister();});
post('/register', function () { $controller = new UserAuthController(); $controller->processRegistration();});
get('/verify', function () { $controller = new UserAuthController(); $controller->showVerify();});
post('/verify', function () { $controller = new UserAuthController(); $controller->processVerification();});
get('/logout', function () { $controller = new UserAuthController(); $controller->logout();});

destroy('/shop', function () { $controller = new ProductController(); $controller->delete();});
get('/shop/product/create', function () { $controller = new ProductController(); $controller->showForm();});
post('/shop/product/create', function () { $controller = new ProductController(); $controller->create();});

get('/orders', function () { $controller = new OrderController(); $controller->index();});
post('/orders', function () { $controller = new OrderController(); $controller->updateTracking();});
get('/order/detail/$id', function ($id) { $controller = new OrderController(); $controller->orderDetail($id);});

get('/review&rating', function () { $controller = new ProductController(); $controller->showReview();});
post('/review&rating', function () { $controller = new ProductController(); $controller->replyReview();});

any('/404', '../src/pages/404.view.php');