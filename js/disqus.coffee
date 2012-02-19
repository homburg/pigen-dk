class Disqus
	# required: replace example with your forum shortname
	constructor: (@shortname)->
		shortname = window.disqus_shortname = @shortname
		@dsq = $("<script/>").attr
			'type': 'text/javascript',
			'async': 'async',
			'src': "http://#{shortname}.disqus.com/embed.js"
	
	load: (url = null) ->
		window.disqus_url = url
		$('head').append(@dsq)

	unload: ->
		$(@dsq).remove()
		$("#disqus_thread").empty()

	reload: (url = none) ->
		@unload()
		@load(url)

# if !window?.d
# 	window.d = new Disqus 'puopuo'
# 	window.d.load()
