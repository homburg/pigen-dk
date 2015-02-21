<?php

class Request extends Singleton {

	/**
	 * Determine whether the request is for
	 * the mobile page
	 * @return bool
	 */
	public function isMobile ()
	{
		return false;
		# return 1 === preg_match('/^m\./', Server::getHttpHost());
	}

	public function getGet ()
	{
		return Get::getInstance();
	}
}
