<?php


require_once 'router.php';

get('/', '../src/controllers/home.php');
get('/shop', '../src/controllers/shop.php');
get('/shop/$id', '../src/controllers/product.php');
get('/cart', '../src/controllers/cart.php');
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

get('/review&rating', '../src/controllers/seller/review&rating.php');
post('/review&rating', '../src/controllers/seller/review&rating.php');

any('/404', '../src/pages/404.view.php');