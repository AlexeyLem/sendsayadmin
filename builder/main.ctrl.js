App.controller('MainCtrl', [
	
	'$rootScope',
	'$state',
	'$stateParams',
	'Auth',
	'localStorageService',

	function($rootScope, $state, $stateParams, Auth, localStorageService) {

		$rootScope.windowTitle = "MyFirst Page in Angular";
	    //$rootScope.isAuthenticated = Auth.isAuthenticated();

}]);