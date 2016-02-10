'use strict';

var App = angular.module("app", [
	
	'app.sumstat',
	'ui.bootstrap',
	'ui.router',
	'LocalStorageModule',
	'ngAnimate',
	'angularMoment'

]).run(['amMoment',function(amMoment) {
	amMoment.changeLocale('ru');
}]);


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

function apiPath() {

	return 'https://test.sendsay.ru/admin/api/';

}

function apiRequest(a) {

	return {

	    		"request": JSON.stringify(a),
	    		"apiversion": 100,
	            "json": 1

	    };
}
App.directive('tarifInfo', function() {

	// Tarif adress database limit list
var _TARIFS = {
	'B': {
		'name': 'Базовый',
		'limit': {
			'email': null,
			'sms': null
		},
		'showChange': 0
	},
    'R': {
		'name': 'Расширеный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'N': {
		'name': 'Начальный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'O': {
		'name': 'Оптимальный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'P': {
		'name': 'Профессиональный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'E': {
		'name': 'Эксперт',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'V': {
		'name': 'Премиум',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'S': {
		'name': 'Свои',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'F': {
		'name': 'Старт',
		'limit': {
			'email': 200,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'U': {
		'name': 'Т1',
		'limit': {
			'email': 2000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'Q': {
		'name': 'Т2',
		'limit': {
			'email': 10000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'X': {
		'name': 'Т3',
		'limit': {
			'email': 20000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'Y': {
		'name': 'Т4',
		'limit': {
			'email': 35000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'Z': {
		'name': 'Т5',
		'limit': {
			'email': 50000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T': {
		'name': 'Тестовый',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
	'trial': {
		'name': 'Триал',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
	'B1': {
		'name': 'Бизнес 1',
		'id': 'Sendsay_B1_fee',
		'limit': {
			'email': 1000,
			'sms': null
		},
		'price': 750,
		'showChange': 1
	},
	'B2': {
		'name': 'Бизнес 2',
		'id': 'Sendsay_B2_fee',
		'limit': {
			'email': 2500,
			'sms': null
		},
		'price': 1300,
		'showChange': 1
	},
	'B5': {
		'name': 'Бизнес 5',
		'id': 'Sendsay_B5_fee',
		'limit': {
			'email': 5000,
			'sms': null
		},
		'price': 2000,
		'showChange': 1
	},
	'B10': {
		'name': 'Бизнес 10',
		'id': 'Sendsay_B10_fee',
		'limit': {
			'email': 10000,
			'sms': null
		},
		'price': 3300,
		'showChange': 1
	},
	'B25': {
		'name': 'Бизнес 25',
		'id': 'Sendsay_B25_fee',
		'limit': {
			'email': 25000,
			'sms': null
		},
		'price': 6500,
		'showChange': 1
	},
	'B50': {
		'name': 'Бизнес 50',
		'id': 'Sendsay_B50_fee',
		'limit': {
			'email': 50000,
			'sms': null
		},
		'price': 10300,
		'showChange': 1
	},
    'I': {
		'name': 'Индивидуальный',
		'limit': {
			'email': 0,
			'sms': null
		},
		'price': null,
		'showChange': 1
	},
    
    'T1': {
		'name': 'Т1',
		'limit': {
			'email': 2000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T2': {
		'name': 'Т2',
		'limit': {
			'email': 10000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T3': {
		'name': 'Т3',
		'limit': {
			'email': 20000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T4': {
		'name': 'Т4',
		'limit': {
			'email': 35000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T5': {
		'name': 'Т5',
		'limit': {
			'email': 50000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	}
};


	// Runs during compile
	return {
		// name: '',
		// priority: 1,
		// terminal: true,
		scope: {}, // {} = isolate, true = child, false/undefined = no change
		// controller: function($scope, $element, $attrs, $transclude) {},
		// require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
		restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
		// template: '{{name}}',
		// templateUrl: '',
		replace: true,
		// transclude: true,
		// compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
		link: function($scope, iElm, iAttrs, controller) {
			var code = iAttrs.code || false,
				option = iAttrs.option || 'name';
			/*
			if(angular.isUndefined(_TARIFS[code]) || angular.isUndefined(_TARIFS[code][option])) {
				iElm.text('Unknown');
				return ;
			}
			*/

			iElm.text(_.get(_TARIFS, [ code, option ], 'Unknown'));	
		
		}
	};
});
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

	_log('app config ...');

	$locationProvider.html5Mode(true);
	localStorageServiceProvider.setPrefix('SA');
    
		// localStorageServiceProvider.setStorageType('localStorage');

	$urlRouterProvider
		.when('/', '/sumstat')
		.otherwise("/404");

/*
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
		*/
}]);
App.controller('favoritesCtrl', [
    '$scope',
    '$rootScope',
    function ($scope, $rootScope) {

        $scope.removeFromFavorites = function(id) {
        	_log('removeFromFavorites: '+id)
            $scope.$emit('removeFromFavorites', { ID: id });
        };

        $scope.showDrop = function() {

        };

        $rootScope.$watch('favoriteUsers', function() {

            _log('event', arguments);

        });

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

App.controller('MainCtrl', [
	'$rootScope',
	function($rootScope) {
		$rootScope.windowTitle = "MyFirst Page in Angular";
}])
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
        _log('setSection arguments:', arguments)
    };
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
	'localStorageServiceProvider',

    function ($stateProvider, $httpProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {
    	_log('app.sumstat config ...');
    	
    	$urlRouterProvider.when('/sumstat/','/sumstat');

    	$httpProvider.defaults.useXDomain = true;
    	$httpProvider.defaults.withCredentials = true;

    	delete $httpProvider.defaults.headers.common["X-Requested-With"];

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
	                	
	                	var deferred = $q.defer();
	                	/*
	                	_.extend($http.defaults.headers.common, {
					        'Access-Control-Allow-Origin': '*',
					        'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
					        'Access-Control-Allow-Headers': 'Content-Type, X-Requested-With'
				        });
				        */

				        _log('$http.defaults.headers:', $http.defaults.headers);

	                	

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

	                    _log('_apiRequest_: ', _apiRequest_);

	                    $.post(apiPath(), _apiRequest_,
	                    	function(data) {
	                    		_log('jQuery post:', data);
	                    	}
				        	
				        );

	                    $http.post(apiPath(), _apiRequest_)
	                    
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

AppSumstat
.controller('SumstatListCtrl', [
    '$scope',
    '$rootScope',
    '$location',
    function ($scope, $rootScope, $location) {
        
        $scope.userCount = $rootScope.userList.length;
        $scope.currentPage = $location.search().page || 1;
        $scope.sortType = $location.search().sortType || 'ID';
        $scope.sortReverse = $location.search().sortReverse || false;
        $scope.changeSort = function(type) {
            $scope.sortReverse = ($scope.sortType != type? 0: !$scope.sortReverse )
            $scope.sortType = type;
        }

        $scope.favoriteUser = function(event, id) {
            $rootScope.$broadcast('favoriteUserChange', { 'ID': id });
        };
        
        $scope.pageChanged = function() {
            $location.search('page', $scope.currentPage);
        };
        
        $scope.$watch('sortType', function() {
            $location.search('sortType', $scope.sortType);
        });

        $scope.$watch('sortReverse', function() {
            $location.search('sortReverse', $scope.sortReverse?1:null);
        });

        $scope.checkOnDrop = function(event, key) {

            var item = $(event.currentTarget).parents('.ui-table-dropdown-item'),
                isChecked = event.currentTarget.checked;
            
            item[(isChecked?'add':'remove')+'Class']('ui-table-dropdown-checked');
        };

        $rootScope.$on('changeUserList', function() {
            $scope.userCount = $rootScope.userList.length;
        });
        
        $scope.showAdvCols = {};

        $scope.tableCols = [
            { key: 'manager', name: 'Менеджер', 'checked': 0 },
            { key: 'seller', name: 'Продавец', 'checked': 0 },
            { key: 'tarif', name: 'Тариф', 'checked': 0 },
            { key: 'adress', name: 'Адрес', 'checked': 0 },
            { key: 'lastIssue', name: 'Последний выпуск', 'checked': 0 },
            { key: 'memberCount', name: 'Адресов в базе', 'checked': 0 }
        ];

        angular.forEach($scope.tableCols , function(value, key){
            $scope.showAdvCols[value.key] = 0;
        });
    }
]);
AppSumstat
.controller('SumstatUserViewCtrl', [
    '$scope',
    '$stateParams',
    '$location',
    function ($scope, $stateParams, $location) {
    	
    	/*,
		resolve: {
            user: ['$scope','$stateParams', function($scope, $stateParams) {
                $scope.user = $scope.userList[$stateParams.user];
                return $scope.userList[$stateParams.user];
            }]
        }
        
        var index = $scope.userListLink[$stateParams.userId];
        */

	    $scope.user = $scope.userList[$stateParams.userId];
	    $scope.userJSON = JSON.stringify($scope.user)
	    	.replace(/\,/ig,",\n")
	    	.replace(/\{/ig,"{\n")
	    	.replace(/\}/ig,"\n}");
	    	
    }]);
angular.module("content", [ 'sumstat', 'ui.router' ])

.config([
	'$stateProvider',
    '$urlRouterProvider',
    '$locationProvider',
    function ($stateProvider, $urlRouterProvider, $locationProvider) {

    	$stateProvider
            .state(".sumstat", {
            	url: '/sumstat/list',
            	templateUrl: 'pages/sumstat/list/template.html',
                controller: 'SumstatListCtrl'
            });

        $urlRouterProvider.otherwise("/sumstat/list");
    }
]);