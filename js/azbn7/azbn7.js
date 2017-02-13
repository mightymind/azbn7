'use strict';

/*
Требуется подключение jQuery
*/

function Azbn7Constructor($, cfg, settings) {
	
	var ctrl = this;
	
	ctrl.name = 'Azbn7 JS Framework';
	
	ctrl.__mdl = {};
	ctrl.__argv = {};
	ctrl.__param = {};
	
	ctrl.settings = $.extend({}, {
		intervals : {
			codecache : null,
		},
		cache : {
			expires_in : 3600,
			update_or_expires : 600,
		},
	}, settings);
	
	
	if(typeof cfg != 'object') {
		cfg = new Object();
	} 
	
	
	ctrl.config = $.extend({}, {
		prefix : 'azbn7.',
		url : '/api/',
		access_as : 'user',
		key : 'public',
		method : 'version',
	}, cfg);
	
	
	
	
	/* ---------- служебные ---------- */
	
	ctrl.randstr = function() {
		return (Math.random().toString(36).split('.'))[1];
	};
	
	ctrl.now = function() {
		return new Date().getTime();
	};
	
	ctrl.now_sec = function() {
		return Math.floor(ctrl.now() / 1000);
	};
	
	ctrl.ls = {
		set : function(id,value) {localStorage.setItem(ctrl.config.prefix + id,value);},
		get : function(id) {var item = localStorage.getItem(ctrl.config.prefix + id);if(typeof item !== 'undefined' && item != null) {return item;} else {return null;}},
		remove : function(id) {localStorage.removeItem(ctrl.config.prefix + id);},
		clear : function() {localStorage.clear();},
		obj2s : function(id,obj2save) {this.set(id, JSON.stringify(obj2save));},
		s2obj : function(id) {var item = this.get(id);if(typeof item !== 'undefined' && item != null) {return JSON.parse(item);} else {return null;}},
	};
	ctrl.ss = {
		set : function(id,value) {sessionStorage.setItem(ctrl.config.prefix + id,value);},
		get : function(id) {var item = sessionStorage.getItem(ctrl.config.prefix + id);if(typeof item !== 'undefined' && item != null) {return item;} else {return null;}},
		remove : function(id) {sessionStorage.removeItem(ctrl.config.prefix + id);},
		clear : function() {sessionStorage.clear();},
		obj2s : function(id,obj2save) {this.set(id, JSON.stringify(obj2save));},
		s2obj : function(id) {var item = this.get(id);if(typeof item !== 'undefined' && item != null) {return JSON.parse(item);} else {return null;}},
	};
	
	ctrl.len = function(arr) {
		if(this.is_def(arr) && !this.is_null(arr)) {
			return arr.length;
		} else {
			return 0;
		}
	};
	
	ctrl.echo = function(text, prefix) {
		prefix = prefix || ctrl.name;
		console.log(prefix + ': ' + text);
	}
	
	ctrl.warn = function(text, prefix) {
		prefix = prefix || ctrl.name;
		console.warn(prefix + ': ' + text);
	}
	
	ctrl.is_def = function(v) {
		if(v == undefined || typeof v == "undefined") {
			return false;
		} else {
			return true;
		}
	};
	
	ctrl.is_null = function(v) {
		if(v == null) {
			return true;
		} else {
			return false;
		}
	};
	
	ctrl.is_func = function(functionToCheck) {
		var getType = {};
		return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
	};
	
	ctrl.sleep = function(milliSeconds) {
		milliSeconds = milliSeconds || 1;
		
		var startTime = this.now();
		while (this.now() < startTime + milliSeconds);
	};
	
	ctrl.needReload = function(need) {
		if(need) {
			window.location.reload();
		}
	};
	
	/* ---------- /служебные ---------- */
	
	
	/* --------- Параметры командной строки --------- */
	ctrl.parseArgv = function(prms, sym) {
		for (var i = 0; i < prms.length; i++) {
			var arr = prms[i].split(sym||"=");
			ctrl.__argv[arr[0]] = arr[1];
		}
	},
	
	ctrl.getArgv = function(name) {
		return ctrl.__argv[name];
	},
	/* --------- /Параметры командной строки --------- */
	
	
	
	/* --------- Модули --------- */
	ctrl.load = function(uid, mdl) {
		ctrl.__mdl[uid] = mdl;
		return ctrl;
	};
	
	ctrl.unload = function(name) {
		ctrl.__mdl[name] = null;
		delete ctrl.__mdl[name];
		return ctrl.is_def(ctrl.__mdl[name]);
	};
	
	ctrl.mdl = function(name) {
		return ctrl.__mdl[name];
	};
	/* --------- /Модули --------- */
	
	
	
	ctrl.load('fnc', {
		
		byTag : function(tag) {
			return document.getElementsByTagName(tag);
		},
		
		byId : function(id) {
			return document.getElementById(id);
		},
		
		include : function(url, cb){
			
			var script;
			
			script = document.createElement('script');
			
			if(cb) {
				script.onload = cb;
			}
			
			script.language = 'javascript';
			script.type = 'text/javascript';
			//script.setAttribute('data-url', url);
			script.setAttribute('class', 'azbn7__mdl__fnc__include');
			script.src = url;
			
			document.documentElement.appendChild(script);
			
			//document.createTextNode('azbn7 test');
			
		},
		
		script2head : function(url, cb){
			
			var head = document.getElementsByTagName('head')[0];
			
			if(!head) {
				//return;
			} else {
				
				var script = document.createElement('script');
				
				if(cb) {
					script.onload = cb;
				}
				
				script.language = 'javascript';
				script.type = 'text/javascript';
				//script.setAttribute('data-url', url);
				script.setAttribute('class', 'azbn7__mdl__fnc__script2head');
				script.src = url;
				
				head.appendChild(script);
				
			}
		},
		
		nl2br : function(str) {
			
			return str.replace(/([^>])\n/g, '$1<br/>');
			
		},
		
		tpl : function(str,tpls){
			
			var _str = '';
			
			for(var key in tpls) {
				_str = str.replace(key, tpls[key]);
			}
			
			return _str;
			
		},
		
		stripTags : function(str){
			
			return str.replace(/<\/?[^>]+>/gi, '');
			
		},
		
		obj2param : function(obj){
			
			var param_str = '';
			
			for(var key in obj) {
				param_str = param_str+'&'+key+'='+obj[key];
			}
			
			return param_str;
			
		},
	});
	
	
	/* ---------- API вызов ---------- */
	
	ctrl.api = function(params, cb) {
		
		params.key = ctrl.config.key;
		params.access_as = ctrl.config.access_as;
		
		if(params.method) {
			
		} else {
			params.method = ctrl.config.method;
		}
		
		$.ajax({
			url : ctrl.config.url,
			type : 'POST',
			dataType : 'json',
			data : params,
			success : cb,
		});
		
	};
	
	/* ---------- /API вызов ---------- */
	
	return ctrl;
	
};




