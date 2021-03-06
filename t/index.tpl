{extends "master.tpl"}
{block name="head" append}
	<meta property="og:title" content="{$p->getTitle(true)}" />
	<meta property="og:image" content="{$p->getUri(true, Web::DOMAIN_TYPE_DESKTOP)}" />
	<meta property="og:url" content="{$p->getAddress(true, Web::DOMAIN_TYPE_DESKTOP)}" />
	<meta property="og:type" content="article" />
{/block}
{block "content"}
	<div>
		<a href="http://{Web::getDomain()}/" alt="{$site->getTitle()}">
			<div class="responsive-header"><img src="/i/header-responsive.jpg"></div>
		</a>
	</div>
	<div id="load-container">
		<script type="text/javascript">
			// Hide joke, if dynamic address and javascript is enabled
			if (/#\/.+/.test(document.location.hash)) {
				document.write("<div style=\"opacity: 0;\">");
			}
		</script>
		<a href="http://{Web::getDomain()}/" alt="{$site->getTitle()}">
			<div id="header">&nbsp;</div>
		</a>
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
			<div id="navigation">
				{if $previous}
				<a id="prev" href="{$previous->getAddress(false)}" class="softlink"><img alt="forrige" src="/i/left.png" /></a>
				<img src="{$previous->getUri()}" style="display:none;" />
				{/if}
				{if $next}
				<a id="next" href="{$next->getAddress(false)}" class="softlink"><img alt="næste" src="/i/right.png" /></a>
				<img src="{$next->getUri()}" style="display:none;"/>
				{/if}
			</div>
			<div class="links">
				<table>
					<tr>
						<td><div id="facebook-share">{include file="t/c/facebook-share.tpl"}</div></td>
						<td><div id="twitter-share">{include file="t/c/twitter-share.tpl"}</div></td>
						<td><div id="gallery-link"><a href="/galleri" alt="galleri"><img src="/i/gallery.gif" alt="galleri" /></a></div></td>
					</tr>
				</table>
			</div>
		</div>
		<script type="text/javascript">
			// Hide joke, if dynamic address and javascript is enabled
			if (/#\/.+/.test(document.location.hash)) {
				document.write("</div>");
			}
		</script>
	</div> {* load-container *}
	<script type="text/javascript" src="/public/panel.js?v={#js_timestamp#}"></script>
	<script type="text/javascript" src="/public/nav.js?v={#js_timestamp#}"></script>
	<div class="footer-push"></div>
{/block}
{block "footer"}
	<div id="bottom">
		<div id="footer">
			<p><a href="http://theismadsen.dk" alt="theismadsen.dk">{$site->getTitle()} 2005 - 2015 · Tegnet af Theis Vallø Madsen</a>
			{if Server::isDevelopment()}<br /><span style="font-weight: bold;">Udvikling</span>{/if}
			</p>
		</div>
	</div>
{/block}
{* Rename to panel.tpl *}
