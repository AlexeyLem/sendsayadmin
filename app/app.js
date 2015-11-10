'use strict';

var App = angular.module("app", [
	'app.sumstat',
	'ui.bootstrap',
	'ui.router'
])

.config([
	'$stateProvider',
	'$urlRouterProvider',
	'$locationProvider',
    function ($stateProvider,   $urlRouterProvider, $locationProvider) {

		_log('app config ...');

 		$locationProvider.html5Mode(true);
 		$urlRouterProvider
			.when('', '/sumstat/')
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
                    function ($http, $rootScope, $state, $stateParams) {

                        $rootScope.$state = $state;
                        $rootScope.$stateParams = $stateParams;

                        $rootScope.favorites = {};
                        
                        $rootScope.userList = {};
                        $rootScope.userOrder = [];
                        $rootScope.activeUsers = [];
                        $rootScope.blockedUsers = [];

                        return $http.get('sumstat.json').success(function(data) {

                            $.each(data, function(i, user) {
                                $rootScope.userOrder.push(user.ID);
                                $rootScope.userList[user.ID] = user;

                                if (user.BLOCKED=="0") {
                                    $rootScope.blockedUsers.push(user.ID);
                                }else{
                                    $rootScope.activeUsers.push(user.ID);
                                }

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