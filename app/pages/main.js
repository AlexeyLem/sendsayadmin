'use strict';

var adminCtrls = angular.module('adminCtrls', []);

adminCtrls.controller('MainCtrl', ['$scope', '$http', function() {

    $http.get('sumstat.json').success(function() {
        $log.debug(data[0]);
    });
    
}]);