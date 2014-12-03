(function() {
  $("#gallery").infinitescroll({
    nextSelector: "a.next",
    loadingText: "Henter flere...",
    donetext: "<em>Så er der ikke flere.</em>",
    navSelector: "div#navigation",
    itemSelector: "#gallery > div.gallery-part"
  });


  /* infinite scroll 2.0 options
   * TODO: Der bliver ikke hentet flere,
   * hvis vinduet åbner større end siden
  $("#gallery").infinitescroll(
  			 * debug: true,
  			navSelector: "div#navigation",
  			nextSelector: "div#navigation a.next",
  			itemSelector: "div#gallery .gallery-part",
  			callback: (x) ->
  				console.log "callback"
  				false
  			behavior: (x) ->
  				console.log "behavior"
  				false
  			loading: 
  				 * start: (x) ->
  				 * 	console.log "start!"
  				 * finished: (x) ->
  				 * 	console.log arguments, "finished"
  				 * 	false
  				 * msg bliver overskrevet i den nuværende version?
  				 * msg: "<h1>Am I just overwritten?!</h1>",
  				msgText: "<em>Henter flere...</em>",
  				finishedMsg: "<div><em>Så er der ikke flere.</em></div>",
  				 * finished: <callback>
  				 * img: false,
  			animate: true,
  		(x) ->
  			console.log "alternative callback"
  		(x) ->
  			console.log "secondary alternative callback"
  )
   */

}).call(this);
