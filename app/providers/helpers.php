<?php

namespace App\Providers;

class Helpers extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    require_once __DIR__.'/../helpers/globals.php';
  }
}
