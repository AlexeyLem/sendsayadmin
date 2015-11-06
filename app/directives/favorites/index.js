
angular.module("app", [])

.directive('saFavorites', function () {
    return {
        scope: {
            list: "="
        },
        // replace: true,
        restrict: 'E',
        templateUrl: 'directives/favorites/template.html',
        controller: function($scope, $element, $attrs, $transclude) {
            // _log('localStorage:',localStorage);
            
            _log('controller attrs', $scope.list);

            $scope.removeItem = function(id) {
            	$scope.$broadcast('removeFromFavorites', { id: id });
            };

            $scope.showDrop = function() {

            };
        }
    };
});