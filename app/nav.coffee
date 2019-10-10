class Nav
	@KEY_LEFT: 37
	@KEY_RIGHT: 39

	@bind: ->
    $(window).keydown(Nav._keydown)

	@_keydown: (e) ->
		return if $(e.target).is("textarea,input,select")
		return if e.ctrlKey || e.altKey
		switch e.which
			when Nav.KEY_LEFT
				$("#prev").trigger "click"
				return false
			when Nav.KEY_RIGHT
				$("#next").trigger "click"
				return false

Nav.bind()
