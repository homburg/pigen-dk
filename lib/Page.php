<?php

class Page implements iPage
{
	protected static $class;
	protected static $title;
	protected static $id;

	protected static function load ($s)
	{
		$s->assign('title', static::$title);
		$s->assign('id', static::$id);
	}

	public static function render ()
	{
		static::load(Web::getSmarty());
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
