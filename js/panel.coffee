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
			$("#load-container").load "/#{id} #load-container > *", ->
				$("#load-container").fadeIn()
				# Disqus
				window.d.reload()
	
	@loadContainers: {"load-container": "load-container", }

Panel.init()
