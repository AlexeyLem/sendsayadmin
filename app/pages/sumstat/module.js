'use strict';

 var AppSumstat = angular.module('app.sumstat', [
	'ui.router',
	'LocalStorageModule',
	'AppFilters'
])

.config([
	
	'$stateProvider',
	'$httpProvider',
	'$urlRouterProvider',
	'$locationProvider',
	'localStorageServiceProvider',

    function ($stateProvider, $httpProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {
    	_log('app.sumstat config ...');
    	
    	$urlRouterProvider.when('/sumstat/','/sumstat');
    	$httpProvider.defaults.useXDomain = true;
    	
    	$stateProvider
	    	.state('sumstat', {
	    		abstract: true,
				url: '/sumstat',
	    		template: '<div class="ui-main-conteiner" ui-view></div>',
	    		resolve:  [
	    			'$q',
	                '$http',
	                '$rootScope',
	                '$state',
	                '$stateParams',
	                'localStorageService',
	                function ($q, $http, $rootScope, $state, $stateParams, localStorageService) {
	                	

	                	$http.defaults.headers.put = {
					        'Access-Control-Allow-Origin': '*',
					        'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
					        'Access-Control-Allow-Headers': 'Content-Type, X-Requested-With'
				        };

				        $http.defaults.useXDomain = true;
				        
				        delete $http.defaults.headers.common['X-Requested-With'];

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

	                    _log('$rootScope.favoriteUsers', $rootScope.favoriteUsers);
	                    
	                    var _apiRequest_ = apiRequest({
	                    	"action": "account.sumstat"
	                    });

	                    _log();

	                    $http(_apiRequest_)

	                    .success(function(data) {

		                	    var len = Object.keys(data.list).length;
		                    	
		                    	$rootScope.userList = data;
		                    	$rootScope.userListLink = {};

		                    	_log('$rootScope.userList', Object.keys(data.list).length);

		                    	if(data.list && len) {

		                    		for(var key in data.list) {

			                            if (user.BLOCKED=="0") {
			                                $rootScope.blockedUsers.push(user.ID);
			                            }else{
			                                $rootScope.activeUsers.push(user.ID);
			                            }

		                    		}
			                        // _log('userListLink', $rootScope.userListLink );
		                    	}

		                    	$rootScope.$emit('changeUserList');
		                        deferred.resolve();
		                    })

		                    .error(function(data, status, headers, config) {

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
 ]);
