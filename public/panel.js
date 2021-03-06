(function() {
  var Panel, console, l;

  console = window.console;

  if (console == null) {
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
      var fragment, i, len, name, ref, selector;
      if (l.hash !== "") {
        ref = Panel.loadContainers;
        for (selector = i = 0, len = ref.length; i < len; selector = ++i) {
          name = ref[selector];
          $("#" + name).hide();
        }
      }
      $(document).on("click", "a.softlink", function(event) {
        var id;
        id = $(this).attr('href').replace(/.*\//, "");
        l.href = "/#/" + id;
        event.preventDefault();
        return false;
      });
      $(window).bind('hashchange', function(e) {
        var fragment;
        fragment = $.param.fragment();
        if (l.hash !== "") {
          return Panel.load(fragment.slice(1));
        } else {
          return Panel.load();
        }
      });
      $(document).on("swipe", "#joke img", function(e) {
        switch (e.direction) {
          case "left":
            return $("#next").trigger("click");
          case "right":
            return $("#prev").trigger("click");
        }
      });
      if (l.hash === "") {
        return;
      }
      fragment = l.hash;
      l.hash = "";
      return l.hash = fragment;
    };

    Panel.load = function(id) {
      return $("#load-container").velocity({
        opacity: 0
      }, {
        complete: function() {
          return $("#load-container").load("/" + id + " #load-container > *", function(responseText, textStatus) {
            var domain, m;
            if (typeof _gaq !== "undefined" && _gaq !== null) {
              _gaq.push(['_trackPageview', "/" + id]);
            }
            m = responseText.match(/<title>(.*)<\/title>/m);
            if ((m != null ? m.length : void 0) === 2) {
              document.title = m[1];
            }
            $("#load-container").velocity({
              opacity: 1
            });
            domain = window.Web.domain;
            return console.log("link:http://" + domain + "/" + id);
          });
        }
      });
    };

    Panel.loadContainers = {
      "load-container": "load-container"
    };

    return Panel;

  })();

  Panel.init();

}).call(this);
