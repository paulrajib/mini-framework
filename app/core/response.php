<?php

namespace App\Core;

use App\Core\Container;

class Response {

  public $container;

  public function __construct()
  {
    $this->container = Container::getInstance();
  }

  public function render($template, $parameters)
  {
    echo $this->container->blade->make($template, $parameters)->render();
  }

  public function json($obj)
  {
    echo json_encode($obj);
  }
}

?>
