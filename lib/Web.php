<?php

class Web
{
	const REDIRECT_TEMPORARY = 302;
	const REDIRECT_PERMANENT = 301;

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
			$smarty->setConfigDir('t/');

			$smarty->configLoad('puo.conf');

			if (Server::isDevelopment())
			{
				$smarty->setCaching(Smarty::CACHING_OFF);
				$smarty->setDebuggingCtrl('URL');
			}
			else
				$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);

			self::$smarty = $smarty;
		}
		return self::$smarty;
	}

	/**
	 * Redirect and stop output
	 *
	 * @param string $url
	 * @param int $type Redirect type, see self::REDIRECT_*
	 */
	public static function redirect ($url, $type = self::REDIRECT_TEMPORARY)
	{
		if ($type === self::REDIRECT_PERMANENT)
			header('Status: 301 Permanent');

		header('Location: '.$url);
		exit();

		// TODO: javascript?
	}

}

?>
