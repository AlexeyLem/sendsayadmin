App.controller('favoritesCtrl', [
    '$scope',
    '$rootScope',
    function ($scope, $rootScope) {

        $scope.removeFromFavorites = function(id) {
        	_log('removeFromFavorites: '+id)
            $scope.$emit('removeFromFavorites', { ID: id });
        };

        $scope.showDrop = function() {

        };

        $scope.$on('favoriteUserChange', function(event, data) {

            var list = $scope.favoriteUsers,
            	index = $.inArray(data.ID, list);

            if(index == -1) {
                list.push(data.ID);
            }else{
               delete list[index];
            }
			
			$scope.localStorage.set('favoriteUsers', list.join(','));
        });
        
        _log('favoritesCtrl ...');
    }
]);
