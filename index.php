<?php

class IndexPage extends Page
{
	protected static $title = 'Pigen uden ordforråd';
	protected static $t = 'index.tpl';

	protected static function load ($s)
	{
		parent::load($s);
		$upperBound = 199;
		$lowerBound = 195;
		$panelId = (int)substr(Server::getUri(),1);
		if ($panelId < $lowerBound || $panelId >= $upperBound)
			$panelId = $lowerBound;

		$index = $panelId - $lowerBound;	
		$max = $upperBound - $lowerBound;
		$currentPanel = '/panels/PIGEN'.$panelId.'.jpg';
		$nextPanelId = Util::mod(($index+1), $max) + $lowerBound;
		$prevPanelId = Util::mod(($index-1), $max) + $lowerBound;
		$s->assign('panels', array($prevPanelId, $currentPanel, $nextPanelId));
	}
}

Page::setClass('IndexPage');

$filename = Server::getDocumentRoot().Server::getRequestUri().'.php';
if (file_exists($filename) && is_file($filename))
	require_once($filename);

$page = Page::getClass();
$page::render();

?>
