<?php

require_once 'router/router.php';

get('/', '../src/pages/home.php');
get('/shop', '../src/pages/shop.php');

any('/404', '../src/pages/404.php');
