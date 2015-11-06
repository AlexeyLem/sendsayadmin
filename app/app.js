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

angular.module("app", [ 'sumstat', 'ui.bootstrap', 'ui.router' ])

.config([
    '$stateProvider',
    '$urlRouterProvider',
    '$locationProvider',
    function ($stateProvider, $urlRouterProvider, $locationProvider) {

        $stateProvider
            .state("base", {
                url: '/',
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
                        templateUrl: 'pages/content.html',
                        controller: 'contentCtrl'
                    },
                }
            });

        $urlRouterProvider.otherwise("/sumstat");
        _log('Kuku ...');
        // localStorageServiceProvider.setStorageType('localStorage');
        $locationProvider.html5Mode(true);
}])

.controller('MainCtrl', [
    '$scope',
    '$location',
    '$rootScope',
    '$http',
    function($scope, $location, $rootScope, $http) {
        
        $rootScope.favorites = {};
        $scope.title = "MyFirst Page in Angular";
        
        $rootScope.userList = {};
        
        $http.get('sumstat.json').success(function(data) {
            _log(data[0]);
            
            $.each(data, function(i, user) {
                $rootScope.userList[user.ID] = user;
            });

            $rootScope.activeUsers = [];
            $rootScope.blockedUsers = [];
            
            $.each($rootScope.userList, function(index, user) {
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
    function ($scope, $rootScope) {
        
        $scope.favList = ['abg','abtoys'];

        $rootScope.$on('changeUserList', function(data) {

            $scope.favoritUsers = {};

            $.each($scope.favList, function(i, id) {
                $scope.favoritUsers[id] = $rootScope.userList[id];
            });
        });
        
        // $scope.
        /*
        $scope.favoritUsers = localStorageService.get('favoritUsers');
        
        $scope.$watch('favoritUsers', function(value) {
            _log('$watch:favoritUsers value:', value);
            localStorageService.set('favoritUsers',value);
        });
        */

        $rootScope.$on('addToFavorites', function(event, data) {

            _log('Event saFavorites > addToFavorites:', data);

            if(typeof $scope.favoritUsers[data.id] == 'undefined') {
                 $scope.favoritUsers[data.id] = $rootScope.userList[data.id];
            }

        });
        
        _log('favoritesCtrl ...');
    }
]);