<?php

error_reporting(E_ALL);

set_include_path(get_include_path().PATH_SEPARATOR.__DIR__);
require_once('Smarty.class.php');

function __autoload ($classname)
{
	if (!@$_SERVER['DOCUMENT_ROOT'])
		$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);

	$filename = $_SERVER['DOCUMENT_ROOT'].'/lib/'.$classname.'.php';
	if (file_exists($filename) && is_file($filename))
		require_once($filename);
	else
		error_log('Could not load class: "'.$classname.'"');
}
spl_autoload_register('__autoload');

?>
