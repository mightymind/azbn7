'use strict';

(function($){
	
	var a7_class = 'azbn7';
	var a7admin_class = 'azbn7-admin';
	
	var container_class = '.azbn7-container';
	
	
	
	$(function(){
		
		
		if($.Azbn7.body.hasClass(a7_class + ' ' + a7admin_class)) {
			
			
			(function(){
				
				$.datepicker.regional['ru'] = {
					closeText : 'Закрыть',
					prevText : '&#x3c;Пред',
					nextText : 'След&#x3e;',
					currentText : 'Сегодня',
					monthNames : ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
					monthNamesShort : ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
					dayNames : ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
					dayNamesShort : ['вс','пн','вт','ср','чт','пт','сб'],
					dayNamesMin : ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
					//dateFormat : 'dd.mm.yy',
					firstDay : 1,
					inline : true,
					isRTL : false,
				};
				$.datepicker.setDefaults($.datepicker.regional['ru']);
				
				$('.datepicker').datepicker();
				
			})();
			
			
			
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
					
					(function(){
						
						var select = block.find('select[name="entity[visible]"]');
						var val = parseInt(select.attr('data-select-value')) || 0;
						
						select.val(val);
						
					})();
					
					(function(){
						
						var select = block.find('select[name="item[fill]"]');
						var val = parseInt(select.attr('data-select-value')) || 0;
						
						select.val(val);
						
					})();

					(function(){
						
						var select = block.find('select[name="item[parent]"]');
						var val = parseInt(select.attr('data-select-value')) || 0;
						
						select.val(val);
						
					})();
					
				}
				
			})();
			
			
			
			
			(function(){
				
				$.Azbn7.body.on('click.azbn7', container_class + ' .azbn-flt-block-btn', {}, function(event){
					event.preventDefault();
					
					var btn = $(this);
					var trg = btn.attr('data-flt-block') || '';
					
					$(container_class + ' ' + trg).slideToggle('fast');
					
				});
				
			})();
			
			
			
			
			(function(){
				
				// создание нового типа сущностей
				
				$.Azbn7.body.on('azbn7.field-list.field-item.reset', container_class + ' .field-list .field-item', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					var nid = $.Azbn7.randstr();
					
					block.find('input')
						.val('')
						.each(function(index){
							
							var input = $(this);
							var name = input.attr('name');
							
							name = name.replace('[0]', '[' + nid + ']');
							input.attr('name', name);
							
							var list = input.attr('list') || '';
							
						})
					;
					
				});
				
				$.Azbn7.body.on('click.azbn7', container_class + ' .field-list .btn-panel .btn-add-item', {}, function(event){
					event.preventDefault();
					
					var btn = $(this);
					var block = btn.closest('.field-list');
					var last = block.find('.field-item').eq(0);
					
					last.clone(true).insertAfter(block.find('.field-item').eq(-1)).trigger('azbn7.field-list.field-item.reset');
					
				});
				
			})();
			
			
			
			
			
			
			
			(function(){
				
				// запрос при нажатии на кнопку удаления
				
				$.Azbn7.body.on('click.azbn7', container_class + ' .delete-confirm', {}, function(event){
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
				
				var blocks = $(container_class + ' .item-pos-block');
				
				if(blocks.length > 0) {
					
					blocks.each(function(__index){
						
						var block = $(this);
						var range = block.find('.item-pos-range');
						var input = block.find('.item-pos-view');
						
						range.on('change.azbn7', function(event){
							event.preventDefault();
							
							var val = range.val();
							
							range
								.attr('title', val)
								.attr('value', val)
							;
							
							input.val(val);
							
						});
						
						input.on('change.azbn7 keyup.azbn7 blur.azbn7', function(event){
							event.preventDefault();
							
							var val = input.val();
							
							range
								.attr('title', val)
								.attr('value', val)
								.val(val)
							;
							
						});
						
						input.trigger('blur.azbn7');
						
					});
					
				}
				
			})();
			
			
			
			
			
			
			(function(){
				
				// быстрый поиск
				
				$.Azbn7.body.on('azbn7.field-list.field-item.reset', container_class + ' .field-list .field-item', {}, function(event){
					event.preventDefault();
					
					var block = $(this);
					block.find('input').val('');
					
				});
				
				$.Azbn7.body.on('keyup.azbn7', container_class + ' .azbn7-search-input[data-result]', {}, function(event){
					event.preventDefault();
					
					var input = $(this);
					var result_id = input.attr('data-result');
					var result = $('.list-group[data-result="' + result_id + '"]');
					var val = input.val();
					
					if(val.length > 2) {
						
						$.Azbn7.mdl('API').r({
							method : 'admin/entity/search',
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
							
						});
						
					}
					
				});
				
			})();
			
			
			
			(function(){
				
				var blocks = $(container_class + ' .azbn-rights-list');
				
				if(blocks.length) {
					
					blocks.each(function(__index){
						
						var block = $(this);
						
						block.find('.check-btn').on('click.azbn7', function(event){
							event.preventDefault();
							
							var btn = $(this);
							var for_all = parseInt(btn.attr('data-check-all'));
							
							if(for_all) {
								
								block
									.find('.right-item-cb')
										.prop('checked', 'checked')
										
								;
								
							} else {
								
								block
									.find('.right-item-cb')
										.prop('checked', null)
										
								;
								
							}
							
						});
						
					});
					
				}
			
			})();
			
			
			(function(){
				
				var blocks = $(container_class + ' .entity-autocomplete');
				
				if(blocks.length) {
					
					blocks.each(function(__index){
						
						var block = $(this);
						
						var value = block.find('.edit-value');
						var input = block.find('.edit-input');
						var checked = block.find('.checked-list');
						var variant = block.find('.variant-list');
						
						var is_single = parseInt(block.attr('data-single') || 1);
						var type = parseInt(block.attr('data-type') || 0);
						
						var __genListItem = function(item) {
							
							var a = $('<a/>', {
								class : 'list-group-item variant',
								html : item.item.title,
							})
								.attr('draggable', true)
								.attr('href', '#' + item.entity.id)
								.attr('data-entity', item.entity.id)
							;
							
							return a;
							
						};
						
						input.on('keyup.azbn7', function(event){
							event.preventDefault();
							
							if(!variant.hasClass('in-action')) {
								variant.addClass('in-action');
							}
							
							var val = input.html().replace(new RegExp('&nbsp;','ig'), ' ');
							
							if(val.length > 2) {
								
								$.Azbn7.mdl('API').r({
									method : 'admin/entity/search',
									text : val,
									type : type,
								}, function(resp){
									
									if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
										
										variant.empty();
										
										for(var i in resp.response.entities) {
											
											if(i < 20) {
												
												var item = resp.response.entities[i];
												
												(__genListItem(item)).appendTo(variant);
												
											}
											
										}
											
									} else {
										
										variant.empty();
										
									}
									
								});
								
							} else if(val.length == 0) {
								
								variant.empty();
								
							}
							
						});
						
						block.on('azbn7.setValue', function(event){
							
							var res = [];
							
							checked.find('.variant').each(function(){
								
								var item = $(this);
								
								res.push(parseInt(item.attr('data-entity') || 0));
								
							});
							
							if(is_single) {
								
								if(res.length > 0) {
									value.text(res[0]);
								} else {
									value.text('[]');
								}
								
							} else {
								
								value.text(JSON.stringify(res));
								
							}
							
							value.val(value.text());
							
						});
						
						block.on('azbn7.init', function(event){
							
							variant.empty();
							
							var res = [];
							var ___val = value.val();
							
							if(___val == '' || ___val == ' ' || ___val == null || typeof ___val == 'undefined') {
								___val = '[]';
							}
							
							//console.log('' + value.val());
							
							if(is_single) {
								res = [parseInt(___val)];
							} else {
								res = JSON.parse(___val);
							}
							
							$.Azbn7.mdl('API').r({
								method : 'admin/entity/search_by_id',
								text : '0,' + res.join(),
								type : type,
							}, function(resp){
								
								if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
									
									for(var i in resp.response.entities) {
										
										var item = resp.response.entities[i];
										
										(__genListItem(item))
											.appendTo(checked);
										
									}
									
								}
								
							});
							
							//console.log(res);
							
						});
						
						checked.on('click.azbn7', '.variant', {}, function(event){
							
							if(confirm('Удалить запись из списка?')) {
								
								event.preventDefault();
								
								var btn = $(this);
								
								btn
									.empty()
									.remove()
								;
								
								block.trigger('azbn7.setValue');
								
							}
							
						});
						
						variant.on('click.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var btn = $(this);
							
							if(is_single) {
								checked.empty();
							} else {
								checked.find('.variant[data-entity="' + btn.attr('data-entity') + '"]').remove();
							}
							
							btn
								.appendTo(checked)
								/*
								.attr('title', 'Нажмите для удаления')
								.on('mouseover', function(){
									btn.addClass('on-hover');
								})
								.on('mouseout', function(){
									btn.removeClass('on-hover');
								})
								*/
							;
							
							input.text('');
							block.trigger('azbn7.setValue');
							
							if(variant.hasClass('in-action')) {
								variant.removeClass('in-action');
							}
							
						});
						
						checked.on('mousedown.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var oe = event.originalEvent;
							var item = $(this);
							
							if (oe.which != 1) { //клик правой кнопкой мыши
								return;
							} else {
								checked.attr('data-azbn7-mousedown', 1);
								checked.data('azbn7-mousedown', item);
							}
							
						});
						
						checked.on('mousemove.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var oe = event.originalEvent;
							var item = $(this);
							
							if (oe.which != 1) { //клик правой кнопкой мыши
								return;
							} else {
								//checked.attr('data-azbn7-mousedown', 1);
								//checked.data('azbn7-mousedown', item);
								
								if(parseInt(checked.attr('data-azbn7-mousedown')) && checked.data('azbn7-mousedown')) {
									
									var md = checked.data('azbn7-mousedown');
									
									if(parseInt(md.attr('data-entity')) != parseInt(item.attr('data-entity'))) {
										
										var __item = item.clone();
										var __md = md.clone();
										
										__item.insertAfter(md);
										__md.insertAfter(item);
										
										md.insertAfter(__md);
										item.insertAfter(__item);
										
										__item.remove();
										__md.remove();
										
										block.trigger('azbn7.setValue');
										
									}
									
								}
								
								
								
								
								
							}
							
						});
						
						/*
						checked.on('mouseup.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var oe = event.originalEvent;
							var item = $(this);
							
							if (oe.which != 1) { //клик правой кнопкой мыши
								return;
							} else {
								
								if(parseInt(checked.attr('data-azbn7-mousedown'))) {
									
									checked.attr('data-azbn7-mousedown', 0);
									
									var __mu_i = checked.index(item);
									var __md_i = checked.index(checked.data('azbn7-mousedown'));
									
									if(0) {
										
									} else {
										
									}
									
								}
								
								
								
								var md = checked.data('azbn7-mousedown');
								var _md = md.prev('.variant');
								
								md.insertAfter(item);
								item.insertAfter(_md);
								
							}
							
						});
						*/
						
						
						block.trigger('azbn7.init');
						
					});
					
				}
				
			})();
			
			
			
			
			(function(){
				
				var blocks = $(container_class + ' .single-upload-block');
				
				if(blocks.length) {
					
					blocks.each(function(__index){
						
						var block = $(this);
						
						var input = block.find('.upload-input');
						var btn = block.find('.upload-btn');
						var viewer = block.find('.upload-viewer');
						
						block.on('azbn7.init', function(event){
							
							var val = input.val();
							
							if(val != '') {
								
								viewer.removeClass('azbn7-hidden');
								
								viewer.attr('src', val);
								
							} else {
								
								viewer.addClass('azbn7-hidden');
								
							}
							
						});
						
						input.on('keyup.azbn7 blur.azbn7 change.azbn7', function(event){
							event.preventDefault();
							
							block.trigger('azbn7.init');
							
						})
						
						block.trigger('azbn7.init');
						
					});
					
				}
				
			})();
			
			
			
			(function(){
				
				var blocks = $(container_class + ' .gallery-collect');
				
				if(blocks.length) {
					
					blocks.each(function(__index){
						
						var block = $(this);
						
						var value = block.find('.edit-value');
						var input = block.find('.edit-input');
						
						var checked = block.find('.image-cont');
						var variant = block.find('.variant-cont');
						
						var is_single = 0;
						var type = parseInt(block.attr('data-type') || 0);
						
						var append_btn = checked.find('.append-variant-item');
						var upload_btn = checked.find('.upload-variant-item');
						
						var edit = block.find('.edit-block');
						
						var __genListItem = function(item, in_search) {
							
							var html = '';
							
							if(in_search) {
								html = '<i class="fa fa-plus" aria-hidden="true"></i>';
							} else {
								html = '<i class="fa fa-times" aria-hidden="true"></i>';
							}
							
							var a = $('<a/>', {
								class : 'variant',
								html : html,
							})
								.attr('draggable', true)
								.attr('href', '#' + item.entity.id)
								.attr('data-entity', item.entity.id)
								.css({
									'background-image' : 'url(' + item.item.path + ')',
								})
							;
							
							return a;
							
						};
						
						input.on('keyup.azbn7', function(event){
							event.preventDefault();
							
							if(!variant.hasClass('in-action')) {
								variant.addClass('in-action');
							}
							
							var val = input.html().replace(new RegExp('&nbsp;','ig'), ' ');
							
							if(val.length > 2) {
								
								$.Azbn7.mdl('API').r({
									method : 'admin/entity/search',
									text : val,
									type : type,
								}, function(resp){
									
									if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
										
										variant.empty();
										
										for(var i in resp.response.entities) {
											
											if(i < 20) {
												
												var item = resp.response.entities[i];
												
												(__genListItem(item, true)).appendTo(variant);
												
											}
											
										}
											
									} else {
										
										variant.empty();
										
									}
									
								});
								
							} else if(val.length == 0) {
								
								variant.empty();
								
							}
							
						});
						
						block.on('azbn7.setValue', function(event, arr){
							
							var res = arr || [];
							
							checked.find('.variant').each(function(){
								
								var item = $(this);
								
								res.push(parseInt(item.attr('data-entity') || 0));
								
							});
							
							if(is_single) {
								
								if(res.length > 0) {
									value.text(res[0]);
								} else {
									value.text('');
								}
								
							} else {
								
								value.text(JSON.stringify(res));
								
							}
							
							value.val(value.text());
							
						});
						
						block.on('azbn7.init', function(event){
							
							/*
							var res = [];
							var ___val = value.val();
							
							if(___val == '' || ___val == ' ' || ___val == null || typeof ___val == 'undefined') {
								___val = '[]';
							}
							
							//console.log('' + value.val());
							
							if(is_single) {
								res = [parseInt(___val)];
							} else {
								res = JSON.parse(___val);
							}
							*/
							
							var res = [];
							var ___val = value.val();
							
							if(___val == '' || ___val == ' ' || ___val == null || typeof ___val == 'undefined') {
								___val = '[]';
							}
							
							if(is_single) {
								res = [parseInt(___val)];
							} else {
								res = JSON.parse(___val);
							}
							
							$.Azbn7.mdl('API').r({
								method : 'admin/entity/search_by_id',
								text : '0,' + res.join(','),
								type : type,
							}, function(resp){
								
								if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
									
									checked.find('.variant')
										.empty()
										.remove()
									;
									
									for(var i in resp.response.entities) {
										
										var item = resp.response.entities[i];
										
										(__genListItem(item))
											//.appendTo(checked)
											.insertBefore(append_btn)
											;
										
									}
									
								}
								
							});
							
							//console.log(res);
							
						});
						
						checked.on('click.azbn7', '.variant', {}, function(event){
							
							if(confirm('Удалить запись из списка?')) {
								
								event.preventDefault();
								
								var btn = $(this);
								
								btn
									.empty()
									.remove()
								;
								
								block.trigger('azbn7.setValue');
								
							}
							
						});
						
						checked.on('mousedown.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var oe = event.originalEvent;
							var item = $(this);
							
							if (oe.which != 1) { //клик правой кнопкой мыши
								return;
							} else {
								checked.attr('data-azbn7-mousedown', 1);
								checked.data('azbn7-mousedown', item);
								item.addClass('on-drag');
							}
							
						});
						
						checked.on('mouseup.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var oe = event.originalEvent;
							var item = $(this);
							
							if (oe.which != 1) { //клик правой кнопкой мыши
								return;
							} else {
								checked.attr('data-azbn7-mousedown', 0);
								checked.data('azbn7-mousedown', null);
								item.removeClass('on-drag');
							}
							
						});
						
						checked.on('mousemove.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var oe = event.originalEvent;
							var item = $(this);
							
							if (oe.which != 1) { //клик правой кнопкой мыши
								return;
							} else {
								//checked.attr('data-azbn7-mousedown', 1);
								//checked.data('azbn7-mousedown', item);
								
								
								
								if(parseInt(checked.attr('data-azbn7-mousedown')) && checked.data('azbn7-mousedown')) {
									
									var md = checked.data('azbn7-mousedown');
									
									if(parseInt(md.attr('data-entity')) != parseInt(item.attr('data-entity'))) {
										//console.log('111x');
										var __item = item.clone();
										var __md = md.clone();
										
										__item.insertAfter(md);
										__md.insertAfter(item);
										
										md.insertAfter(__md);
										item.insertAfter(__item);
										
										__item.remove();
										__md.remove();
										
										block.trigger('azbn7.setValue');
										
									}
									
								}
								
							}
							
						});
						
						variant.on('click.azbn7', '.variant', {}, function(event){
							event.preventDefault();
							
							var btn = $(this);
							
							if(is_single) {
								checked.empty();
							} else {
								checked.find('.variant[data-entity="' + btn.attr('data-entity') + '"]').remove();
							}
							
							btn
								.insertBefore(append_btn);
								//.appendTo(checked)
								
							;
							
							//input.text('');
							block.trigger('azbn7.setValue');
							
							//if(variant.hasClass('in-action')) {
							//	variant.removeClass('in-action');
							//}
							
						});
						
						append_btn.on('click.azbn7', function(event) {
							event.preventDefault();
							
							edit.slideToggle('fast');
							edit.find('.edit-input').trigger('focus');
							
						});
						//append_btn.trigger('click.azbn7');
						
						
						upload_btn.on('click.azbn7', function(event) {
							event.preventDefault();
							
							var arr = [];
							
							$.Azbn7.body.Azbn7_AjaxUploader('upload', {
								name : 'uploading_file',
								action : '/admin/upload/file/',
								on_percent : function(file, total, loaded, percent) {
									//Azbn7.User.msg('info', 'Загрузка ' + file.name + ': ' + percent + '%');
								},
								callback : function(file, response, uploaded, is_last) {
									
									var json = JSON.parse(response);
									console.log(json);
									
									var type = 0;
									
									switch(json.mime_type) {
										
										// картинки
										case 'image/tiff' :
										case 'image/svg+xml' :
										case 'image/gif' :
										case 'image/jpeg' :
										case 'image/png' : {
											type = 4;
										}
										break;
										
										// аудио
										case 'audio/mpeg' : {
											type = 5;
										}
										break;
										
										// видео
										case 'video/mp4' :
										case 'video/webm' :
										case 'video/quicktime' : {
											type = 6;
										}
										break;
										
										default : {
											type = 7;
										}
										break;
										
									}
									
									$.Azbn7.mdl('API').r({
										method : 'admin/entity/create_upload',
										type : type,
										title : json.title,
										path : json.url,
									}, function(resp){
										
										if(resp && resp.response && resp.response.entity && type == 4) {
											
											//area.append('<p>Файл <a href="' + resp.response.entity.item.path + '" target="_blank" >' + resp.response.entity.item.title + '</a> загружен</p>');
											
											/*
											(__genListItem(resp.response.entity))
												//.appendTo(checked)
												.insertBefore(append_btn)
											;
											*/
											arr.push(resp.response.entity.entity.id);
											
											if(is_last) {
												//alert('last');
												block.trigger('azbn7.setValue', [arr]);
												block.trigger('azbn7.init');
											}
											
											
											
										}
										
									});
									
								},
							});
							
						});
						
						block.trigger('azbn7.init');
						
					});
					
				}
				
			})();
			
			
			
			
			
			(function(){
				
				/*
				$.Azbn7.body.Azbn7_AjaxUploader('dropping', {
					name : 'uploading_file',
					action : '/admin/upload/file/',
					on_percent : function(file, total, loaded, percent) {
						//Azbn7.User.msg('info', 'Загрузка ' + file.name + ': ' + percent + '%');
					},
					callback : function(file, response, uploaded, is_last) {
						
						var json = JSON.parse(response);
						
						console.log(json);
						
					},
				});
				*/
				
				$.Azbn7.body.Azbn7_ImageMinimizer('dropping', {
					callback : function(data) {
						
						console.log(data.file.name);
						
						/*
						$.Azbn7.body.append(
							$('<img/>', {
								src : data.dataURL,
							})
						);
						*/
						
						$.post('/admin/upload/dataurl/', {uploading_file : data.dataURL}, function(response){
							
							//var json = JSON.parse(response);
							
							console.log(response);
							
						});
						
					},
				});
				
			})();
			
			
			
			
			(function(){
				
				var form = $(container_class + ' form[method="POST"]');
				
				form.on('azbn7.single-upload', null, {}, function(event, upload){
					
					(function(){
						
						form.find('[data-need-upload-param]').each(function(index){
							
							var input = $(this);
							var need_param = input.attr('data-need-upload-param');
							
							if(!input.val() || input.val() == '') {
								input.val(upload[need_param]);
							}
							
						});
						
					})();
					
				});
				
			})();
			
			
			(function(){
				
				$(container_class + ' .single-upload-block').each(function(__index){
					
					var block = $(this);
					
					var input = block.find('.upload-input');
					var btn = block.find('.upload-btn');
					var img = block.find('.upload-img');
					
					btn.on('click', function(event){
						event.preventDefault();
						
						$.Azbn7.body.Azbn7_AjaxUploader('upload', {
							name : 'uploading_file',
							action : '/admin/upload/file/',
							on_percent : function(file, total, loaded, percent) {
								//console.log(file.name + ': ' + percent);
								//Azbn7.User.msg('info', 'Загрузка ' + file.name + ': ' + percent + '%');
							},
							callback : function(file, response, uploaded, is_last) {
								
								var json = JSON.parse(response);
								console.log(json);
								
								input.val(json.url);
								
								block.closest('form').trigger('azbn7.single-upload', [json]);
								input.trigger('blur.azbn7');
								
								if(img) {
									img.attr('src', json.url);
								}
								
							},
						});
						
					});
					
				});
				
			})();
			
			(function(){
				
				$.Azbn7.body.on('change.azbn7', '.azbn-entity-all-mass-select', {}, function(event){
					event.preventDefault();
					
					var sel = $(this);
					var val = sel.val();
					var items = [];
					
					$('input.azbn-entity-all-mass-cb').each(function(__index){
						
						var el = $(this);
						
						if(el.prop('checked')) {
							
							items.push(el.val())
							
						}
						
					});
					
					if(confirm('Совершить групповое действие над выбранными элементами?') && items.length && val != '') {
						
						var items_str = items.join();
						
						$.Azbn7.mdl('API').r({
							method : 'admin/entity/mass_action',
							ids : items_str,
							action : val,
						}, function(resp){
							
							window.location.reload(true);
							
						});
						
					}
					
					sel.val('');
					
				});
				
				$.Azbn7.body.on('change.azbn7', '.azbn-entity-all-cbs-cb', {}, function(event){
					//event.preventDefault();
					
					var cb = $(this);
					
					$('input.azbn-entity-all-mass-cb').prop('checked', cb.prop('checked'));
					
				});
				
			})();
			
			
			(function(){
				
				var blocks = $(container_class + ' .hierarchy-draggable');
				
				if(blocks.length) {
					
					blocks.each(function(__index){
						
						var block = $(this);
						var li = block.children();
						
						var __uniq = block.attr('data-uniq') || '';
						
						/*
						var li.each(function(____index){
							
						});
						
						block.data('item-positions', '');
						*/
						
						
						
						block
							.sortable({
								//revert : false,
							})
						;
						
						li
							.draggable({
								axis : 'y',
								revert : false,
								containment : 'parent',
								handle : '.drag-handle',
								connectToSortable : 'ul[data-uniq="' + __uniq + '"]',
								start : function(event, ui){
									
									var __pos_arr = [];
									
									block.children().each(function(____index){
										__pos_arr[____index] = $(this).attr('data-entity-pos') || 0
									});
									
									block.data('children-pos', __pos_arr);
									//console.log(block.children().index(ui.helper));
									
								},
								drag : function(event, ui){
									
								},
								stop : function(event, ui){
									
									//alert(block.children().index(ui.helper));
									
									var __entities = {};
									var __pos_arr = block.data('children-pos');
									
									block.children().each(function(____index){
										
										var e_id = $(this).attr('data-entity-id') || 0;
										
										__entities[e_id] = __pos_arr[____index];
										
										$(this).attr('data-entity-pos', __pos_arr[____index]);
										
									});
									
									$.Azbn7.mdl('API').r({
										method : 'admin/entity/set_positions',
										entities : __entities,
									}, function(resp){
										
										console.log('saved positions');
										
									});
									
									//var pos = block.children().index(ui.helper);
									//console.log(block.data('children-pos').eq(pos).text());
									
								},
							})
						;
						
						block
							.disableSelection();
						li
							.disableSelection();
						
					});
					
				}
				
			})();
			
			
			(function(){
				
				var block = $('.' + a7admin_class + ' .azbn7-multiple-upload');
				
				var btn = block.find('.upload-on-click-btn');
				var area = block.find('.upload-on-drag-area');
				
				if(btn.length && area.length) {
					
					btn.on('click.azbn7', function(event){
						event.preventDefault();
						
						$.Azbn7.body.Azbn7_AjaxUploader('upload', {
							name : 'uploading_file',
							action : '/admin/upload/file/',
							on_percent : function(file, total, loaded, percent) {
								//Azbn7.User.msg('info', 'Загрузка ' + file.name + ': ' + percent + '%');
							},
							callback : function(file, response, uploaded, is_last) {
								
								var json = JSON.parse(response);
								console.log(json);
								
								var type = 0;
								
								switch(json.mime_type) {
									
									// картинки
									case 'image/tiff' :
									case 'image/svg+xml' :
									case 'image/gif' :
									case 'image/jpeg' :
									case 'image/png' : {
										type = 4;
									}
									break;
									
									// аудио
									case 'audio/mpeg' : {
										type = 5;
									}
									break;
									
									// видео
									case 'video/mp4' :
									case 'video/webm' :
									case 'video/quicktime' : {
										type = 6;
									}
									break;
									
									default : {
										type = 7;
									}
									break;
									
								}
								
								$.Azbn7.mdl('API').r({
									method : 'admin/entity/create_upload',
									type : type,
									title : json.title,
									path : json.url,
								}, function(resp){
									
									if(resp && resp.response && resp.response.entity) {
										
										area.append('<p>Файл <a href="' + resp.response.entity.item.path + '" target="_blank" >' + resp.response.entity.item.title + '</a> загружен</p>');
										
									}
									
								});
								
							},
						});
						
					});
					
				}
				
				if(area.length) {
					
					area.Azbn7_AjaxUploader('dropping', {
						name : 'uploading_file',
						action : '/admin/upload/file/',
						on_percent : function(file, total, loaded, percent) {
							//Azbn7.User.msg('info', 'Загрузка ' + file.name + ': ' + percent + '%');
						},
						callback : function(file, response, uploaded, is_last) {
							
							var json = JSON.parse(response);
							console.log(json);
							
							var type = 0;
							
							switch(json.mime_type) {
								
								// картинки
								case 'image/tiff' :
								case 'image/svg+xml' :
								case 'image/gif' :
								case 'image/jpeg' :
								case 'image/png' : {
									type = 4;
								}
								break;
								
								// аудио
								case 'audio/mpeg' : {
									type = 5;
								}
								break;
								
								// видео
								case 'video/mp4' :
								case 'video/webm' :
								case 'video/quicktime' : {
									type = 6;
								}
								break;
								
								default : {
									type = 7;
								}
								break;
								
							}
							
							$.Azbn7.mdl('API').r({
								method : 'admin/entity/create_upload',
								type : type,
								title : json.title,
								path : json.url,
							}, function(resp){
								
								if(resp && resp.response && resp.response.entity) {
									
									area.append('<p>Файл <a href="' + resp.response.entity.item.path + '" target="_blank" >' + resp.response.entity.item.title + '</a> загружен</p>');
									
								}
								
							});
							
						},
					});
					
				}
				
			})();
			
		}
		
	});
	
})(jQuery);