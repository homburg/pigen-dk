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

class Panel
	@init: ->
		$("#load-container").hide() if location.hash != ""
		# Overloading default navigation link
		$("#tools a.softlink").live 'click', (event) ->
			id = $(this).attr 'href'
			document.location.href = "/#/#{id}"
			event.preventDefault()
			false
		$(window).bind 'hashchange', (event) ->
			fragment = $.param.fragment()
			return if location.hash == ""
			console.log "Loading fragment #{fragment[1..]}"
			Panel.load fragment[1..]
		return if location.hash == ""
		fragment = location.hash
		location.hash = ""
		location.hash = fragment
	
	@fadeTo: (uri) ->
		$("#joke img")
			.fadeOut null, ->
				console.log this
				console.log uri
				i = $(this)
				i.attr "src", "/panels/#{uri}.jpg"
				i.fadeIn "slow"

	# TODO: 404?
	@load: (id) ->
		$("#load-container").fadeOut null, ->
			$("#load-container").load "/#{id} #load-container > div", ->
				$("#load-container").fadeIn()

Panel.init()
# Panel.fadeTo "195"
# Panel.fadeTo "PIGEN197"
# Panel.load "PIGEN197"
