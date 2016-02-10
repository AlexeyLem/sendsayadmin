var AppAuth = angular.module('app.auth', [
    	'ui.router'
])

.run([
	
	'Auth',
	'$rootScope',

	function(AuthService,$rootScope) {
		_log('AppAuth run ...');
		$rootScope.isAuthenticated = AuthService.isAuthenticated();
	}
])

.controller('AuthCtrl', [
	
	'$scope',
	'$rootScope',
	'Auth',

	function($scope, $rootScope, AuthService) {
		
		$scope.loginModel = 'alexey';
		$scope.passwordModel = '';

		$scope.loginError = false;
		$scope.passwordError = false;

		$scope.Auth = function(event) {

			_log('$scope.Auth Call ...', $scope.loginModel, $scope.passwordModel );
			
			var noErrors = true;

			if($.trim($scope.loginModel) == '') {
				noErrors = false;
				$scope.loginError = true;
			}

			if($.trim($scope.passwordModel) == '') {
				noErrors = false;
				$scope.passwordError = true;
			}

			if(noErrors) {
				
				$scope.loginError = false;
				$scope.passwordError = false;


				AuthService.login({
					'login': $.trim($scope.loginModel),
					'password': $.trim($scope.passwordModel)
				});
			}

		};

		$scope.keyAuth = function(event) {

			if(event.keyCode == 13) { // Enter
				$scope.Auth();
			}else if(event.keyCode == 27) { // Esc
				// Something
			}

		};

	}
])

.factory('Auth', [
	'$http',
	'$q',
	'Api',

	 function($http, $q, Api) {

		var authenticatedUser = true;

		return {
			
			isAuthenticated: function() {
				return authenticatedUser;
			},

			login: function (inputs) {
				
				var deffered = $q.defer();

				Api.login({
					
					login: inputs.login,
					password: inputs.password
				
				}).success(function(data) {
					_log('Auth login success Data:', data);
					// authenticatedUser = inputs.login;
					deffered.resolve(data);

				}).error(function(data, status, header, config) {
					
					_log('Auth login error Data:', arguments);

					deffered.reject(data);

				});

				return deffered.promise;
			}
		}

	}
]);