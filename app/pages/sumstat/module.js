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

    	$stateProvider
	    	.state('sumstat', {
	    		abstract: true,
				url: '/sumstat',
	    		template: '<div class="ui-main-conteiner" ui-view></div>',
	    		resolve:  [
	    			
	    			'$q',
	                'Api',
	                '$rootScope',
	                '$state',
	                '$stateParams',
	                'localStorageService',

	                function ($q, Api, $rootScope, $state, $stateParams, localStorageService) {
	                	
	                	var deferred = $q.defer();

				        // _log('$http.defaults.headers:', $http.defaults.headers);

	                   	$rootScope.userList = [];
	                    $rootScope.activeUsers = [];
	                    $rootScope.blockedUsers = [];
						
						// Избранные пользовтели
	                    if(!$rootScope.localStorage.get('favoriteUsers')) {
	                    	$rootScope.favoriteUsers = [];
	                    }else{
	                    	$rootScope.favoriteUsers = ($rootScope.localStorage.get('favoriteUsers')).split(',');
	                    }

	                    $rootScope.isFavoriteUser = function(id) {
	                    	return ($.inArray(id, $rootScope.favoriteUsers)!=-1);
	                    };

	                    // Удаление пользователя из избранных
	                    $rootScope.$on('removeFromFavorites', function(event, user) {
	                    	var index = $.inArray(user.ID, $rootScope.favoriteUsers);
	                    	if(index!=-1) {
	                    		$rootScope.favoriteUsers.splice(index,1);
	                    		$rootScope.localStorage.set('favoriteUsers', $rootScope.favoriteUsers.join(','))
	                    	}
	                    });

	                    _log('$rootScope.favoriteUsers', $rootScope.favoriteUsers);

	                    var _listHandler = function(data) {
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
		                    };

						_log('Api.request ...', Api);

						Api.request({

	                    	"action": "account.sumstat"
	                    
	                    }).then(function(data) {

 							_log('Api Request:', data);

						});

						/*
	                    $http.post(apiPath(), _apiRequest_)
	                    
	                    .success(function(data) {

		                	    
		                    })

		                 .error(function(data, status, headers, config) {

		                    });
		                 */
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
