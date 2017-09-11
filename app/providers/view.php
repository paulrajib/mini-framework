<?php

namespace App\Providers;

use Xiaoler\Blade\FileViewFinder;
use Xiaoler\Blade\Factory;
use Xiaoler\Blade\Compilers\BladeCompiler;
use Xiaoler\Blade\Engines\CompilerEngine;
use Xiaoler\Blade\Filesystem;
use Xiaoler\Blade\Engines\EngineResolver;

class View extends Provider
{
  public function __construct()
  {
    parent::__construct();
  }
  public function boot()
  {
    $path = [__DIR__.'/../../views/'];
    $cachePath = __DIR__.'/../../storage/cache/';

    $file = new Filesystem;
    $compiler = new BladeCompiler($file, $cachePath);

    $resolver = new EngineResolver;
    $resolver->register('blade', function () use ($compiler) {
      return new CompilerEngine($compiler);
    });

    $factory = new Factory($resolver, new FileViewFinder($file, $path));
    $this->container->bind('blade', $factory);
  }
}
