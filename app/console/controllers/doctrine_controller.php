<?php

namespace App\Console\Controllers;

use App\Core\ConsoleController;
use App\Libs\EntityGenerator;
use Doctrine\ORM\Mapping\Driver\DatabaseDriver;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;

class DoctrineController extends ConsoleController {
  public function __construct() {
    parent::__construct();
  }

  function modelGenerate() {
    $driver = new DatabaseDriver(
      $this->container->entityManager->getConnection()->getSchemaManager()
    );
    $driver->setNamespace('App\\Models\\');
    $this->container->entityManager->getConfiguration()->setMetadataDriverImpl($driver);

    $cmf = new DisconnectedClassMetadataFactory();
    $cmf->setEntityManager($this->container->entityManager);
    $metadata = $cmf->getAllMetadata();

    $entityGenerator = new EntityGenerator();
    $entityGenerator->setGenerateAnnotations(true);
    $entityGenerator->setGenerateStubMethods(true);
    $entityGenerator->setRegenerateEntityIfExists(false);
    $entityGenerator->setUpdateEntityIfExists(true);
    $entityGenerator->generate($metadata, __DIR__.'/../../models/');
    echo "Models Generated\n";
  }
}

?>
