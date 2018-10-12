/**
 * Created by Himel on 9/17/14.
 */
var freelancerSettings = angular.module('freelancerSettings',['ui.bootstrap']);
var requestPath = BASE + 'freelancer/';
freelancerSettings.controller('FSettingsCtrl' , ['$scope','$http','$location','$anchorScroll',function ($scope,$http,$location,$anchorScroll) {

    $scope.Freelancer=freelancer;

    $scope.changeStatus = function(changed_val,cfield)
    {
        changed_val = changed_val != true?false:true;

        changed_val = !changed_val;
        $scope.successMsg = null;

        $http({
            url : requestPath + 'change-widget-status',
            method: 'POST',
            data : {val:changed_val,field:cfield}
        }).success(function(response,status){
                $scope.successMsg = statusValue+" changed successfully."  ;
                window.location.reload();
        });


    };

}]);