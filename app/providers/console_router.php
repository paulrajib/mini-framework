<?php

namespace App\Providers;

use App\Core\ConsoleRouter as ConsoleRouterLib;

class ConsoleRouter extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    $consoleRouter = new ConsoleRouterLib();
    $this->container->bind('consoleRouter', $consoleRouter);
  }
}
