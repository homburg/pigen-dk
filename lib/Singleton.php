<?php

abstract class Singleton extends MagicProperties {
	public static $_instances;

	public static function getInstance()
	{
		$class = get_called_class();
		if (static::$_instances == null || !isset(static::$_instances[$class]))
		{
			@static::$_instances[$class] = new $class;
		}

		return static::$_instances[$class];
	}

	private function __construct ()
	{
	}
}
