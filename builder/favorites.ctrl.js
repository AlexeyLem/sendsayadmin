App.controller('favoritesCtrl', [
    
    '$scope',
    '$rootScope',
    'SumstatFavorites',

    function ($scope, $rootScope, SumstatFavorites) {

        $rootScope.sumstatFavoriteUsers = SumstatFavorites.getList();

        $rootScope.isFavoriteUser = function(id) {
            return SumstatFavorites.inList(id);
        };

        $scope.removeFromFavorites = function(id) {
        	
            _log('removeFromFavorites: '+id);
            SumstatFavorites.Remove(id);
        
        };

        $scope.$watch('sumstatFavoriteUsers', function() {

            _log('event', arguments);

        });

        // Изменение списка избранных

        $scope.$on('SumstatFavorites_Change', function(event, list) {

            // $rootScope.sumstatFavoriteUsers = list;
        
        });


        $scope.showDrop = function() {

        };


        _log('favoritesCtrl ...');
    }
]);
