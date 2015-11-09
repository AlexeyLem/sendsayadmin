angular.module("app", [
	'app.sumstat',
	'ui.bootstrap',
	'ui.router'
]).filter('sumstatpagination', function($stateParams) {
  return function(input) {
    _log('arguments:',arguments);
    return true;
    // return input ? '\u2713' : '\u2718';
  };
});