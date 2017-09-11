<?php

class App\Core;

class Model {
  protected $container;
  protected $entityManager;

  public function __construct() {
    $this->container = Container::getInstance();
    $this->entityManager = $this->container->entityManager;
  }

  
}

?>
