{extends "master.tpl"}
{block "content"}
<div id="header">&nbsp;</div>
<div id="joke">
	<img src="{$panels[1]}" />
</div>
<div id="tools">
	<a href="/{$panels[0]}">Forrige</a> <a href="/{$panels[2]}">næste</a>
</div>
&nbsp;
{/block}
