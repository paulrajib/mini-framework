<?php

namespace App\Providers;

use App\Core\BaseUrl as BaseUrlLib;

class BaseUrl extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    $baseUrl = new BaseUrlLib();
    $this->container->bind('baseUrl', $baseUrl->detectBaseUrl());
  }
}
