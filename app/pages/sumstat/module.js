'use strict';

 var AppSumstat = angular.module('app.sumstat', [
	'ui.router',
	'LocalStorageModule',
	'AppFilters'
])

.config([
	'$stateProvider',
	'$urlRouterProvider',
	'$locationProvider',
	'localStorageServiceProvider',
    function ($stateProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {
    	_log('app.sumstat config ...');
    	
    	$urlRouterProvider.when('/sumstat/','/sumstat');

    	$stateProvider
	    	.state('sumstat', {
	    		abstract: true,
				url: '/sumstat',
	    		template: '<div class="ui-main-conteiner container-fluid" ui-view></div>',
	    		resolve:  [
	    			'$q',
	                '$http',
	                '$rootScope',
	                '$state',
	                '$stateParams',
	                'localStorageService',
	                function ($q, $http, $rootScope, $state, $stateParams, localStorageService) {
	                	
	                	var deferred = $q.defer();

	                    $rootScope.$state = $state;
	                    $rootScope.$stateParams = $stateParams;
	                    $rootScope.localStorage = localStorageService;

	                   	$rootScope.userList = [];
	                    $rootScope.activeUsers = [];
	                    $rootScope.blockedUsers = [];
						
						// Избранные пользовтели
	                    if(!localStorageService.get('favoriteUsers')) {
	                    	$rootScope.favoriteUsers = [];
	                    }else{
	                    	$rootScope.favoriteUsers = (localStorageService.get('favoriteUsers')).split(',');
	                    }

	                    $rootScope.isFavoriteUser = function(id) {
	                    	return ($.inArray(id, $rootScope.favoriteUsers)!=-1);
	                    };

	                    // Удаление пользователя из избранных
	                    $rootScope.$on('removeFromFavorites', function(event, user) {
	                    	var index = $.inArray(user.ID, $rootScope.favoriteUsers);
	                    	if(index!=-1) {
	                    		$rootScope.favoriteUsers.splice(index,1);
	                    		localStorageService.set('favoriteUsers', $rootScope.favoriteUsers.join(','))
	                    	}
	                    });
	                    _log('$rootScope.favoriteUsers',$rootScope.favoriteUsers);
	                    $http.get('sumstat.json').success(function(data) {
	                    	
	                    	$rootScope.userList = data;
	                    	$rootScope.userListLink = {};

	                    	_log('$rootScope.userList', $rootScope.userList.length);

	                        data.forEach(function(user, i) {
	                        	
	                        	$rootScope.userListLink[user.ID] = i;

	                            if (user.BLOCKED=="0") {
	                                $rootScope.blockedUsers.push(user.ID);
	                            }else{
	                                $rootScope.activeUsers.push(user.ID);
	                            }

	                        });
	                        
	                        // _log('userListLink', $rootScope.userListLink );

	                        $rootScope.$emit('changeUserList');

	                        deferred.resolve();
	                    });

	                    return deferred.promise;
	                }
	            ]
	    	})
	    	
	    	.state('sumstat.list', {
	    		url: '',
	    		templateUrl: 'pages/sumstat/list/template.html',
	    		controller: 'SumstatListCtrl',
	    	})

	    	.state('sumstat.view', {
	    		abstract: true,
	    		url: '/view/:userId',
	    		templateUrl: 'pages/sumstat/user_view/template.html',
	    		controller: [
				    '$scope',
				    '$stateParams',
				    function ($scope, $stateParams) {
					    var index = $scope.userListLink[$stateParams.userId];
        				$scope.user = $scope.userList[index];
				    }]
	    	})

	    	.state('sumstat.view.detail', {
	    		url: '',
	    		templateUrl: 'pages/sumstat/user_view/card/template.html',
	    		controller: 'SumstatUserViewCtrl'
	    	});
    }
 ])
