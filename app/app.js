'use strict';

var App = angular.module("app", [
	
	'app.sumstat',
	'ui.bootstrap',
	'ui.router',
	'LocalStorageModule',
	'ngAnimate',
	'angularMoment'

]).run(['amMoment',function(amMoment) {
	amMoment.changeLocale('ru');
}]);
