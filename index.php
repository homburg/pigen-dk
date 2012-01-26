<?php

class IndexPage extends Page
{
	protected static $title = 'Pigen uden ordforråd';
	protected static $t = 'index.tpl';

	protected static function load ($s)
	{
		parent::load($s);
		$panelId = substr(Server::getUri(true),1);

		if ($panelId == "")
			$p = Panel::getNewest();
		else
			$p = Panel::getById($panelId);

		if (!$p)
		{
			Web::redirect('/');
			// $p = Panel::getNewest();
		}

		$s->assign('currentPanel', $p);
		$s->assign('p', $p);

		$s->assign('next', $p->getNext());
		$s->assign('previous', $p->getPrevious());

		// $s->assign('debug', $p);
	}
}

Page::setClass('IndexPage');

$filename = Server::getDocumentRoot().'/'.Server::getUriSegment(0).'.php';
if (file_exists($filename) && is_file($filename))
	require_once($filename);

$page = Page::getClass();
$page::render();

