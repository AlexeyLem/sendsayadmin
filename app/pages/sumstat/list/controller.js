'use strict';

angular.module('sumstat', [ 'ui.router',  'ui.bootstrap', 'app' ])

.controller('SumstatCtrl', [
    '$scope',
    '$rootScope',
    '$http',
    '$stateParams',
    '$location',
    function ($scope, $rootScope, $http, $stateParams, $location) {
        
        _log('sumstat Module:SumstatCtrl Controller', $location.search());
        
        var prepareData = function() {
            $scope.usersShow = $rootScope.userList.slice(0,20);
            $scope.userCount = $rootScope.userList.length;
            $scope.usersShow = $rootScope.userList.slice(0,20);
        };;
        
        $scope.addToFavorites = function(id) {
            $rootScope.$broadcast('addToFavorites', { 'ID': id });
        };
        
        $scope.changePageNum = function() {
            
        };
        
        $scope.page = $stateParams.page || 1;
        
        $rootScope.$on('changeUserList', prepareData);

        prepareData();
    }
]);
