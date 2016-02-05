App.controller('MainCtrl', [
	
	'$rootScope',
	'$state',
	'$stateParams',
	'Auth',
	'localStorageService',

	function($rootScope, $state, $stateParams, Auth, localStorageService) {

		$rootScope.windowTitle = "MyFirst Page in Angular";

		$rootScope.$state = $state;
	    $rootScope.$stateParams = $stateParams;
	    $rootScope.localStorage = localStorageService;

	    $rootScope.isAuthenticated = Auth.isAuthenticated();

}]);