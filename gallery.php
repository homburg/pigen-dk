<?php

class GalleryPage extends Page
{
	protected static $title = 'Pigen uden ordforråd - Galleri';
	protected static $t = 'gallery.tpl';
	protected static $id = 'gallery';

	protected static function load ($s)
	{
		parent::load($s);

		$p = Server::getUriSegment(2);
		if ($p != null)
		{
			$ppp = Server::getUriSegment(1);
		}
		else
		{
			$ppp = 24;
			$p = Server::getUriSegment(1);
		}

		if ($p == "")
		{
			$p = 1;
		}

		$count = count(Panel::getList());
		$start = ($p-1) * $ppp;
		if ($start > $count-1)
			Web::error404();

		$panels = Panel::getAll($start, $ppp, Panel::ORDER_DESC);
		$s->assign('panels', $panels);
		$s->assign('page', $p);
		$s->assign('ppp', $ppp);
		$s->assign('count', $count);
		$s->assign('pageCount', ceil($count/$ppp));
	}
}

Page::setClass('GalleryPage');

