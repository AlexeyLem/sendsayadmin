'use strict';

angular.module('webapp.MainCtrl', [])

.config(['$routeProvider', function($routeProvider) {

}])

.controller('MainCtrl', ['$scope', '$recourse', '$log', function() {

    $http.get('sumstat.json').success(function() {
        _log(data[0]);
    });
    
}]);