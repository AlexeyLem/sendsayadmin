'use strict';

 var AppSumstat = angular.module('app.sumstat', [
	'ui.router'
])

.config([
	'$stateProvider',
	'$urlRouterProvider',

    function ($stateProvider, $urlRouterProvider) {
    	_log('app.sumstat config ...');
    	
    	$urlRouterProvider.when('/sumstat/','/sumstat');
    	$stateProvider
	    	
	    	.state('home.sumstat', {
	    		abstract: true,
				url: '/sumstat',
	    		template: '<div ui-view></div>'
	    	})
	    	
	    	.state('home.sumstat.list', {
	    		url: '',
	    		// template: 'SumstatList ...',
	    		templateUrl: 'pages/sumstat/list/template.html',
	    		controller: 'SumstatListCtrl',
	    	})

	    	.state('home.sumstat.view', {
	    		url: '/view',
	    		templateUrl: 'pages/sumstat/user_view/template.html',
	    		controller: 'SumstatUserView',
	    		resolve: {
	    			user: ['$scope','$stateParams', function($scope, $stateParams) {
	    				return $scope.userList[$stateParams.user];
	    			}]
	    		}
	    	});
    }
 ])
