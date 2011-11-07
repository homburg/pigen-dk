<?php

class Server
{
	public static function __callStatic($method, $args)
	{
		$method = substr($method, 3);
		
		$method = preg_replace('/([a-z])([A-Z])/', '$1_$2', $method);
		$method = strtoupper($method);

		return $_SERVER[$method];
	}

	public static function getUri ()
	{
		return self::getRequestUri();
	}
}

?>
