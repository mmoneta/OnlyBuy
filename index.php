<?php
    require 'Routing.php';

    $path = trim($_SERVER['REQUEST_URI'], '/');
    $path = parse_url($path, PHP_URL_PATH);

    Router::get('', 'LoginController');
    Router::get('login', 'LoginController');
    Router::get('register', 'RegisterController');
    Router::post('login', 'LoginController');
    Router::post('registers', 'RegisterController');

    Router::run($path);