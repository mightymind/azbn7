!function(e){e.Azbn7&&!function(){var r=function(){var r=this,t="undefined"!=typeof MutationObserver;return r.name="domtree",r.uid="azbn7__mdl__domtree",r.observer_config={attributes:!0,childList:!0,characterData:!0},r.__observers={},r.startSpy=function(n,o,s){var a=null,i=n.eq(0).get(0),_=e.extend({},r.observer_config,o);if(t){a=e.Azbn7.randstr(),n.attr("data-"+r.uid+"-uid",a);var u=new MutationObserver(s);u.observe(i,_),r.__observers[a]=u}return a},r.stopSpy=function(e){t&&r.__observers[e]&&r.__observers[e].disconnect(),r.__observers[e]=null,delete r.__observers[e]},r};e.Azbn7.load("DOMTree",new r)}()}(jQuery);