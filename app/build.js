
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

	'app.auth',
	'app.sumstat',
	'ui.bootstrap',
	'ui.router',
	'LocalStorageModule',
	'ngAnimate',
	'angularMoment'

]).run([

	'amMoment',
	'$rootScope',
	'$state',
	'$stateParams',
	
	function(amMoment, $rootScope, $state, $stateParams) {

		_log('App run ...');

		amMoment.changeLocale('ru');

		$rootScope.$state = $state;
		$rootScope.$stateParams = $stateParams;

		$rootScope.user = null;

		
	}
]);
var AppAuth = angular.module('app.auth', [
    	'ui.router'
])

.run([
	
	'Auth',
	'$rootScope',

	function(AuthService,$rootScope) {
		_log('AppAuth run ...');
		$rootScope.isAuthenticated = AuthService.isAuthenticated();
	}
])

.controller('AuthCtrl', [
	
	'$scope',
	'$rootScope',
	'Auth',

	function($scope, $rootScope, AuthService) {
		
		$scope.loginModel = 'alexey';
		$scope.passwordModel = '';

		$scope.loginError = false;
		$scope.passwordError = false;

		$scope.Auth = function(event) {

			_log('$scope.Auth Call ...', $scope.loginModel, $scope.passwordModel );
			
			var noErrors = true;

			if($.trim($scope.loginModel) == '') {
				noErrors = false;
				$scope.loginError = true;
			}

			if($.trim($scope.passwordModel) == '') {
				noErrors = false;
				$scope.passwordError = true;
			}

			if(noErrors) {
				
				$scope.loginError = false;
				$scope.passwordError = false;


				AuthService.login({
					'login': $.trim($scope.loginModel),
					'password': $.trim($scope.passwordModel)
				});
			}

		};

		$scope.keyAuth = function(event) {

			if(event.keyCode == 13) { // Enter
				$scope.Auth();
			}else if(event.keyCode == 27) { // Esc
				// Something
			}

		};

	}
])

