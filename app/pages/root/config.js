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


	$urlRouterProvider
		.when('/', '/sumstat')
		.when('/sumstat/','/sumstat')
		.otherwise("/404");

}]);