App.factory('Api', ['$q', function($q) {
	
	var _apiUrl = 'https://test.sendsay.ru/admin/api/';

	return {
		
		_prepeareRequest: function(request) {

			return {
				"request": JSON.stringify(request),
	    		"apiversion": 100,
	            "json": 1
			};

		},
		
		hasError: function(responce) {

			return (isD(responce.errors) && responce.errors.length);
		
		},

		request: function(request, options) {
			
			options = options || {};

			// _log('Api.request DO ...');
			
			var self = this,
				_deffered = $q.defer(),
				_fullRequest = this._prepeareRequest(request),
				ajaxSettings = {
					/*
					beforeSend: function (xhr) {
					    xhr.setRequestHeader("Authorization", "Basic " + btoa("alexey:654174"));
					},
					*/
					url: _apiUrl,

					crossDomain: true,
					// contentType: false,
				    async: true,
				    cache: false,
				    dataType: 'json',

					global: true,
					
					method: options.method || 'post',
					data: _fullRequest,
					
					error: function(data) {

						// Handler for Server or Network Errors 
						_log('API ERROR: ', arguments);

					},

					success: function(data) {

						if(self.hasError(data)) {
							_deffered.reject(data);
						}else{
							_deffered.resolve(data);
						}
					
					},

					// "username": "alexey"
				};

			// _log("ajaxSettings:", ajaxSettings );

			$.ajax(ajaxSettings);
			
			return _deffered.promise;

			// return $http.post(_apiUrl+'api/', this._prepeareRequest(request));
		
		},

		login: function(options) {
			return $http({
				method: 'POST',
				url: _apiUrl +'api/', // '?AUTHLOGINadmin',
				data: {
					credential_0: options.login,
					credential_1: options.password
				}
			});
		}
	};

}])