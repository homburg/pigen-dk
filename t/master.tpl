<!DOCTYPE html>
<html lang="en">
<head>
	{block name="head"}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{$title|default:$site->getTitle(true)}</title>
	<link href='//fonts.googleapis.com/css?family=Asap|Permanent+Marker|Gudea' rel='stylesheet' type='text/css'> 

	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#f8c3d0">
	<meta name="msapplication-TileColor" content="#f8c3d0">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
	<meta name="theme-color" content="#f8c3d0">

	<link rel="stylesheet" href="/css/screen.css" type="text/css" />
	{block name="stylesheets_primary"}
	<link rel="stylesheet" href="/css/style.css?t=20150225" type="text/css" />
	{/block}
	<link rel="stylesheet" href="/bower_components/jquery-ui/themes/base/all.css" type="text/css" />
	<script type="text/javascript" src="/public/vendor.js" ></script>
	{include file="t/c/ga.tpl"}
	{/block}
</head>
<body class="{$id|default:""}">
	{include file="t/c/js_setup.tpl"}
	<div id="container">
		{block name="content"}
		{$debug|default:'debug!'|var_export nofilter}
	{/block}
	</div> <!-- end container -->
	{block name="footer"}
	{/block}
</body>
</html>
