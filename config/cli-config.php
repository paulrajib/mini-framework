<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
$container = \App\Core\Container::getInstance();
$container->boot();

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $container->entityManager;
return ConsoleRunner::createHelperSet($entityManager);
