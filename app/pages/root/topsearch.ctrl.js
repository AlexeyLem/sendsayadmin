App.controller('TopSearchCtrl', [
    '$scope',
    '$location',
    function($scope, $location) {

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

    $scope.searchSection = 0;
    $scope.setSection = function(event, index) {
        $scope.section = index;
        event.preventDefault();
        _log('setSection arguments:', arguments)
    };
}])