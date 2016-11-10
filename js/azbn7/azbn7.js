/*
Прослойка для работы с Azbn7 API
Требуется подключение jQuery
*/

window.Azbn7 = {

	config:{
		url : '/api/',
		key : 'public',
		method : 'version',
	},
	
	API:function(params, cb) {
		params.key = this.config.key;
		
		if(params.method) {
			
		} else {
			params.method = this.config.method;
		}
		
		$.ajax({
			url: this.config.url,
			type: 'POST',
			dataType: 'json',
			data: params,
			success: function(resp) {
				console.log('Azbn7 API response to: ' + params.method);
				cb(resp);
			}
		});
	},
	
};
