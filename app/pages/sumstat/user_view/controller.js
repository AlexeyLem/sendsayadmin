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

	    $scope.user = $scope.userList[$stateParams.userId];
	    $scope.userJSON = JSON.stringify($scope.user)
	    	.replace(/\,/ig,",\n")
	    	.replace(/\{/ig,"{\n")
	    	.replace(/\}/ig,"\n}");
	    	
    }]);