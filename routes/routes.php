<?php

require_once 'router.php';

get('/', '../src/controllers/home.php');
get('/shop', '../src/controllers/shop.php');
get('/shop/$id', '../src/controllers/product.php');
get('/cart', '../src/controllers/cart.php');

get('/seller/products', '../src/controllers/seller/products.php');

any('/404', '../src/pages/404.view.php');