<?php
    require 'Routing.php';

    $path = trim($_SERVER['REQUEST_URI'], '/');
    $path = parse_url($path, PHP_URL_PATH);

    Router::get('', 'DashboardController');
    Router::get('forgot-password', 'ForgotPasswordController');
    Router::get('login', 'LoginController');
    Router::get('product-creator', 'ProductCreatorController');
    Router::get('product-editor', 'ProductEditorController');
    Router::get('products', 'ProductsController');
    Router::get('register', 'RegisterController');
    Router::get('roles', 'RolesController');
    Router::get('user-creator', 'UserCreatorController');
    Router::get('user-editor', 'UserEditorController');
    Router::get('users', 'UsersController');
    
    Router::post('login', 'LoginController');
    Router::post('register', 'RegisterController');
    Router::post('product-creator', 'ProductCreatorController');

    Router::run($path);