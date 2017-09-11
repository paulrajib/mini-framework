<?php

namespace App\Providers;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Database extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    $dbConf = (require __DIR__.'/../../config/database.php');
    $paths = array(__DIR__.'/../models');
    $isDevMode = false;
    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $entityManager = EntityManager::create($dbConf, $config);
    $this->container->bind('entityManager', $entityManager);
  }
}

?>
