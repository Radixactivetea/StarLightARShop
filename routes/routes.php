<?php


use Src\Controllers\CartController;
use src\Controllers\Home;
use Src\Controllers\Shop;
use Src\Controllers\Product;

require_once 'router.php';

get('/', function () { $controller = new Home(); $controller->index();});
get('/shop', function () { $controller = new Shop(); $controller->index();});
get('/shop/$id', function ($id) { $controller = new Product(); $controller->show($id);});
post('/shop/$id', function ($id) { $controller = new CartController(); $controller->addToCart($id);});

get('/cart', function () { $controller = new CartController(); $controller->viewCart();});
post('/cart-update', '../src/controllers/cart-update.php');
post('/cart', '../src/controllers/cart.php');

get('/checkout', '../src/controllers/checkout.php');
post('/checkout', '../src/controllers/order-create.php');

get('/payment', '../src/controllers/payment.php');
post('/payment', '../src/controllers/payment.php');

get('/AR/$id', '../src/controllers/ar.php');

get('/login', '../src/controllers/login.php');
post('/login', '../src/controllers/login.php');
get('/verify', '../src/controllers/verify.php');
post('/verify', '../src/controllers/verify.php');
get('/register', '../src/controllers/register.php');
post('/register', '../src/controllers/register.php');

get('/products', '../src/controllers/seller/products-show.php');
destroy('/products', '../src/controllers/seller/products-show.php');
get('/product/create', '../src/controllers/seller/product-create.php');
post('/product/create', '../src/controllers/seller/product-create.php');

get('/orders', '../src/controllers/seller/orders.php');
post('/orders', '../src/controllers/seller/order-update.php');

get('/review&rating', '../src/controllers/seller/review&rating.php');
post('/review&rating', '../src/controllers/seller/review&rating-update.php');

any('/404', '../src/pages/404.view.php');