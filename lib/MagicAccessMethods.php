<?php

abstract class MagicAccessMethods {
	protected static $_gettersAndSetters;

	public function __call ($method, $arguments) {
		$matches = array();
		if (0 === preg_match('/^(?<prefix>[gs]et)(?<property>.*)$/', $method, $matches))
			throw new Exception ("Invalid method: ".get_called_class()."->${method}(...)");

		static::_getAccessProperties();

		$property = $matches['property'];
		$property = strtolower($property[0])
			.substr($property, 1);

		foreach (array('get', 'set') as $accessPrefix)
		{
			if ($accessPrefix === $matches['prefix'])
			{
				if (isset(static::$_gettersAndSetters[$accessPrefix][$property]))
				{
					if ('get' === $accessPrefix)
						return $this->$property;
					else
						$this->$property = @$arguments[0];
				}
			}
		}

		throw new Exception("Invalid accessor method: ".get_called_class()."->${method}(...)");
	}

	protected static function _getAccessProperties ()
	{
		if (is_array(static::$_gettersAndSetters))
			return;

		$r = new ReflectionClass(get_called_class());
		$ps = $r->getProperties();

		$gass = array('get' => array(), 'set' => array());
		foreach ($ps as $p)
		{
			$doc = $p->getDocComment();
			if ($doc)
			{
				if (preg_match('/@access [^\n]*get/', $doc))
					$gass['get'][$p->getName()] = true;

				if (preg_match('/@access [^\n]*set/', $doc))
					$gass['set'][$p->getNamE()] = true;
			}
		}

		static::$_gettersAndSetters = $gass;
	}
}
