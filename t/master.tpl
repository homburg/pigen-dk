{strip}<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{$title|default:"puo"}</title>
	<link rel="favicon" type="image/ico" href="/favicon.ico" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
	<script type="text/javascript" src="//code.jquery.com/jquery-latest.js" ></script>
</head>
<body>
	<div id="container">
		{block name="content"}
		{$debug|default:'debug!'|var_export nofilter}
	{/block}
    </div>
</body>
</html>{/strip}
