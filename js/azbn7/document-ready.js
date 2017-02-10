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
						
						Azbn7.api({
							method : 'azbn7/live-edit/save',
							uid : uid,
							value : val,
						}, function(resp){
							
							Azbn7.echo(resp.meta.msg.text);
							
						});
						
					} else {
						
						
						
					}
					
					block.removeClass('azbn7__live-edit__now');
					
				});
				
			})();
			
		}
		
		/*
		Azbn7.CodeCache.load({
			tag : 'script',
			uid : 'codecache.js.test',
			url : '/js/azbn7/test.js',
			expires_in : 90,
		}, function(element){
			element
				.appendTo($(document.body))
				.empty()
				.remove()
			;
		});
		
		Azbn7.CodeCache.load({
			tag : 'style',
			uid : 'codecache.css.test',
			url : '/css/azbn7/test.css',
			expires_in : 19,
		}, function(element){
			element.prependTo($(document.body))
		});
		
		Azbn7.CodeCache.load({
			tag : 'div',
			uid : 'codecache.html.test',
			url : '',
			expires_in : 33,
		}, function(element){
			$('.azbn7-container').html($('.azbn7-container', element).html());
		});
		*/
		
	});
	
})(jQuery);