'use strict';

angular.module("app", [
	'app.sumstat',
	'ui.bootstrap',
	'ui.router'
])
.run([
	'$rootScope',
	'$state',
	'$stateParams',
	'$http',
    function ($rootScope,   $state,   $stateParams, $http) {
	    // It's very handy to add references to $state and $stateParams to the $rootScope
	    // so that you can access them from any scope within your applications.For example,
	    // <li ng-class="{ active: $state.includes('contacts.list') }"> will set the <li>
	    // to active whenever 'contacts.list' or one of its decendents is active.
	    $rootScope.$state = $state;
	    $rootScope.$stateParams = $stateParams;

	    $rootScope.favorites = {};
		
		$rootScope.userList = {};
		$rootScope.userOrder = [];
		$rootScope.activeUsers = [];
        $rootScope.blockedUsers = [];

        $http.get('sumstat.json').success(function(data) {

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
				url: '/',
				template: 'Hello! go to <a href="/sumstat/">Sumstat</a>'
			});

			/*
				views: {
					'top_search': {
						templateUrl: 'pages/topSearch.html',
						controller: 'topSearchCtrl'
					},
					'favorits': {
						templateUrl: 'pages/favorits.html',
						controller: 'favoritesCtrl'
					},
					'navigation': {
						templateUrl: 'pages/navigation.html',
						controller: 'NavogationCtrl'
					},
					"content": {
						templateUrl: 'pages/content.html',
						controller: 'contentCtrl'
					}
				}
			*/
		
		// localStorageServiceProvider.setStorageType('localStorage');
		
}]).controller('MainCtrl', [
	'$scope',
	'$location',
	'$rootScope',
	'$http',
	function($scope, $location, $rootScope, $http) {
		_log('MainCtrl ...');
		$scope.title = "MyFirst Page in Angular";

}])
.controller('NavogationCtrl', [
	'$scope',
	'$location',
	function($scope, $location) {
		
		_log('NavogationCtrl ...');
		
		$scope.mainMenu = [
			{
				name: 'Sumstat',
				path: '/sumstat'
			},
			{
				name: 'Devilstat',
				path: '/delivstat'
			},
			{
				name: 'Payment',
				path: '/payment'
			},
			{
				name: 'Tarif',
				path: '/tarif'
			},
			{
				name: 'Sending',
				path: '/sending'
			}
		];
		
		// $scope.defaultSearchSection = 0;
}])

.controller('topSearchCtrl', ['$scope', '$location', function($scope, $location) {

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
}])

.controller('favoritesCtrl', [
	'$scope',
	'$rootScope',
	function ($scope, $rootScope) {
		_log('favoritesCtrl ...');
		$scope.favList = ['abg','abtoys'];

		$rootScope.$on('changeUserList', function(data) {

			$scope.favoritUsers = {};

			$.each($scope.favList, function(i, id) {
				$scope.favoritUsers[id] = $rootScope.userList[id];
			});
		});
		
		// $scope.
		/* >>>>>>>>>>>>>
		$scope.favoritUsers = localStorageService.get('favoritUsers');
		
		$scope.$watch('favoritUsers', function(value) {
			_log('$watch:favoritUsers value:', value);
			localStorageService.set('favoritUsers',value);
		});
		*/
		// <<<<<<<<<<<<<

		$rootScope.$on('addToFavorites', function(event, data) {

			_log('Event saFavorites > addToFavorites:', data);

			if(typeof $scope.favoritUsers[data.id] == 'undefined') {
				 $scope.favoritUsers[data.id] = $rootScope.userList[data.id];
			}

		});
		
		_log('favoritesCtrl ...');
	}
]).filter('sumstatpagination', function() {
    _log('sumstatpagination arguments:',arguments);
  return function(input) {
    _log('arguments:',arguments);
    return input;
    // return input ? '\u2713' : '\u2718';
  };
});



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