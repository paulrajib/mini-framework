<?php

namespace App\Providers;

use App\Core\Request as RequestLib;

class Request extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    $req = new RequestLib();
    $this->container->bind('request', $req);
  }
}
