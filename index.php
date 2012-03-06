<?php

class IndexPage extends Page
{
	protected static $title = 'Pigen uden ordforråd';
	protected static $t = 'index.tpl';

	protected static function load ($s)
	{
		parent::load($s);
		$panelId = substr(Server::getUri(false),1);

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
		$s->assign('title', $p->getTitle(true));

		$s->assign('next', $p->getNext());
		$s->assign('previous', $p->getPrevious());

		// $s->assign('debug', $p);
	}
}

Page::setClass('IndexPage');

$script = Server::getScript();
if (is_file($script))
	require_once($script);

if (!Web::hasOutputStarted())
{
	$page = Page::getClass();
	$page::render();
}
