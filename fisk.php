<?php

class FiskPage extends Page
{
	public static function render ()
	{
		header('content-type: text/plain; charset=utf-8');
		echo "fisk!";
	}
}

Page::setClass('FiskPage');

?>
