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

		if (Client::isMobile() || 1 === preg_match('/^m\./', Server::getHttpHost()))
			Web::setTemplateDir('m/t/');
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
