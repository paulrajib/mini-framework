<?php

namespace App\Core;

use App\Core\Container;

class HttpExceptionHandler {
  public $container;

  public function __construct()
  {
    $this->container = Container::getInstance();
  }

  public function handleException($exc)
  {
    $className = get_class($exc);
    switch($className)
    {
      case 'App\Core\Exceptions\RouteNotFoundException':
        http_response_code(404);
        return true;
      default:
        return false;
    }
  }
}
