'use strict';

AppSumstat
.controller('SumstatUserViewCtrl', [
    '$scope',
    '$stateParams',
    '$location',
    function ($scope, $stateParams, $location) {
    	
    	/*,
		resolve: {
            user: ['$scope','$stateParams', function($scope, $stateParams) {
                $scope.user = $scope.userList[$stateParams.user];
                return $scope.userList[$stateParams.user];
            }]
        }
        */
        var index = $scope.userListLink[$stateParams.userId];
        
	    $scope.user = $scope.userList[index];
	    $scope.userJSON = JSON.stringify($scope.user)
	    	.replace(/\,/ig,",\n")
	    	.replace(/\{/ig,"{\n")
	    	.replace(/\}/ig,"\n}");
	    	
    }]);