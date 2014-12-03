{extends "master.tpl"}
{block "content"}
<script src="/js/lib/jquery.infinitescroll.min.js" type="text/javascript"></script>
<a href="http://{Web::getDomain()}/" alt="Pigen uden ordforråd"><div id="header">&nbsp;</div></a>
<div id="gallery">
	<div class="gallery-part" id="gallery-part-{$page}">
	{foreach $panels as $p}
		{strip}
		<div class="gallery-item">
			<a alt="{$p->getTitle()}" href="/{$p->getId()}">
				<img src="{$p->getThumbnailUri()}" alt="{$p->getTitle()}" />
			</a>
		</div>
		{/strip}
	{/foreach}
	</div>
	<div id="navigation" class="navigation">
	{for $i=1 to $pageCount}
		<a {if $i == 2}class="next"{/if} href="/galleri/{$i}" alt="Side {$i}" >{$i}</a>
	{/for}
	</div>
</div>
&nbsp;
<script src="/public/gallery.js?v={#js_timestamp#}" type="text/javascript"></script>
{/block}
