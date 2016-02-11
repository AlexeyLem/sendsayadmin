App.config([

'$stateProvider',
'$urlRouterProvider',
'$locationProvider',
'localStorageServiceProvider',

function ($stateProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {

	_log('App config ...');

	$locationProvider.html5Mode(true);
	
	localStorageServiceProvider
		.setPrefix('SA');
	
	localStorageServiceProvider
		.setStorageType('localStorage');

    // $httpProvider.defaults.useXDomain = true;
	// delete $httpProvider.defaults.headers.common["X-Requested-With"];
    
	// Здесь мы будем проверять авторизацию
	/*
	$rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
		
		_log('Event $stateChangeStart ... ');

		Auth.checkAccess(event, toState, toParams, fromState, fromParams);
	});
	*/

	$urlRouterProvider
		.when('/', '/sumstat')
		.otherwise("/404");
    
}]);