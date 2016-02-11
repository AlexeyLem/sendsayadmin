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
	    
    }]);