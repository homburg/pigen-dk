{extends "master.tpl"}
{block name="head" append}
	<meta property="og:title" content="Pigen uden ordforråd - {$p->getTitle()}"/>
{/block}
{block "content"}
	<div id="load-container">
		<div id="header">&nbsp;</div>
		<div id="joke">
			<img src="{$p->getUri()}" />
		</div>
		<div id="tools">
			{if $previous}
			<a href="{$previous->getAddress()}" class="softlink"><img alt="forrige" src="/i/left.png" /></a>
			{/if}
			<a href="/galleri" alt="galleri"><img src="/i/gallery.gif" alt="galleri" /></a>
			{if $next}
			<a href="{$next->getAddress()}" class="softlink"><img alt="næste" src="/i/right.png" /></a>
			{/if}
			<div id="facebook-like">{include file="t/c/facebook-like.tpl"}</div>
			<div id="comments">{include file="t/c/disqus.tpl"}</div>
		</div>
	</div>
<script type="text/javascript" src="/js/panel.js"></script>
&nbsp;
{/block}
