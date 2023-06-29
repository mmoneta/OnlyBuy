<?php

use src\utils\Utils;

class Router
{
  public static $routes;

  public static function get($url, $view)
  {
    self::$routes[$url] = $view;
  }

  public static function post($url, $view)
  {
    self::$routes[$url] = $view;
  }

  public static function run($url)
  {
    if (file_exists($url)) {
      header('Content-Type: ' . mime_content_type($url));
      header('Content-Length: ' . filesize($url));

      echo file_get_contents($url);
      return;
    }

    $urlParts = explode("/", $url);
    $action = $urlParts[0];
    $params = array_slice($urlParts, 1);

    $controller = self::$routes[$action];
    $object = new $controller;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $action = Utils::dashesToCamelCase($action);
    }

    $action = method_exists($controller, $action) ? $action : 'index';

    if ($params) {
      $object->$action(...$params);
      return;
    }

    $object->$action();
  }
}