<?php

namespace App\Core;

class Controller {
  public $container;
  public $response;

  public function __construct() {
    $this->container = Container::getInstance();
    $this->response = $this->container->response;
  }
}

?>
