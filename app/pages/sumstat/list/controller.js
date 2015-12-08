'use strict';

AppSumstat
.controller('SumstatListCtrl', [
    '$scope',
    '$rootScope',
    '$location',
    function ($scope, $rootScope, $location) {
        
        $scope.userCount = $rootScope.userList.length;
        $scope.currentPage = $location.search().page || 1;
        $scope.sortType = $location.search().sortType || 'ID';
        $scope.sortReverse = $location.search().sortReverse || false;
        $scope.changeSort = function(type) {
            $scope.sortReverse = ($scope.sortType != type? 0: !$scope.sortReverse )
            $scope.sortType = type;
        }

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

        $scope.checkOnDrop = function(event, key) {

            var item = $(event.currentTarget).parents('.ui-table-dropdown-item'),
                isChecked = event.currentTarget.checked;
            
            item[(isChecked?'add':'remove')+'Class']('ui-table-dropdown-checked');
        };

        $rootScope.$on('changeUserList', function() {
            $scope.userCount = $rootScope.userList.length;
        });
        
        $scope.showAdvCols = {};

        $scope.tableCols = [
            { key: 'manager', name: 'Менеджер', 'checked': 0 },
            { key: 'seller', name: 'Продавец', 'checked': 0 },
            { key: 'tarif', name: 'Тариф', 'checked': 0 },
            { key: 'adress', name: 'Адрес', 'checked': 0 },
            { key: 'lastIssue', name: 'Последний выпуск', 'checked': 0 },
            { key: 'memberCount', name: 'Адресов в базе', 'checked': 0 }
        ];

        angular.forEach($scope.tableCols , function(value, key){
            $scope.showAdvCols[value.key] = 0;
        });
    }
]);