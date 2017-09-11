<?php

namespace App\Core;

class Container {
  public static $instance = null;

  public static function getInstance()
	{
		null === self::$instance AND self::$instance = new self;
		return self::$instance;
	}

  public function __construct()
  {

  }

  public function boot()
  {
    $isCLI = ( php_sapi_name() == 'cli' );
    if($isCLI)
    {
      $conf = (require __DIR__.'/../../config/console.php');
    }
    else
    {
      $conf = (require __DIR__.'/../../config/app.php');
    }
    $providers = $conf['providers'];
    foreach($providers as $provider)
    {
      $providerObj = new $provider;
      $providerObj->boot();
    }
  }

  public function bind($name, $obj)
  {
    $this->{$name} = $obj;
  }

  public function getProperties()
  {
    return get_object_vars ($this);
  }
}

?>
