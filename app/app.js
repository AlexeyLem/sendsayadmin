'use strict';
define(['angularAMD', 'angular-route'], function (angularAMD) {
    var app = angular.module("app", ['ngRoute']);
    
    app.config(function ($routeProvider) {
    
      $routeProvider
          .when("/home", angularAMD.route({
              templateUrl: 'pages/home/index.html',
              controller: 'HomeCtrl',
              controllerUrl: 'pages/home/index'
          }))
          .otherwise({redirectTo: "/home"});
    });

    app.controller('MainCtrl', ['$scope', '$routeProvider', function($scope, $routeProvider) {
        
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