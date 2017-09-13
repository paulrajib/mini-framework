<?php

namespace App\Core;

class Repository {
  public $container;
  public $entityManager;
  protected static $instance;

  final public static function getInstance()
  {
    $class = get_called_class();
    if(!static::$instance) {
      static::$instance = new $class();
    }
    return static::$instance;
  }

  public function __construct() {
    $this->container = Container::getInstance();
    $this->entityManager = $this->container->entityManager;
  }
}

?>
