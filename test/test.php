<?php

$p = Panel::getById("PIGEN200");
highlight_string("<?php\n\n\$x = ".var_export(array(
	'isMobileEnabled' => Web::getSettings()->mobileEnabled,
	'isMobile' => Web::getClient()->mobile,
	'isWindowPhone' => Web::getClient()->windowsPhone,
	'isAndroid' => Web::getClient()->android,
	'isIPad' => Web::getClient()->iPad,
	'PIGEN200' => $p,
	'mobile address' => $p->getAddress(true, Web::DOMAIN_TYPE_MOBILE),
	'mobile domain' => Web::getDomain(Web::DOMAIN_TYPE_MOBILE),
), true)."\n\n?>");

