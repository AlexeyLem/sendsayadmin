AppSumstat
.controller('SumstatUserViewCtrl', [
    
    '$scope',
    '$rootScope',
    '$stateParams',
    '$location',

    function ($scope, $rootScope, $stateParams, $location) {
    	
        _log('$stateParams.userId: ' + $stateParams.userId);
        
        var userIndex = $rootScope.userList_keyLink[$stateParams.userId];

	    $scope.user = $rootScope.userList[userIndex];

        _log('$scope.user: ', _.extend({}, $scope.user));

        
	    $scope.userJSON = JSON.stringify($scope.user)
	    	.replace(/\,/ig,",\n")
	    	.replace(/\{/ig,"{\n")
	    	.replace(/\}/ig,"\n}");
	    
    }]);: 'Адрес', 'checked': 0 },
        { key: 'lastIssue', name: 'Последний выпуск', 'checked': 0 },
        { key: 'memberCount', name: 'Адресов в базе', 'checked': 0 }
    ];

    angular.forEach($scope.tableCols , function(value, key) {
        $scope.showAdvCols[value.key] = 0;
    });

    // BEGIN Functions 

    $scope.changeSort = function(type) {
        $scope.sortReverse = ($scope.sortType != type? 0: !$scope.sortReverse )
        $scope.sortType = type;
    }

    $scope.favoriteUser = function(event, id) {
        
        if(SumstatFavorites.inList(id)) {
            SumstatFavorites.Remove(id);    
        }else{
            SumstatFavorites.Add(id);   
        }            

    };
    
    $scope.pageChanged = function(currentPage) {

        $scope.currentPage = currentPage;
        $location.search('page', currentPage);
    
    };

    $scope.checkOnDrop = function(event, key) {

        var item = $(event.currentTarget).parents('.ui-table-dropdown-item'),
            isChecked = event.currentTarget.checked;
        
        item[(isChecked?'add':'remove')+'Class']('ui-table-dropdown-checked');
    };

    // END Functions
    

    // BEGIN Watchers & Listeners
    /*
    $scope.$watch('sortType', function() {
        $location.search('sortType', $scope.sortType);
    });

    $scope.$watch('sortReverse', function() {
        $location.search('sortReverse', $scope.sortReverse?1:null);
    });
    */
    $rootScope.$on('changeUserList', function() {
        $scope.userCount = Object.keys($rootScope.userList).length;
    });
    
    // END Watchers & Listeners
}

AppSumstat
    .controller('SumstatListCtrl', [
        '$scope',
        '$rootScope',
        '$location',
        'Api',
        'SumstatFavorites',
        SumstatListCtrl
    ]);


})();