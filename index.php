<?php
    require 'Routing.php';

    $path = trim($_SERVER['REQUEST_URI'], '/');
    $path = parse_url($path, PHP_URL_PATH);

    Router::get('', 'DashboardController');
    Router::get('login', 'LoginController');
    Router::get('register', 'RegisterController');
    Router::get('forgot-password', 'ForgotPasswordController');
    Router::post('login', 'LoginController');
    Router::post('register', 'RegisterController');

    Router::run($path);