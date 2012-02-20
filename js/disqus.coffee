class Disqus
	# required: replace example with your forum shortname
	constructor: (@shortname)->
		shortname = window.disqus_shortname = @shortname
		@dsq = $("<script/>").attr
			'type': 'text/javascript',
			'async': 'async',
			'src': "http://#{shortname}.disqus.com/embed.js"
	
	load: (url = null) ->
		@url = window.disqus_url = url
		$('head').append(@dsq)

	unload: ->
		$(@dsq).remove()
		$("#disqus_thread").empty()

	reload: (url = @url) ->
		@unload()
		@load(url)

window.Disqus = Disqus
# if !window?.d
# 	window.d = new Disqus 'puopuo'
#	fisk
# 	window.d.load()
