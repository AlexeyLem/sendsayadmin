'use strict';

// Declare app level module which depends on views, and components
angular.module('App', [
  'ngRoute'
]).
config(['$routeProvider','$cookies', '$http', function($routeProvider) {
  $routeProvider.otherwise({redirectTo: '/'});
}]);
