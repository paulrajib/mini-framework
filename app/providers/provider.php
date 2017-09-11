<?php

namespace App\Providers;

use App\Core\Container;

class Provider {
  protected $container;

  public function __construct()
  {
    $this->container = Container::getInstance();
  }
}

?>
