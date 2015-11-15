App.controller('TopSearchCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    '$location',
    function($scope, $state, $rootScope, $location) {

	_log('topSearchCtrl ...');

	$scope.searchlist = [
		{
			'name': 'chrights',
			'code': 'chrights'
		},
		{
			'name': 'Defer',
			'code': 'defer'
		},
		{
			'name': 'Chenv',
			'code': 'chenv'
		}
	];

	$scope.doSearch = function(str) {
		if($scope.searchSection == 0) {
			
		}
	};

	$scope.$watch('searchInput', function(data) {

	});

    $scope.searchSection = 0;

    $scope.setSection = function(event, index) {
        $scope.searchSection = index;
        event.preventDefault();
        _log('setSection arguments:', arguments)
    };
}])