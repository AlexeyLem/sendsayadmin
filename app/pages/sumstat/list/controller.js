'use strict';

AppSumstat
.controller('SumstatListCtrl', [
    '$scope',
    '$rootScope',
    '$http',
    '$state',
    '$stateParams',
    '$location',
    function ($scope, $rootScope, $http, $state, $stateParams, $location) {
        
        var prepareData = function() {
            var partSize = 20,

                partStart = ($scope.currentPage - 1) * partSize,
                partEnd = $scope.currentPage * partSize - 1;

            $scope.userCount = $rootScope.userOrder.length;
            $scope.usersShow = $rootScope.userOrder.slice(partStart, partEnd);
        };

        $scope.addToFavorites = function(id) {
            $rootScope.$broadcast('addToFavorites', { 'ID': id });
        };
        
        $scope.pageChanged = function() {
            $location.search('page', $scope.currentPage);
            prepareData();
        };
        
        $rootScope.$on('changeUserList', prepareData);

        $scope.currentPage = $location.search().page || 1;

        prepareData();
    }
]);