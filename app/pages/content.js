'use strict';

angular.module("content", [ 'sumstat', 'ui.router' ])

.config([
	'$stateProvider',
    '$urlRouterProvider',
    '$locationProvider',
    function ($stateProvider, $urlRouterProvider, $locationProvider) {

    	$stateProvider
            .state("sumstat", {
            	url: '/sumstat/list',
            	templateUrl: 'pages/sumstat/list/template.html',
                controller: 'SumstatListCtrl'
            })
            .state("sumstat.view", {
            	url: '/sumstat/view/:id',
            	templateUrl: 'pages/sumstat/list/template.html',
                controller: 'SumstatViewCtrl'
            });

        $urlRouterProvider.otherwise("/sumstat/list");
    }
]);