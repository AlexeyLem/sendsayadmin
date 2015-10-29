define(['app'], function (app) {
    app.controller('HomeCtrl', function ($scope) {
        $scope.message = "Message from HomeCtrl";
        _log('kuku');
    });
});