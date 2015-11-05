'use strict';

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

angular.module("app", [ 'sumstat', 'ui.router' ])

.config([
    '$stateProvider',
    '$urlRouterProvider',
    '$locationProvider',
    function ($stateProvider, $urlRouterProvider, $locationProvider) {

        $stateProvider
            .state("sumstat", {
                url: '/sumstat',
                views: {
                    'top_search': {
                        templateUrl: 'pages/topSearch.html',
                        controller: 'topSearchCtrl'
                    },
                    'favorits': {
                        templateUrl: 'pages/favorits.html'
                    },
                    'navigation': {
                        templateUrl: 'pages/navigation.html',
                        controller: 'NavogationCtrl'
                    },
                    "content": {
                        templateUrl: 'pages/sumstat/template.html',
                        controller: 'SumstatCtrl'
                    },
                }
            });
        
        _log('Kuku ...');
        
        $urlRouterProvider.otherwise("sumstat");
        $locationProvider.html5Mode(true);
}])

.controller('MainCtrl', ['$scope', '$location', function($scope, $location) {
    $scope.title = "MyFirst Page in Angular";
}])

.controller('NavogationCtrl', ['$scope', '$location', function($scope, $location) {
    
    _log('MainCtrl ...');
        
    
    
    $scope.mainMenu = [
        {
            name: 'Sumstat',
            path: '/sumstat'
        },
        {
            name: 'Devilstat',
            path: '/delivstat'
        },
        {
            name: 'Payment',
            path: '/payment'
        },
        {
            name: 'Tarif',
            path: '/tarif'
        },
        {
            name: 'Sending',
            path: '/sending'
        }
    ];
    
    // $scope.defaultSearchSection = 0;
}])
.controller('topSearchCtrl', ['$scope', '$location', function($scope, $location) {
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
}]);