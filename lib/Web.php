<?php

class Web
{
	private static $smarty;

	public static function getUri ()
	{
		return $_SERVER['REQUEST_URI'];
	}

	public static function getSmarty()
	{
		if (self::$smarty === null)
		{
			$smarty = new Smarty();

			$smarty->setTemplateDir('t/');
			$smarty->setCacheDir('/tmp/smarty/cache');
			$smarty->setCompileDir('/tmp/smarty/compile');
			$smarty->setConfigDir('/tmp/smarty/configs');

			// $smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
			self::$smarty = $smarty;
		}
		return self::$smarty;
	}
}

?>
