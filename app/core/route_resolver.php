<?php

namespace App\Core;

use App\Core\Container;
use App\Core\Exceptions\RouteNotFoundException;

class RouteResolver
{
	private $router;
	public $container;

	public function __construct(Router $router)
	{
		$this->container = Container::getInstance();
		$this->router = $router;
	}

	public function resolve($request)
	{
		$routes = $this->router->getRoutesByMethod($request['method']);
		$requestedUri = trim(preg_replace('/\?.*/', '', $request['uri']), '/');
		foreach ($routes as $route) {
			$matches = array();
			if ($route->getUrl() === $requestedUri || preg_match('~^'.$route->getUrl().'$~', $requestedUri, $matches)) {
				$arguments = $this->getArguments($matches);
				if (is_object($route->getAction()) && ($route->getAction() instanceof \Closure)) {
					return call_user_func_array($route->getAction(), $arguments);
				}
				$className = substr($route->getAction(), 0, strpos($route->getAction(), '::'));
				$functionName = substr($route->getAction(), strpos($route->getAction(), '::') + 2);
				$refl = new \ReflectionClass($className);
	      $par = $refl->getMethod($functionName)->getParameters();
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
	                	$arguments[] = $property;
	              	}
								}
	            }
	          }
	        }
	      }
				call_user_func_array(array((new $className), $functionName), $arguments);
				return;
			}
		}
		throw new RouteNotFoundException($request['method'].' '.$request['uri'].' not found');
	}

	private function getArguments($matches)
	{
		$arguments = array();
		foreach ($matches as $key => $match) {
			if ($key === 0) continue;
			if (strlen($match) > 0) {
				$arguments[] = $match;
			}
		}
		return $arguments;
	}
}
