
App.controller('NavogationCtrl', [
	'$scope',
	'$location',
	function($scope, $location) {
		
		_log('NavogationCtrl ...');
		
		$scope.mainMenu = [
			{
				name: 'Sumstat',
				icon: 'glyphicon glyphicon-signal',
				path: '/sumstat/',
				state: 'sumstat.list'
			},
			{
				name: 'Delivstat',
				path: '/delivstat/',
				state: 'delivstat.list',
				icon: 'glyphicon glyphicon-pencil'
			},
			{
				name: 'Payment',
				path: '/payment/',
				state: 'payment.list',
				icon: 'glyphicon glyphicon-euro'
			},
			{
				name: 'Tarif',
				path: '/tarif/',
				state: 'tarif.list',
				icon: 'glyphicon glyphicon-briefcase'
			},
			{
				name: 'Sending',
				path: '/sending/',
				state: 'sending.list',
				icon: 'glyphicon glyphicon-envelope'
			}
		];
		
		// $scope.defaultSearchSection = 0;
}])