<?php

/**
 * Static class representing the http client
 */
class Client extends Singleton {

	/**
	 * Check if the client is an Android device
	 * Tablets and mobile alike
	 */
	public function isAndroid ()
	{
		return false !== strpos(Server::getHttpUserAgent(), 'Android');
	}

	public function isIOs ()
	{
		return static::isIPhone() || static::isIPad();
	}

	public function isIPhone ()
	{
		return false !== strpos(Server::getHttpUserAgent(), 'iPhone');
	}

	public function isIPad ()
	{
		return false !== strpos(Server::getHttpUserAgent(), 'iPad');
	}

	public function isWindowsPhone ()
	{
		return false !== strpos(Server::getHttpUserAgent(), 'IEMobile');
	}

	public function isMobile ()
	{
		return static::isAndroid() || static::isIPhone()
			|| static::isWindowsPhone();
	}

	public function isTablet ()
	{
		return static::isIPad();
	}

	public function isDesktop ()
	{
		return !static::isMobile();
	}

	public function getRequest()
	{
		return Request::getInstance();
	}

	public function getCookies ()
	{
		return Cookie::getInstance();
	}
}
