<?php


require_once 'router.php';

get('/', '../src/controllers/home.php');
get('/shop', '../src/controllers/shop.php');
get('/shop/$id', '../src/controllers/product.php');
get('/cart', '../src/controllers/cart.php');

get('/login', '../src/controllers/login.php');
post('/login', '../src/controllers/login.php');
get('/verify', '../src/controllers/verify.php');
get('/register', '../src/controllers/register.php');
post('/register', '../src/controllers/register.php');

get('/seller/manage-products', '../src/controllers/seller/seller-products.php');
get('/seller/manage-products/form', '../src/controllers/seller/seller-product-form.php');
post('/seller/manage-products', '../src/controllers/seller/seller-products.php');
post('/seller/manage-products', '../src/controllers/seller/seller-products.php');

any('/404', '../src/pages/404.view.php');