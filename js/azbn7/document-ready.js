'use strict';

(function(){
	
	var a7_class = 'azbn7';
	var a7admin_class = 'azbn7-admin';
	
	$(function(){
		
		/*
		Azbn7.api({}, function(resp){
			console.log(resp);
		});
		*/
		
		/*
		$(document.body).on('', '.', {}, function(event){
			event.preventDefault();
			
			//var block = $(this);
			//var btn = $(this);
			
		});
		*/
		if($(document.body).hasClass(a7_class + ' ' + a7admin_class)) {
			
			(function(){
				
				// загрузка значений при редактировании
				
				var block = $(a7admin_class + ' form[action*="/admin/update/"]');
				
				if(block.length) {
					
					(function(){
						
						var select = block.find('select[name="item[json]"]');
						var val = parseInt(select.attr('data-select-value')) || 0;
						
						select.val(val);
						
					})();
					
					(function(){
						
						var select = block.find('select[name="item[editable]"]');
						var val = parseInt(select.attr('data-select-value')) || 0;
						
						select.val(val);
						
					})();
					
				}
				
			})();
			
			
			(function(){
				
				// создание нового типа сущностей
				
				$(document.body).on('azbn7.field-list.field-item.reset', '.field-list .field-item', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					block.find('input').val('');
					
				});
				
				$(document.body).on('click.azbn7', '.field-list .btn-panel .btn-add-item', {}, function(event){
					event.preventDefault();
					
					var btn = $(this);
					var block = btn.closest('.field-list');
					var last = block.find('.field-item').eq(-1);
					
					last.clone(true).insertAfter(last).trigger('azbn7.field-list.field-item.reset');
					
				});
				
			})();
			
		}
		
	});
	
})();