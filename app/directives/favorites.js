
App.directive('saFavorites', [
    '$rootScope',
    'ngStorage',
    function ($rootScope, $localStorage) {
    
        return {
            replace: true,
            compile:  function(scope, element, attrs) {
                $scope.users = $localStorage.$default('users');
                _log('$scope.users:',$scope.users);
            },
            link: function(scope, element, attrs) {
                
            },
            // templateUrl: 'favorites.html',
            controller: function($scope, $element, $attrs, $transclude, otherInjectables) {
            
                $rootScope.$on('addToFavorites', function(data) {
                    _log('Event saFavorites > addToFavorites:', data);
                });
            }
        };
        
        
        
        /*Метод-фабрика для директивы*/
    }]);