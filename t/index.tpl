{extends "master.tpl"}
{block "content"}
<div id="header">&nbsp;</div>
<div id="joke">
	<img src="{$currentPanel->getUri()}" style="opacity: 0;" />
	<script type="text/javascript">
	{literal}
		$(function _jokeOnLoad() {
			$("#joke img").animate({opacity:1});
		});
	{/literal}
	</script>
</div>
<div id="tools">
	{if $previous}
	<a href="{$previous->getAddress()}"><img alt="forrige" src="/i/left.png" /></a>
	{/if}
<a href="/galleri" alt="galleri"><img src="/i/gallery.png" alt="galleri" /></a>
	{if $next}
	<a href="{$next->getAddress()}"><img alt="næste" src="/i/right.png" />
	{/if}
<div id="facebook-like">{include file="t/c/facebook-like.tpl"}</div></a>
</div>
&nbsp;
{/block}
