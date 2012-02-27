<?php

/**
 * Static class representing the http client
 */
class Client {

	/**
	 * Check if the client is an Android device
	 * Tablets and mobile alike
	 */
	public static function isAndroid ()
	{
		return false !== strpos(Server::getHttpUserAgent(), 'Android');
	}

	public static function isIOs ()
	{
		return static::isIPhone() || static::isIPad();
	}

	public static function isIPhone ()
	{
		return false !== strpos(Server::getHttpUserAgent(), 'iPhone');
	}

	public static function isIPad ()
	{
		return false !== strpos(Server::getHttpUserAgent(), 'iPad');
	}

	public static function isMobile ()
	{
		return static::isAndroid() || static::isIPhone();
	}

	public static function isTablet ()
	{
		return static::isIPad();
	}

	public static function isDesktop ()
	{
		return !static::isMobile();
	}
}
