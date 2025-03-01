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
get('/dashboard', function () { $controller = new HomeController(); $controller->index();});

get('/admin', function () { $controller = new HomeController(); $controller->index();});
post('/admin', function () { $controller = new FeedBackController(); $controller->reply();});

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
get('/AR', function () { $controller = new ARController(); $controller->manageAR();});
post('/AR', function () { $controller = new ARController(); $controller->findAR();});
post('/AR/create', function () { $controller = new ARController(); $controller->createAR();});
get('/ar-experience', function () { $controller = new ARController(); $controller->arGallery();});
get('/ar-experience/camera', function () { $controller = new ARController(); $controller->arCamera();});

get('/mail', function () { $controller = new NotificationController(); $controller->index();});
get('/messages', function () { $controller = new NotificationController(); $controller->index();});

get('/feedback', function () { $controller = new FeedBackController(); $controller->index();});
post('/feedback', function () { $controller = new FeedBackController(); $controller->create();});
get('/help&center/feedback', function () { $controller = new FeedBackController(); $controller->index();});
post('/help&center/feedback', function () { $controller = new FeedBackController(); $controller->create();});
get('/help&center/request-ban', function () { $controller = new FeedBackController(); $controller->index();});
get('/help&center/request-seller', function () { $controller = new FeedBackController(); $controller->index();});

get('/profile', function () { $controller = new UserController(); $controller->index();});
post('/profile', function () { $controller = new UserController(); $controller->update();});
get('/settings', function () { $controller = new UserController(); $controller->index();});
post('/settings', function () { $controller = new UserController(); $controller->update();});
post('/help&center/request-ban', function () { $controller = new UserController(); $controller->requestBan();});
post('/help&center/request-seller/confirm', function () { $controller = new UserController(); $controller->validateSeller();});
post('/help&center/request-seller', function () { $controller = new UserController(); $controller->requestSeller();});
get('/user-management/user', function () { $controller = new UserController(); $controller->manageUser();});
post('/user-management/user', function () { $controller = new UserController(); $controller->banUser();});
post('/user-management/user/rejected', function () { $controller = new UserController(); $controller->rejectBan();});
get('/user-management/seller', function () { $controller = new UserController(); $controller->manageSeller();});
post('/user-management/seller', function () { $controller = new UserController(); $controller->transferSeller();});

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
get('/shop/product/update/$id', function ($id) { $controller = new ProductController(); $controller->update($id);});
post('/shop/product/update/$id', function ($id) { $controller = new ProductController(); $controller->updateProduct($id);});

get('/orders', function () { $controller = new OrderController(); $controller->index();});
post('/orders', function () { $controller = new OrderController(); $controller->updateTracking();});
get('/order/detail/$id', function ($id) { $controller = new OrderController(); $controller->orderDetail($id);});

get('/review&rating', function () { $controller = new ProductController(); $controller->showReview();});
post('/review&rating', function () { $controller = new ProductController(); $controller->replyReview();});
post('/order/detail/$id', function ($id) { $controller = new ProductController(); $controller->createReview($id);});

any('/help', '../src/pages/help.view.php');
any('/404', '../src/pages/404.view.php');