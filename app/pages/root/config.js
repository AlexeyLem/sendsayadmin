App.config([

'$stateProvider',
'$urlRouterProvider',
'$locationProvider',
'localStorageServiceProvider',

function ($stateProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {

	_log('App config ...');

	$locationProvider.html5Mode(true);
	localStorageServiceProvider.setPrefix('SA');
    // $httpProvider.defaults.useXDomain = true;
	// delete $httpProvider.defaults.headers.common["X-Requested-With"];

	// localStorageServiceProvider.setStorageType('localStorage');
    
	$urlRouterProvider
		.when('/', '/sumstat')
		.otherwise("/404");
    
}]);