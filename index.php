<?php

require 'Core/function.php';


spl_autoload_register(function ($class) {
    
    $class = str_replace('\\', '/', $class);
    
    require "{$class}.php";
});

//dummyLogin('customer');
// clearSession();

require 'routes/routes.php';