<?php
  require_once 'src/utils/DashesToCamelcase.php';

  require_once 'src/controllers/DashboardController.php';
  require_once 'src/controllers/ForgotPasswordController.php';
  require_once 'src/controllers/LoginController.php';
  require_once 'src/controllers/ProductCreatorController.php';
  require_once 'src/controllers/ProductEditorController.php';
  require_once 'src/controllers/ProductsController.php';
  require_once 'src/controllers/RegisterController.php';
  require_once 'src/controllers/RolesController.php';
  require_once 'src/controllers/UserCreatorController.php';
  require_once 'src/controllers/UserEditorController.php';
  require_once 'src/controllers/UsersController.php';

  class Router {
    public static $routes;

    public static function get($url, $view) {
      self::$routes[$url] = $view;
    }

    public static function post($url, $view) {
      self::$routes[$url] = $view;
    }

    public static function run ($url) {
      $urlParts = explode("/", $url);
      $action = $urlParts[0];
      $id = $urlParts[1] ?? '';

      if (!array_key_exists($action, self::$routes)) {
        die("Wrong url!");
      }

      $controller = self::$routes[$action];
      $object = new $controller;

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = dashesToCamelCase($action);
      }
      
      $action = method_exists($controller, $action) ? $action : 'index';

      $object->$action($id);
    }
  }