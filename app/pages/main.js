'use strict';

angular.module('App.main', ['ngRoute'])

.config(['$routeProvider', '$location', '$http', function($routeProvider, $location, $http) {
    $routeProvider.when('/', {
        templateUrl: 'pages/main.html',
        controller: 'MainCtrl'
    });
}])

.controller('MainCtrl', [function() {

    $http.get('sumstat.json').success(function() {
        
    });
    
    
    
}]);