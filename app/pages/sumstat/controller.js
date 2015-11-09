'use strict';

angular.module('app.sumstat', [
	'ui.router'
])

.config([
	'$stateProvider',
	'$urlRouterProvider',

    function ($stateProvider, $urlRouterProvider) {
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
	    		controller: 'SumstatListCtrl',
	    	});

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
		
		_log("$location.search('page'): " + $location.search().page);

		var prepareData = function() {
			var partSize = 20,

                partStart = ($scope.currentPage - 1) * partSize,
                partEnd = $scope.currentPage * partSize - 1;

			$scope.userCount = $rootScope.userOrder.length;
            $scope.usersShow = $rootScope.userOrder.slice(partStart, partEnd);
		};

		$scope.addToFavorites = function(id) {
			$rootScope.$broadcast('addToFavorites', { 'ID': id });
		};
		
		$scope.pageChanged = function() {
			$location.search('page', $scope.currentPage);
			prepareData();
		};
		
		$rootScope.$on('changeUserList', prepareData);

		$scope.currentPage = $location.search().page;
		_log('$scope.currentPage: '+$scope.currentPage);

		prepareData();
	}
]);