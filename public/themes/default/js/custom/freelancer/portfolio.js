/**
 * Created by Himel on 9/9/14.
 */
var portfolioApp = angular.module('portfolioApp',[]);
portfolioApp.controller('portfolioController',['$scope',function($scope){

    $scope.errorMsg = errorMsg;
    if(errorMsg)
        $scope.showFrm = 1;

    $scope.showFrm = 0;

    $scope.AddForm = function()
    {
        $scope.showFrm = 1;
    }

}]);