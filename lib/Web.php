<?php

class Web
{
	const REDIRECT_TEMPORARY = 307;
	const REDIRECT_PERMANENT = 301;

	const DOMAIN_TYPE_AUTO = 'auto';
	const DOMAIN_TYPE_DESKTOP = 'desktop';
	const DOMAIN_TYPE_MOBILE = 'mobile';

	private static $smarty;

	public static function getUri ()
	{
		return $_SERVER['REQUEST_URI'];
	}

	public static function urlEncode($str)
	{
		return rawurlencode($str);
	}

	public static function getSmarty()
	{
		if (self::$smarty === null)
		{
			$smarty = new Smarty();

			$smarty->setTemplateDir(array('t/', 'desktop' => 't/'));
			$smarty->setCacheDir('/tmp/smarty/cache');
			$smarty->setCompileDir('/tmp/smarty/compile');
			$smarty->setConfigDir('t/');

			$smarty->configLoad('puo.conf');
			if (is_file(Server::getDocumentRoot().'/js/js.conf'))
				$smarty->configLoad(Server::getDocumentRoot().'/js/js.conf');

			$smarty->registerClass('Web', 'Web');
			$smarty->assign('site', Web::getSite());

			if (Server::isDevelopment())
			{
				$smarty->setCaching(Smarty::CACHING_OFF);
				$smarty->setDebuggingCtrl('URL');
			}
			else
			{
				// $smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
				$smarty->setCaching(Smarty::CACHING_OFF);
			}

			self::$smarty = $smarty;
		}
		return self::$smarty;
	}

	public static function setTemplateDir ($dir, $key = null)
	{
		$smarty = static::getSmarty();
		$ts = $smarty->getTemplateDir();
		if (!is_array($ts))
			$ts = array($ts);

		$newTs = array($dir);
		if (null != $key)
			$newTs[$key] = $dir;
		$smarty->setTemplateDir(
			array_merge($newTs, $ts)
		);
	}

	public static function pushTemplateDir ($dir)
	{
		Debug::log($smarty->getTemplateDir());
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

	/**
	 * Get domain
	 *
	 * @param string $type
	 * @return string
	 */
	public static function getDomain ($type = self::DOMAIN_TYPE_AUTO)
	{
		if ($type === self::DOMAIN_TYPE_AUTO)
		{
			if (Web::getSite()->getMode() === Site::MODE_MOBILE)
				$type = self::DOMAIN_TYPE_MOBILE;
			else
				$type = self::DOMAIN_TYPE_DESKTOP;
		}

		if (Server::isDevelopment())
		{
			if ($type === self::DOMAIN_TYPE_DESKTOP)
				return 'test.pigen.dk';
			else
				return 'm.test.pigen.dk';
		}
		else
		{
			if ($type === self::DOMAIN_TYPE_DESKTOP)
				return 'www.pigen.dk';
			else
				return 'm.pigen.dk';
		}
	}

	/**
	 * Get client
	 *
	 * @return Client
	 */
	public static function getClient ()
	{
		return Client::getInstance();
	}

	/**
	 * Get settings
	 *
	 * @return Settings
	 */
	public static function getSettings ()
	{
		return Settings::getInstance();
	}

	/**
	 * Get site instance
	 *
	 * @return Site
	 */
	public static function getSite ()
	{
		return Site::getInstance();
	}

	public static function error404 ()
	{
		header('Status: 404 Not Found');
		exit();
	}

	public static function hasOutputStarted ()
	{
		return ob_get_contents() != "" || headers_sent();
	}
}

