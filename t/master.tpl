<!DOCTYPE html>
<html lang="en">
<head>
	{block name="head"}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{$title|default:$site->getTitle(true)}</title>
	<link href='http://fonts.googleapis.com/css?family=Asap|Permanent+Marker|Gudea' rel='stylesheet' type='text/css'> 
	<link rel="favicon" type="image/ico" href="/favicon.ico" />
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
