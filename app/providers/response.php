<?php

namespace App\Providers;

use App\Core\Response as ResponseLib;

class Response extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    $res = new ResponseLib();
    $this->container->bind('response', $res);
  }
}
