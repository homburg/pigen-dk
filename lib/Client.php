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

	public function isMobile ()
	{
		return static::isAndroid() || static::isIPhone();
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

	public function __get ($property)
	{
		$getter = 'get'.ucfirst($property);
		if (method_exists($this, $getter))
			return $this->$getter();

		$isser = 'is'.ucfirst($property);
		if (method_exists($this, $getter))
			return $this->$isser();

		error_log('Invalid property: '.__CLASS__.'::'.$property);
		return null;
	}
}
