{extends "[desktop]index.tpl"}
{block "content"}
	<div id="load-container">
		{strip}
		<a href="http://{Web::getDomain()}/" alt="{$site->getTitle()}">
			<div id="header">
				&nbsp;
			</div>
		</a>
		{/strip}
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
				<img src="{$previous->getMobileUri()}" alt="prefetch-prev" style="display:none;"/>
				{/if}
				{if $next}
				<a id="next" href="{$next->getAddress(false)}" class="softlink"><img alt="næste" src="/i/right.png" /></a>
				<img src="{$next->getMobileUri()}" alt="prefetch-next" style="display:none;" />
				{/if}
			</div>

			<div id="facebook-share">{include file="../../t/c/facebook-share.tpl"}</div>
			<div id="twitter-share">{include file="../../t/c/twitter-share.tpl"}</div>
			<div id="gallery-link"><a href="/galleri" alt="galleri"><img src="/i/gallery.gif" alt="galleri" /></a></div>
			<div id="desktop-link"><a href="{$p->getAddress(true, Web::DOMAIN_TYPE_DESKTOP)}?m=false"><img src="/i/desktop-link.gif" alt="desktop" /></a></div>
		</div>
		<div id="bottom">
			<div id="comments">{include file="../../t/c/disqus.tpl"}</div>
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
	var joke = $("#joke");
	joke.live("swipeleft", function () {
		$("#next").trigger("click");
	});
	joke.live("swiperight", function () {
		$("#prev").trigger("click");
	});
	// Send current path to Android webview
	if (console && console.log)
		console.log("link:{$p->getAddress(true, Web::DOMAIN_TYPE_DESKTOP)}");
});
</script>
{/block}
{* Rename to panel.tpl *}
