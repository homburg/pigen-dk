<?php

class Server
{
	const HOSTNAME_DEVELOPMENT = 'gravko';

	public static function __callStatic($method, $args)
	{
		$method = substr($method, 3);
		
		$method = preg_replace('/([a-z])([A-Z])/', '$1_$2', $method);
		$method = strtoupper($method);

		return $_SERVER[$method];
	}

	/**
	 * Determine whether we are on the development server
	 * @return bool
	 */
	public static function isDevelopment ()
	{
		return gethostname() === self::HOSTNAME_DEVELOPMENT;
	}

	/**
	 * @param bool $noGetParameters Do not include get parameters
	 */
	public static function getUri ($noGetParameters = false)
	{
		$uri = self::getRequestUri();
		if ($noGetParameters)
			$uri = preg_replace('/\?.*/', '', $uri);

		return $uri;
	}

	/**
	 * Get uri segment by index
	 *
	 * @param int $index Index
	 * @return string
	 */
	public static function getUriSegment ($index)
	{
		$segments = explode('/', Server::getUri(true));
		array_shift($segments);
		return @$segments[$index];
	}
}

?>
