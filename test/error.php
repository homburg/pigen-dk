<?php

class ErrorPage extends DemoPage
{
	protected static $title = 'Fejl!';
	protected static $t = 'demo/fejl.tpl';

	protected static function load ($s)
	{
		throw new Exception("Exception!");
	}
}

Page::setClass('ErrorPage');

$filename = Server::getDocumentRoot().Server::getRequestUri().'.php';
if (file_exists($filename) && is_file($filename))
	require_once($filename);

$page = Page::getClass();
$page::render();

?>
