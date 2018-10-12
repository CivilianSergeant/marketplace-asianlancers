/**
 * Created by Himel on 9/24/14.
 */
var notifyApp = angular.module('notifyApp',['ui.bootstrap']);
notifyApp.controller('notifyController',['$scope','$http',function($scope,$http){

    $scope.data = data;
    $scope.notification = notification;

    $scope.setStatus = function(val,type)
    {
        switch(type)
        {
            case 'TI':
                $http({
                    url    : BASE + 'freelancer/set-team-invitation',
                    method : "POST",
                    data   : {status : val+'ed',id:$scope.data.id, nid:$scope.notification.id}
                }).success(function(data,status){
                    window.location.reload();
                });
                break;
        }
    }
}]);