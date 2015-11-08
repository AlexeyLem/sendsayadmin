'use strict';

angular.module('app.sumstat', [
	'ui.router'
])

.config([
	'$stateProvider',
	'$urlRouterProvider',

    function ($stateProvider,   $urlRouterProvider) {
    	_log('app.sumstat config ...')
    	
    	$stateProvider
	    	
	    	.state('sumstat', {
	    		abstract: true,
				url: '/sumstat/',
	    		template: '<div ui-view></div>'
	    	})
	    	.state('sumstat.list', {
	    		url: '',
	    		// template: 'SumstatList ...',
	    		templateUrl: 'pages/sumstat/list/template.html',
	    		controller: 'SumstatListCtrl'
	    	});
	    
	    $urlRouterProvider.when('/sumstat', '/sumstat/list');
    }
 ])

.controller('SumstatListCtrl', [
	'$scope',
	'$rootScope',
	'$http',
	'$state',
	'$stateParams',
	'$location',
	function ($scope, $rootScope, $http, $state, $stateParams, $location) {
		
		_log('sumstat Module:SumstatCtrl Controller', $location.search());
		
		var prepareData = function() {
			$scope.usersShow = $rootScope.userOrder.slice(0,20);
			$scope.userCount = $rootScope.userOrder.length;
			$scope.usersShow = $rootScope.userOrder.slice(0,20);
		};
		
		$scope.addToFavorites = function(id) {
			$rootScope.$broadcast('addToFavorites', { 'ID': id });
		};
		
		$scope.$watch('currentPage', function(pageNum) {
			_log($state.current.name+ ' / currentPage: ' + pageNum);
			$location.search('page', pageNum);
			// $state.go($state.current.name, { page: pageNum });
			_log('stateParams: ',$stateParams);
		});

		$scope.page = $stateParams.page || 1;
		
		$rootScope.$on('changeUserList', prepareData);

		prepareData();
	}
]);