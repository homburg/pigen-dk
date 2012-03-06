<?php

highlight_string("<?php\n\n\$x = ".var_export(array(
	'isMobileEnabled' => Web::getSettings()->mobileEnabled,
	'isMobile' => Web::getClient()->mobile,
	'isWindowPhone' => Web::getClient()->windowsPhone,
	'isAndroid' => Web::getClient()->android,
	'isIPad' => Web::getClient()->iPad,
), true)."\n\n?>");

