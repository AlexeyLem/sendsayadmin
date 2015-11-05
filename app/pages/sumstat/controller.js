'use strict';

angular.module('sumstat', [ 'ui.router', 'app' ])

.controller('SumstatCtrl',['$scope', function ($scope) {
    $scope.message = "Message from HomeCtrl";
    _log('sumstat Module:SumstatCtrl Controller');
}]);
