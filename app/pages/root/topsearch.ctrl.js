App.controller('TopSearchCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    '$location',
    function($scope, $state, $rootScope, $location) {

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

		_log('searchInput', data);

		$location.search('search', data);
		$rootScope.$broadcast('topSearchChange', data);
	
	});

    $scope.searchSection = 0;

    $scope.setSection = function(event, index) {
        $scope.searchSection = index;
        event.preventDefault();
        _log('setSection arguments:', arguments);
    };

}])