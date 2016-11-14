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
			key : 'public',
			method : 'version',
		}, cfg);
	
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
	
	return ctrl;
	
};

window.Azbn7 = new Azbn7Constructor(jQuery, {});

window.Azbn7.me('user', function(type, entity){
	
	console.log('I am ' + type + ' with ID ' + entity.id);
	
	if(entity && (entity.id > 0)) {
		window.Azbn7.buildUserPanel(entity);
	}
	
});

window.Azbn7.me('profile', function(type, entity){
	console.log('I am ' + type + ' with ID ' + entity.id);
});
