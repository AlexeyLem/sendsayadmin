App.factory('SumstatFavorites', [

	'$rootScope',
	'localStorageService',

	function($rootScope, localStorageService) {

	_log('localStorageService:', localStorageService);

	var keyName = 'sumstatFavoriteUsers';

	if(!localStorageService.get(keyName)) {
		localStorageService.set(keyName,'')
	}

	var list = localStorageService.get(keyName).split(',') || [],
		
		saveList = function() {

			localStorageService.set(keyName, list.join(','));
		
		},

		service = {

		'getList': function() {
			
			return list.slice(0);

		},
		
		'Add': function(id) { // id

			id = id || null;

			if(typeof id !== 'object' && id && !this.inList(id)) {
				
				list.push(id);

				saveList();

				$rootScope.$broadcast('SumstatFavorites_Add', id);
				$rootScope.$broadcast('SumstatFavorites_Change', list);
			}

		},

		Remove: function(id) { // id
			
			id = id || null;

			var index = $.inArray(id, list);

			if(typeof id !== 'object' && id && index != -1) {

				list.splice(index, 1);

				saveList();

				$rootScope.$broadcast('SumstatFavorites_Remove', id);
				$rootScope.$broadcast('SumstatFavorites_Change', list);
			}

		},

		inList: function(id) { // id
			return ($.inArray(id, list)!=-1);
		}

	};

	return service;

}]);