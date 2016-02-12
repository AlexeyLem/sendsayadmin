
 // is Undefined
function isU(o) {
  return (typeof o == 'undefined');
}

// is defined
function isD(o) { 
  return (typeof o != 'undefined');
}

function _log() {
	
	var m = arguments.length;
	
	for (var i = 0; i < m; i += 1) {
		if (typeof arguments[i] == 'object') {
			console.dir(arguments[i]);
		} else {
			console.log(arguments[i]);
		}
	}

}
'use strict';

var App = angular.module("app", [

	// 'app.auth',
	'app.sumstat',
	'ui.bootstrap',
	'ui.router',
	'LocalStorageModule',
	'ngAnimate',
	'angularMoment'

]).run([

	'$rootScope',
	'$state',
	'$stateParams',
	'amMoment',
	
	function($rootScope, $state, $stateParams, amMoment) {

		_log('App run ...');

		$rootScope.$on('$stateChangeStart', 
			function(event, toState, toParams, fromState, fromParams, options) {
				_log('$stateChangeStart: ', arguments);
		});

		amMoment.changeLocale('ru');

		$rootScope.$state = $state;
		$rootScope.$stateParams = $stateParams;

		$rootScope.user = null;

	}
]);
var AppFilters = angular.module('AppFilters', []);
AppFilters.filter('sumstatPaginationFilter', function() {
    _log('sumstatpagination arguments:',arguments);
  return function(items, currentPage, itemsPerPage) {
    return items.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage - 1);
    // return input ? '\u2713' : '\u2718';
  };
});
App.config([

'$stateProvider',
'$urlRouterProvider',
'$locationProvider',
'localStorageServiceProvider',

function ($stateProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {

	_log('App config ...');

	$locationProvider.html5Mode(true);
	
	localStorageServiceProvider
		.setPrefix('SA');
	
	localStorageServiceProvider
		.setStorageType('localStorage');

    // $httpProvider.defaults.useXDomain = true;
	// delete $httpProvider.defaults.headers.common["X-Requested-With"];


	$urlRouterProvider
		.when('/', '/sumstat')
		.when('/sumstat/','/sumstat')
		.otherwise("/404");

}]);
App.controller('MainCtrl', [
	
	'$rootScope',
	'$state',
	'$stateParams',
	// 'Auth',
	'localStorageService',

	function($rootScope, $state, $stateParams, localStorageService) {

		$rootScope.windowTitle = "MyFirst Page in Angular";
	    // $rootScope.isAuthenticated = Auth.isAuthenticated();

}]);
App.controller('favoritesCtrl', [
    
    '$scope',
    '$rootScope',
    'SumstatFavorites',

    function ($scope, $rootScope, SumstatFavorites) {
/*
        $rootScope.sumstatFavoriteUsers = SumstatFavorites.getList();

        $rootScope.isFavoriteUser = function(id) {
            return SumstatFavorites.inList(id);
        };

        $scope.removeFromFavorites = function(id) {
        	
            _log('removeFromFavorites: '+id);
            SumstatFavorites.Remove(id);
        
        };

        $scope.$watch('sumstatFavoriteUsers', function() {

            _log('event', arguments);

        });

        // Изменение списка избранных

        $scope.$on('SumstatFavorites_Change', function(event, list) {

            // $rootScope.sumstatFavoriteUsers = list;
        
        });


        $scope.showDrop = function() {

        };

*/
        _log('favoritesCtrl ...');
    }
]);

App.controller('NavogationCtrl', [
	'$scope',
	'$location',
	function($scope, $location) {
		
		_log('NavogationCtrl ...');
		
		$scope.mainMenu = [
			{
				name: 'Sumstat',
				icon: 'glyphicon glyphicon-signal',
				path: '/sumstat/',
				state: 'sumstat.list'
			},
			{
				name: 'Delivstat',
				path: '/delivstat/',
				state: 'delivstat.list',
				icon: 'glyphicon glyphicon-pencil'
			},
			{
				name: 'Payment',
				path: '/payment/',
				state: 'payment.list',
				icon: 'glyphicon glyphicon-euro'
			},
			{
				name: 'Tarif',
				path: '/tarif/',
				state: 'tarif.list',
				icon: 'glyphicon glyphicon-briefcase'
			},
			{
				name: 'Sending',
				path: '/sending/',
				state: 'sending.list',
				icon: 'glyphicon glyphicon-envelope'
			}
		];
		
		$scope.$watchCollection('mainMenu', function() {

			_log('Performe RUN: '+ $('#left-panel').length);

			$('#left-panel').css({
				left: -80,
				opacity: 0.25
			}).animate({
				left: 0,
				opacity: 1
			},500);
		
		});

		// $scope.defaultSearchSection = 0;
}])
App.controller('TopSearchCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    '$location',
    function($scope, $state, $rootScope, $location) {
/*
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

	$scope.doSearch = function(str) {
		if($scope.searchSection == 0) {
			
		}
	};

	$scope.$watch('searchInput', function(data) {
		_log('searchInput', data);
	});

    $scope.searchSection = 0;

    $scope.setSection = function(event, index) {
        $scope.searchSection = index;
        event.preventDefault();
        _log('setSection arguments:', arguments);
    };
*/
}])
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

    function ($stateProvider, $httpProvider, $urlRouterProvider, $locationProvider) {

    	_log('app.sumstat config ...');
    	$stateProvider
	    	.state('sumstat', {
	    		abstract: true,
				url: '/sumstat',
	    		template: '<div class="ui-main-conteiner" ui-view></div>',
	    		resolve:  [
	    			
	    			"$q",
	                "$rootScope",
	                "$state",
	                "$stateParams",
	                // "Api",

	                function ($q, $rootScope, $state, $stateParams) {
	                	/*
	                	var deferred = $q.defer();

	                	_log('AppSumstat base state resolve ... ');

				        $rootScope.userList = [];
	                   	$rootScope.userList_keyLink = {};
	                    $rootScope.activeUsers = [];
	                    $rootScope.blockedUsers = [];
						
	                    var _listHandler = function(data) {

	                    	_log('Api Request:', data);

	                    	var len = Object.keys(data.list).length,
	                    		uList = [];

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

						_log('Api.request ...', Api);

						Api.request({

	                    	"action": "account.sumstat"
	                    
	                    }).then(_listHandler);
						
	                    return deferred.promise;
	                */
	                }
	            ]
	    	})
	    	
	    	.state('sumstat.list', {
	    		url: '',
	    		templateUrl: 'pages/sumstat/list/template.html',
	    		controller: 'SumstatListCtrl'
	    	})

	    	.state('sumstat.view', {
	    		abstract: true,
	    		url: '/view/:userId',
	    		templateUrl: 'pages/sumstat/user_view/template.html',
	    		controller: [
				    '$scope',
				    '$stateParams',
				    function ($scope, $stateParams) {
					    var index = $scope.userList_keyLink[$stateParams.userId];
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

(function() {

function SumstatListCtrl($scope, $rootScope, $location ) { // 
/*
    $scope.userCount = $rootScope.userList.length;
    $scope.currentPage = $location.search().page || 1;
    $scope.sortType = $location.search().sortType || 'ID';
    $scope.sortReverse = $location.search().sortReverse || false;

    $scope.showAdvCols = {};

    $scope.tableCols = [
        { key: 'manager', name: 'Менеджер', 'checked': 0 },
        { key: 'seller', name: 'Продавец', 'checked': 0 },
        { key: 'tarif', name: 'Тариф', 'checked': 0 },
        { key: 'adress', name: 'Адрес', 'checked': 0 },
        { key: 'lastIssue', name: 'Последний выпуск', 'checked': 0 },
        { key: 'memberCount', name: 'Адресов в базе', 'checked': 0 }
    ];

    angular.forEach($scope.tableCols , function(value, key) {
        $scope.showAdvCols[value.key] = 0;
    });

    // BEGIN Functions 

    $scope.changeSort = function(type) {
        $scope.sortReverse = ($scope.sortType != type? 0: !$scope.sortReverse )
        $scope.sortType = type;
    }

    $scope.favoriteUser = function(event, id) {
        
        if(SumstatFavorites.inList(id)) {
            SumstatFavorites.Remove(id);    
        }else{
            SumstatFavorites.Add(id);   
        }            

    };
    
    $scope.pageChanged = function(currentPage) {

        $scope.currentPage = currentPage;
        $location.search('page', currentPage);
    
    };

    $scope.checkOnDrop = function(event, key) {

        var item = $(event.currentTarget).parents('.ui-table-dropdown-item'),
            isChecked = event.currentTarget.checked;
        
        item[(isChecked?'add':'remove')+'Class']('ui-table-dropdown-checked');
    };

    // END Functions
    */

    // BEGIN Watchers & Listeners
    /*
    $scope.$watch('sortType', function() {
        $location.search('sortType', $scope.sortType);
    });

    $scope.$watch('sortReverse', function() {
        $location.search('sortReverse', $scope.sortReverse?1:null);
    });
    
    $rootScope.$on('changeUserList', function() {
        $scope.userCount = Object.keys($rootScope.userList).length;
    });
    */
    // END Watchers & Listeners
}

AppSumstat
    .controller('SumstatListCtrl', [
        '$scope',
        '$rootScope',
        '$location',
        // 'Api',
        //'SumstatFavorites',
        SumstatListCtrl
    ]);


})();
AppSumstat
.controller('SumstatUserViewCtrl', [
    
    '$scope',
    '$rootScope',
    '$stateParams',
    '$location',

    function ($scope, $rootScope, $stateParams, $location) {
    	/*
        _log('$stateParams.userId: ' + $stateParams.userId);
        
        var userIndex = $rootScope.userList_keyLink[$stateParams.userId];

	    $scope.user = $rootScope.userList[userIndex];

        _log('$scope.user: ', _.extend({}, $scope.user));

        
	    $scope.userJSON = JSON.stringify($scope.user)
	    	.replace(/\,/ig,",\n")
	    	.replace(/\{/ig,"{\n")
	    	.replace(/\}/ig,"\n}");
	    */
    }]);