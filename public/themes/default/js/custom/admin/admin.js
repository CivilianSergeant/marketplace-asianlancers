/**
 * Created by sanzeeb on 8/25/14.
 */

var requestPath = BASE + 'admin/' ;
var userApp = angular.module('userApp',['ui.bootstrap']);
var ModalInstanceCtrl = function ($scope, $modalInstance) {
            $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
               // console.log('data print');
            };
            };

var userTypeList = [{name:'Client', value:'Client'},
                    {name:'Individual', value:'Individual'},
                    {name:'Agency', value:'Agency'},];

userApp.controller('AdminController',['$scope','$http','$location','$anchorScroll','$modal'
            ,function($scope,$http,$location,$anchorScroll,$modal){


   (typeof users !== 'undefined')? ($scope.userList = users):($scope.userList = []);

        $scope.successMsg = '';
        $scope.errorMsg = '';

    if(typeof pageName !=='undefined')
    {
        $scope.userTypeList = userTypeList;

        $scope.form={};
        $scope.form._token = token;

        $scope.form.userList = $scope.userTypeList[0].name;
    }





    $scope.deactivateUser = function($index,$id)
    {

        if(confirm('Are you sure to deactivate this user ?'))
        {
            if($scope.userList[$index].banned == 1)
                $scope.userList[$index].banned = 0;
            else if($scope.userList[$index].banned == 0)
                $scope.userList[$index].banned = 1;

            $http({
                url : requestPath+'active-deactivate-user',
                method: "POST",
                data: {user_id:$id}
            }).success(function(data,status){
            });
        }
    }



    $scope.DisplayProfile = function(index)
    {
        var selectedUser = index;

        $http({
            url : requestPath+'set-profile-to-session',
            method: 'POST',
            data : {id: selectedUser.id}
        }).success(function(){
                if(selectedUser.user_type == 'Freelancer')
                    /*return false;*/
                     window.location = BASE+'freelancer/overview';
                else if(selectedUser.user_type == 'Client')
                    window.location = BASE+'client';
                else if(selectedUser.user_type == 'Admin')
                    window.location = BASE+'admin';
                else
                    return false;
        });


    }

    $scope.addUser = function(){
        $scope.successMsg = '';
        $scope.errorMsg = '';
        $http({
            url : requestPath+'create-default-profile',
            method: "POST",
            data: $scope.form
        }).success(function(data,status){

            if((status == 200) && (data.status == 'Error'))
            {
                console.log(data.message);
                $scope.errorMsg = data.message;
            }
            else if((status == 200) && (data.status == 'Success')){
                $scope.successMsg = data.message;
            }else{
                $scope.errorMsg = 'Password changing fail.';
            }

        });

        return false;

    }

        //////////////// Pagination //////////



        $scope.initPage = function(){
            $scope.massData = $scope.userList;
            $scope.currentPage = 1;
            $scope.maxSize = 3;
            $scope.itemsPerPage = 10;
            $scope.bigTotalItems = $scope.massData.length;
            $scope.bigCurrentPage = 1;
            $scope.content = $scope.massData.slice(1,$scope.itemsPerPage);

            $scope.curPage = 0;
            $scope.startOffset = 0;
            $scope.endOffset = 0;

        };

        $scope.initPage();

        //console.log($scope.massData.length);
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
                    url: requestPath + 'filter-users-by-email',
                    method: 'POST',
                    data: {'email':$scope.customItem}


                }).success(function(data,status){
                    $scope.massData = data;
                    $scope.bigTotalItems = $scope.massData.length;
                    $scope.pageChanged();
                    // console.log($scope.curPage, $scope.startOffset, $scope.endOffset );
                });
            }else{
                $scope.initPage();

            };
            return false;
        };
        //////////////// Pagination //////////

}]);



