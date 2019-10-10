console = window.console
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

    history = window.History.createHistory()
    initial_path = document.location.pathname

    history.listen (loc) ->
      path = loc.pathname

      if path == initial_path
        return
      else
        initial_path = null

      if path != "/"
        Panel.load path[1..]
      else
        Panel.load()
      false

    hash_history = window.History.createHashHistory({ queryKey: false })
    hash_history.listen (loc) ->
      if loc.pathname != "/"
        history.replace({ pathname: loc.pathname.toUpperCase() })


    # Overloading default navigation link
    $(document).on "click", "a.softlink", (event) ->
      id = $(this).attr('href').replace /.*\//,""
      history.push({
        pathname: "/#{id}"
      })
      event.preventDefault()
      false

    $(document).on "swipe", "#joke img", (e) ->
      switch e.direction
        when "left"
          $("#next").trigger("click")
        when "right"
          $("#prev").trigger("click")

    return if l.hash == ""
    fragment = l.hash
    l.hash = ""
    l.hash = fragment

  # TODO: 404?
  @load: (id) ->
    $("#load-container").velocity(
      {opacity: 0}
      {
        complete: ->
          $("#load-container").load "/#{id} #load-container > *", (responseText, textStatus) ->
            # TODO: event pattern
            _gaq.push ['_trackPageview', "/#{id}"] if _gaq?
            m = responseText.match(/<title>(.*)<\/title>/m)
            document.title = m[1] if m?.length == 2
            $("#load-container").velocity({opacity: 1})
            domain = window.Web.domain
            console.log "link:http://#{domain}/#{id}"
      }
    )

  @loadContainers: {"load-container": "load-container", }

Panel.init()
