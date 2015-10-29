require.config({
    
    baseUrl: '/',
    
    paths: {
        'angular': './libs/angular/angular',
        'angular-route': './libs/angular-route/angular-route',
        'angularAMD': './libs/angularAMD/angularAMD',
        'jquery': './libs/jquery/dist/jquery.min'
    },
  
    shim: {
        'angular' : {'exports' : 'angular'},
        'angularAMD': ['angular'],
        'angular-route': ['angular']
    },
    // kick start application
    // deps: ['angular', 'app'],
    	priority: [
        "angular"
    ],
    urlArgs: 'version=' + Date.now(),
    
    waitSeconds: 5
});

require([ 'angular', 'app' ], function(angular, app) {
        /*
        var $html = angular.element(document.getElementsByTagName('html')[0]);
        angular.element().ready(function() {
            // bootstrap the app manually
            angular.bootstrap(document, ['app']);
        });
        */
    }
);

function _log() {
    var m = arguments.length;
    for (var i = 0; i < m; i += 1) {
        if (typeof arguments[i] == 'object') {
            console.dir(arguments[i]);
        } else {
            console.log(arguments[i]);
        }
    }
}