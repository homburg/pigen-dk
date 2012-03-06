<?php

class Get extends Singleton {
	public function __get ($property)
	{
		if (!isset($_GET[$property]))
			return null;

		if ('false' === $_GET[$property])
			return false;

		else return $_GET[$property];
	}
}
