<?php

class Page implements iPage
{
	protected static $class;
	protected static $title;
	protected static $id;

	protected static $mode = 1;

	const MODE_DESKTOP = 1;
	const MODE_MOBILE = 2;

	protected static function load ($s)
	{
		if (isset($_GET['m']))
			Web::getSettings()->setMobileEnabled(Web::getClient()->request->get->m);

		// Mobile request
		if (Web::getclient()->request->isMobile())
		{
			if (!Web::getSettings()->isMobileEnabled())
			{
				$r = 'http://'.Web::getDomain(Web::DOMAIN_TYPE_DESKTOP).'/'
					.Web::getUri();
				Web::redirect($r);
			}
		}
		else // Desktop request
		{
			if (Web::getClient()->isMobile()
				&& Web::getSettings()->isMobileEnabled())
			{
				$r = 'http://'.Web::getDomain(Web::DOMAIN_TYPE_MOBILE).'/'
					.Web::getUri();
				Web::redirect($r);
			}
		}

		$s->assign('title', static::$title);
		$s->assign('id', static::$id);
	}

	public static function getMode ()
	{
		return static::$mode;
	}
	
	public static function setMode($mode)
	{
		static::$mode = $mode;
	}

	public static function render ()
	{
		static::load(Web::getSmarty());

		if (Web::getClient()->request->isMobile())
			Web::setTemplateDir('m/t/', 'mobile');

		Web::getSmarty()->display(static::$t);
	}

	public static function setClass ($class)
	{
		self::$class = $class;
	}

	public static function getClass ()
	{
		if (self::$class !== null)
			return self::$class;
		else
			return __CLASS__;
	}
}
