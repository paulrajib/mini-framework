<?php

namespace App\Core;

class ConsoleController {
  public $container;

  public function __construct() {
    $this->container = Container::getInstance();
  }
}

?>
