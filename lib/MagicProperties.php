<?php

abstract class MagicProperties {
	protected static $_gettersAndSetters;

	public function __get ($property) {
		foreach (array('get', 'is') as $prefix)
		{
			$m = $prefix.ucfirst($property);

			if (method_exists($this, $m))
				return $this->$m();
		}

		return null;
	}
}
