(function() {
  var Nav;

  Nav = (function() {

    function Nav() {}

    Nav.KEY_LEFT = 37;

    Nav.KEY_RIGHT = 39;

    Nav.bind = function() {
      if ($.browser.msie) {
        return $(document).keydown(Nav._keydown);
      } else {
        return $(window).keydown(Nav._keydown);
      }
    };

    Nav._keydown = function(e) {
      if ($(e.target).is("textarea,input,select")) return;
      switch (e.which) {
        case Nav.KEY_LEFT:
          $("#prev").trigger("click");
          return false;
        case Nav.KEY_RIGHT:
          $("#next").trigger("click");
          return false;
      }
    };

    return Nav;

  })();

  Nav.bind();

}).call(this);
