<?php

namespace App\Providers;

use App\Core\HttpExceptionHandler as HttpExceptionHandlerLib;

class HttpExceptionHandler extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
      $httpExceptionHandler = new HttpExceptionHandlerLib();
      $this->container->bind('httpExceptionHandler', $httpExceptionHandler);
  }
}