document.addEventListener('DOMContentLoaded', function(){
	
	while(typeof jQuery == 'undefined') {}
	
	if(window.Azbn7) {
		
	} else {
		
		window.Azbn7 = new Azbn7Constructor(jQuery, JSON.parse($(document.body).attr('data-azbn7') || '{}'));
		
		Azbn7.mdl('fnc').include('/js/azbn7/mdl/codecache.mdl.js', function(){
			
			Azbn7.warn('loaded');
			
			/*
			Azbn7.mdl('CodeCache').load({
				tag : 'script',
				uid : 'codecache.js.test',
				url : '/js/azbn7/test.js',
				expires_in : 900,
			}, function(element){
				element
					.appendTo($(document.body))
					.empty()
					.remove()
				;
			});
			
			Azbn7.mdl('CodeCache').load({
				tag : 'style',
				uid : 'codecache.css.test',
				url : '/css/azbn7/test.css',
				expires_in : 900,
			}, function(element){
				element.prependTo($(document.body))
			});
			*/
			
		});
		
		Azbn7.mdl('fnc').include('/js/azbn7/mdl/user.mdl.js', function(){
			
			
			
		});
		
		/*
		azbn.mdl('fnc').include('/js/azbn7/mdl/profile.mdl.js', function(){
			
			
			
		});
		*/
		
	}
	
});
