(function() {
    
'use strict';

angular.module('sumstat', [ 'ui.router',  'ui.bootstrap', 'app' ])

.controller('SumstatListCtrl', [
    '$scope',
    '$rootScope',
    '$http',
    '$stateParams',
    '$location',
    function ($scope, $rootScope, $http, $stateParams, $location) {
        
        _log('sumstat Module:SumstatCtrl Controller', $location.search());
        
        var prepareData = function() {
            var partSize = 20,
                partStart = ($stateParams.page-1) * partSize,
                partEnd = $stateParams.page*partSize;

            $scope.userCount = $rootScope.userOrder.length;
            $scope.usersShow = $rootScope.userOrder.slice(partStart, partEnd);
        };
        
        $scope.page = $stateParams.page || 1;

        $scope.addToFavorites = function(id) {
            $rootScope.$broadcast('addToFavorites', { 'ID': id });
        };
        
        $scope.changePageNum = function() {
            
        };

        $scope.$watch('currentPage', function(pageNum) {
            prepareData();
        });

        
        $rootScope.$on('changeUserList', prepareData);

        prepareData();
    }
]);

})();