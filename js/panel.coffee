if !console?
	console =
		log: ->
		dir: ->
		dirxml: ->
		trace: ->
		count: ->
		assert: ->
		debug: ->
		warn: ->
		info: ->
		time: ->
		timeEnd: ->
		timeStamp: ->
		profile: ->
		profileEnd: ->
		profiles: ->
		group: ->
		groupEnd: ->
		groupCollapsed: ->
		clear: ->
		exception: ->
		table: ->
		markTimeline: ->
		memory: ->

l = window.location

class Panel
	@init: ->
		if l.hash != ""
			for name, selector in Panel.loadContainers
				$("##{name}").hide()
		# Overloading default navigation link
		$("a.softlink").live 'click', (event) ->
			id = $(this).attr('href').replace /.*\//,""
			l.href = "/#/#{id}"
			event.preventDefault()
			false
		$(window).bind 'hashchange', (event) ->
			fragment = $.param.fragment()
			return if l.hash == ""
			Panel.load fragment[1..]
		return if l.hash == ""
		fragment = l.hash
		l.hash = ""
		l.hash = fragment
	
	@fadeTo: (uri) ->
		$("#joke img")
			.fadeOut null, ->
				i = $(this)
				i.attr "src", "/panels/#{uri}.jpg"
				i.fadeIn "slow"

	# TODO: 404?
	@load: (id) ->
		$("#load-container").fadeOut null, ->
			$("#load-container").load "/#{id} #load-container > *", (responseText, textStatus) ->
				# TODO: event pattern
				_gaq.push ['_trackPageview', "/#{id}"] if _gaq?
				console.log responseText, "responseText"
				$("#load-container").fadeIn()
				# Disqus
				domain = window.Web.domain
				window.d.reload("http://#{domain}/#{id}")
	
	@loadContainers: {"load-container": "load-container", }

Panel.init()
