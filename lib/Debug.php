<?php

class Debug
{
	/**
	 * Debug to error log
	 * XXX: Warning! Triggers a fatal error on recursive dependency
	 *
	 * @param mixed $obj Anything to debug
	 * @param string $tag Title to identify the output
	 * @param bool $production Send output even on production
	 */
	public static function log($obj, $tag = null)
	{
		$bt = debug_backtrace();
		$callLocation = $bt[0];

		$lineString = str_replace($_SERVER['DOCUMENT_ROOT'], '',
			$callLocation['file'].':'.$callLocation['line'].' ');

		if (null !== $tag)
			error_log($lineString.var_export(array($tag => $obj), true));
		else
			error_log($lineString.var_export($obj, true));
	}

	/**
	 * Send output to the error log even on production
	 *
	 * @param mixed $obj Anything to debug
	 * @param string $tag Title to identify output
	 */
	public static function info ($obj, $tag=null)
	{
		self::log($obj, $tag);
	}

	/**
	 * Send output to the error log marked as warning
	 *
	 * @param mixed $obj Anything to debug
	 * @param string $tag Title to identify output
	 */
	public static function warn ($obj, $tag=null)
	{
		self::info($obj, $tag);
	}

	/**
	 * Log exception info to error log
	 *
	 * @param Exception $e
	 */
	public static function logException($e)
	{
		error_log((string)$e);
	}

	/**
	 * Get backtrace with custom formatting
	 *
	 * @param int $startLevel
	 * @return string Backtrace
	 */
	public static function getPrettyBacktrace ($startLevel = 1)
	{
		$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

		for ($i = 0; $i < $startLevel; $i++)
			array_shift($backtrace);

		$str = "";
		$i = 0;
		foreach ($backtrace as $level)
		{
			$str .= '#'.$i.' '.$level['class'].$level['type'].$level['function'].'() '.$level['file'].':'.$level['line']."\n";
			$i++;
		}

		return $str;
	}

	/***
	 * Log custom formatted backtrace to error log
	 */
	public static function logBacktrace ()
	{
		error_log(self::getPrettyBacktrace(2));
	}
}

?>
