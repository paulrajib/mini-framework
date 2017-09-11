<?php

namespace App\Core;

use App\Core\Route;
/**
 * Route builder
 */
class RouteFactory
{
	private $patterns = array(
		'~/~',			     // slash
		'~{an:[^\/]+}~',     // placeholder accepts alphabetic and numeric chars
		'~{n:[^\/]+}~',      // placeholder accepts only numeric
		'~{a:[^\/]+}~',      // placeholder accepts only alphabetic chars
		'~{w:[^\/]+}~',      // placeholder accepts alphanumeric and underscore
		'~{\*:[^\/]+}~',     // placeholder match rest of url
		'~\\\/{\?:[^\/]+}~', // optional placeholder
		'~{[^\/]+}~',	     // normal placeholder
	);

	private $replacements = array(
		'\/', 			     // slash
		'([0-9a-zA-Z]++)',   // placeholder accepts alphabetic and numeric chars
		'([0-9]++)',		 // placeholder accepts only numeric
		'([a-zA-Z]++)',	     // placeholder accepts only alphabetic chars
		'([0-9a-zA-Z-_]++)', // placeholder accepts alphanumeric and underscore
		'(.++)',			 // placeholder match rest of url
		'\/?([^\/]*)',	     // optional placeholder
		'([^\/]++)',	 	 // normal placeholder
	);

	public function create($url, $method, $action)
	{
		return new Route($this->parseUrl($url), $this->parseMethod($method), $action);
	}

	private function parseUrl($url)
	{
		$newUrl = preg_replace($this->patterns, $this->replacements, $url);
		$newUrl = trim($newUrl, '\/');
		return $newUrl;
	}

	private function parseMethod($method)
	{
		return explode('|', $method);
	}
}
