
App.directive('saFavorites', function () {
    return {
        scope: {
            list: "="
        },
        // replace: true,
        restrict: 'E',
        templateUrl: 'directives/favorites/template.html',
        controller: function($scope, $element, $attrs, $transclude) {
            // _log('localStorage:',localStorage);
            $scope.removeItem = function(id) {
            	$scope.$broadcast('removeFromFavorites', { id: id });
            };

            $scope.showDrop = function() {

            };
        }
    };
})
.controller('favoritesCtrl', [
    '$scope',
    '$rootScope',
    function ($scope, $rootScope) {
        _log('favoritesCtrl ...');
        $scope.favList = ['abg','abtoys'];

        $rootScope.$on('changeUserList', function(data) {

            $scope.favoritUsers = {};

            $.each($scope.favList, function(i, id) {
                $scope.favoritUsers[id] = $rootScope.userList[id];
            });
        });
        
        // $scope.
        /* >>>>>>>>>>>>>
        $scope.favoritUsers = localStorageService.get('favoritUsers');
        
        $scope.$watch('favoritUsers', function(value) {
            _log('$watch:favoritUsers value:', value);
            localStorageService.set('favoritUsers',value);
        });
        */
        // <<<<<<<<<<<<<

        $rootScope.$on('addToFavorites', function(event, data) {

            _log('Event saFavorites > addToFavorites:', data);

            if(typeof $scope.favoritUsers[data.id] == 'undefined') {
                 $scope.favoritUsers[data.id] = $rootScope.userList[data.id];
            }

        });
        
        _log('favoritesCtrl ...');
    }
]);