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
		
	});
	
})(jQuery);