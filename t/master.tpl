{strip}<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="favicon" type="image/ico" href="/favicon.ico" />
	<title>{$title|default:"puo"}</title>
	<style type="text/css">
		body {
			font-family: monospace, sans;
		}
		div#container {
			margin: 0px auto;
			background-image: url('/i/background.jpg');
			box-sizing: border-box;
			width: 751px;
			min-height: 1350px;
		}
		div#header {
			height: 179px;
			margin-bottom: 31px;
			margin-top: 10px;
		}
		div#joke {
			height: 454px;
			margin: 0px 199px;
			margin-bottom: 15px;
		}
		div#tools {
			height: 100%;
			text-align: center;
		}
		a {
			text-decoration: none;
			color: black;
		}
		div {
			margin: 0px;
		}
	</style>
</head>
<body>
	<div id="container">
		{block name="content"}
		{$debug|default:'debug!'|var_export nofilter}
	{/block}
    </div>
</body>
</html>{/strip}
