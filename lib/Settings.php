<?php

class Settings extends Singleton {

	public function setMobileEnabled ($val)
	{
		Web::getClient()->cookies->mobileEnabled = (bool)$val;
	}

	public function isMobileEnabled ()
	{
		return Web::getClient()->cookies->mobileEnabled;
	}
}
