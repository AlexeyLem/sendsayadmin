App.filter('sumstatpagination', function() {
    _log('sumstatpagination arguments:',arguments);
  return function(input) {
    _log('arguments:',arguments);
    return input;
    // return input ? '\u2713' : '\u2718';
  };
});