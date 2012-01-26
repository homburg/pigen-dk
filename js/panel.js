var Panel, console;

if (!(typeof console !== "undefined" && console !== null)) {
  console = {
    log: function() {},
    dir: function() {},
    dirxml: function() {},
    trace: function() {},
    count: function() {},
    assert: function() {},
    debug: function() {},
    warn: function() {},
    info: function() {},
    time: function() {},
    timeEnd: function() {},
    timeStamp: function() {},
    profile: function() {},
    profileEnd: function() {},
    profiles: function() {},
    group: function() {},
    groupEnd: function() {},
    groupCollapsed: function() {},
    clear: function() {},
    exception: function() {},
    table: function() {},
    markTimeline: function() {},
    memory: function() {}
  };
}

Panel = (function() {

  function Panel() {}

  Panel.init = function() {
    var fragment;
    if (location.hash !== "") $("#load-container").hide();
    $("#tools a.softlink").live('click', function(event) {
      var id;
      id = $(this).attr('href');
      document.location.href = "/#/" + id;
      event.preventDefault();
      return false;
    });
    $(window).bind('hashchange', function(event) {
      var fragment;
      fragment = $.param.fragment();
      if (location.hash === "") return;
      console.log("Loading fragment " + fragment.slice(1));
      return Panel.load(fragment.slice(1));
    });
    if (location.hash === "") return;
    fragment = location.hash;
    location.hash = "";
    return location.hash = fragment;
  };

  Panel.fadeTo = function(uri) {
    return $("#joke img").fadeOut(null, function() {
      var i;
      console.log(this);
      console.log(uri);
      i = $(this);
      i.attr("src", "/panels/" + uri + ".jpg");
      return i.fadeIn("slow");
    });
  };

  Panel.load = function(id) {
    return $("#load-container").fadeOut(null, function() {
      return $("#load-container").load("/" + id + " #load-container > div", function() {
        return $("#load-container").fadeIn();
      });
    });
  };

  return Panel;

})();

Panel.init();
