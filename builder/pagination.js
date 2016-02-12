AppFilters.filter('sumstatPaginationFilter', function() {
    _log('sumstatpagination arguments:',arguments);
  return function(items, currentPage, itemsPerPage) {
    return items.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage - 1);
    // return input ? '\u2713' : '\u2718';
  };
});