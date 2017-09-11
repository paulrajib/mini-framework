<?php

namespace App\Core;

use App\Core\RouteFactory;

class Router
{
	private $factory;
	private $routes = array();
	private $routesByMethod = array();

	public function __construct()
	{
		$this->factory = new RouteFactory();
	}

	public function get($url, $action)
	{
		$this->add($url, 'GET', $action);
	}

	public function post($url, $action)
	{
		$this->add($url, 'POST', $action);
	}

	public function put($url, $action)
	{
		$this->add($url, 'PUT', $action);
	}

	public function patch($url, $action)
	{
		$this->add($url, 'PATCH', $action);
	}

	public function delete($url, $action)
	{
		$this->add($url, 'DELETE', $action);
	}

	public function any($url, $action)
	{
		$this->add($url, 'GET|POST|PUT|PATCH|DELETE', $action);
	}

	public function add($url, $method, $action)
	{
		$route = $this->factory->create($url, $method, $action);
		$this->routes[] = $route;
		foreach ($route->getMethod() as $method) {
			$this->routesByMethod[$method][] = $route;
		}
	}

	public function getRoutesByMethod($method)
	{
		return ($this->routesByMethod && isset($this->routesByMethod[$method])) ? $this->routesByMethod[$method] : array();
	}

	public function getAllRoutes()
	{
		return $this->routes;
	}
}

?>
