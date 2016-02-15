AppFilters.filter('searchFilter', function() {
  
	return function(items, search) {
		
		if(search=='') return items;

		return _.filter(items, function(item) {
			return (item.TITLE.indexOf(search) != -1 || item.ID.indexOf(search) != -1)? true: false;
		});
    // return input ? '\u2713' : '\u2718';
	};

});