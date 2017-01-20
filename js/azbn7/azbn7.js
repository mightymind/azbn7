'use strict';

/*
Прослойка для работы с Azbn7 API
Требуется подключение jQuery
*/

function Azbn7Constructor($, cfg) {
	
	var ctrl = this;
	
	if(typeof cfg != 'object') {
		cfg = new Object();
	} 
	
	ctrl.config = $.extend({}, {
			prefix : 'azbn7.',
			url : '/api/',
			atype : 'user',
			key : 'public',
			method : 'version',
		}, cfg);
	
	ctrl.randstr = function() {
		return (Math.random().toString(36).split('.'))[1];
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
	
	ctrl.User = {};
	
	ctrl.api = function(params, cb) {
		
		params.key = ctrl.config.key;
		
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
	
	ctrl.buildUserPanel = function(user) {
		
		$(function(){
			
			var panel = $('<div/>', {
				class : 'azbn7-panel',
			});
			
			panel.appendTo($(document.body));
			
			$(document.body).addClass('azbn7');
			
		});
		
	};
	
	ctrl.needReload = function(need) {
		
		if(need) {
			
			window.location.reload();
			
		}
		
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
	
	ctrl.echo = function(text, prefix) {
		
		prefix = prefix || 'Azbn7 Default';
		
		console.log(prefix + ': ' + text);
		
	}
	
	/*
	ctrl.User.msg = function(state, text) {
		
		
		//state = state || 'hide';
		
		//console.warn('.admin-action-line: ' + state + ': ' + text);
		
		//var block = $('.admin-action-line');
		
		//block.find('.text').html(text);
		
		//block.attr('data-state', state);
		
		//if(block.data('cleartimeout')) {
		//	
		//	clearTimeout(block.data('cleartimeout'));
		//	
		//}
		
		//block.data('cleartimeout', setTimeout(function(){
		//	
		//	block.attr('data-state', 'hide');
		//	
		//	//clearTimeout(block.data('cleartimeout'));
		//	
		//}, 4444));
		
		
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
	
	*/
	
	return ctrl;
	
};
