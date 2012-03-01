{extends "master.tpl"}
{block name="head" append}
	<meta property="og:title" content="{$p->getTitle(true)}" />
	<meta property="og:image" content="{$p->getUri(true)}" />
	<meta property="og:url" content="{$p->getAddress()}" />
	<meta property="og:type" content="article" />
{/block}
{block "content"}
	<div id="load-container">
		<a href="http://{Web::getDomain()}/" alt="{$site->getTitle()}"><div id="header"><img src="/i/m/header.jpg" alt="{$site->getTitle()}" /></div></a>
		<div id="joke">
		{if $next}
			<a href="{$next->getAddress(false)}" class="softlink">
				<img src="{$p->getMobileUri()}" />
			</a>
		{else}
			<img src="{$p->getMobileUri()}" />
		{/if}
		</div>
		<div id="tools">
			<div id="navigation">
				{if $previous}
				<a id="prev" href="{$previous->getAddress(false)}" class="softlink"><img alt="forrige" src="/i/left.png" /></a>
				{/if}
				{if $next}
				<a id="next" href="{$next->getAddress(false)}" class="softlink"><img alt="næste" src="/i/right.png" /></a>
				{/if}
			</div>

			<div id="facebook-share">{include file="t/c/facebook-share.tpl"}</div>
			<div id="twitter-share">{include file="t/c/twitter-share.tpl"}</div>
			<div id="gallery-link"><a href="/galleri" alt="galleri"><img src="/i/gallery.gif" alt="galleri" /></a></div>
		</div>
		<div id="bottom">
			{* <div id="comments">{include file="t/c/disqus.tpl"}</div> *}
			<div id="footer">
				<p><a href="http://theismadsen.dk" alt="theismadsen.dk">{$site->getTitle()} 2005 - 2012<br />Tegnet af Theis Vallø Madsen</a>
				{if Server::isDevelopment()}<br /><span style="font-weight: bold;">Udvikling</span>{/if}
				</p>
			</div>
		</div>
	</div> {* load-container *}
<script type="text/javascript" src="/js/panel.js?v={#js_timestamp#}"></script>
<script type="text/javascript" src="/js/nav.js?v={#js_timestamp#}"></script>
{include file="m/t/c/jquery.mobile.tpl"}
<script type="text/javascript">
$(function () {
	var body = $(document.body);
	body.bind("swipeleft", function () {
		$("#next").trigger("click");
	});
	body.bind("swiperight", function () {
		$("#prev").trigger("click");
	});
});
</script>
{/block}
{* Rename to panel.tpl *}
