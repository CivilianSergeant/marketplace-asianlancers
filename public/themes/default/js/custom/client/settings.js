/**
 * Created by Himel on 9/17/14.
 */
var clientSettingsApp = angular.module('clientSettingsApp',['ui.bootstrap']);
var requestPath = BASE + 'client/';
clientSettingsApp.controller('clientSettingsController' , ['$scope','$http','$location','$anchorScroll',function ($scope,$http,$location,$anchorScroll) {

    $scope.client=client;

    $scope.changeStatus = function(changed_val,cfield)
    {
        changed_val = changed_val != true?false:true;

        changed_val = !changed_val;
        $scope.successMsg = null;
        $scope.errorMsg = null;

        $http({
            url : requestPath + 'change-widget-status',
            method: 'POST',
            data : {val:changed_val,field:cfield}
        }).success(function(data,status){
            if((status == 200) && (data.status == 200))
            {
                $scope.successMsg = data.msg;

            }else{
                $scope.errorMsg = data.msg;

                $location.hash('top');
                $anchorScroll();

            }
        });


    };

}]);