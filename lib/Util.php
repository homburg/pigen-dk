<?php

class Util {
	public static function mod ($num, $mod) {
		return ($mod + ($num % $mod)) % $mod;
	}
}
