/**
 * Created by sanzeeb on 8/26/14.
 */

var userApp = angular.module('xApp',['ui.bootstrap']);
userApp.controller('PaginationDemoCtrl' , ['$scope','$http',function ($scope,$http) {

    $scope.massData = massData;
    $scope.currentPage = 1;
    $scope.maxSize = 6;
    $scope.itemsPerPage = 10;
    $scope.bigTotalItems = $scope.massData.length;
    $scope.bigCurrentPage = 1;
    $scope.content = $scope.massData.slice(1,$scope.itemsPerPage);

    $scope.curPage = 0;
    $scope.startOffset = 0;
    $scope.endOffset = 0;

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function() {
        $scope.curPage = ($scope.bigCurrentPage-1);
        $scope.startOffset = $scope.curPage * $scope.itemsPerPage;
        $scope.endOffset   =   ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
        $scope.content = $scope.massData.slice($scope.startOffset,$scope.endOffset);
    };

    $scope.searchData=function(){
        if($scope.customItem.length > 5 ){
        $http({
            url: BASE + 'test/fd',
            method: 'POST',
            data: {'cd':$scope.customItem}


        }).success(function(data,status){
            $scope.massData = data;
            $scope.bigTotalItems = $scope.massData.length;
            $scope.pageChanged();
           // console.log($scope.curPage, $scope.startOffset, $scope.endOffset );
        });
        }else{
            $scope.massData = massData;
            $scope.bigTotalItems = massData.length;
        };
        return false;
    };

}]);