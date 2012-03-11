<?php

$list = Panel::getList();
$i = rand(0, count($list)-1);
$list = array_values($list);
$p = Panel::getById($list[$i]);
highlight_string("<?php\n\n\$x = ".var_export(array(
	'isMobileEnabled' => Web::getSettings()->mobileEnabled,
	'isMobile' => Web::getClient()->mobile,
	'isWindowPhone' => Web::getClient()->windowsPhone,
	'isAndroid' => Web::getClient()->android,
	'isIPad' => Web::getClient()->iPad,
	'Panel' => $p,
	'mobile address' => $p->getAddress(true, Web::DOMAIN_TYPE_MOBILE),
	'mobile domain' => Web::getDomain(Web::DOMAIN_TYPE_MOBILE),
), true)."\n\n?>");

