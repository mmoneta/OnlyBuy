<?php

require 'Autoloader.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
$domainLink = $protocol . '://' . $_SERVER['HTTP_HOST'];

Router::get('', 'src\\controllers\\DashboardController');
Router::get('forgot-password', 'src\\controllers\\ForgotPasswordController');
Router::get('login', 'src\\controllers\\LoginController');
Router::get('product-creator', 'src\\controllers\\ProductCreatorController');
Router::get('product-editor', 'src\\controllers\\ProductEditorController');
Router::get('products', 'src\\controllers\\ProductsController');
Router::get('register', 'src\\controllers\\RegisterController');
Router::get('roles', 'src\\controllers\\RolesController');
Router::get('session', 'src\\controllers\\SessionController');
Router::get('user-creator', 'src\\controllers\\UserCreatorController');
Router::get('user-editor', 'src\\controllers\\UserEditorController');
Router::get('users', 'src\\controllers\\UsersController');

Router::post('login', 'src\\controllers\\LoginController');
Router::post('register', 'src\\controllers\\RegisterController');
Router::post('product-creator', 'src\\controllers\\ProductCreatorController');
Router::post('user', 'src\\controllers\\UserCreatorController');

Router::run($path);