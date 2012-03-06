<?php

class Server
{
	private static $uriSegments;
	private static $script;

	const HOSTNAME_DEVELOPMENT = 'gravko';

	public static function __callStatic($method, $args)
	{
		$method = substr($method, 3);
		
		$method = preg_replace('/([a-z])([A-Z])/', '$1_$2', $method);
		$method = strtoupper($method);

		return @$_SERVER[$method];
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
	public static function getUri ($getParameters = true)
	{
		$uri = self::getRequestUri();
		if (!$getParameters)
			$uri = preg_replace('/\?.*/', '', $uri);

		return $uri;
	}

	public static function getUriSegments ()
	{
		if (static::$uriSegments == null)
		{
			static::$uriSegments = explode('/', Server::getUri(false));
			array_shift(static::$uriSegments);
		}

		return static::$uriSegments;
	}

	/**
	 * Get uri segment by index
	 *
	 * @param int $index Index
	 * @return string
	 */
	public static function getUriSegment ($index)
	{
		$segments = static::getUriSegments();
		return @$segments[$index];
	}

	/**
	 * Find target script from uri
	 * - Longest match first
	 * 	- $uri.php
	 * 	- $uri/index.php
	 * 	- /index.php
	 *
	 * @return string
	 */
	public static function getScript ()
	{
		if (self::$script != null)
			return self::$script;

		$uri = self::getUri(false);
		if (is_file(self::getDocumentRoot().$uri))
			return self::$script = self::getDocumentRoot().$uri;

		$limit = 100;

		do {
			$continue = $uri != "";
			$fullUri = self::getDocumentRoot().$uri;
			if (is_file("$fullUri.php"))
				return self::$script = "$fullUri.php";
			else if (is_file("{$fullUri}/index.php"))
				return self::$script = "{$fullUri}/index.php";
			else
				$uri = preg_replace("/\/[^\/]*$/", "", $uri);
			$limit--;
		} while ($continue && $limit > 0);

		Debug::warn("Could not resolve script for uri: \"".self::getUri()."\"");
		return self::$script = "";
	}
}
