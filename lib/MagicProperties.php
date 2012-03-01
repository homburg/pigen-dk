<?php

abstract class MagicProperties {
	protected static $_gettersAndSetters;

	public function __get ($property) {
		$m = 'get'.ucfirst($property);

		if (method_exists($this, $m))
			return $this->$m();
		else
			return null;
	}
}
