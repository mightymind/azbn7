'use strict';

/*
Прослойка для работы с Azbn7 API
Требуется подключение jQuery
*/

function Azbn7Constructor($, cfg, settings) {
	
	
	
	
	var ctrl = this;
	
	
	
	
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
	
	ctrl.needReload = function(need) {
		if(need) {
			window.location.reload();
		}
	};
	
	ctrl.echo = function(text, prefix) {
		prefix = prefix || 'Azbn7 Default';
		console.log(prefix + ': ' + text);
	}
	
	/* ---------- /служебные ---------- */
	
	
	
	
	
	
	/* ---------- профиль админа или пользователя ---------- */
	
	ctrl.User = {};
	
	/* ---------- /профиль админа или пользователя ---------- */
	
	
	
	
	
	/* ---------- API вызов ---------- */
	
	ctrl.api = function(params, cb) {
		
		params.key = ctrl.config.key;
		params.access_as = ctrl.config.access_as;
		
		if(params.method) {
			
		} else {
			params.method = ctrl.config.method;
		}
		
		$.ajax({
			url: ctrl.config.url,
			type: 'POST',
			dataType: 'json',
			data: params,
			success: cb,//function(resp) {cb(resp);}
		});
		
	};
	
	/* ---------- /API вызов ---------- */
	
	
	
	
	
	
	/* ---------- обновление инфы о пользователе ---------- */
	
	ctrl.me = function(type, _cb) {
		
		if(!ctrl.ss.get('me.' + type)) {
			
			ctrl.api({
				method : 'me',
				type : type,
			}, function(resp){
				
				if(resp && resp.response && resp.response.entity) {
					
					if(typeof resp.response.entity == 'object') {
						
						ctrl.ss.obj2s('me.' + type, resp.response.entity);
						_cb(type, resp.response.entity);
						ctrl.needReload(parseInt(resp.meta.need.reload));
						
					} else {
						
						_cb(type, null);
						
					}
					
				} else {
					
					_cb(type, null);
					
				}
				
			});
			
		} else {
			
			_cb(type, ctrl.ss.s2obj('me.' + type));
			
		}
		
	};
	
	/* ---------- /обновление инфы о пользователе ---------- */
	
	
	
	
	
	ctrl.buildUserPanel = function(user) {
		
		$(function(){
			
			var panel = $('<div/>', {
				class : 'azbn7-panel',
			});
			
			panel.appendTo($(document.body));
			
			$(document.body).addClass('azbn7');
			
		});
		
	};
	
	
	ctrl.User.notify = function(state, text) {
		
		state = state || 'hide';
		
		var __uid = 'killme_timeout';
		
		var block = $('.azbn7-user-msg-cont');
		
		(function(){
			
			var msg = $('<div/>', {
				class : 'azbn7-notify-item alert alert-' + state,
				html : text
			});
			
			msg.data(__uid, setTimeout(function(){
				
				clearTimeout(block.data(__uid));
				
				msg
					.empty()
					.remove()
				;
				
			}, 10000));
			
			msg.prependTo(block);
			
		})();
		
	};
	
	
	
	
	
	
	/* ---------- кеширование кода ---------- */
	
	ctrl.CodeCache = {};
	
	ctrl.CodeCache.remove = function(uid) {
		ctrl.ls.remove(uid);
	};
	
	ctrl.CodeCache.download = function(code, reload_in_body, cb) {
		
		//ctrl.CodeCache.remove(uid)
		
		reload_in_body = reload_in_body || false;
		
		$.ajax(code.url, {
			type : 'GET',
			dataType : 'text',
			success : function(data){
				
				var _code = {
					tag : code.tag,
					uid : code.uid,
					url : code.url,
					expires : ctrl.now_sec() + (code.expires_in || ctrl.settings.cache.expires_in),
					expires_in : code.expires_in,
					html : '<' + code.tag + '>' + data + '</' + code.tag + '>',
				};
				
				ctrl.ls.obj2s(code.uid, _code);
				
				$('.azbn7-codecache[data-azbn7-codecache-uid="' + code.uid + '"]').attr('data-azbn7-codecache-expires-in', code.expires_in);
				
				if(reload_in_body) {
					ctrl.CodeCache.eval(_code, true, cb);
				}
				
			},
		});
		
	};
	
	ctrl.CodeCache.doUpdate = function(interval) {
		
		interval = interval || 60000;
		
		ctrl.settings.intervals.codecache = setInterval(function(){
			
			var items = $('.azbn7-codecache');
			items.each(function(index){
				
				var item = $(this);
				var uid = item.attr('data-azbn7-codecache-uid') || '';
				
				var code = ctrl.ls.s2obj(uid);
				
				if(code) {
					
					var _period = code.expires - ctrl.now_sec();
					
					item.attr('data-azbn7-codecache-expires-in', _period);
					
					if(_period > 0) {
						
						if(_period < ctrl.settings.cache.update_or_expires) {
							ctrl.CodeCache.download(code, false);
						}
						
					} else {
						
						ctrl.CodeCache.download(code, false);
						
					}
					
				}
				
			})
			
		}, interval);
	};
	
	ctrl.CodeCache.eval = function(code, updated, cb) {
		
		var el = $(code.html);
		el
			.attr('id', 'codecache-' + ctrl.randstr())
			.attr('class', 'azbn7-codecache')
			.attr('data-azbn7-codecache-expires-in', code.expires - ctrl.now_sec())
			.attr('data-azbn7-codecache-uid', code.uid)
			.attr('data-azbn7-codecache-from-url', updated)
			//.appendTo($(document.body))
		;
		if(cb) {
			cb(el);
		}
		
	};
	
	ctrl.CodeCache.load = function(item, cb) {
		
		var newcode = $.extend({}, {
			tag : '!--',
			uid : 'codecache.html.default',
			url : '',
			expires : ctrl.now_sec() + (item.expires_in || ctrl.settings.cache.expires_in),
			expires_in : 3600,
			html : '',
		}, item);
		
		var code = ctrl.ls.s2obj(newcode.uid);
		
		if(code) {
			
			code.expires_in = newcode.expires_in;
			
			if((code.expires > ctrl.now_sec())) {
				ctrl.CodeCache.eval(code, false, cb);
			} else {
				ctrl.CodeCache.download(newcode, true, cb);
			}
			
		} else {
			
			ctrl.CodeCache.download(newcode, true, cb);
			
		}
		
	};
	
	ctrl.CodeCache.doUpdate(30 * 1000);
	
	/* ---------- /кеширование кода ---------- */
	
	
	
	return ctrl;
	
};




document.addEventListener('DOMContentLoaded', function(){
	while(typeof jQuery == 'undefined') {}
	window.Azbn7 = new Azbn7Constructor(jQuery, JSON.parse($(document.body).attr('data-azbn7') || '{}'));
});
