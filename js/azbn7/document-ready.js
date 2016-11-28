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
					
					(function(){
						
						var select = block.find('select[name="entity[visible]"]');
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
					var nid = Azbn7.randstr();
					
					block.find('input')
						.val('')
						.each(function(index){
							
							var input = $(this);
							var name = input.attr('name');
							
							name = name.replace('[0]', '[' + nid + ']');
							input.attr('name', name);
							
							var list = input.attr('list') || '';
							
							if(list != '') {
								
								list = list.replace('-0', '-' + nid);
								input.attr('list', list);
								
								var dl = input.next('datalist#input-list-0');
								var dl_id = dl.attr('id') || '';
								
								if(dl_id != '') {
									
									dl_id = dl_id.replace('-0', '-' + nid);
									dl.attr('id', dl_id);
									
								}
								
							}
							
						})
					;
					
				});
				
				$(document.body).on('click.azbn7', container_class + ' .field-list .btn-panel .btn-add-item', {}, function(event){
					event.preventDefault();
					
					var btn = $(this);
					var block = btn.closest('.field-list');
					var last = block.find('.field-item').eq(0);
					
					last.clone(true).insertAfter(block.find('.field-item').eq(-1)).trigger('azbn7.field-list.field-item.reset');
					
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
			
			
			/*
			(function(){
				
				var block = $('.' + a7admin_class + ' .azbn7-select-entity');
				
				if(block.length) {
				
					var search_l = block.find('.searched-entities-list');
					var select_l = block.find('.selected-entities-list');
					
					var type = 0;
					
					var __genListItem = function(item) {
						
						var a = $('<li/>', {
							class : 'list-group-item list-group-item-action ',
						})
							.attr('data-entity-id', item.entity.id)
						;
						
						$('<a/>', {
							href : '#add',
							class : 'tag tag-default tag-success float-xs-right select-entity-add',
							html : 'Add',
						})
							.appendTo(a);
						
						$('<a/>', {
							href : '#delete',
							class : 'tag tag-default tag-danger float-xs-right select-entity-delete',
							html : 'Del',
						})
							.appendTo(a);
						
						$('<h5/>', {
							class : 'list-group-item-heading',
							html : item.item.title,
						})
							.appendTo(a);
						
						$('<p/>', {
							class : 'list-group-item-text',
							html : item.entity.entity_type,
						})
							.appendTo(a);
						
						
						return a;
					};
					
					block.on('show.bs.modal', function(event, params){
						
						search_l
							.empty()
						;
						select_l
							.empty()
						;
						block
							.find('form')
							.trigger('reset')
						;
						
					});
					
					block.on('azbn7.init', function(event, params){
						
						type = params.type;
						
						if(params.single) {
							select_l.attr('data-single', 1);
						} else {
							select_l.attr('data-single', 0);
						}
						
						if(params.selected.length) {
							
							var ids = params.selected.join(',');
							
							if(params.selected.length == 1) {
								ids = '0,' + ids;
							}
							
							Azbn7.api({
								method : 'entity/search_by_id',
								text : ids,
								type : type,
							}, function(resp){
								
								if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
									
									for(var i in resp.response.entities) {
										
										var item = resp.response.entities[i];
										
										(__genListItem(item)).appendTo(select_l);
										
									}
									
								}
								
							});
						
						}
						
						block.find('.azbn7-select-entity-ok').one('click.azbn7', function(event){
							
							var items = select_l.find('.list-group-item');
							var ids = new Array();
							
							items.each(function(index){
								ids.push($(this).attr('data-entity-id') || 0);
							});
							
							params.callback.ok(ids);
							
							block.modal('hide');
							
						});
						
					});
					
					block.on('azbn7.entity.add', function(event, item){
						
						if(parseInt(select_l.attr('data-single'))) {
							
							select_l.empty();
							
						}
						
						var entity_id = parseInt(item.attr('data-entity-id'));
						select_l.find('[data-entity-id="' + entity_id + '"]')
							.empty()
							.remove()
						;
						
						item
							.clone()
							.appendTo(select_l)
						;
						
					});
					
					block.on('azbn7.entity.delete', function(event, item){
						
						item
							.empty()
							.remove()
						;
						
					});
					
					block.find('.azbn7-search-input[data-result]')
						.on('keyup.azbn7', function(event){
							event.preventDefault();
							
							var input = $(this);
							var result_id = input.attr('data-result');
							var result = $('.list-group[data-result="' + result_id + '"]');
							var val = input.val();
							
							if(val.length > 2) {
								
								Azbn7.api({
									method : 'entity/search',
									text : val,
									type : type,
								}, function(resp){
									
									if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
										
										result.empty();
										for(var i in resp.response.entities) {
											
											if(i < 8) {
												
												var item = resp.response.entities[i];
												
												(__genListItem(item)).appendTo(result);
												
											}
											
										}
										
									} else {
										
										result.empty();
										
									}
									
								});
								
							} else if(val.length == 0) {
								
								search_l.empty();
								
							}
							
						});
					
					block
						.on('click.azbn7', '.list-group .select-entity-add', {}, function(){
							event.preventDefault();
							
							var btn = $(this);
							
							block.trigger('azbn7.entity.add', [btn.closest('.list-group-item')])
						});
					
					block
						.on('click.azbn7', '.list-group .select-entity-delete', {}, function(){
							event.preventDefault();
							
							var btn = $(this);
							
							block.trigger('azbn7.entity.delete', [btn.closest('.list-group-item')])
						});
				
				}
				
			})();
			*/
			
			
			/*
			(function(){
				
				var block = $(container_class + ' .entity-select-block');
				
				if(block.length) {
					
					var single = parseInt(block.attr('data-single') || 0);
					var type = parseInt(block.attr('data-type') || 0);
					
					var select_l = block.find('.entity-select-list');
					
					var __getVal = function() {
						
						var __v;
						
						if(single) {
							
							__v = parseInt(block.find('.entity-select-value').val() || 0);
							
						} else {
							
							__v = JSON.parse(block.find('.entity-select-value').val());
							
						}
						
						return __v;
						
					};
					
					var __setVal = function(v) {
						
						var __v;
						
						if(single) {
							
							__v = parseInt(v[0] || 0);
							
						} else {
							
							__v = JSON.stringify(v);
							
						}
						
						block.find('.entity-select-value').val(__v);
						
					};
					
					var __genListItem = function(item) {
						
						var a = $('<div/>', {
							class : (single) ? 'col-xs-12' : 'col-sm-6 col-lg-4',
						})
						;
						
						var c = $('<div/>', {
							class : 'card ',
						})
							.attr('data-entity-id', item.entity.id)
							.appendTo(a)
						;
						
						$('<div/>', {
							class : 'card-header',
							html : item.entity.entity_type,
						})
							.appendTo(c)
						;
						
						var b = $('<div/>', {
							class : 'card-block ',
						})
							.appendTo(c)
						;
						
						$('<h4/>', {
							class : 'card-title entity-select-edit-title',
							html : item.item.title,
						})
							.appendTo(b)
						;
						
						return a;
					};
					
					block.on('azbn7.reinit', function(event, params){
						
						if(params.result && params.result.length) {
							
							select_l
								.empty()
							;
							
							__setVal(params.result);
							
							Azbn7.api({
								method : 'entity/search_by_id',
								text : '0,' + params.result.join(','),
								type : type,
							}, function(resp){
								
								if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
									
									for(var i in resp.response.entities) {
										
										var item = resp.response.entities[i];
										
										(__genListItem(item))
											.appendTo(select_l);
										
									}
									
								}
								
							});
							
						}
						
					});
					
					block.find('.entity-select-edit-btn').on('click.azbn7', function(event){
						event.preventDefault();
						
						var __v;
						
						if(!single) {
							__v = __getVal();
						} else {
							__v = [__getVal()];
						}
						
						$('.azbn7-select-entity')
							.modal()
							.trigger('azbn7.init', [{
								single : single,
								selected : __v,
								type : type,
								callback : {
									ok : function(result){
										
										block.trigger('azbn7.reinit', [{result : result}]);
										
									},
								}
							}])
						;
						
					});
					
					
					if(single) {
						
						block.trigger('azbn7.reinit', [{result : [__getVal()]}]);
						
					} else {
						
						block.trigger('azbn7.reinit', [{result : __getVal()}]);
						
					}
				
				}
				
			})();
			*/
			
			
			(function(){
				
				var block = $(container_class + ' .entity-autocomplete');
				
				if(block.length) {
					
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
						
						var val = input.text();
						
						if(val.length > 2) {
							
							Azbn7.api({
								method : 'entity/search',
								text : val,
								type : type,
							}, function(resp){
								
								if(resp && resp.response && resp.response.entities && resp.response.entities.length) {
									
									variant.empty();
									
									for(var i in resp.response.entities) {
										
										if(i < 8) {
											
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
								value.text('');
							}
							
						} else {
							
							value.text(JSON.stringify(res));
							
						}
						
						value.val(value.text());
						
					});
					
					block.on('azbn7.init', function(event){
						
						variant.empty();
						
						var res = []
						
						if(is_single) {
							res[0] = parseInt(value.val());
						} else {
							res = JSON.parse(value.val());
						}
						
						Azbn7.api({
							method : 'entity/search_by_id',
							text : '0,' + res.join(','),
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
						event.preventDefault();
						
						var btn = $(this);
						
						btn
							.empty()
							.remove()
						;
						
						block.trigger('azbn7.setValue');
						
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
					
				}
				
			})();
			
			
			
			
			
			(function(){
				
				/*
				$(document.body).Azbn7_AjaxUploader('dropping', {
					name : 'uploading_file',
					action : '/admin/upload/file/',
					callback : function(file, response, uploaded) {
						
						var json = JSON.parse(response);
						
						console.log(json);
						
					},
				});
				*/
				
				$(document.body).Azbn7_ImageMinimizer('dropping', {
					callback : function(data) {
						
						console.log(data.file.name);
						
						/*
						$(document.body).append(
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
				
				// imperavi redactor
				
				//$('.imperavi-redactor').redactor();
				
			})();
			
		}
		
	});
	
})(jQuery);