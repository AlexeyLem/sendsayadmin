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

function _log() {
	var m = arguments.length;
	for (var i = 0; i < m; i += 1) {
		if (typeof arguments[i] == 'object') {
			console.dir(arguments[i]);
		} else {
			console.log(arguments[i]);
		}
	}
};