<?php

class Cookie extends Singleton {

	// Save cookies for before request
	protected $cookies = array();
	
	/**
	 * @uses $_COOKIE
	 */
	public function __get ($property)
	{
		if (isset($this->cookies[$property]))
			return $this->cookies[$property];

		if (isset($_COOKIE[$property]))
			return $_COOKIE[$property];

		return null;
	}

	public function __set ($property, $value)
	{
		if (is_bool($value))
			$value = (int)$value;

		$expire = time()+60*60*24*30;
		$domain = Server::isDevelopment() ? 'test.pigen.dk' : 'pigen.dk';
		setcookie((string)$property, $value, $expire, '/', $domain);
		$this->cookies[(string)$property] = $value;
	}
}
