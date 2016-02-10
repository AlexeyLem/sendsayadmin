App.factory('SumstatFavorites', [

	'$rootScope',
	'localStorageService',

	function($rootScope, localStorage) {

	var list = localStorage.get('sumstat_favorite').split(',') || [],
		service = {

		'List': function() {
			return list.splice(0);
		},
		
		'Add': function(id) { // id

			$rootScope.$broadcast('SumstatFavorites_Add', id);
			$rootScope.$broadcast('SumstatFavorites_Change', list);
		},

		Remove: function(id) { // id

			$rootScope.$broadcast('SumstatFavorites_Remove', id);
			$rootScope.$broadcast('SumstatFavorites_Change', list);
		},

		inList: function(id) { // id
			return ($.inArray(id, list)!=-1);
		}

	};

	return service;

}]);