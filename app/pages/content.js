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