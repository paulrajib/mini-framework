<?php

namespace App\Core;

use App\Core\Container;

class ConsoleRouter
{
  public $container;

  public function __construct()
  {
    $this->container = Container::getInstance();
  }

  public function resolve()
  {
    $commands = (require __DIR__.'/../console/commands.php');
    global $argv;
    $called = $argv[1];
    $target = null;
    foreach($commands as $k => $v)
    {
      if($k == $called)
      {
        $target = $v;
        break;
      }
    }
    if(!empty($target))
    {
      $parts = explode('@', $target);
      $targetCls = $parts[0];
      $targetFunc = $parts[1];

      $paramStack = [];

      $refl = new \ReflectionClass($targetCls);
      $par = $refl->getMethod($targetFunc)->getParameters();
      foreach($par as $param)
      {
        $paramCls = $param->getClass();
        if(!empty($paramCls))
        {
          if(!empty($paramCls->getName()))
          {
            $properties = $this->container->getProperties();
            foreach($properties as $property)
            {
              if(is_object($property))
              {
                $propertyCls = get_class($property);
                if($propertyCls == $paramCls->getName())
                {
                  $paramStack[] = $property;
                }
              }
            }
          }
        }
      }

      $controller = new $targetCls;
      call_user_func_array([$controller, $targetFunc], $paramStack);
    }
  }
}

?>
