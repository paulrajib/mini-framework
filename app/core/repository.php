<?php

namespace App\Core;

class Repository {
  public $container;
  public $entityManager;
  protected static $instance;
  protected $modelName;

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

  public function selectByData(array $data)
  {
    $qb = $this->entityManager->createQueryBuilder()
              ->select('m')
              ->from($this->modelName, 'm');
    $count = 0;
    foreach($data as $k => $v)
    {
      if($count == 0)
      {
        $qb->where("m.$k = ?".++$count);
      }
      else
      {
        $qb->andWhere("m.$k = ?".++$count);
      }
    }
    $count = 0;
    foreach($data as $k => $v)
    {
      $qb->setParameter(++$count, $v);
    }
    $q = $qb->getQuery();
    return $q->getResult();
  }
}

?>
