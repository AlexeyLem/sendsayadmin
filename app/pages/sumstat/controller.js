'use strict';

angular.module('sumstat', [ 'ui.router', 'app' ])

.controller('SumstatCtrl', [
    '$scope',
    '$http',
    '$stateParams',
    function ($scope, $http, $stateParams) {
        $scope.message = "Message from HomeCtrl";
        // _log('sumstat Module:SumstatCtrl Controller');
        $http.get('sumstat.json').success(function(data) {
            
            _log(data[0]);
            
            $scope.users = data;
            $scope.activeUsers = [];
            $scope.blockedUsers = [];
            $scope.usersShow = $scope.users.slice(0,10);
            
            $.each($scope.users, function(index, user) {
                if (user.BLOCKED=="0") {
                    $scope.blockedUsers.push(user.ID);
                }else{
                    $scope.activeUsers.push(user.ID);
                }
            });
            
            $scope.addToFavorites = function(id) {
                _log('Add to Favorites: '+id);
            };
            
            $scope.page = $stateParams.page;
        });
    }
]);
