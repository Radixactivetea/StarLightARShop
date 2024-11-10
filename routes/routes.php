<?php

require_once 'router.php';

get('/', '../src/controllers/home.php');
get('/shop', '../src/controllers/shop.php');
get('/shop/$id', '../src/controllers/product.php');
get('/shop/filterBy/$category', '../src/controllers/shop.php');

any('/404', '../src/pages/404.view.php');