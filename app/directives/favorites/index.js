
App.directive('saFavorites', function () {
    return {
        scope: {
            list: "="
        },
        // replace: true,
        restrict: 'E',
        templateUrl: 'directives/favorites/template.html',
        /*
        controller: function($scope, $element, $attrs, $transclude) {
            // _log('localStorage:',localStorage);
            
        },
        */
        compile: function (tElement, tAttrs, transclude) {
            return {
                pre: function (scope, iElement, iAttrs, controller) {
                    
                    _log('saFavorites arguments:', arguments);

                    if(typeof scope.list == 'string') {
                        if(scope.list=='') {
                            scope.showList = [];
                        }else{
                            scope.showList = scope.list.split(',');
                        }
                    }
                    
                    scope.users = scope.showList.map(function(id) {
                        return scope.userList[id];
                    });

                    _log('showList.userList: ', scope.users );

                },
                post: function postLink(scope, iElement, iAttrs, controller) {
                }
            }
        }
    };
})

.controller('favoritesCtrl', [
    '$scope',
    '$rootScope',
    function ($scope, $rootScope) {
        _log('favoritesCtrl ...');
        $scope.favList = 'aamsystems,abris,abg'.split(','); // ['abg','abtoys'];
        
        /*
        $scope.$watch('favoritUsers', function(value) {
            _log('$watch:favoritUsers value:', value);
            localStorageService.set('favoritUsers',value);
        });
        */
        var list = [],
            userList = $rootScope.userList;

        _log('------ $rootScope.favoriteUsers:', $rootScope.favoriteUsers);
        
        if($rootScope.favoriteUsers) {
            list = ($rootScope.favoriteUsers.toString()).split(',');
        }
        
        _log('list', list);
        $scope.favoriteUsersList = [];
        
        _log('$rootScope.userList: ',$rootScope.userList);
        
        list.forEach(function(id) {
            var _id = $.trim(id);
            _log('ID:'+_id+' / length: '+id.length, $rootScope.userList[_id]);
        });

        $scope.removeItem = function(id) {
            $scope.$broadcast('removeFromFavorites', { ID: id });
        };

        $scope.showDrop = function() {
        };

        $scope.$on('favoriteUserChange', function(event, data) {

            _log('Event saFavorites > addToFavorites:', data);
            var list = $scope.favoriteUsersList;
            var index = $.inArray(data.ID, list);

            if(index == -1) {
                list.push(data.ID);
            }else{
               delete list[index];
            }
            $scope.favoriteUsers = list;

            _log('list: ',list);
            console.dir(list);
            $rootScope.localStorage.set('favoriteUsers', list.join(','));
        });
        
        _log('favoritesCtrl ...');
    }
]);