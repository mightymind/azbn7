'use strict';

(function($){
	
	var a7_class = 'azbn7';
	var a7admin_class = 'azbn7-admin';
	
	var container_class = '.azbn7-container';
	
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
				
				var block = $(container_class + ' form[action*="/admin/update/"], ' + container_class + ' form[action*="/admin/create/"]');
				
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
					
					(function(){
						
						var select = block.find('select[name="item[visible]"]');
						var val = parseInt(select.attr('data-select-value')) || 0;
						
						select.val(val);
						
					})();
					
				}
				
			})();
			
			
			(function(){
				
				// создание нового типа сущностей
				
				$(document.body).on('azbn7.field-list.field-item.reset', container_class + ' .field-list .field-item', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					block.find('input').val('');
					
				});
				
				$(document.body).on('click.azbn7', container_class + ' .field-list .btn-panel .btn-add-item', {}, function(event){
					event.preventDefault();
					
					var btn = $(this);
					var block = btn.closest('.field-list');
					var last = block.find('.field-item').eq(-1);
					
					last.clone(true).insertAfter(last).trigger('azbn7.field-list.field-item.reset');
					
				});
				
			})();
			
			
			(function(){
				
				// запрос при нажатии на кнопку удаления
				
				$(document.body).on('click.azbn7', container_class + ' .delete-confirm', {}, function(event){
					event.preventDefault();
					
					var btn = $(this);
					var href = btn.attr('href');
					
					if(confirm('Вы действительно хотите удалить запись?')) {
						window.location.href = href;
					}
					
				});
				
			})();
			
			
			(function(){
				
				// изменение input type=range
				
				$(document.body).on('change.azbn7', container_class + ' .item-pos-range', {}, function(event){
					event.preventDefault();
					
					var input = $(this);
					var val = input.val();
					
					input
						.attr('title', val)
						.attr('value', val)
					;
					
					input.closest('.form-group').find('.item-pos-view').html(val);
					
				});
				
				$(container_class + ' .item-pos-range').trigger('change.azbn7');
				
			})();
			
			
			(function(){
				
				// быстрый поиск
				
				$(document.body).on('azbn7.field-list.field-item.reset', container_class + ' .field-list .field-item', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					block.find('input').val('');
					
				});
				
				$(document.body).on('keyup.azbn7', container_class + ' .azbn7-search-input[data-result]', {}, function(event){
					event.preventDefault();
					
					var input = $(this);
					var result_id = input.attr('data-result');
					var result = $('.list-group[data-result="' + result_id + '"]');
					var val = input.val();
					
					if(val.length > 2) {
						
						Azbn7.api({
							method : 'entity/search',
							text : val,
						}, function(resp){
							
							if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
								
								result.empty();
								for(var i in resp.response.entities) {
									
									if(i < 8) {
										
										var item = resp.response.entities[i];
										
										var a = $('<a/>', {
											href : item.entity.link,
											class : 'list-group-item list-group-item-action ',
											html : '<h5 class="list-group-item-heading">' + item.item.title + '</h5><p class="list-group-item-text">' + item.entity.entity_type + '</p>'
										});
										
										a.appendTo(result);
										
									}
									
								}
								
							} else {
								
								result.empty();
								
							}
							
						})
						
					}
					
				});
				
			})();
			
		}
		
	});
	
})(jQuery);