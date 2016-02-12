'use strict';

var App = angular.module("app", [

	'app.auth',
	'app.sumstat',
	'ui.bootstrap',
	'ui.router',
	'LocalStorageModule',
	'ngAnimate',
	'angularMoment'

]).run([

	'$rootScope',
	'$state',
	'$stateParams',
	'amMoment',
	
	function($rootScope, $state, $stateParams, amMoment) {

		_log('App run ...');

		$rootScope.$on('$stateChangeStart', 
			function(event, toState, toParams, fromState, fromParams, options) {
				_log('$stateChangeStart: ', arguments);
		});

		amMoment.changeLocale('ru');

		$rootScope.$state = $state;
		$rootScope.$stateParams = $stateParams;

		$rootScope.user = null;

	}
]);