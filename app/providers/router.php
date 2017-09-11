<?php

namespace App\Providers;

use App\Core\Router as RouterLib;
use App\Core\RouteResolver;

class Router extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    $router = new RouterLib();
    require_once __DIR__.'/../http/routes.php';

    $resolver = new RouteResolver($router);

    $this->container->bind('router', $router);
    $this->container->bind('resolver', $resolver);
  }
}