.factory('Auth', [
	'$http',
	'$q',
	'Api',

	 function($http, $q, Api) {

		var authenticatedUser = true;

		return {
			
			isAuthenticated: function() {
				return authenticatedUser;
			},

			login: function (inputs) {
				
				var deffered = $q.defer();

				Api.login({
					
					login: inputs.login,
					password: inputs.password
				
				}).success(function(data) {
					_log('Auth login success Data:', data);
					// authenticatedUser = inputs.login;
					deffered.resolve(data);

				}).error(function(data, status, header, config) {
					
					_log('Auth login error Data:', arguments);

					deffered.reject(data);

				});

				return deffered.promise;
			}
		}

	}
]);
App.factory('Api', ['$q', function($q) {
	
	var _apiUrl = 'https://test.sendsay.ru/admin/api/';

	return {
		
		_prepeareRequest: function(request) {

			return {
				"request": JSON.stringify(request),
	    		"apiversion": 100,
	            "json": 1
			};

		},
		
		hasError: function(responce) {

			return (isD(responce.errors) && responce.errors.length);
		
		},

		request: function(request, options) {
			
			options = options || {};

			// _log('Api.request DO ...');
			
			var self = this,
				_deffered = $q.defer(),
				_fullRequest = this._prepeareRequest(request),
				ajaxSettings = {
					/*
					beforeSend: function (xhr) {
					    xhr.setRequestHeader("Authorization", "Basic " + btoa("alexey:654174"));
					},
					*/
					url: _apiUrl,

					crossDomain: true,
					// contentType: false,
				    async: true,
				    cache: false,
				    dataType: 'json',

					global: true,
					
					method: options.method || 'post',
					data: _fullRequest,
					
					error: function(data) {

						// Handler for Server or Network Errors 
						_log('API ERROR: ', arguments);

					},

					success: function(data) {

						if(self.hasError(data)) {
							_deffered.reject(data);
						}else{
							_deffered.resolve(data);
						}
					
					},

					// "username": "alexey"
				};

			// _log("ajaxSettings:", ajaxSettings );

			$.ajax(ajaxSettings);
			
			return _deffered.promise;

			// return $http.post(_apiUrl+'api/', this._prepeareRequest(request));
		
		},

		login: function(options) {
			return $http({
				method: 'POST',
				url: _apiUrl +'api/', // '?AUTHLOGINadmin',
				data: {
					credential_0: options.login,
					credential_1: options.password
				}
			});
		}
	};

}])
App.factory('SumstatFavorites', [

	'$rootScope',
	'localStorageService',

	function($rootScope, localStorageService) {

	_log('localStorageService:', localStorageService);

	var keyName = 'sumstatFavoriteUsers';

	if(!localStorageService.get(keyName)) {
		localStorageService.set(keyName,'')
	}

	var list = localStorageService.get(keyName).split(',') || [],
		
		saveList = function() {

			localStorageService.set(keyName, list.join(','));
		
		},

		service = {

		'getList': function() {
			
			return list.slice(0);

		},
		
		'Add': function(id) { // id

			id = id || null;

			if(typeof id !== 'object' && id && !this.inList(id)) {
				
				list.push(id);

				saveList();

				$rootScope.$broadcast('SumstatFavorites_Add', id);
				$rootScope.$broadcast('SumstatFavorites_Change', list);
			}

		},

		Remove: function(id) { // id
			
			id = id || null;

			var index = $.inArray(id, list);

			if(typeof id !== 'object' && id && index != -1) {

				list.splice(index, 1);

				saveList();

				$rootScope.$broadcast('SumstatFavorites_Remove', id);
				$rootScope.$broadcast('SumstatFavorites_Change', list);
			}

		},

		inList: function(id) { // id
			return ($.inArray(id, list)!=-1);
		}

	};

	return service;

}]);
var AppFilters = angular.module('AppFilters', []);
AppFilters.filter('sumstatPaginationFilter', function() {
    _log('sumstatpagination arguments:',arguments);
  return function(items, currentPage, itemsPerPage) {
    return items.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage - 1);
    // return input ? '\u2713' : '\u2718';
  };
});
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

			_log(code, option);

			iElm.text(_.get(_TARIFS, [ code, option ], 'Unknown'));	
		
		}
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
    
	// Здесь мы будем проверять авторизацию
	/*
	$rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
		
		_log('Event $stateChangeStart ... ');

		Auth.checkAccess(event, toState, toParams, fromState, fromParams);
	});
	*/

	$urlRouterProvider
		.when('/', '/sumstat')
		.otherwise("/404");
    
}]);
App.controller('MainCtrl', [
	
	'$rootScope',
	'$state',
	'$stateParams',
	'Auth',
	'localStorageService',

	function($rootScope, $state, $stateParams, Auth, localStorageService) {

		$rootScope.windowTitle = "MyFirst Page in Angular";

		$rootScope.$state = $state;
	    $rootScope.$stateParams = $stateParams;
	    $rootScope.localStorage = localStorageService;

	    $rootScope.isAuthenticated = Auth.isAuthenticated();

}]);
App.controller('favoritesCtrl', [
    
    '$scope',
    '$rootScope',
    'SumstatFavorites',

    function ($scope, $rootScope, SumstatFavorites) {

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

            $rootScope.sumstatFavoriteUsers = list;
        
        });


        $scope.showDrop = function() {

        };


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

	                function ($q, Api, $rootScope, $state, $stateParams) {
	                	
	                	var deferred = $q.defer();

				        // _log('$http.defaults.headers:', $http.defaults.headers);

	                   	$rootScope.userList = [];
	                   	$rootScope.userList_keyLink = {};
	                    $rootScope.activeUsers = [];
	                    $rootScope.blockedUsers = [];
						
	                    var _listHandler = function(data) {

	                    	// _log('Api Request:', data);

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

AppSumstat
.controller('SumstatListCtrl', [
    '$scope',
    '$rootScope',
    '$location',
    'Api',
    'SumstatFavorites',

    function ($scope, $rootScope, $location, api, SumstatFavorites) {

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

        /* BEGIN Functions */

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

        /* END Functions */
        

        /* BEGIN Watchers & Listeners */
        
        $scope.$watch('sortType', function() {
            $location.search('sortType', $scope.sortType);
        });

        $scope.$watch('sortReverse', function() {
            $location.search('sortReverse', $scope.sortReverse?1:null);
        });

        $rootScope.$on('changeUserList', function() {
            $scope.userCount = Object.keys($rootScope.userList).length;
        });
        
        /* END Watchers & Listeners */
    }
]);
AppSumstat
.controller('SumstatUserViewCtrl', [
    
    '$scope',
    '$rootScope',
    '$stateParams',
    '$location',

    function ($scope, $rootScope, $stateParams, $location) {
    	
        _log('$stateParams.userId: ' + $stateParams.userId);
        
        var userIndex = $rootScope.userList_keyLink[$stateParams.userId];

	    $scope.user = $rootScope.userList[userIndex];

        _log('$scope.user: ', _.extend({}, $scope.user));

        
	    $scope.userJSON = JSON.stringify($scope.user)
	    	.replace(/\,/ig,",\n")
	    	.replace(/\{/ig,"{\n")
	    	.replace(/\}/ig,"\n}");
	    
    }]);