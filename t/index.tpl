{extends "master.tpl"}
{block name="head" append}
	<meta property="og:title" content="{$p->getTitle(true)}" />
	<meta property="og:image" content="{$p->getUri(true)}" />
	<meta property="og:url" content="{$p->getAddress()}" />
	<meta property="og:type" content="article" />
{/block}
{block "content"}
	<div id="load-container">
		<a href="http://{Web::getDomain()}/" alt="{$site->getTitle()}"><div id="header">&nbsp;</div></a>
		<div id="joke">
		{if $next}
			<a href="{$next->getAddress(false)}" class="softlink">
				<img src="{$p->getUri()}" />
			</a>
		{else}
			<img src="{$p->getUri()}" />
		{/if}
		</div>
		<div id="tools">
			<div id="share-left" class="left">
				<div id="facebook-share">{include file="t/c/facebook-share.tpl"}</div>
				<div id="twitter-share">{include file="t/c/twitter-share.tpl"}</div>
			</div>
			<div id="share-right" class="right">
				<div><a href="/galleri" alt="galleri"><img src="/i/gallery.gif" alt="galleri" /></a></div>
				<div style="width: 7px;">&nbsp;</div>
			</div>
			<div id="navigation">
				{if $previous}
				<a id="prev" href="{$previous->getAddress(false)}" class="softlink"><img alt="forrige" src="/i/left.png" /></a>
				{/if}
				{if $next}
				<a id="next" href="{$next->getAddress(false)}" class="softlink"><img alt="næste" src="/i/right.png" /></a>
				{/if}
			</div>
		</div>
		<div id="bottom">
			<div id="comments">{include file="t/c/disqus.tpl"}</div>
			<div id="footer">
				<p><a href="http://theismadsen.dk" alt="theismadsen.dk">{$site->getTitle()} 2005 - 2012 · Tegnet af Theis Vallø Madsen</a>
				{if Server::isDevelopment()}<br /><span style="font-weight: bold;">Udvikling</span>{/if}
				</p>
			</div>
		</div>
	</div> {* load-container *}
	<script type="text/javascript" src="/js/panel.js?v={#js_timestamp#}"></script>
	<script type="text/javascript" src="/js/nav.js?v={#js_timestamp#}"></script>
{/block}
{* Rename to panel.tpl *}
