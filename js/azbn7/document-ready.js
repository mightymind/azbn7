'use strict';

(function($){
	
	var a7_class = 'azbn7';
	
	$(function(){
		
		if($(document.body).hasClass(a7_class)) {
			
			(function(){
				
				$(document.body).on('dblclick.azbn7', '.azbn7__live-edit__html[data-azbn7-live-edit]', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					var uid = block.attr('data-azbn7-live-edit') || '';
					
					if(uid != '' && confirm('Изменить значение поля?')) {
						
						block.addClass('azbn7__live-edit__now');
						
						block.attr('contenteditable', true);
						
					}
					
				});
				
				$(document.body).on('blur.azbn7', '.azbn7__live-edit__html[data-azbn7-live-edit]', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					var uid = block.attr('data-azbn7-live-edit') || '';
					
					block.attr('contenteditable', false);
					
					if(uid != '' && confirm('Сохранить значение поля?')) {
						
						var val = block.html();
						
						$.Azbn7.api({
							method : 'azbn7/live-edit/save',
							uid : uid,
							value : val,
						}, function(resp){
							
							$.Azbn7.echo(resp.meta.msg.text);
							
						});
						
					} else {
						
						
						
					}
					
					block.removeClass('azbn7__live-edit__now');
					
				});
				
				
				/*
				$(document.body).on('dblclick.azbn7', '.azbn7__live-edit__evalContent[data-azbn7-live-edit]', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					var uid = block.attr('data-azbn7-live-edit') || '';
					
					if(uid != '' && confirm('Изменить значение поля?')) {
						
						$.Azbn7.api({
							method : 'azbn7/live-edit/get_evalContent',
							uid : uid,
						}, function(resp){
							
							block.html(resp);
							
						});
						
						block.addClass('azbn7__live-edit__now');
						
						block.attr('contenteditable', true);
						
					}
					
				});
				*/
				
			})();
			
			(function(){
				
				
				$.Azbn7.mdl('fnc').include('/js/azbn7/mdl/codecache.mdl.js', function(){
					
					$.Azbn7.warn('codecache loaded');
					
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
				
				
				//$.Azbn7.mdl('fnc').include('/js/azbn7/mdl/user.mdl.js', function(){});
				
				
			})();
			
		}
		
	});
	
})(jQuery);