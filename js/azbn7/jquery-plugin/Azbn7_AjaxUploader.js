/*
jquery-плагин
ajax-загрузки файлов на сервер
*/ 
(function($){
	
	//var body = $(document.body);
	
	// Пилюля от слабоумия для Chrome, который портит файлы в процессе загрузки.
	if (!XMLHttpRequest.prototype.sendAsBinary) {
		XMLHttpRequest.prototype.sendAsBinary = function(datastr) {
			function byteValue(x) {
				return x.charCodeAt(0) & 0xff;
			}
			var ords = Array.prototype.map.call(datastr, byteValue);
			var ui8a = new Uint8Array(ords);
			this.send(ui8a.buffer);
		}
	}
	
	var defaults = {
		plugin : {
			name : 'Azbn7_AjaxUploader',
			version : '0.1',
			mod_date : '24/11/2016 00:15'
		},
		strings : {
			//press_me:'<center>Перетащите файлы на меня или нажмите для их выбора</center>',
			error_no_filereader : '<center>Не поддерживается браузером</center>',
		},
		action : '/',
		name : 'filename',
		callback : function(str){alert(str);}
	};
	
	var uploadFile = function(el, file, name, action, callback) {
		
		var reader = new FileReader();
		
		reader.onload = function() {
			
			var xhr = new XMLHttpRequest();
			
			xhr.upload.addEventListener('progress', function(e) {
				if (e.lengthComputable) {
					/* вычисление процента загрузки */
					
					var percent = parseInt((e.loaded * 100) / e.total);
					
				}
			}, false);
			
			xhr.onreadystatechange = function () {
				if (this.readyState == 4) {
					
					if(this.status == 200) {
						/* окончание загрузки */
						
						var counter = el.data(defaults.plugin.name + '-counter');
						counter++;
						el.data(defaults.plugin.name + '-counter', counter);
						
						callback(file, this.responseText, counter);
						
					} else {
						/* ошибка */
						//el.html('Произошла ошибка!');
						//el.css(styles.error);
						
					}
				
				}
			};
			
			xhr.open("POST", action);
			var boundary = "xxxxxxxxx";
			xhr.setRequestHeader("Content-Type", "multipart/form-data, boundary=" + boundary);
			xhr.setRequestHeader("Cache-Control", "no-cache");
			
			var body = "--" + boundary + "\r\n";
			body += "Content-Disposition: form-data; name='" + name + "'; filename='" + unescape(encodeURIComponent(file.name)) + "'\r\n";
			body += "Content-Type: application/octet-stream\r\n\r\n";
			body += reader.result + "\r\n";
			body += "--" + boundary + "--";
			
			if(xhr.sendAsBinary) {
				// firefox
				xhr.sendAsBinary(body);
			} else {
				// chrome (спецификация W3C)
				xhr.send(body);
			}
			
		};
		
		reader.readAsBinaryString(file);
		
	};
	
	var uploadFilesFromInput = function(el, files, name, action, callback) {
		
		//el.css(styles.drop);
		
		$.each(files, function(i, file) {
			
			uploadFile(el, file, name, action, callback);
			
		});
		
		return false;
		
	}
	
	var methods = {
		
		drop : function(params) {
			
			if (typeof(window.FileReader) == 'undefined') {
				
			} else {
				
				var options = $.extend({}, defaults, params);
				
				var el = $(this);
				
				el.data(defaults.plugin.name + '-options', options);
				el.data(defaults.plugin.name + '-counter', 0);
				
				el
					.on('dragover', false) 
					.on('drop', function(event) {
						
						for (var i = 0, f; f = event.originalEvent.dataTransfer.files[i]; i++) {
							
							var file = event.originalEvent.dataTransfer.files[i];
							uploadFile(el, file, options.name, options.action, options.callback);
							
						}
						
						return false;
					});
				
			}
			
			return this;
			
		},
		
		upload : function(params) {
			
			if (typeof(window.FileReader) == 'undefined') {
				
			} else {
				
				var options = $.extend({}, defaults, params);
				this.data(defaults.plugin.name, options);
					
				// доступ к объекту через $(this)
				/*
				options={
					action
					name
					callback
					}
				*/
				
				var el = $(this);
				
				el.data(defaults.plugin.name + '-options', options);
				el.data(defaults.plugin.name + '-counter', 0);
				//el.css(styles.base);
				//el.html(defaults.strings.press_me);
				
				
				/*
				el[0].ondragover = function() {
					
					//el.css(styles.hover);
					return false;
					
				};
				
				el[0].ondragleave = function() {
					
					//el.css(styles.default);
					return false;
					
				};
				
				el[0].ondrop = function(event) {
					
					//el.css(styles.drop);
					
					for (var i = 0, f; f = event.dataTransfer.files[i]; i++) {
						
						var file = event.dataTransfer.files[i];
						uploadFile(el, file, options.name, options.action, options.callback);
						
					}
					
					return false;
					
				};
				*/
				
				/*
				el.on('drop.azbn7.ajaxuploader', function(event) {
					event.preventDefault();  
					event.stopPropagation();
					alert('Dropped!');
				});
				*/
				
				el.one(defaults.plugin.name + '.upload', function(event){
					//event.preventDefault();
					
					var uploadfile;
					
					uploadfile = $('<input/>', {
						name : options.name,
						type : 'file',
						multiple : 'multiple',
						css : {
							'display':'none',
						},
						id : defaults.plugin.name + '-uploadfile',
					})
						.appendTo($(document.body))
						.bind('change.' + defaults.plugin.name, function(){
							
							uploadFilesFromInput(el, this.files, options.name, options.action, options.callback);
							
							uploadfile.unbind('change.' + defaults.plugin.name);
							uploadfile.remove();
							
						});
						
					uploadfile.trigger('click.' + defaults.plugin.name);
					
					return false;
					
				});
				
				el.trigger(defaults.plugin.name + '.upload');
				
				/*
				el[0].onclick = function(event) {
					
					//el.css(styles.drop);
					
					
					
				};
				*/
				
			}
			
			
			return this;
		
		},
		
	};
	
	$.fn.Azbn7_AjaxUploader = function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments, 1));
		} else if(typeof method === 'object' || !method) {
			return methods.upload.apply(this, arguments);
		} else {
			$.error('Метод ' + method + ' в плагине не найден!');
		}
	};
	
})(jQuery);

