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

	'amMoment',
	'$rootScope',
	'$state',
	'$stateParams',
	
	function(amMoment, $rootScope, $state, $stateParams) {

		_log('App run ...');

		amMoment.changeLocale('ru');

		$rootScope.$state = $state;
		$rootScope.$stateParams = $stateParams;

		$rootScope.user = null;

		// Здесь мы будем проверять авторизацию
		
		/*
		$rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
			
			_log('Event $stateChangeStart ... ');

			Auth.checkAccess(event, toState, toParams, fromState, fromParams);
		});
		*/
	}
]);