'use strict';
define(['angularAMD', 'angular-route'], function (angularAMD) {
    var app = angular.module("app", ['ngRoute']);
    
    app.config(['$routeProvider','$locationProvider', function ($routeProvider, $locationProvider) {
      
      $routeProvider
          .when("/home", angularAMD.route({
              templateUrl: 'pages/index.html',
              controller: 'HomeCtrl',
              controllerUrl: 'pages/home/index'
          }))
          .otherwise({redirectTo: "/home"});
        
        $locationProvider.html5Mode(true);
    }]);

    app.controller('MainCtrl', ['$scope', '$location', function($scope, $location) {
        
        _log('MainCtrl ...');
        
        $scope.title = "MyFirst Page in Angular";
        $scope.defaultSearchSection = 0;
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
        
        }
    ]);
  
    return angularAMD.bootstrap(app);
});