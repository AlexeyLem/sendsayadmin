App.controller('favoritesCtrl', [
    
    '$scope',
    '$rootScope',
    'SumstatFavorites',

    function ($scope, $rootScope, SumstatFavorites) {


        $rootScope.isFavoriteUser = function(id) {
            return SumstatFavorites.inList(id);
        };

        $scope.removeFromFavorites = function(id) {
        	
            _log('removeFromFavorites: '+id);
            SumstatFavorites.Remove(id);
            // $scope.$emit('sumstatRemoveFromFavorites', { ID: id });
        
        };

        $scope.showDrop = function() {

        };

        $rootScope.$watch('sumstat_favoriteUsers', function() {

            _log('event', arguments);

        });

        $scope.$on('sumstatFavoriteUserChange', function(event, data) {
            
            
        });
        
        // Удаление пользователя из избранных
        $rootScope.$on('sumstatRemoveFromFavorites', function(event, user) {
            
            var index = $.inArray(user.ID, $rootScope.sumstat_favoriteUsers);

            if(index!=-1) {
                $rootScope.sumstat_favoriteUsers.splice(index,1);
                $scope.localStorage.set('sumstat_favoriteUsers', $rootScope.sumstat_favoriteUsers.join(','));
            }

        });


        // Удаление пользователя из избранных
        /*
        $scope.$on('sumstat:removeFromFavorites', function(event, user) {
            
            var index = $.inArray(user.ID, $rootScope.sumstat_favoriteUsers);

            if(index!=-1) {
                $rootScope.sumstat_favoriteUsers.splice(index,1);
                $rootScope.localStorage.set('sumstat_favoriteUsers', $rootScope.sumstat_favoriteUsers.join(','));
            }

        });
        */
        _log('favoritesCtrl ...');
    }
]);
