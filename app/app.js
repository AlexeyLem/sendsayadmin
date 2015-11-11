'use strict';

var App = angular.module("app", [
	'app.sumstat',
	'ui.bootstrap',
	'ui.router',
	'LocalStorageModule'
])

.config([
	'$stateProvider',
	'$urlRouterProvider',
	'$locationProvider',
	'localStorageServiceProvider',
    function ($stateProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {

		_log('app config ...');

 		$locationProvider.html5Mode(true);
 		
 		localStorageServiceProvider.setPrefix('SA');
 		// localStorageServiceProvider.setStorageType('localStorage');

 		$urlRouterProvider
			.when('/', '/sumstat/')
			.otherwise("/404/");

		$stateProvider
			.state("home", {
                abstract: true,
                template: '<div ui-view></div>',
                resolve:  [
                    '$http',
                    '$rootScope',
                    '$state',
                    '$stateParams',
                    'localStorageService',
                    function ($http, $rootScope, $state, $stateParams, localStorageService) {

                        $rootScope.$state = $state;
                        $rootScope.$stateParams = $stateParams;
                        
                        _log('localStorageService.isSupported', localStorageService.isSupported);
                        _log('localStorageService:', localStorageService.get('favoriteUsers'));

                        $rootScope.localStorage = localStorageService;

                        if(!localStorageService.get('favoriteUsers')) {
                        	$rootScope.favoriteUsers = '';
                        }else{
                        	$rootScope.favoriteUsers = localStorageService.get('favoriteUsers');
                        }
                        

                       	_log(' ---- $rootScope.favoriteUsers:', $rootScope.favoriteUsers);

                        $rootScope.userList = {};
                        $rootScope.userOrder = [];
                        $rootScope.activeUsers = [];
                        $rootScope.blockedUsers = [];

                        return $http.get('sumstat.json').success(function(data) {
                        	
                        	var _data = data.slice(0,50);

                            $rootScope.userOrder = _data.map(function(user) {
                            	
                            	$rootScope.userList[user.ID] = user;

                                if (user.BLOCKED=="0") {
                                    $rootScope.blockedUsers.push(user.ID);
                                }else{
                                    $rootScope.activeUsers.push(user.ID);
                                }
                                return user.ID;
                            });
                            
                            $rootScope.$emit('changeUserList');
                        });
                    }
                ]
			});
		
		// localStorageServiceProvider.setStorageType('localStorage');
		
}])

.controller('MainCtrl', [
	'$rootScope',
	function($rootScope) {
		$rootScope.windowTitle = "MyFirst Page in Angular";
}])

.controller('NavogationCtrl', [
	'$scope',
	'$location',
	function($scope, $location) {
		
		_log('NavogationCtrl ...');
		
		$scope.mainMenu = [
			{
				name: 'Sumstat',
				path: '/sumstat/'
			},
			{
				name: 'Devilstat',
				path: '/delivstat/'
			},
			{
				name: 'Payment',
				path: '/payment/'
			},
			{
				name: 'Tarif',
				path: '/tarif/'
			},
			{
				name: 'Sending',
				path: '/sending/'
			}
		];
		
		// $scope.defaultSearchSection = 0;
}])

.controller('TopSearchCtrl', [
    '$scope',
    '$location',
    function($scope, $location) {

	_log('topSearchCtrl ...');

	$scope.searchlist = [
		{
			'name': 'chrights',
			'code': 'chrights'
		},
		{
			'name': 'Defer',
			'code': 'defer'
		},
		{
			'name': 'Chenv',
			'code': 'chenv'
		}
	];

    $scope.searchSection = 0;
    $scope.setSection = function(event, index) {
        $scope.section = index;
        event.preventDefault();
        _log('setSection arguments:', arguments)
    };
}]);


function _log() {
	var m = arguments.length;
	for (var i = 0; i < m; i += 1) {
		if (typeof arguments[i] == 'object') {
			console.dir(arguments[i]);
		} else {
			console.log(arguments[i]);
		}
	}
};