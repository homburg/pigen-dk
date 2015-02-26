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

    # Overloading default navigation link
    $(document).on "click", "a.softlink", (event) ->
      id = $(this).attr('href').replace /.*\//,""
      l.href = "/#/#{id}"
      event.preventDefault()
      false

    $(window).bind 'hashchange', (e) ->
      fragment = $.param.fragment()
      if l.hash != ""
        Panel.load fragment[1..]
      else
        Panel.load()

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
