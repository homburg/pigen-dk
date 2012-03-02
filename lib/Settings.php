<?php

class Settings extends Singleton {

	public function setMobileEnabled ($val)
	{
		Web::getClient()->cookies->mobileEnabled = (bool)$val;
	}

	public function isMobileEnabled ()
	{
		$c = Web::getClient()->cookies;

		if (isset($c->mobileEnabled))
			return $c->mobileEnabled;
		else
			return true;
	}
}
