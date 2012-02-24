<!DOCTYPE HTML>
<html lang="en">
<head>
	{block name="head"}
	<meta charset="UTF-8">
	<title>{$title|default:Site::getTitle()}</title>
	<link href='http://fonts.googleapis.com/css?family=Asap|Permanent+Marker|Gudea' rel='stylesheet' type='text/css'> 
	<link rel="favicon" type="image/ico" href="/favicon.ico" />
	<link rel="stylesheet" href="/css/screen.css" type="text/css" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.8.17/themes/base/jquery-ui.css" type="text/css" />
	<script type="text/javascript" src="//code.jquery.com/jquery-latest.js" ></script>
	<script type="text/javascript" src="//code.jquery.com/ui/1.8.17/jquery-ui.js"></script>
	<script type="text/javascript" src="//code.homburg.dk/jquery.ba-bbq.js"></script>
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
