<?php

class Site extends Singleton
{
	const TITLE = 'Pigen uden ordforråd';

	const MODE_DESKTOP = 'desktop';
	const MODE_MOBILE = 'mobile';

	public function getTitle ()
	{
		return self::TITLE;
	}

	public function getMode ()
	{
		if ($this->isMobile())
			return self::MODE_MOBILE;
		else
			return self::MODE_DESKTOP;
	}

	/**
	 * Determine whether the site (should)
	 * be mobile
	 *
	 */
	public function isMobile ()
	{
		if (Web::getClient()->request->isMobile())
			return true;

		if (Web::getSettings()->isMobileEnabled())
			return false;
		else
			if (Web::getClient()->isMobile())
				return true;

		return false;
	}
}

