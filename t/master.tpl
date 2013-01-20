<!DOCTYPE HTML>
<html lang="en">
<head>
	{block name="head"}
	<meta charset="UTF-8">
	<title>{$title|default:$site->getTitle(true)}</title>
	<link href='http://fonts.googleapis.com/css?family=Asap|Permanent+Marker|Gudea' rel='stylesheet' type='text/css'> 
	<link rel="favicon" type="image/ico" href="/favicon.ico" />
	<link rel="stylesheet" href="/css/screen.css" type="text/css" />
	{block name="stylesheets_primary"}
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
	{/block}
	<link rel="stylesheet" href="/css/lib/jqueryui/1.9.2/themes/base/jquery-ui.css" type="text/css" />
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js" ></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.ba-bbq/1.2.1/jquery.ba-bbq.min.js"></script>
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
</body>
</html>
