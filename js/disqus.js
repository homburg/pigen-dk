(function() {
  var Disqus;

  Disqus = (function() {

    function Disqus(shortname) {
      this.shortname = shortname;
      shortname = window.disqus_shortname = this.shortname;
      this.dsq = $("<script/>").attr({
        'type': 'text/javascript',
        'async': 'async',
        'src': "http://" + shortname + ".disqus.com/embed.js"
      });
    }

    Disqus.prototype.load = function(url) {
      if (url == null) url = null;
      window.disqus_url = url;
      return $('head').append(this.dsq);
    };

    Disqus.prototype.unload = function() {
      $(this.dsq).remove();
      return $("#disqus_thread").empty();
    };

    Disqus.prototype.reload = function(url) {
      if (url == null) url = none;
      this.unload();
      return this.load(url);
    };

    return Disqus;

  })();

}).call(this);
