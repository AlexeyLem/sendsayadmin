module.exports = (function(type) {

	var source = {};

	source.js = {

		'lib': [

			'libs/jquery/dist/jquery.min.js',
			'libs/lodash/lodash.min.js',
			'libs/bootstrap/dist/js/bootstrap.min.js',

			'libs/angular/angular.js',
			'libs/angular-ui-router/release/angular-ui-router.js',
			'libs/angular-local-storage/dist/angular-local-storage.min.js',
			'libs/angular-animate/angular-animate.js',
			'libs/angular-bootstrap/ui-bootstrap.js',
			'libs/angular-bootstrap/ui-bootstrap-tpls.js',

			'libs/moment/moment.js',
			'libs/angular-moment/angular-moment.js',
			'libs/moment/locale/ru.js',
		
		],
		
		'app': [
			
			'helpers/global.js',

			'app.js',
			
			'services/auth.js',
			'services/api.js',
			'services/sumstat_favorites.js',

			'filters/module.js',
			'filters/pagination.js',
			'filters/search.js',

			'directives/tarif_info.js',

			'pages/root/config.js',
			'pages/root/main.ctrl.js',
			'pages/root/favorites.ctrl.js',
			'pages/root/navigation.ctrl.js',
			'pages/root/topsearch.ctrl.js',
			'pages/sumstat/module.js',
			'pages/sumstat/list/controller.js',
			'pages/sumstat/user_view/controller.js'

		]

	};

	source.css  = {

		'libs': [
			'libs/bootstrap/dist/css/bootstrap.css',
			'libs/bootstrap/dist/css/bootstrap-theme.css',
		],

		'app': [
			'css/animation.css',
			'css/app.css'
		]
	};

	return source;

})();