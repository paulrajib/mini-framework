<?php

namespace App\Core;

use App\Core\Exceptions\InvalidArgumentException;

class Route
{
	private $method;
	private $url;
	private $action;

	public function __construct($url = null, $method = null, $action = null)
	{
		$this->setUrl($url);
		$this->setMethod($method);
		$this->setAction($action);
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function setMethod($method)
	{
		if ($method === null || !is_array($method) || empty($method)) {
			throw new InvalidArgumentException('No method provided');
		}
		foreach ($method as $m) {
			if (!in_array($m, array('GET','POST','PUT','PATCH','DELETE'))) {
				throw new InvalidArgumentException('Method not allowed. allowed methods: GET, POST, PUT, PATCH, DELETE');
			}
		}
		$this->method = $method;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function setUrl($url)
	{
		if ($url === null) {
			throw new InvalidArgumentException('No url provided, for root use /');
		}
		$this->url = $url;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function setAction($action)
	{
		if (!(is_object($action) && ($action instanceof \Closure)) && ($action === null || $action === '')) {
			throw new InvalidArgumentException('Action should be a Closure or a path to a function');
		}
		$this->action = $action;
	}
}
