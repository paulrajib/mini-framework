<?php

$classMap = require __DIR__.'/../vendor/composer/autoload_classmap.php';
$newClassMap = array();
foreach ($classMap as $class => $file)
    $newClassMap [strtolower($class)] = $file;
unset($classMap);
spl_autoload_register(function ($class) use($newClassMap)
{
  $class = strtolower($class);
  if (isset($newClassMap[$class]))
  {
    require_once $newClassMap[$class];
    return true;
  }
  else
    return false;
}, true, false);
unset($newClassMap);

$container = \App\Core\Container::getInstance();
$container->boot();
$isCLI = ( php_sapi_name() == 'cli' );
if($isCLI) {
  $container->consoleRouter->resolve();
}
else {
  try {
    $container->resolver->resolve([
  	  'uri' => $_SERVER['REQUEST_URI'],
  	  'method' => $_SERVER['REQUEST_METHOD']
    ]);
  } catch (Exception $e) {
    $result = $container->httpExceptionHandler->handleException($e);
    if($result == false)
    {
      throw $e;
    }
  }
}

?>
