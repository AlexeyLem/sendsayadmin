'use strict';

App.config([
'$stateProvider',
'$urlRouterProvider',
'$locationProvider',
'localStorageServiceProvider',
function ($stateProvider, $urlRouterProvider, $locationProvider, localStorageServiceProvider) {

	_log('app config ...');

	$locationProvider.html5Mode(true);
	localStorageServiceProvider.setPrefix('SA');
    
		// localStorageServiceProvider.setStorageType('localStorage');

	$urlRouterProvider
		.when('/', '/sumstat')
		.otherwise("/404");

/*
	$stateProvider
		.state("home", {
            abstract: true,
            template: '<div ui-view></div>',
            resolve:  [
                '$http',
                '$rootScope',
                '$state',
                '$stateParams',
                'localStorageService',
                function ($http, $rootScope, $state, $stateParams, localStorageService) {

                    $rootScope.$state = $state;
                    $rootScope.$stateParams = $stateParams;
                    $rootScope.localStorage = localStorageService;

                   	$rootScope.userList = {};
                    $rootScope.userOrder = [];
                    $rootScope.activeUsers = [];
                    $rootScope.blockedUsers = [];

                    // Избранные пользовтели
                    if(!localStorageService.get('favoriteUsers')) {
                    	$rootScope.favoriteUsers = [];
                    }else{
                    	$rootScope.favoriteUsers = (localStorageService.get('favoriteUsers')).split(',');
                    }
                    
                    $rootScope.isFavoriteUser = function(id) {
                    	return ($.inArray(id,$rootScope.favoriteUsers)!=-1);
                    };

                    // Удаление пользователя из избранных
                    $rootScope.$on('removeFromFavorites', function(event, user) {
                    	var index = $.inArray(user.ID, $rootScope.favoriteUsers);
                    	if(index!=-1) {
                    		$rootScope.favoriteUsers.splice(index,1);
                    		localStorageService.set('favoriteUsers',$rootScope.favoriteUsers.join(','))
                    	}
                    });

                    return $http.get('sumstat.json').success(function(data) {
                    	
                        $rootScope.userOrder = data.map(function(user) {
                        	
                        	$rootScope.userList[user.ID] = user;

                            if (user.BLOCKED=="0") {
                                $rootScope.blockedUsers.push(user.ID);
                            }else{
                                $rootScope.activeUsers.push(user.ID);
                            }

                            return user.ID;
                        });
                        
                        $rootScope.$emit('changeUserList');
                    });
                }
            ]
		});
		*/
}]);