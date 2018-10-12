/**
 * Created by sanzeeb on 8/25/14.
 */

var requestPath = BASE + 'admin/' ;
var userApp = angular.module('userApp',['ui.bootstrap']);
var ModalInstanceCtrl = function ($scope, $modalInstance) {
            $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
                console.log('data print');
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
      //  console.log($id,$index);
        //$scope.userList[$id] = 'x';

        //console.log();
        if(confirm('Are you sure to deactivate this user ?'))
        {
            if($scope.userList[$index].banned == 1)
                $scope.userList[$index].banned = 0;
            else if($scope.userList[$index].banned == 0)
                $scope.userList[$index].banned = 1;

           // console.log($scope.userList[$index].activated);
            $http({
                url : requestPath+'active-deactivate-user',
                method: "POST",
                data: {user_id:$id}
            }).success(function(data,status){
              //  console.log(data, status);
            });
        }
    }


    $scope.open = function()
    {
        var html  = '';

        html += '<div class="modal-header"></div>';
        html += '<div class="modal-body pi-section-w pi-section-white piICheck piStylishSelect">';
        html+= '<div class="form-group">';
        html+= '<div class="pi-input-with-icon">';
        html+= '<div class="pi-input-icon"><i class="icon-user"></i></div>';
        html+= '<input type="text" placeholder="First name" id="exampleInputName-1" class="form-control">';
        html+= '</div>';
        html+= '</div>';
        html +=             '</div>';
        html +=             '<div class="modal-footer"></div>';

        var modalInstance = $modal.open({
            template: html,
            controller: ModalInstanceCtrl
            //size: size,
            /*resolve: {
             items: function () {
             return $scope.items;
             }
             }*/
        });

        modalInstance.result.then(function () {
            //$scope.selected = selectedItem;
        }, function () {
            //$log.info('Modal dismissed at: ' + new Date());
        });
    };

    $scope.DisplayProfile = function(index)
    {
        var selectedUser = $scope.userList[index];
        $http({
            url : requestPath+'set-profile-to-session',
            method: 'POST',
            data : {id: selectedUser.id}
        }).success(function(){
                if(selectedUser.user_type == 'Freelancer')
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

}]);



