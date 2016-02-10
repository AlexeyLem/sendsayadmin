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
	                   	$rootScope.userList_keyLink = {};
	                    $rootScope.activeUsers = [];
	                    $rootScope.blockedUsers = [];
						
						// Избранные пользовтели
	                    if(!$rootScope.localStorage.get('sumstat_favoriteUsers')) {
	                    	$rootScope.favoriteUsers = [];
	                    }else{
	                    	$rootScope.favoriteUsers = ($rootScope.localStorage.get('sumstat_favoriteUsers')).split(',');
	                    }

	                    var _listHandler = function(data) {

	                    	// _log('Api Request:', data);

	                    	var len = Object.keys(data.list).length,
	                    		uList = [];

	                    	$rootScope.userList = [];
	                    	$rootScope.userListLink = {};
	                    	$rootScope.userCount = len;

	                    	_log('$rootScope.userCount: '+ Object.keys(data.list).length);

	                    	if(data.list && len) {

	                    		for(var key in data.list) {
	                    			
	                    			var user = data.list[key];
	                    			
	                    			$rootScope.userList_keyLink[key] = uList.push(user) -1;

		                            if (user.BLOCKED=="0") {
		                                $rootScope.blockedUsers.push(user.ID);
		                            }else{
		                                $rootScope.activeUsers.push(user.ID);
		                            }

	                    		}

	                    		$rootScope.userList = uList;

	                    	}

	                    	$rootScope.$emit('changeUserList');

	                        deferred.resolve();
		                
		                };

						// _log('Api.request ...', Api);

						Api.request({

	                    	"action": "account.sumstat"
	                    
	                    }).then(_listHandler);
						
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
