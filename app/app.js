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

var App = angular.module("app", [ 'sumstat', 'ui.router', 'ngStorage' ])

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
                        templateUrl: 'pages/favorits.html',
                        controller: 'favoritesCtrl'
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

.controller('MainCtrl', ['$scope', '$location', '$rootScope', '$http', function($scope, $location, $rootScope, $http) {
    $rootScope.favorites = {};
    $scope.title = "MyFirst Page in Angular";
    
    $rootScope.users = [];
    
    $http.get('sumstat.json').success(function(data) {
        _log(data[0]);
        
        $rootScope.users = data;
        $rootScope.activeUsers = [];
        $rootScope.blockedUsers = [];
        
        $.each($rootScope.users, function(index, user) {
            if (user.BLOCKED=="0") {
                $scope.blockedUsers.push(user.ID);
            }else{
                $scope.activeUsers.push(user.ID);
            }
        });
        
        $rootScope.$emit('changeUserList');
    });
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
}])

.controller('favoritesCtrl', [
    '$scope',
    '$rootScope',
    'ngStorage',
    function ($scope, $rootScope, $localStorage) {
        $scope.users = $localStorage.favoritUsers;
        _log('favoritesCtrl ...');
    }
]);