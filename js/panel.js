(function() {
  var Panel, console, l;

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

  l = window.location;

  Panel = (function() {

    function Panel() {}

    Panel.init = function() {
      var fragment, name, selector, _len, _ref;
      if (l.hash !== "") {
        _ref = Panel.loadContainers;
        for (selector = 0, _len = _ref.length; selector < _len; selector++) {
          name = _ref[selector];
          $("#" + name).hide();
        }
      }
      $("a.softlink").live('click', function(event) {
        var id;
        id = $(this).attr('href').replace(/.*\//, "");
        l.href = "/#/" + id;
        event.preventDefault();
        return false;
      });
      $(window).bind('hashchange', function(event) {
        var fragment;
        fragment = $.param.fragment();
        if (l.hash === "") return;
        return Panel.load(fragment.slice(1));
      });
      if (l.hash === "") return;
      fragment = l.hash;
      l.hash = "";
      return l.hash = fragment;
    };

    Panel.fadeTo = function(uri) {
      return $("#joke img").fadeOut(null, function() {
        var i;
        i = $(this);
        i.attr("src", "/panels/" + uri + ".jpg");
        return i.fadeIn("slow");
      });
    };

    Panel.load = function(id) {
      return $("#load-container").fadeOut(null, function() {
        return $("#load-container").load("/" + id + " #load-container > *", function() {
          var domain;
          if (typeof _gaq !== "undefined" && _gaq !== null) {
            _gaq.push(['_trackPageview', "/" + id]);
          }
          $("#load-container").fadeIn();
          domain = window.Web.domain;
          return window.d.reload("http://" + domain + "/" + id);
        });
      });
    };

    Panel.loadContainers = {
      "load-container": "load-container"
    };

    return Panel;

  })();

  Panel.init();

}).call(this);
