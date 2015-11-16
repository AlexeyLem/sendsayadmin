'use strict';

AppSumstat
.controller('SumstatListCtrl', [
    '$scope',
    '$rootScope',
    '$location',
    function ($scope, $rootScope, $location) {
        
        $scope.userCount = $rootScope.userList.length;
        $scope.currentPage = $location.search().page || 1;
        $scope.sortType = $location.search().sortType || null;
        $scope.sortReverse = $location.search().sortReverse || null;


        $scope.favoriteUser = function(event, id) {
            $rootScope.$broadcast('favoriteUserChange', { 'ID': id });
        };
        
        $scope.pageChanged = function() {
            $location.search('page', $scope.currentPage);
        };
        
        $scope.$watch('sortType', function() {
            $location.search('sortType', $scope.sortType);
        });

        $scope.$watch('sortReverse', function() {

            $location.search('sortReverse', $scope.sortReverse?1:null);
        });


        $rootScope.$on('changeUserList', function() {
            $scope.userCount = $rootScope.userList.length;
        });
        
    }
]);