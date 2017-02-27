(function($){
	
	if($.Azbn7) {
		
		(function(){
			
			var _ = function(){
				
				var ctrl = this;
				
				ctrl.name = 'codecache';
				ctrl.uid = 'azbn7__mdl__codecache';
				
				ctrl.__intervals = {};
				ctrl.config = {
					expires_in : 3600,
					update_or_expires : 300,
				};
				
				ctrl.remove = function(uid) {
					$.Azbn7.ls.remove(uid);
				};
				
				ctrl.download = function(code, reload_in_body, cb) {
					
					reload_in_body = reload_in_body || false;
					
					$.ajax(code.url, {
						type : 'GET',
						dataType : 'text',
						success : function(data){
							
							var _code = {
								tag : code.tag,
								uid : code.uid,
								url : code.url,
								expires : $.Azbn7.now_sec() + (code.expires_in || ctrl.config.expires_in),
								expires_in : code.expires_in,
								html : '<' + code.tag + '>' + data + '</' + code.tag + '>',
							};
							
							$.Azbn7.ls.obj2s(code.uid, _code);
							
							$('.' + ctrl.uid + '[data-' + ctrl.uid + '-uid="' + code.uid + '"]').attr('data-' + ctrl.uid + '-expires-in', code.expires_in);
							
							if(reload_in_body) {
								ctrl.eval(_code, true, cb);
							}
							
						},
					});
					
				};
				
				ctrl.doUpdate = function(interval) {
					
					interval = interval || 60000;
					
					ctrl.__intervals.codecache = setInterval(function(){
						
						var items = $('.' + ctrl.uid);
						items.each(function(index){
							
							var item = $(this);
							var uid = item.attr('data-' + ctrl.uid + '-uid') || '';
							
							var code = $.Azbn7.ls.s2obj(uid);
							
							if(code) {
								
								var _period = code.expires - $.Azbn7.now_sec();
								
								item.attr('data-' + ctrl.uid + '-expires-in', _period);
								
								if(_period > 0) {
									
									if(_period < ctrl.config.update_or_expires) {
										ctrl.download(code, false);
									}
									
								} else {
									
									ctrl.download(code, false);
									
								}
								
							}
							
						})
						
					}, interval);
					
				};
				
				ctrl.eval = function(code, updated, cb) {
					
					var el = $(code.html);
					el
						.attr('id', ctrl.name + '-' + $.Azbn7.randstr())
						.attr('class', ctrl.uid)
						.attr('data-' + ctrl.uid + '-expires-in', code.expires - $.Azbn7.now_sec())
						.attr('data-' + ctrl.uid + '-uid', code.uid)
						.attr('data-' + ctrl.uid + '-from-url', updated)
						//.appendTo($(document.body))
					;
					if(cb) {
						cb(el);
					}
					
				};
				
				ctrl.load = function(item, cb) {
					
					var newcode = $.extend({}, {
						tag : '!--',
						uid : 'codecache.html.default',
						url : '',
						expires : $.Azbn7.now_sec() + (item.expires_in || ctrl.config.expires_in),
						expires_in : 3600,
						html : '',
					}, item);
					
					var code = $.Azbn7.ls.s2obj(newcode.uid);
					
					if(code) {
						
						code.expires_in = newcode.expires_in;
						
						if((code.expires > $.Azbn7.now_sec())) {
							ctrl.eval(code, false, cb);
						} else {
							ctrl.download(newcode, true, cb);
						}
						
					} else {
						
						ctrl.download(newcode, true, cb);
						
					}
					
				};
				
				return ctrl;
				
			};
			
			$.Azbn7.load('CodeCache', new _());
			
			$.Azbn7.mdl('CodeCache').doUpdate(10 * 1000);
			
		})();
		
	}
	
})(jQuery);