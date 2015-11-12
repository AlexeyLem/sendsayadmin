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
			.when('/', '/sumstat')
			.otherwise("/404");

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
                        $rootScope.localStorage = localStorageService;

                       	$rootScope.userList = {};
                        $rootScope.userOrder = [];
                        $rootScope.activeUsers = [];
                        $rootScope.blockedUsers = [];

                        // Избранные пользовтели
                        if(!localStorageService.get('favoriteUsers')) {
                        	$rootScope.favoriteUsers = [];
                        }else{
                        	$rootScope.favoriteUsers = (localStorageService.get('favoriteUsers')).split(',');
                        }
                        
                        $rootScope.isFavoriteUser = function(id) {
                        	return ($.inArray(id,$rootScope.favoriteUsers)!=-1);
                        };

                        // Удаление пользователя из избранных
                        $rootScope.$on('removeFromFavorites', function(event, user) {
                        	var index = $.inArray(user.ID, $rootScope.favoriteUsers);
                        	_log('$rootScope.favoriteUsers', $rootScope.favoriteUsers)
                        	_log('user.ID: '+user.ID)
                        	_log('removeFromFavorites index: '+index)
                        	if(index!=-1) {
                        		$rootScope.favoriteUsers.splice(index,1);
                        		localStorageService.set('favoriteUsers',$rootScope.favoriteUsers.join(','))
                        	}
                        });

                        return $http.get('sumstat.json').success(function(data) {
                        	
                            $rootScope.userOrder = data.map(function(user) {
                            	
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
				icon: 'glyphicon glyphicon-signal',
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
}])

.controller('favoritesCtrl', [
    '$scope',
    '$rootScope',
    function ($scope, $rootScope) {

        $scope.removeFromFavorites = function(id) {
        	_log('removeFromFavorites: '+id)
            $scope.$emit('removeFromFavorites', { ID: id });
        };

        $scope.showDrop = function() {

        };

        $scope.$on('favoriteUserChange', function(event, data) {

            var list = $scope.favoriteUsers,
            	index = $.inArray(data.ID, list);

            if(index == -1) {
                list.push(data.ID);
            }else{
               delete list[index];
            }
			
			$scope.localStorage.set('favoriteUsers', list.join(','));
        });
        
        _log('favoritesCtrl ...');
    }
]);


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