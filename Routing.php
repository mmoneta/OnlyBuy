<?php
  require_once 'src/controllers/DashboardController.php';
  require_once 'src/controllers/LoginController.php';
  require_once 'src/controllers/RegisterController.php';
  require_once 'src/controllers/ForgotPasswordController.php';

  class Router {
    public static $routes;

    public static function get($url, $view) {
      self::$routes[$url] = $view;
    }

    public static function post($url, $view) {
      self::$routes[$url] = $view;
    }

    public static function run ($url) {
      $action = explode("/", $url)[0];
      
      if (!array_key_exists($action, self::$routes)) {
        die("Wrong url!");
      }

      $controller = self::$routes[$action];
      $object = new $controller;
      $action = method_exists($controller, $action) ? $action : 'index';

      $object->$action();
    }
  }